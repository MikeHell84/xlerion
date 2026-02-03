<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeMail;
use App\Mail\PasswordResetMail;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $data = $request->only('name','email','password','password_confirmation','role');

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

        return response()->json(['user' => $user], 201);
    }

    public function login(Request $request)
    {
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
            $request->session()->regenerate();
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

    public function logout(Request $request)
    {
        // If token-based (Sanctum), revoke current access token
        if ($request->user() && method_exists($request->user(), 'currentAccessToken') && $request->user()->currentAccessToken()) {
            $request->user()->currentAccessToken()->delete();
            return response()->json(['message' => 'Token revocado.']);
        }

        // Otherwise session logout
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
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
