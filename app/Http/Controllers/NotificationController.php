<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
     public function index()
    {
        $notifications = auth()->user()->notifications()->get();
        return view('notifications.index', compact('notifications'));
    }

    public function markAllAsRead()
    {
        auth()->user()->unreadNotifications->markAsRead();
        return redirect()->route('notifications.index')->with('success', 'Toutes les notifications ont été marquées comme lues.');
    }

    public function markAsRead($id)
    {
        $notification = auth()->user()->notifications()->where('id', $id)->first();
        if ($notification) {
            $notification->markAsRead();
            return redirect()->back()->with('success', 'La notification a été marquée comme lue.');
        }
        return redirect()->back()->with('error', 'Notification non trouvée.');
    }

    public function destroy($id)
    {
        $notification = auth()->user()->notifications()->where('id', $id)->first();
        if ($notification) {
            $notification->delete();
            return redirect()->back()->with('success', 'La notification a été supprimée.');
        }
        return redirect()->back()->with('error', 'Notification non trouvée.');
    }

}
