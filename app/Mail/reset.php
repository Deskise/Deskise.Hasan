<?php

namespace App\Mail;

use App\Models\PasswordReset;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class reset extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $reset;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(PasswordReset $reset)
    {
        $this->afterCommit = true;
        $this->queue = 'emails';

        $this->reset=$reset;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.reset');
    }
}
