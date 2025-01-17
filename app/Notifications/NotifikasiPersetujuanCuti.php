<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NotifikasiPersetujuanCuti extends Notification
{
    use Queueable;
    private $cuti;
    private $sender;

    /**
     * Create a new notification instance.
     */
    public function __construct($cuti, $sender)
    {
        $this->cuti = $cuti;
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

        $url = url('/riwayat-cuti-pribadi/');

        return (new MailMessage)
            ->subject('Status Cuti Anda Berubah')
            ->line('Pengajuan cuti Anda telah diperbarui.')
            ->action('Lihat Detail', $url);
    }



    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toDatabase($notifiable)
    {
        return [
            'message' => 'Status Cuti Diperbarui',
            'description' => 'Status pengajuan cuti Anda telah berubah menjadi ' . $this->cuti->status_Cuti .
                ($this->cuti->Feedback ? ' dengan alasan: ' . $this->cuti->Feedback : ''),
            'link' => '/riwayat-cuti-pribadi/',
            'sender_name' => $this->sender->name, // Nama pengirim
            'sender_avatar' => $this->sender->Avatar, // Foto pengirim
            'sender_jabatan' => $this->sender->jabatan->nama_Jabatan, // Jabatan pengirim
            'sender_perusahaan_id' => $this->sender->id_Perusahaan,
        ];
    }
}
