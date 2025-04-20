<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;

class TodoController extends Controller
{
    public function page() {
        return view('pages.todo.index');
    }

    public function index() {
        return Todo::all();
    }
}
