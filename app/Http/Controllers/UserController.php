<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function page() {
        return view('pages.users.index');
    }
    
    public function login(Request $request) {
        $user = [
            'email' => $request->get('email'),
            'password' => $request->get('password')
        ];

        if(Auth::attempt($user)) {
            $request->session()->regenerate();

            return redirect('/');
        }

        return redirect()->back();
    }

    public function logout() {
        Auth::logout();

        return redirect()->route('users.page');
    }
}
