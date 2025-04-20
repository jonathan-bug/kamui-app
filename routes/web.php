<?php

use Illuminate\Support\Facades\Route;

Route::get('/api/token', fn () => csrf_token())->name('api.token');
