<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TodoController;
use App\Http\Middleware\AuthUser;

// users
Route::get('/users', [UserController::class, 'page'])->name('users.page');
Route::post('/users/login', [UserController::class, 'login'])->name('users.login');
Route::get('/users/logout', [UserController::class, 'logout'])->name('users.logout');

// auth routes
Route::middleware(AuthUser::class)->group(function () {
    // token
    Route::get('/api/token', fn () => csrf_token())->name('api.token');
    
    Route::get('/', fn () => view('pages.todos.index'));

    //todo
    Route::get('/todos', [TodoController::class, 'page'])->name('todos.page');
    Route::get('/api/todos', [TodoController::class, 'index'])->name('api.todos.index');
    Route::get('/api/todos/{id}', [TodoController::class, 'find'])->name('api.todos.find');
    Route::put('/api/todos/{id}', [TodoController::class, 'update'])->name('api.todos.update');
    Route::post('/api/todos', [TodoController::class, 'store'])->name('api.todos.store');
    Route::patch('/api/todos,{id}', [TodoController::class, 'patch'])->name('api.todos.patch');
    Route::delete('/api/todos/{id}', [TodoController::class, 'destroy'])->name('api.todos.destroy');
});
