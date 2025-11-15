<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Mail\ContactSubmitted;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function show()
    {
    // Provide services config and multipliers used by the quotation form
    $quotationController = new \App\Http\Controllers\QuotationController();
    extract($quotationController->getServicesConfig());

    return view('contacto', compact('servicesConfig', 'effortMultipliers', 'engineTypeMultipliers'));
    }

    public function submit(ContactRequest $request)
    {
        $data = $request->validated();

        // Send mail to primary contact address (configurable later)
        try {
            Mail::to('contactus@xlerion.com')->send(new ContactSubmitted($data));
        } catch (\Exception $e) {
            // swallow mail errors in local env, but log in real app
            \Illuminate\Support\Facades\Log::error('Contact mail failed: '.$e->getMessage());
        }

        return back()->with('success', 'Gracias — tu mensaje fue enviado. Nos pondremos en contacto pronto.');
    }
}
