<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\NotificationController;

use Illuminate\Support\Facades\Route;

Route::redirect('/', '/login');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        if (auth()->user()->isAdmin()) {
            return redirect()->route('admin.index');
        }
        else {
            return redirect()->route('ticket.index');
        }
    })->name('dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Utilisation de la route resource pour les tickets
    Route::resource('/ticket', TicketController::class);
    Route::get('/tickets-list', [TicketController::class, 'ticketslist'])->name('user.tickets.list');
    Route::get('/tickets/ouverts', [TicketController::class, 'ticketsOuverts'])->name('user.tickets.open');
    Route::get('/tickets/attentes', [TicketController::class, 'ticketsPending'])->name('user.tickets.pending');
    Route::get('/tickets/fermes', [TicketController::class, 'ticketsFermes'])->name('user.tickets.closed');
    Route::patch('/ticket/{ticket}/close', [TicketController::class, 'close'])->name('ticket.close');
    Route::patch('/ticket/{ticket}/open', [TicketController::class, 'open'])->name('ticket.open');


    // Notifications
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/mark-all-read', [NotificationController::class, 'markAllAsRead'])->name('notifications.markAllRead');

});


// Routes pour l'administration
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/tickets-list', [AdminController::class, 'ticketslist'])->name('admin.tickets.list');
    Route::get('/mes-tickets', [AdminController::class, 'myTickets'])->name('admin.tickets.my');
    Route::get('/users/{user}/tickets', [AdminController::class, 'userTickets'])->name('admin.users.tickets');
    Route::get('/tickets/ouverts', [AdminController::class, 'ticketsOuverts'])->name('admin.tickets.open');
    Route::get('/tickets/attentes', [AdminController::class, 'ticketsPending'])->name('admin.tickets.pending');
    Route::get('/tickets/fermes', [AdminController::class, 'ticketsFermes'])->name('admin.tickets.closed');
    Route::get('/tickets/create', [AdminController::class, 'createTicket'])->name('admin.tickets.create');
    Route::post('/tickets', [AdminController::class, 'storeTicket'])->name('admin.tickets.store');
    Route::get('/tickets/{ticket}/edit', [AdminController::class, 'editTicket'])->name('admin.tickets.edit');
    Route::put('/tickets/{ticket}', [AdminController::class, 'updateTicket'])->name('admin.tickets.update');
    Route::delete('/tickets/{ticket}', [AdminController::class, 'destroyTicket'])->name('admin.tickets.destroy');

    // Route::get('/stats', [AdminController::class, 'statsOverview'])->name('admin.stats.overview');
    // Route::get('/stats/tickets', [AdminController::class, 'statsTickets'])->name('admin.stats.tickets');
    // Route::get('/stats/users', [AdminController::class, 'statsUsers'])->name('admin.stats.users');

    Route::get('/paie', [AdminController::class, 'paie'])->name('admin.paie');


    Route::get('/users', [AdminController::class, 'users'])->name('admin.users.list');
    Route::get('/users/create', [AdminController::class, 'createUser'])->name('admin.users.create');
    Route::post('/users', [AdminController::class, 'storeUser'])->name('admin.users.store');
    Route::get('/users/{user}/edit', [AdminController::class, 'editUser'])->name('admin.users.edit');
    Route::put('/users/{user}', [AdminController::class, 'updateUser'])->name('admin.users.update');
    Route::delete('/users/{user}', [AdminController::class, 'destroyUser'])->name('admin.users.destroy');

});



require __DIR__.'/auth.php';
