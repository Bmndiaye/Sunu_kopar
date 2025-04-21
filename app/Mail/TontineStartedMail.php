<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Tontine;
use App\Models\User;

class TontineStartedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $tontine;
    public $user;

    /**
     * Create a new message instance.
     */
    public function __construct(Tontine $tontine, User $user)
    {
        $this->tontine = $tontine;
        $this->user = $user;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'La tontine ' . $this->tontine->libelle . ' a démarré',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.tontine-started',
            with: [
                'tontine' => $this->tontine,
                'user' => $this->user,
            ],
        );
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