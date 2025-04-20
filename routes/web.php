<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TodoController;
use App\Http\Middleware\AuthUser;

// token
Route::get('/api/token', fn () => csrf_token())->name('api.token');

// users
Route::get('/users', [UserController::class, 'page'])->name('users.page');
Route::post('/users/login', [UserController::class, 'login'])->name('users.login');
Route::get('/users/logout', [UserController::class, 'logout'])->name('users.logout');

// auth routes
Route::middleware(AuthUser::class)->group(function () {
    Route::get('/', fn () => null);
});

//todo
Route::get('/todo', [TodoController::class, 'page'])->name('todo.page');
