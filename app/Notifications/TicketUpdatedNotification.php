<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TicketUpdatedNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public $ticket)
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
            ->subject("Mise à jour du ticket #{$this->ticket->id}")
            ->line("Bonjour {$notifiable->name},")
            ->line("Le ticket intitulé « {$this->ticket->title} » a été mis à jour.")
            ->line("Statut actuel : {$this->ticket->status}")
            ->action('Voir le ticket', url("/tickets/{$this->ticket->id}"))
            ->line('Merci pour votre confiance.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
        'title' => 'Ticket mis à jour',
        'message' => "Le ticket #{$this->ticket->id} a été modifié.",
        'ticket_id' => $this->ticket->id,
        'status' => $this->ticket->status,
        'type' => 'updated',
    ];

    }
}
