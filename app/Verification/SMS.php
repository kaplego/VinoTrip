<?php

namespace App\Verification;

require_once __DIR__ . '/../../vendor/autoload.php';

use Twilio\Rest\Client;

class SMS
{
    public static function start(string $to)
    {
        $twilio = new Client(env('TWILIO_SID'), env('TWILIO_TOKEN'));
        $service = $twilio->verify->v2->services(env('TWILIO_VERIFY_SID'));

        return $service->verifications->create($to, 'sms');
    }

    public static function check(string $to, string $code)
    {
        $twilio = new Client(env('TWILIO_SID'), env('TWILIO_TOKEN'));
        $service = $twilio->verify->v2->services(env('TWILIO_VERIFY_SID'));

        $check = $service->verificationChecks->create([
            'to' => $to,
            'code' => $code
        ]);

        return $check->status;
    }

    public static function get(string $sid)
    {
        $twilio = new Client(env('TWILIO_SID'), env('TWILIO_TOKEN'));
        $service = $twilio->verify->v2->services(env('TWILIO_VERIFY_SID'));

        return $service->verifications($sid)->fetch();
    }

    public static function cancel(string $sid)
    {
        $twilio = new Client(env('TWILIO_SID'), env('TWILIO_TOKEN'));
        $service = $twilio->verify->v2->services(env('TWILIO_VERIFY_SID'));

        return $service->verifications($sid)->update('canceled');
    }

    public static function messageFromStatus(string $status)
    {
        return match ($status) {
            'accepted' => "Le code est correct.",
            'pending' => "Le code est incorrect.",
            'canceled' => "La vérification a été annulée.",
            'max_attempts_reached' => "Vous avez atteint le nombre maximal d'essais.",
            'deleted' => "La vérification a été supprimée.",
            'failed' => "La vérification a échoué.",
            'expired' => "La vérification a expiré.",
            default => "Une erreur s'est produite."
        };
    }
}
