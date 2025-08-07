<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

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


});


// Routes pour l'administration
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/tickets', [AdminController::class, 'tickets'])->name('admin.tickets');
    Route::get('/tickets-list', [AdminController::class, 'ticketslist'])->name('admin.tickets.list');
    Route::get('/tickets/ouverts', [AdminController::class, 'ticketsOuverts'])->name('admin.tickets.open');
    Route::get('/tickets/attentes', [AdminController::class, 'ticketsPending'])->name('admin.tickets.pending');
    Route::get('/tickets/fermes', [AdminController::class, 'ticketsFermes'])->name('admin.tickets.closed');


    Route::get('/stats', [AdminController::class, 'statsOverview'])->name('admin.stats.overview');
    Route::get('/stats/tickets', [AdminController::class, 'statsTickets'])->name('admin.stats.tickets');
    Route::get('/stats/users', [AdminController::class, 'statsUsers'])->name('admin.stats.users');

        Route::get('/paie', [AdminController::class, 'paie'])->name('admin.paie');


    Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
    Route::get('/users/{user}/edit', [AdminController::class, 'editUser'])->name('admin.users.edit');
    Route::put('/users/{user}', [AdminController::class, 'updateUser'])->name('admin.users.update');
    Route::delete('/users/{user}', [AdminController::class, 'destroyUser'])->name('admin.users.destroy');

});



require __DIR__.'/auth.php';
