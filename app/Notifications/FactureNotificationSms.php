<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use App\Models\Cotisation;
use App\Models\Tontine;
use App\Services\TwilioService;

class FactureNotificationSms extends Notification implements ShouldQueue
{
    use Queueable;

    protected $cotisation;
    protected $tontine;

    public function __construct(Cotisation $cotisation, Tontine $tontine)
    {
        $this->cotisation = $cotisation;
        $this->tontine = $tontine;
    }

    public function via($notifiable)
    {
        return ['twilio'];
    }

    public function toTwilio($notifiable)
    {
        $message = "Bonjour {$notifiable->name}, votre cotisation de {$this->cotisation->montant} FCFA pour la tontine '{$this->tontine->nom}' a bien été enregistrée.";

        app(TwilioService::class)->sendSms($notifiable->phone, $message);
    }
}
