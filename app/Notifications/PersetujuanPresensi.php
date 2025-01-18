<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PersetujuanPresensi extends Notification
{
    private $presensi;
    private $sender;

    /**
     * Create a new notification instance.
     */
    public function __construct($presensi, $sender)
    {
        $this->presensi = $presensi;
        $this->sender = $sender;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    // public function toMail(object $notifiable): MailMessage
    // {
    //     return (new MailMessage)
    //                 ->line('The introduction to the notification.')
    //                 ->action('Notification Action', url('/'))
    //                 ->line('Thank you for using our application!');
    // }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'presensi_id' => $this->presensi->id,
            'message' => 'Presensi Dibatalkan',
            'description' => 'Presensi Anda telah dibatalkan oleh ' . $this->sender->name,
            'link' => '/riwayat-presensi-pribadi/',
            'sender_name' => $this->sender->name, // Nama pengirim
            'sender_avatar' => $this->sender->Avatar, // Foto pengirim
            'sender_jabatan' => $this->sender->jabatan->nama_Jabatan, // Jabatan pengirim
            'sender_perusahaan_id' => $this->sender->id_Perusahaan,
        ];
    }
}
