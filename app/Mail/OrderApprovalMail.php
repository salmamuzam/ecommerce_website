<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;

use Illuminate\Contracts\Queue\ShouldQueue;

use Illuminate\Mail\Mailable;

use Illuminate\Mail\Mailables\Content;

use Illuminate\Mail\Mailables\Envelope;

use Illuminate\Queue\SerializesModels;

class OrderApprovalMail extends Mailable

{

    use Queueable, SerializesModels;

    public $order;

    /**

     * Create a new message instance.

     *

     * @param mixed $order

     */

    public function __construct($order)

    {

        $this->order = $order;

    }

    /**

     * Get the message envelope.

     */

    public function envelope(): Envelope

    {

        return new Envelope(

            // Subject of the mail
            subject: 'Aaliyah\'s Collection: Order Approved Notification',

        );

    }

    /**

     * Get the message content definition.

     */

    public function content(): Content

    {

        // Content of the email
        // View
        return new Content(

            view: 'emails.order-approved', 

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