<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReminderMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($todays_user, $url)
    {
        $this->todays_user = $todays_user;
        $this->url = $url;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('【スポっとる】本日のスポット予約のご連絡')
                ->markdown('emails.reminder')
                ->with(['user' => $this->todays_user, 'url' => $this->url]);
    }
}
