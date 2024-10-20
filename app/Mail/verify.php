<?php

namespace App\Mail;

use App\Models\Verification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class verify extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $subject = 'Verify Your Account';

    public $verification;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Verification $verification)
    {
        $this->afterCommit = true;
        $this->queue = 'emails';

        $this->verification = $verification;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.verify');
    }
}
