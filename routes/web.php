<?php

use App\Http\Livewire\Plans;
use App\Http\Livewire\PlanIndex;
use App\Http\Livewire\UserIndex;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('user/{user}', UserIndex::class)->name('user');

    Route::get('plans', Plans::class)->name('plans');

    Route::get('plan/{plan}', PlanIndex::class)->name('plan');

    Route::get('/invites', function () {
        return view('invites');
    })->name('invites');

    Route::get('/attended', function () {
        return view('attended');
    })->name('attended');

    Route::get('/friends', function () {
        return view('friends');
    })->name('friends');

    Route::get('/friend-requests', function () {
        return view('friend-requests');
    })->name('friend-requests');

    Route::get('/notifications', function () {
        return view('notifications');
    })->name('notifications');
});
