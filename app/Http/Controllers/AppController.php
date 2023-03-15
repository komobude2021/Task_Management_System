<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Auth;

class AppController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function loginSubmit(LoginRequest $req)
    {
        $validated = $req->validated();
        if (Auth::attempt($validated)) {
            $req->session()->regenerate();
            return redirect()->intended('/home');
        }
        return back()->withErrors(['email' => 'Incorrect Login Credentials']);
    }

    public function register()
    {
        return view('register');
    }

    public function registerSubmit(RegisterRequest $req)
    {
        dd($req);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
