<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use App\Policies\TicketPolicy;

class TicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::all()->load('user'); // Load the user relationship to access user details
        // $user = auth()->user();
        // $tickets = $user->isAdmin() ? Ticket::all() : Ticket::where('user_id', $user->id)->get();
        return view('ticket.index', compact('tickets'));
    }

    public function create()
    {
        return view('ticket.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
            'duree' => 'required|integer',
        ]);

        $ticket = new Ticket();
        $ticket->user_id = auth()->user()->id;
        $ticket->title = $request->title;
        $ticket->description = $request->description;
        $ticket->date = $request->date;
        $ticket->duree = $request->duree;
        $ticket->save();
        return redirect()->route('ticket.index');
    }

    public function edit(Ticket $ticket)
    {
        $this->authorize('update', $ticket);
        return view('ticket.edit', compact('ticket'));
    }

    public function update(Request $request, Ticket $ticket) {
        $this->authorize('update', $ticket);
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
            'duree' => 'required|integer',
        ]);
        $ticket->title = $request->title;
        $ticket->description = $request->description;
        $ticket->date = $request->date;
        $ticket->duree = $request->duree;
        $ticket->save();
        return redirect()->route('ticket.index');

    }

    public function show(Ticket $ticket)
    {
        return view('ticket.show', compact('ticket'));
    }

    public function destroy(Ticket $ticket)
    {
        $this->authorize('delete', $ticket);
        $ticket->delete();
        return redirect()->route('ticket.index');
    }

    // à ajouter dans la vue show ou index en fontion de l'entreprise

    // public function salaire(Ticket $ticket)
    // {
    //     return $ticket->salaire();
    // }
}
