<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Queue\SerializesModels;

class QuotationRequestNotification extends Mailable
{
    use Queueable, SerializesModels;

    public array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Nouvelle demande de devis - ' . $this->data['quotation_number'],
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.quotation_notification',
        );
    }

    public function attachments(): array
    {
        if (!empty($this->data['attachment_path']) && \Storage::disk('public')->exists($this->data['attachment_path'])) {
            $fullPath = \Storage::disk('public')->path($this->data['attachment_path']);
            $mimeType = mime_content_type($fullPath) ?: 'application/octet-stream';

            return [
                Attachment::fromStorageDisk('public', $this->data['attachment_path'])
                    ->as(basename($this->data['attachment_path']))
                    ->withMime($mimeType),
            ];
        }

        return [];
    }
}
