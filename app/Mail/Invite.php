<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Invite extends Mailable
{
    use Queueable, SerializesModels;

    public $invited_user;
    public $active_user;
    public $code;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct( $active_user, $invited_user, $code )
    {
	    $this->active_user = $active_user;
        $this->invited_user = $invited_user;
        $this->code = $code;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
	    return $this->from('no-reply@newvoices-hh.de')
	               ->markdown('emails.invite');
    }
}
