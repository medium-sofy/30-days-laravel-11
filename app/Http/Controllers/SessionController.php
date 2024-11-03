<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

    public function store()
    {
        dd('hello');
    }

    public function destroy()
    {
        Auth::logout();
        return redirect('/');
    }
}
