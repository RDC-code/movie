<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ForgotPassword extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
     public function __construct($data)
        {
            $this->data = $data;
        }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Forgot Password',
        );
    }

    /**
     * Get the message content definition.
     */
     public function build()
        {
            // Basahin ang HTML file
            $html = file_get_contents(base_path('../frontend/sendtaskemail.html'));

            // Replace placeholders
            $html = str_replace('{{title}}', $this->data['title'] ?? '', $html);
            $html = str_replace('{{description}}', $this->data['description'] ?? '', $html);

            return $this->subject('New Task Assigned')
                        ->html($html);
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
