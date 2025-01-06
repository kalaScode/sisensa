<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PerubahanStatusAkun extends Notification
{
    use Queueable;

    protected $action;

    /**
     * Create a new notification instance.
     *
     * @param string $action
     */
    public function __construct($action)
    {
        $this->action = $action;
    }

    /**
     * Determine the channels the notification will be sent on.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'mail'];
    }

    /**
     * Format the database notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        if ($this->action == 'aktif') {
            $message = "Status akun Anda telah diubah menjadi {$this->action}.";
            $description = "Harap lengkapi data diri anda pada menu profil.";
        } elseif ($this->action == 'dibatalkan') {
            $message = "Pengajuan akun Anda telah {$this->action}.";
            $description = "Harap hubungi HRD untuk informasi lebih lanjut.";
        } else {
            $message = "Status akun Anda telah diubah.";
            $description = "";
        }

        return [
            'message' => $message,
            'description' => $description,
        ];
    }

    /**
     * Format the mail notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $subject = "Perubahan Status Akun";

        if ($this->action == 'aktif') {
            $line = "Status akun Anda telah diubah menjadi '{$this->action}'.";
        } elseif ($this->action == 'dibatalkan') {
            $line = "Pengajuan akun Anda telah '{$this->action}'. 
                    Informasi lebih lanjut dapat menghubungi HRD";
        } else {
            $line = "Status akun Anda telah diubah.";
        }

        return (new MailMessage)
            ->subject($subject)
            ->greeting("Halo, {$notifiable->name}")
            ->line($line)
            ->action('Masuk ke Aplikasi', url('/'))
            ->line('Terima kasih telah menggunakan layanan kami!');
    }
}
