<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewInvoice extends Mailable
{
    use Queueable, SerializesModels;

    public $invoice;

    public $subject;

    public $body;



    /**
     * Create a new message instance.
     */
    public function __construct($invoice, $subject, $body)
    {
        $this->invoice = $invoice;
        $this->subject = $subject;
        $this->body = $body;
    }


    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->subject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'mail.new-invoice',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        $filePath = 'invoices/' . $this->invoice->customer->uuid . '/' . $this->invoice->invoice_id . '.pdf';

        if (!\Storage::exists($filePath)) {
            return [];
        }

        return [

            Attachment::fromStorage($filePath)
                ->as($this->invoice->invoice_id . '.pdf')
                ->withMime('application/pdf'),
        ];
    }
}
