<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('index', [UserController::class, 'index']);
Route::get('show/{id}', [UserController::class, 'show']);
Route::put('update/{id}', [UserController::class, 'update']);
Route::post('store', [UserController::class, 'store']);
Route::delete('destroy/{id}', [UserController::class, 'destroy']);

Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout']);


