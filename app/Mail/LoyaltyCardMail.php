<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class LoyaltyCardMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $qrCodePath;

    public function __construct(User $user, $qrCodePath)
    {
        $this->user = $user;
        $this->qrCodePath = $qrCodePath;
    }

    public function build()
    {
        $directoryPath = 'qrcodes';

        // Vérifier que le dossier existe
        if (!Storage::disk('public')->exists($directoryPath)) {
            Storage::disk('public')->makeDirectory($directoryPath);
        }

        $pdfFileName = 'user' . $this->user->id . '.pdf';
        $pdfPath = storage_path('app/public/' . $directoryPath . '/' . $pdfFileName);

        // Générer le PDF
        $pdf = Pdf::loadView('emails.loyalty_card', ['user' => $this->user]);
        Storage::disk('public')->put($directoryPath . '/' . $pdfFileName, $pdf->output());

        return $this->view('emails.loyalty_card')
                    ->with(['user' => $this->user])
                    ->attach($pdfPath, [
                        'as' => $pdfFileName,
                        'mime' => 'application/pdf',
                    ])
                    ->attach($this->qrCodePath, [
                        'as' => 'qrcode.png',
                        'mime' => 'image/png',
                    ])
                    ->withSwiftMessage(function ($message) use ($pdfPath) {
                        // Supprimer les fichiers après envoi
                        register_shutdown_function(function () use ($pdfPath) {
                            if (file_exists($pdfPath)) {
                                unlink($pdfPath);
                            }
                        });
                    });
    }
}
