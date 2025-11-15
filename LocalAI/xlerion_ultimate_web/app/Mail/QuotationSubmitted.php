<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class QuotationSubmitted extends Mailable
{
    use Queueable, SerializesModels;

    public $quotationData;

    /**
     * Create a new message instance.
     */
    public function __construct($quotationData)
    {
        $this->quotationData = $quotationData;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Nueva Solicitud de Cotización de Xlerion',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.quotation.submitted', // Usaremos una plantilla Blade para el contenido
            with: [
                'name' => $this->quotationData['name'],
                'email' => $this->quotationData['email'],
                'service_type' => $this->quotationData['service_type'],
                'project_details' => $this->quotationData['project_details'],
                'time_factor' => $this->quotationData['time_factor'] ?? 'No especificado',
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}