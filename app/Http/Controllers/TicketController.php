<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use App\Policies\TicketPolicy;
use App\Notifications\TicketCreatedNotification;
use App\Models\User;


class TicketController extends Controller
{
    public function index()
    {

        $user = auth()->user();
        $tickets = Ticket::where('user_id', $user->id)->get();
        $totalTickets = $tickets->count();
        $ticketsPending = $tickets->where('status', 'pending')->count();
        $ticketsOuverts = $tickets->where('status', 'ouvert')->count();
        $ticketsFermes = $tickets->where('status', 'ferme')->count();
        return view('ticket.index', compact('tickets', 'totalTickets', 'ticketsPending', 'ticketsOuverts', 'ticketsFermes'));
    }

    public function ticketslist()
    {
        $pageTitle = 'Liste des tickets du système';
        $tickets = Ticket::all()->load('user');
        return view('ticket.list', compact('tickets', 'pageTitle'));
    }

    public function ticketsOuverts()
    {
        $pageTitle = 'Mes tickets ouverts';
        $tickets = Ticket::where('user_id', auth()->id())->where('status', 'ouvert')->get();
        return view('ticket.list', compact('tickets', 'pageTitle'));
    }

    public function ticketsFermes()
    {
        $pageTitle = 'Mes tickets fermés';
        $tickets = Ticket::where('user_id', auth()->id())->where('status', 'ferme')->get();
        return view('ticket.list', compact('tickets', 'pageTitle'));
    }

    public function ticketsPending()
    {
        $pageTitle = 'Mes tickets en attente';
        $tickets = Ticket::where('user_id', auth()->id())->where('status', 'pending')->get();
        return view('ticket.list', compact('tickets', 'pageTitle'));
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
            'status' => 'required|in:pending,ouvert,ferme',
        ]);
        $admins = User::where('role', 'admin')->get();
        $ticket = new Ticket();
        $ticket->user_id = auth()->user()->id;
        $ticket->title = $request->title;
        $ticket->description = $request->description;
        $ticket->date = $request->date;
        $ticket->duree = $request->duree;
        $ticket->status = $request->status;
        $ticket->save();
        auth()->user()->notify(new TicketCreatedNotification($ticket));
        Notification::send($admins, new TicketCreatedNotification($ticket));
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
            'status' => 'required|in:pending,ouvert,ferme',
        ]);
        $ticket->title = $request->title;
        $ticket->description = $request->description;
        $ticket->date = $request->date;
        $ticket->duree = $request->duree;
        $ticket->status = $request->status;
        $ticket->save();
        return redirect()->route('ticket.index');

    }

    public function close(Ticket $ticket)
    {
        $this->authorize('update', $ticket);
        if ($ticket->status !== 'ferme') {
            $ticket->status = 'ferme';
            $ticket->save();
            auth()->user()->notify(new TicketClosedNotification($ticket));
            $admins = User::where('role', 'admin')->get();
            Notification::send($admins, new TicketResolvedNotification($ticket));
        }

        return redirect()->route('ticket.index')->with('success', 'Ticket fermé avec succès.');
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
