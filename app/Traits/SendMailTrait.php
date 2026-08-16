<?php

namespace App\Traits;

use App\Mail\SendSmtpMail;
use Illuminate\Support\Facades\Mail;

trait SendMailTrait
{
    protected function sendMail($to, $view, $data, $sender = null): bool
    {
        $engine    = config('mail.default', env('MAIL_MAILER'));

        if ($sender) {
            $from = $sender;
        } else {
            if ($engine == 'smtp') {
                $from = config('mail.from.address', env('MAIL_FROM_ADDRESS'));
            } else {
                $from = config('mail.from.address', env('SENDER_MAIL'));
            }
        }

        $attribute = [
            'from'    => $from,
            'content' => $data,
            'view'    => $view,
        ];

        if (is_array($to)) {
            $emails = array_filter($to);
        } else {
            $emails = $to;
        }

        Mail::to($emails)->send(new SendSmtpMail($attribute));

        return true;
    }
}
