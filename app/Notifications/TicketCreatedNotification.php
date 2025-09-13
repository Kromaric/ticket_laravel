<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Mail\GenericNotificationMail;
use Illuminate\Mail\Mailable;


class TicketCreatedNotification extends Notification
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
            'Nouveau ticket créé',
            "Votre ticket #{$this->ticket->id}: {$this->ticket->title} a été créé avec succès.",
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
            'type' => 'created',
            'message' => "Ticket #{$this->ticket->id} créé.",
            'ticket_id' => $this->ticket->id,
        ];

    }
}
