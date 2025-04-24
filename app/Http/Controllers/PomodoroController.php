<?php

namespace App\Http\Controllers;

class PomodoroController extends Controller
{
    public function page() {
        return view('pages.pomodoro.index');
    }
}
