<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SubscriberController;
use Illuminate\Support\Facades\Route;

// Rotas para Usuários
Route::prefix('users')
    ->name('users.')
    ->group(function () {
        Route::get('index', [UserController::class, 'index'])->name('index');
        Route::get('show/{id}', [UserController::class, 'show'])->name('show');
        Route::put('update/{id}', [UserController::class, 'update'])->name('update');
        Route::post('store', [UserController::class, 'store'])->name('store');
        Route::delete('destroy/{id}', [UserController::class, 'destroy'])->name('destroy');
    });


// Rotas para Eventos
Route::prefix('events')
    ->name('events.')
    ->group(function () {
        Route::get('index', [EventController::class, 'index'])->name('index');
        Route::get('show/{id}', [EventController::class, 'show'])->name('show');
        Route::put('update/{id}', [EventController::class, 'update'])->name('update');
        Route::post('store', [EventController::class, 'store'])->name('store');
        Route::delete('destroy/{id}', [EventController::class, 'destroy'])->name('destroy');
    });


// Rotas para Inscrições
Route::prefix('subscribers')
    ->name('subscribers.')
    ->group(function () {
        Route::get('index', [SubscriberController::class, 'index'])->name('index');
        Route::get('show/{id}', [SubscriberController::class, 'show'])->name('show');
        Route::put('update/{id}', [SubscriberController::class, 'update'])->name('update');
        Route::post('store', [SubscriberController::class, 'store'])->name('store');
        Route::delete('destroy/{id}', [SubscriberController::class, 'destroy'])->name('destroy');
    });

    
// Rotas para Pagamentos
Route::prefix('payments')
    ->name('payments.')
    ->group(function () {
        Route::get('index', [PaymentController::class, 'index'])->name('index');
        Route::get('show/{id}', [PaymentController::class, 'show'])->name('show');
        Route::put('update/{id}', [PaymentController::class, 'update'])->name('update');
        Route::post('store', [PaymentController::class, 'store'])->name('store');
        Route::delete('destroy/{id}', [PaymentController::class, 'destroy'])->name('destroy');
    });


Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout']);