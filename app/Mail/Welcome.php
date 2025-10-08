<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Welcome extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public User $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        $locale = app()->getLocale();
        $markdownView = "mail.$locale.welcome";

        return $this->from(config('mail.from.address'), config('app.name'))
            ->subject(__('app/mail.subjects.welcome', ['name' => config('app.name')]))
            ->markdown($markdownView)
            ->with([
                'user' => $this->user,
            ]);
    }
}
