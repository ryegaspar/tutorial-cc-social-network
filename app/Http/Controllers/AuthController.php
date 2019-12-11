<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function getSignup()
    {
        return view('auth.signup');
    }

    public function postSignup(Request $request)
    {
        $validatedData = $request->validate([
            'email'    => 'required|unique:users,email|email|max:255',
            'username' => 'required|unique:users,username|alpha_dash|max:20',
            'password' => 'required|min:6'
        ]);

        User::create([
            'email'    => $validatedData['email'],
            'username' => $validatedData['username'],
            'password' => bcrypt($validatedData['password'])
        ]);

        return redirect()->route('home')
            ->with('info', 'Your account has been created and you can now sign in');
    }
}
