<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Http;
use App\Mail\WelcomeMail;
use App\Mail\PasswordResetMail;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        // Support Firebase ID token registration: if frontend authenticates with Firebase,
        // it can send `id_token` to this endpoint. We verify it via Google's tokeninfo endpoint.
        $idToken = $request->input('id_token');
        if ($idToken) {
            $payload = $this->verifyFirebaseIdToken($idToken);
            if (! $payload || empty($payload['email'])) {
                return response()->json(['message' => 'ID token inválido.'], 422);
            }

            // Find or create user based on Firebase email
            $email = $payload['email'];
            $name = $payload['name'] ?? $request->input('name', 'Usuario Firebase');

            $user = User::firstOrCreate(
                ['email' => $email],
                ['name' => $name, 'password' => Hash::make(Str::random(40)), 'role' => $request->input('role', 'buyer')]
            );

            Auth::login($user);

            try {
                $token = $user->createToken($request->input('device_name', 'api-token'))->plainTextToken;
            } catch (\Throwable $e) {
                logger()->warning('Token creation failed: '.$e->getMessage());
                $token = null;
            }

            return response()->json(['user' => $user, 'token' => $token], 201);
        }

        $data = $request->only('name','email','password','password_confirmation','role');

        // Validate input (email must be unique)
        $validator = Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'nullable|in:buyer,seller,admin',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => $data['role'] ?? 'buyer',
        ]);

        // Send welcome email (queued)
        try {
            Mail::to($user->email)->queue(new WelcomeMail($user));
        } catch (\Exception $e) {
            logger()->error('WelcomeMail queue failed: '.$e->getMessage());
        }

        Auth::login($user);

        // Create a personal access token for API usage (useful for SPA)
        try {
            $token = $user->createToken($request->input('device_name', 'api-token'))->plainTextToken;
        } catch (\Throwable $e) {
            logger()->warning('Token creation failed: '.$e->getMessage());
            $token = null;
        }

        return response()->json(['user' => $user, 'token' => $token], 201);
    }

    public function login(Request $request)
    {
        // Support Firebase ID token login
        $idToken = $request->input('id_token');
        if ($idToken) {
            $payload = $this->verifyFirebaseIdToken($idToken);
            if (! $payload || empty($payload['email'])) {
                return response()->json(['message' => 'ID token inválido.'], 422);
            }

            $email = $payload['email'];
            $name = $payload['name'] ?? 'Usuario Firebase';

            $user = User::firstOrCreate(
                ['email' => $email],
                ['name' => $name, 'password' => Hash::make(Str::random(40)), 'role' => 'buyer']
            );

            Auth::login($user);

            try {
                $token = $user->createToken($request->input('device_name', 'api-token'))->plainTextToken;
            } catch (\Throwable $e) {
                logger()->warning('Token creation failed: '.$e->getMessage());
                $token = null;
            }

            return response()->json(['user' => $user, 'token' => $token], 200);
        }

        $credentials = $request->only('email','password');

        $validator = Validator::make($credentials, [
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Rate limiting applied in middleware (throttle)
        if (Auth::attempt($credentials)) {
            if (method_exists($request, 'hasSession') && $request->hasSession()) {
                $request->session()->regenerate();
            }
            $user = Auth::user();

            // If API login requested (device_name provided) create a Sanctum token
            if ($request->filled('device_name') || $request->wantsJson()) {
                // Ensure user model uses HasApiTokens (User model includes it)
                $token = $user->createToken($request->input('device_name', 'api-token'))->plainTextToken;
                return response()->json(['user' => $user, 'token' => $token], 200);
            }

            return response()->json(['user' => $user], 200);
        }

        return response()->json(['message' => 'Las credenciales no son válidas.'], 401);
    }

    /**
     * Verify a Firebase ID token using Google's tokeninfo endpoint.
     * Returns the decoded payload array on success, null on failure.
     */
    protected function verifyFirebaseIdToken(string $idToken)
    {
        try {
            $resp = Http::get('https://oauth2.googleapis.com/tokeninfo', ['id_token' => $idToken]);
            if ($resp->ok()) {
                $data = $resp->json();
                // tokeninfo returns fields like email, email_verified, name, sub (uid)
                return $data;
            }
        } catch (\Throwable $e) {
            logger()->warning('Firebase token verification failed: '.$e->getMessage());
        }
        return null;
    }

    public function logout(Request $request)
    {
        // If token-based (Sanctum), revoke current access token
        if ($request->user() && method_exists($request->user(), 'currentAccessToken') && $request->user()->currentAccessToken()) {
            $request->user()->currentAccessToken()->delete();
            return response()->json(['message' => 'Token revocado.']);
        }

        // Otherwise session logout
        Auth::logout();
        if (method_exists($request, 'hasSession') && $request->hasSession()) {
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        }
        return response()->json(['message' => 'Sesión cerrada.']);
    }

    public function forgotPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Generate token and store manually to be able to send custom email if Password broker is not configured
        $token = Str::random(64);
        \DB::table('password_resets')->insert([
            'email' => $request->input('email'),
            'token' => $token,
            'created_at' => now(),
        ]);

        $resetUrl = url('/password/reset') . '?token=' . $token . '&email=' . urlencode($request->input('email'));

        try {
            Mail::to($request->input('email'))->queue(new PasswordResetMail($resetUrl));
            return response()->json(['message' => 'Enlace de recuperación enviado.']);
        } catch (\Exception $e) {
            logger()->error('PasswordResetMail queue failed: '.$e->getMessage());
            return response()->json(['message' => 'No se pudo enviar el enlace.'], 500);
        }
    }

    public function resetPassword(Request $request)
    {
        $data = $request->only('email','token','password','password_confirmation');

        $validator = Validator::make($data, [
            'email' => 'required|email|exists:users,email',
            'token' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $status = Password::reset($data, function ($user, $password) {
            $user->password = Hash::make($password);
            $user->save();
        });

        if ($status == Password::PASSWORD_RESET) {
            return response()->json(['message' => 'Contraseña actualizada correctamente.']);
        }

        return response()->json(['message' => 'Token inválido o expirado.'], 400);
    }

    public function user(Request $request)
    {
        return response()->json(['user' => Auth::user()]);
    }
}
