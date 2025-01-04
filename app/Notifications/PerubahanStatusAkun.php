<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PerubahanStatusAkun extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    protected $status;

    public function __construct($status)
    {
        $this->status = $status;
    }

    public function via($notifiable)
    {
        return ['database', 'mail'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'type' => 'non general',
            'message' => "Status akun Anda telah diubah menjadi {$this->status}.",
            'description' => "Harap lengkapi data diri anda pada menu profil",
        ];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Perubahan Status Akun')
            ->greeting("Halo, {$notifiable->name}")
            ->line("Status akun Anda telah diubah menjadi '{$this->status}'.")
            ->action('Masuk ke Aplikasi', url('/'))
            ->line('Terima kasih telah menggunakan layanan kami!');
    }
}
