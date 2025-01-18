<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;


class PerubahanStatusAkun extends Notification
{
    use Queueable;

    public $action; // Ubah menjadi public agar dapat diakses langsung
    public $sender; // Ubah menjadi public agar dapat diakses langsung

    /**
     * Create a new notification instance.
     *
     * @param string $action
     * @param object $sender
     */
    public function __construct($action, $sender)
    {
        $this->action = $action;
        $this->sender = $sender;
    }

    /**
     * Determine the channels the notification will be sent on.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'mail']; // Channel database dan email
    }

    /**
     * Format the database notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        $message = "Status akun Anda telah diubah.";
        $description = "";

        if ($this->action === 'aktif') {
            $message = "Status akun Anda telah diubah menjadi aktif.";
            $description = "Harap lengkapi data diri Anda pada menu profil.";
        } elseif ($this->action === 'dibatalkan') {
            $message = "Pengajuan akun Anda telah dibatalkan.";
            $description = "Harap hubungi HRD untuk informasi lebih lanjut.";
        }

        $url = url('/');

        return [
            'message' => $message,
            'description' => $description,
            'link' => $url,
            'sender_name' => $this->sender->name ?? 'Sistem', // Tambahkan fallback
            'sender_avatar' => $this->sender->Avatar ?? null, // Tambahkan fallback
            'sender_jabatan' => $this->sender->jabatan->nama_Jabatan ?? 'Tidak Diketahui', // Tambahkan fallback
            'sender_perusahaan_id' => $this->sender->id_Perusahaan ?? null,
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
        Log::info("Mengirim email untuk status {$this->action} kepada {$notifiable->email}");

        $subject = "Perubahan Status Akun";
        $line = "Status akun Anda telah diubah.";

        if ($this->action === 'aktif') {
            $line = "Status akun Anda telah diubah menjadi aktif. Harap lengkapi data diri Anda pada menu profil.";
        } elseif ($this->action === 'dibatalkan') {
            $line = "Pengajuan akun Anda telah dibatalkan. Informasi lebih lanjut dapat menghubungi HRD.";
        }

        return (new MailMessage)
            ->subject($subject)
            ->greeting("Halo, {$notifiable->name}")
            ->line($line)
            ->action('Masuk ke Aplikasi', url('/'))
            ->line('Terima kasih telah menggunakan layanan kami!');
    }
}