<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TontineCommence extends Mailable
{
    use Queueable, SerializesModels;

    public $tontine;

    public function __construct($tontine)
    {
        $this->tontine = $tontine;
    }

    public function build()
    {
        return $this->subject('Votre tontine a commencé !')
                    ->view('emails.tontine_commence')
                    ->with(['tontine' => $this->tontine]);
    }
}
