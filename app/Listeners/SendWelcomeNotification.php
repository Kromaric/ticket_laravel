<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendWelcomeNotification
{
    
    /**
     * Handle the event.
     */
    #[AsListener]
    public function handle(Registered $event): void
    {
        $event->user->notify(new WelcomeUserNotification());
    }
}
