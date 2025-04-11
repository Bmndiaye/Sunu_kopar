<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Cotisation;
use App\Models\Tontine;

class FactureNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $cotisation;
    public $tontine;

    /**
     * Create a new message instance.
     *
     * @param Cotisation $cotisation
     * @param Tontine $tontine
     * @return void
     */
    public function __construct(Cotisation $cotisation, Tontine $tontine)
    {
        $this->cotisation = $cotisation;
        $this->tontine = $tontine;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Facture de cotisation - ' . $this->tontine->nom)
                    ->view('emails.facture-notification');
    }
}