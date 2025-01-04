<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\ResetPassword as BaseResetPassword;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPassword extends BaseResetPassword
{
    public function toMail($notifiable)
    {
        $url = url(route('password.reset', [
            'token' => $this->token,
            'email' => $notifiable->getEmailForPasswordReset(),
        ], false));

        return (new MailMessage)
            ->subject('Notifikasi Reset Password')
            ->greeting('Halo!')
            ->line('Anda Mendapatkan Email Ini Karena Telah Mengajukan Reset Password Pada Akun Sisensa Anda.')
            ->action('Reset Password', $url)
            ->line('Jika Anda Merasa Tidak Melakukan Hal Ini, Cukup Abaikan Pesan Ini.')
            ->line('')
            ->line('Regards,')
            ->salutation('Tim Sisensa');
    }
}
