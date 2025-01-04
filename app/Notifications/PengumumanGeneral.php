<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PengumumanGeneral extends Notification
{
    use Queueable;

    public $judul;
    public $isi_pengumuman;

    /**
     * Create a new notification instance.
     */
    public function __construct($judul, $isi_pengumuman)
    {
        $this->judul = $judul;
        $this->isi_pengumuman = $isi_pengumuman;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database', 'mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->line('Pengumuman baru: ' . $this->judul)
            ->line($this->isi_pengumuman)
            ->action('Lihat Pengumuman', url('/pengumuman'))
            ->line('Terima kasih telah menggunakan aplikasi kami!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'message' => $this->judul,         // Judul pengumuman
            'description' => $this->isi_pengumuman, // Isi pengumuman
        ];
    }
}
