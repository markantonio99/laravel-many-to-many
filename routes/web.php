<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/events/{event:slug}/restore', [EventController::class, 'restore'])->name('events.restore')->withTrashed();

    Route::resource('events', EventController::class)->parameters([
        'events' => 'event:slug'
    ])->withTrashed(['show', 'edit', 'update', 'destroy']);
});

require __DIR__.'/auth.php';
