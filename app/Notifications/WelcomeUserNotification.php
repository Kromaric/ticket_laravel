<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Mail\GenericNotificationMail;
use Illuminate\Mail\Mailable;

class WelcomeUserNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): Mailable
    {
        return new GenericNotificationMail(
            'Bienvenue sur TicketApp !',
            "Bonjour {$notifiable->name},\n\nTon compte a bien été créé. Tu peux maintenant accéder à ton espace personnel.",
            url('/profile'),
            $notifiable->email
        );
    }


    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'title' => 'Bienvenue',
            'message' => 'Ton compte a été créé avec succès.',
            'type' => 'welcome',
        ];
    }
}
