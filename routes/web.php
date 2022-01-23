<?php

use App\Http\Livewire\MyPlans;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('my-plans', MyPlans::class)->name('my-plans');

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
