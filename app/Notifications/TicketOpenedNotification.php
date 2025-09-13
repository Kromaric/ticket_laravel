<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Mail\GenericNotificationMail;
use Illuminate\Mail\Mailable;

class TicketOpenedNotification extends Notification
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
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): Mailable
    {
        return new GenericNotificationMail(
            'Nouveau ticket ouvert',
            "Votre ticket #{$this->ticket->id}: {$this->ticket->title} a été ouvert.",
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
            'type' => 'opened',
            'message' => "Ticket #{$this->ticket->id} ouvert.",
            'ticket_id' => $this->ticket->id,
        ];
    }
}
