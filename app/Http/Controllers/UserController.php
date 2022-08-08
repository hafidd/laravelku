<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function auth(Request $req)
    {
        $fields = $req->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($fields)) {
            $req->session()->regenerate();
            return redirect("/");
        }

        return back()->withErrors(['email' => 'Email/Password salah'])->onlyInput('email');
    }

    public function store(Request $req)
    {
        $fields = $req->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        $fields["password"] = Hash::make($fields["password"]);
        $user = User::create($fields);
        Auth::login($user);

        return redirect("/");
    }

    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect('/');
    }
}
