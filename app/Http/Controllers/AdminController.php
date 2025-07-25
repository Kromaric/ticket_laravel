<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Ticket;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Tableau de bord : statistiques globales
    public function index()
    {
        $tickets = Ticket::with('user')->get();
        $users = User::all();
        $totalTickets = $tickets->count();
        $ticketsOuverts = $tickets->where('status', 'ouvert')->count();
        $ticketsFermes = $tickets->where('status', 'ferme')->count();
        $heuresTotales = $tickets->sum('duree');
        $salaireTotal = $users->sum(function ($user) {
            return $user->salaire();
        });

        return view('admin.index', compact(
            'tickets', 'users', 'totalTickets', 'ticketsOuverts', 'ticketsFermes', 'heuresTotales', 'salaireTotal'
        ));
    }

    // Vue paie utilisateurs
    public function paie()
    {
        $users = User::with('tickets')->get();
        return view('admin.paie', compact('users'));
    }

    // Liste des utilisateurs
    public function users()
    {
        $users = User::withCount('tickets')->get();
        return view('admin.users', compact('users'));
    }

    // Modifier un utilisateur
    public function editUser(User $user)
    {
        return view('admin.edit-user', compact('user'));
    }

    // Mettre à jour un utilisateur
    public function updateUser(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'role' => 'required|in:admin,user',
            'taux_horaire' => 'required|numeric|min:0',
        ]);
        $user->update($request->only('name', 'email', 'role', 'taux_horaire'));
        return redirect()->route('admin.users')->with('success', 'Utilisateur mis à jour');
    }

    // Supprimer un utilisateur
    public function destroyUser(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users')->with('success', 'Utilisateur supprimé');
    }

    // Liste des tickets
    public function tickets()
    {
        $tickets = Ticket::with('user')->get();
        return view('admin.tickets', compact('tickets'));
    }

    // Modifier un ticket
    public function editTicket(Ticket $ticket)
    {
        return view('admin.edit-ticket', compact('ticket'));
    }

    // Mettre à jour un ticket
    public function updateTicket(Request $request, Ticket $ticket)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
            'duree' => 'required|integer|min:0',
            'status' => 'required|string',
        ]);
        $ticket->update($request->only('title', 'description', 'date', 'duree', 'status'));
        return redirect()->route('admin.tickets')->with('success', 'Ticket mis à jour');
    }

    // Supprimer un ticket
    public function destroyTicket(Ticket $ticket)
    {
        $ticket->delete();
        return redirect()->route('admin.tickets')->with('success', 'Ticket supprimé');
    }
}
