<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMessageMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public array $data;
    /**
     * Create a new message instance.
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        $locale = app()->getLocale();
        $markdownView = "mail.$locale.contact-message";

        return $this->from(
            config('mail.from.address'),
            config('app.name')
        )
            ->replyTo($this->data['email'], $this->data['full_name'])
            ->subject(__('app/mail.subjects.contact', ['name' => config('app.name')]))
            ->markdown($markdownView)
            ->with(['data' => $this->data]);
    }
}
