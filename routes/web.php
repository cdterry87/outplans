<?php

use App\Http\Livewire\Plans;
use App\Http\Livewire\Friends;
use App\Http\Livewire\Plan;
use App\Http\Livewire\UserIndex;
use App\Http\Livewire\FriendRequests;
use App\Http\Livewire\Invites;
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
    Route::get('plan/{plan}', Plan::class)->name('plan');
    Route::get('invites', Invites::class)->name('invites');

    Route::get('/attended', function () {
        return view('attended');
    })->name('attended');

    Route::get('friends', Friends::class)->name('friends');
    Route::get('friend-requests', FriendRequests::class)->name('friend-requests');

    Route::get('/notifications', function () {
        return view('notifications');
    })->name('notifications');
});
