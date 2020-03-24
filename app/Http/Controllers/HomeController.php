<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        if (is_null($user)) {
            $request->session()->flash('status', 'Welcome!');

            return view('dashboard.home');
        }

        $request->session()->flash('status', "Welcome, $user->first_name $user->last_name!");

        return view($user->role->name === 'admin' ? 'administration.home' : 'manager.home');
    }
}
