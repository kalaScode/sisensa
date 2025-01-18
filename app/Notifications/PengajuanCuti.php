<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PengajuanCuti extends Notification
{
    use Queueable;

    protected $cuti;
    protected  $sender;

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
     */
    public function via($notifiable)
    {
        return ['mail', 'database']; // Kirim ke email dan simpan ke database
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $url = url('/persetujuan-cuti/');
        return (new MailMessage)
            ->subject('Pengajuan Cuti Baru')
            ->line('Ada pengajuan cuti baru dari ' . $this->cuti->user->name . '.')
            ->line('Jenis Cuti: ' . $this->cuti->jenis_Cuti)
            ->line('Durasi: ' . $this->cuti->tanggal_Mulai->format('Y-m-d') . ' s/d ' . $this->cuti->tanggal_Selesai->format('Y-m-d'))
            ->action('Lihat Detail', $url)
            ->line('Mohon untuk segera diproses.');
    }

    /**
     * Get the array representation of the notification.
     */
    public function toArray($notifiable)
    {
        return [
            'message' => 'Ada pengajuan cuti baru dari ' . $this->sender->name, // Pesan tambahan
            'description' => 'Silakan tinjau pengajuan cuti tersebut.', // Deskripsi tambahan
            'link' => '/persetujuan-cuti/',
            'user_name' => $this->cuti->user->name,
            'jenis_cuti' => $this->cuti->jenis_Cuti,
            'tanggal_mulai' => $this->cuti->tanggal_Mulai,
            'tanggal_selesai' => $this->cuti->tanggal_Selesai,
            'id_cuti' => $this->cuti->id_Cuti,
            'sender_name' => $this->sender->name, // Nama pengirim
            'sender_avatar' => $this->sender->Avatar, // Foto pengirim
            'sender_jabatan' => $this->sender->jabatan->nama_Jabatan, // Jabatan pengirim
            'sender_perusahaan_id' => $this->sender->id_Perusahaan,
        ];
    }
}
