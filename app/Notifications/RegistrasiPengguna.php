<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RegistrasiPengguna extends Notification
{
    use Queueable;
    public $user;
    private $sender;

    /**
     * Create a new notification instance.
     */
    public function __construct(User $user, $sender)
    {
        $this->user = $user;
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
            ->subject('Persetujuan Akun Pengguna Baru')
            ->greeting('Halo, ' . $notifiable->name)
            ->line('Pengguna baru dengan nama ' . $this->user->name . ' telah melakukan registrasi akun.')
            ->line('Silakan lakukan peninjauan terhadap akun tersebut.')
            ->line('Detail Pengguna Baru:')
            ->line('Nama: ' . $this->user->name)
            ->line('Email: ' . $this->user->email)
            ->line('ID Perusahaan: ' . $this->user->id_Perusahaan)
            ->action('Tinjau Akun', url('/persetujuan-akun')) // Ubah URL sesuai dengan rute untuk meninjau akun.
            ->line('Terima kasih atas perhatian Anda!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        $url = '/persetujuan-akun';
        return [
            'message' => 'Persetujuan Akun Pengguna Baru',
            'description' => 'Pengguna baru dengan nama ' . $this->user->name . ' telah melakukan registrasi Akun. Silahkan lakukan peninjauan terhadap akun tersebut',
            'link' => $url,
            'name' => $this->user->name,
            'email' => $this->user->email,
            'user_id' => $this->user->user_id,
            'id_Perusahaan' => $this->user->id_Perusahaan,
            'sender_name' => $this->sender->name, // Nama pengirim
            'sender_avatar' => $this->sender->Avatar, // Foto pengirim
            'sender_jabatan' => $this->sender->jabatan->nama_Jabatan ?? 'None', // Jabatan pengirim
            'sender_perusahaan_id' => $this->sender->id_Perusahaan,
        ];
    }
}
