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

    /**
     * Create a new notification instance.
     */
    public function __construct(User $user)
    {
        $this->user = $user;
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
    //         ->line('The introduction to the notification.')
    //         ->action('Notification Action', url('/'))
    //         ->line('Thank you for using our application!');
    // }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'message' => 'Persetujuan Akun Pengguna Baru',
            'description' => 'Pengguna baru dengan nama ' . $this->user->name . ' telah melakukan registrasi Akun. Silahkan lakukan peninjauan terhadap akun tersebut',
            'name' => $this->user->name,
            'email' => $this->user->email,
            'user_id' => $this->user->user_id,
            'id_Perusahaan' => $this->user->id_Perusahaan,
        ];
    }
}
