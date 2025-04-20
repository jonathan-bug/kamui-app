<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function page() {
        return view('pages.todo.index');
    }
}
