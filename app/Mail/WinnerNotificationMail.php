<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class WinnerNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $winner;
    public $tontine;

    public function __construct($winner, $tontine)
    {
        $this->winner = $winner;
        $this->tontine = $tontine;
    }

    public function build()
    {
        $directoryPath = 'winner_notifications';

        // Vérifier que le dossier existe, sinon le créer
        if (!Storage::disk('public')->exists($directoryPath)) {
            Storage::disk('public')->makeDirectory($directoryPath);
        }

        // Générer le fichier PDF avec les données du gagnant et de la tontine
        $pdfFileName = 'winner_' . $this->winner->id . '.pdf';
        $pdfPath = Storage::disk('public')->path($directoryPath . '/' . $pdfFileName);

        $pdf = Pdf::loadView('emails.winner_notification', [
            'winner' => $this->winner,
            'tontine' => $this->tontine,
        ]);

        // Sauvegarder le PDF dans le répertoire public
        Storage::disk('public')->put($directoryPath . '/' . $pdfFileName, $pdf->output());

        // Envoyer l'e-mail avec le PDF attaché
        return $this->view('emails.winner_notification')
                    ->with([
                        'winner' => $this->winner,
                        'tontine' => $this->tontine,
                    ])
                    ->attach($pdfPath, [
                        'as' => $pdfFileName,
                        'mime' => 'application/pdf',
                    ])
                    ->withSwiftMessage(function ($message) use ($pdfPath) {
                        // Supprimer le fichier après l'envoi
                        register_shutdown_function(function () use ($pdfPath) {
                            if (file_exists($pdfPath)) {
                                unlink($pdfPath);
                            }
                        });
                    });
    }
}
