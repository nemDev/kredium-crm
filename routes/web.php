<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdviserController;
use App\Http\Controllers\ClientController;
use App\Http\Middleware\CheckIfAuthenticated;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/login', function () {
    return view('login');
})->middleware('guest')->name('login');

Route::post('/login', [AdviserController::class, 'login'])->name('adviser.login');

Route::middleware([CheckIfAuthenticated::class])->group(function(){
    //Logout
    Route::post('/logout', [AdviserController::class, 'logout'])->name('logout');
    //Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Clients route
    Route::get('/clients', [ClientController::class, 'index'])->name('clients.index');
    Route::get('/clients/create', [ClientController::class, 'create'])->name('clients.create');
    Route::post('/clients/create', [ClientController::class, 'store'])->name('clients.store');
    Route::get('/clients/{client}', [ClientController::class, 'edit'])->name('clients.edit');
    Route::post('/clients/{client}', [ClientController::class, 'update'])->name('clients.update');
});

