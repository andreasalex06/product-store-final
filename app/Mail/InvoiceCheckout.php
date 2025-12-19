<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class InvoiceCheckout extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(
        public Order $order
    )
    {
        //
    }

    /**
     * Get the message envelope.
     */
    // metadata email
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Invoice Checkout #'. $this->order->id,
        );
    }

    /**
     * Get the message content definition.
     */
    // isi email
    public function content(): Content
    {
        return new Content(
            view: 'emails.invoice',
            with: [
                'order' => $this->order
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */

    // lampiran
    public function attachments(): array
    {
        return [];
    }
}
