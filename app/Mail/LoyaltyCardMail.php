<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Models\User;

class LoyaltyCardMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function build()
    {
        $directoryPath = 'qrcodes';

        // Vérifier que le dossier existe
        if (!Storage::disk('public')->exists($directoryPath)) {
            Storage::disk('public')->makeDirectory($directoryPath);
        }

        // Génération du QR Code contenant le numéro de téléphone
        $qrCodeFileName = 'qrcode_' . $this->user->id . '.png';
        $qrCodePath = storage_path('app/public/' . $directoryPath . '/' . $qrCodeFileName);

        $qrCodeData = QrCode::format('png')
            ->size(300)
            ->margin(2)
            ->generate($this->user->telephone); // ✅ Ajout du téléphone

        Storage::disk('public')->put($directoryPath . '/' . $qrCodeFileName, $qrCodeData);

        // Génération du PDF contenant le QR Code
        $pdfFileName = 'user_' . $this->user->id . '.pdf';
        $pdf = Pdf::loadView('emails.qrcode_pdf', [
                'qrCodePath' => asset('storage/' . $directoryPath . '/' . $qrCodeFileName),
                'user' => $this->user
            ])
            ->setPaper('a4', 'portrait');

        $pdfPath = storage_path('app/public/' . $directoryPath . '/' . $pdfFileName);
        Storage::disk('public')->put($directoryPath . '/' . $pdfFileName, $pdf->output());

        // Construction de l'email
        return $this->view('emails.loyalty_card')
                    ->with(['user' => $this->user])
                    ->attach($pdfPath, [
                        'as' => 'qrcode.pdf',
                        'mime' => 'application/pdf',
                    ])
                    ->attach($qrCodePath, [
                        'as' => 'qrcode.png',
                        'mime' => 'image/png',
                    ])
                    ->withSwiftMessage(function ($message) use ($pdfPath, $qrCodePath) {
                        // Supprimer les fichiers après envoi
                        register_shutdown_function(function () use ($pdfPath, $qrCodePath) {
                            if (file_exists($pdfPath)) {
                                unlink($pdfPath);
                            }
                            if (file_exists($qrCodePath)) {
                                unlink($qrCodePath);
                            }
                        });
                    });
    }
}
