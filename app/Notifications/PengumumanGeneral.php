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
    private $sender;

    /**
     * Create a new notification instance.
     */
    public function __construct($judul, $isi_pengumuman, $sender)
    {
        $this->judul = $judul;
        $this->isi_pengumuman = $isi_pengumuman;
        $this->sender = $sender;
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
            ->line('Pengumuman baru: ' . strip_tags($this->judul))
            ->line(strip_tags($this->isi_pengumuman))
            ->action('Lihat Pengumuman', url('/notifikasi'))
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
            'link' => '/notifikasi',
            'sender_name' => $this->sender->name, // Nama pengirim
            'sender_avatar' => $this->sender->Avatar, // Foto pengirim
            'sender_jabatan' => $this->sender->jabatan->nama_Jabatan, // Jabatan pengirim
            'sender_perusahaan_id' => $this->sender->id_Perusahaan,
        ];
    }
}
