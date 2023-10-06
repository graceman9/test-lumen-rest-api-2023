<?php

namespace App\Services;

use App\Contracts\Service\MailServiceInterface;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class MailService implements MailServiceInterface
{
    public function __construct()
    {
    }

    public function sendRecovePasswordMail(User $user, string $verificationToken)
    {
        // FIXME: maybe do it in laravel-style, but just for simplicity
        // FIXME: transaction?
        $appUrl = env('APP_URL') . ':' . env('APP_PORT');
        $urlPath = '/api/user/recover-password/verify';
        $jsonBody = json_encode(['verification_token' => $verificationToken, 'new_password' => '***YOUR NEW PASSWORD***']);
        $text = "Comfirm password change by sending PATCH request to {$appUrl}{$urlPath} with JSON body `{$jsonBody}`";

        Mail::raw($text, function ($msg) use ($user, $appUrl) {
            $msg->subject('Recover password for ' . $appUrl);
            $msg->to($user->email);
            $msg->from(['example@example.com']);
        });
    }
}
