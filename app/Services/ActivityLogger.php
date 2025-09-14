<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;

class ActivityLogger
{
    public static function userRegistered($user)
    {
        Log::channel('activity')->info('Nouvel utilisateur enregistré', [
            'user_id' => $user->id,
            'email' => $user->email,
            'timestamp' => now()->toDateTimeString(),
        ]);
    }

    public static function userLoggedIn($user)
    {
        Log::channel('activity')->info('Connexion utilisateur', [
            'user_id' => $user->id,
            'email' => $user->email,
            'timestamp' => now()->toDateTimeString(),
        ]);
    }

    public static function userUpdated($user)
    {
        Log::channel('activity')->info('Utilisateur mis à jour', [
            'user_id' => $user->id,
            'email' => $user->email,
            'timestamp' => now()->toDateTimeString(),
        ]);
    }

    public static function userLoggedOut($user)
    {
        Log::channel('activity')->info('Deconnexion utilisateur', [
            'user_id' => $user->id,
            'email' => $user->email,
            'timestamp' => now()->toDateTimeString(),
        ]);
    }

    public static function userDeleted($user)
    {
        Log::channel('activity')->warning('Utilisateur supprimé', [
            'user_id' => $user->id,
            'email' => $user->email,
            'timestamp' => now()->toDateTimeString(),
        ]);
    }

    public static function ticketUpdated($ticket)
    {
        Log::channel('activity')->info('Ticket mis à jour', [
            'ticket_id' => $ticket->id,
            'title' => $ticket->title,
            'user_id' => $ticket->user_id,
            'timestamp' => now()->toDateTimeString(),
        ]);
    }

    public static function ticketCreated($ticket)
    {
        Log::channel('activity')->info('Ticket créé', [
            'ticket_id' => $ticket->id,
            'title' => $ticket->title,
            'user_id' => $ticket->user_id,
            'timestamp' => now()->toDateTimeString(),
        ]);
    }

    public static function ticketDeleted($ticket)
    {
        Log::channel('activity')->warning('Ticket supprimé', [
            'ticket_id' => $ticket->id,
            'title' => $ticket->title,
            'user_id' => $ticket->user_id,
            'timestamp' => now()->toDateTimeString(),
        ]);
    }


}
