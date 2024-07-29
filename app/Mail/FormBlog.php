<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class FormBlog extends Mailable
{
    use Queueable, SerializesModels;
  
  	public $formData;

    /**
     * Create a new message instance.
     *
     * @return void
     */
   public function __construct($formData)
    {
        $this->formData = $formData;
    }
  
  
   /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
               
    return $this->view('sendes', ['data' => $this->formData]);
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Notification Blog',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'sendes',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
