<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

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
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
        ->subject('Bienvenue sur TicketApp !')
        ->line("Bonjour {$notifiable->name},")
        ->line("Ton compte a bien été créé. Tu peux maintenant accéder à ton espace personnel.")
        ->action('Accéder au profil', url('/profile'))
        ->line('Merci de nous rejoindre !');
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
