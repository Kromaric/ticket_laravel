<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AdminController extends Controller
{
    // Tableau de bord : statistiques globales
    public function index()
    {
        $tickets = Ticket::with('user')->get();
        $users = User::all();
        $totalTickets = $tickets->count();
        $ticketsPending = $tickets->where('status', 'pending')->count();
        $ticketsOuverts = $tickets->where('status', 'ouvert')->count();
        $ticketsFermes = $tickets->where('status', 'ferme')->count();
        $heuresTotales = $tickets->sum('duree');
        // $salaireTotal = $users->sum(function ($user) {
        //     return $user->salaire();
        // });

        // Calcul des revenus par statut
        $moisActuel = Carbon::now()->month;
        $ticketsMoisActuel = Ticket::whereMonth('date', $moisActuel)->get();
        $revenusParStatut = [
            'En cours' => $ticketsMoisActuel->where('status', 'ouvert')->sum('montant'),
            'En attente' => $ticketsMoisActuel->where('status', 'pending')->sum('montant'),
            'Résolus' => $ticketsMoisActuel->where('status', 'ferme')->sum('montant')

        ];

        // Calcul des revenus mensuels
        $revenusMensuels = [];
        for ($mois = 1; $mois <= 12; $mois++) {
            $ticketsDuMois = Ticket::with('user')
                ->whereMonth('date', $mois)
                ->get();
            $revenusMensuels[] = $ticketsDuMois->sum(function ($ticket) {
                return $ticket->montant;
            });
        }

        // Calcul des tickets créés et résolus par mois
        $ticketsCrees = [];
        $ticketsResolus = [];

        for ($mois = 1; $mois <= 12; $mois++) {
            $ticketsCrees[] = Ticket::whereYear('date', now()->year)
                ->whereMonth('date', $mois)
                ->count();

            $ticketsResolus[] = Ticket::whereYear('date', now()->year)
                ->whereMonth('date', $mois)
                ->where('status', 'ferme')
                ->count();
        }

        return view('admin.index', compact(
            'tickets', 'users', 'totalTickets', 'ticketsPending', 'ticketsOuverts', 'ticketsFermes', 'heuresTotales',
            'revenusParStatut', 'revenusMensuels', 'ticketsCrees', 'ticketsResolus'
        ));
    }

    // Liste des tickets
    public function ticketslist()
    {
        $pageTitle = 'du système';
        $tickets = Ticket::with('user')->get();
        return view('admin.list', compact('tickets', 'pageTitle'));
    }

    // Créer un ticket
    public function createTicket()
    {
        return view('admin.create');
    }

    // Stocker un ticket
    public function storeTicket(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
            'duree' => 'required|integer|min:0',
            'status' => 'required|in:pending,ouvert,ferme',
            'user_id' => 'required|exists:users,id'
        ]);

        Ticket::create($request->only('title', 'description', 'date', 'duree', 'status', 'user_id'));
        return redirect()->route('admin.tickets')->with('success', 'Ticket créé');
    }

    // Modifier un ticket
    public function editTicket(Ticket $ticket)
    {
        return view('admin.edit', compact('ticket'));
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


    // Tickets ouverts
    public function ticketsOuverts()
    {
        $pageTitle = 'ouverts';
        $tickets = Ticket::with('user')->where('status', 'ouvert')->get();
        return view('admin.list', compact('tickets', 'pageTitle'));
    }

    // Tickets fermés
    public function ticketsFermes()
    {
        $pageTitle = 'fermés';
        $tickets = Ticket::with('user')->where('status', 'ferme')->get();
        return view('admin.list', compact('tickets', 'pageTitle'));
    }

    // Tickets en attente
    public function ticketsPending()
    {
        $pageTitle = 'en attente';
        $tickets = Ticket::with('user')->where('status', 'pending')->get();
        return view('admin.list', compact('tickets', 'pageTitle'));
    }
    // Statistiques générales
    // public function statsOverview()
    // {
    //     $totalTickets = Ticket::count();
    //     $totalUsers = User::count();
    //     $heuresTotales = Ticket::sum('duree');

    //     return view('admin.stats-overview', compact('totalTickets', 'totalUsers', 'heuresTotales'));
    // }

    // Statistiques par utilisateur
    // public function statsUsers()
    // {
    //     $users = User::with('tickets')->get();
    //     return view('admin.stats-users', compact('users'));
    // }

    // Statistiques par ticket
    // public function statsTickets()
    // {
    //     $tickets = Ticket::with('user')->get();
    //     return view('admin.stats-tickets', compact('tickets'));
    // }

    #################### GESTION DES UTILISATEURS #########################

    // Vue paie utilisateurs
    public function paie()
    {
        $users = User::with('tickets')->get();
        return view('admin.paie', compact('users'));
    }

    // Tickets d'un utilisateur
    public function userTickets(User $user)
    {
        $pageTitle = 'de ' . $user->name;
        $tickets = $user->tickets;
        return view('admin.list', compact('user', 'tickets' , 'pageTitle'));
    }

    // Liste des utilisateurs
    public function users()
    {
        $users = User::withCount('tickets')->get();
        return view('admin.users.list', compact('users'));
    }

    // Créer un nouvel utilisateur
    public function createUser()
    {
        return view('admin.users.create');
    }

    // Stocker un nouvel utilisateur
    public function storeUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|in:admin,user',
            'taux_horaire' => 'required|numeric|min:0',
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
            'taux_horaire' => $request->taux_horaire,
        ]);
        return redirect()->route('admin.users.list')->with('success', 'Utilisateur créé avec succès');
    }

    // Modifier un utilisateur
    public function editUser(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    // Mettre à jour un utilisateur
    public function updateUser(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|in:admin,user',
            'taux_horaire' => 'required|numeric|min:0',
        ]);
        $user->update($request->only('name', 'role', 'taux_horaire'));
        return redirect()->route('admin.users.list')->with('success', 'Utilisateur mis à jour');
    }

    // Supprimer un utilisateur
    public function destroyUser(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.list')->with('success', 'Utilisateur supprimé');
    }

    // // Vue pour ajouter un rôle à un utilisateur
    // public function showAddRoleForm(User $user)
    // {
    //     return view('admin.users.add-role', compact('user'));
    // }

    // // Ajouter un rôle à un utilisateur
    // public function addRoleToUser(Request $request, User $user)
    // {
    //     $request->validate([
    //         'role' => 'required|in:admin,user',
    //     ]);
    //     $user->role = $request->role;
    //     $user->save();
    //     return redirect()->route('admin.users.list')->with('success', 'Rôle ajouté à l\'utilisateur');
    // }



}
