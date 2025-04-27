<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KanbanController extends Controller
{
    public function page() {
        return view('pages.kanban.index');
    }
}
