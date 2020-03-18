<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        if (is_null($user)) {
            return view('dashboard.home');
        }

        return view($user->role->name === 'admin' ? 'administration.home' : 'manager.home');
    }
}
