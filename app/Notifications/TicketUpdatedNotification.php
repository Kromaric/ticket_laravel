<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Mail\GenericNotificationMail;
use Illuminate\Mail\Mailable;

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
    public function toMail(object $notifiable): Mailable
    {
        return new GenericNotificationMail(
            "Mise à jour du ticket #{$this->ticket->id}",
            "Bonjour {$notifiable->name},\n\nLe ticket #{$this->ticket->id} : {$this->ticket->title} a été mis à jour.\n\nStatut actuel : {$this->ticket->status}",
            url("/tickets/{$this->ticket->id}"),
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
        'title' => 'Ticket mis à jour',
        'message' => "Le ticket #{$this->ticket->id} a été modifié.",
        'ticket_id' => $this->ticket->id,
        'status' => $this->ticket->status,
        'type' => 'updated',
    ];

    }
}
