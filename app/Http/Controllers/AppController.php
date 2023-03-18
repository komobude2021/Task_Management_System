<?php

namespace App\Http\Controllers;

use App\Helper\AppService;
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
        return redirect()->back()->withErrors(['email' => 'Incorrect Login Credentials']);
    }

    public function register()
    {
        return view('register');
    }

    public function registerSubmit(RegisterRequest $req, AppService $appService)
    {
        $validated = $req->validated();

        if (!$appService->addNewUser($validated)) {
            return redirect()->back()->withErrors(['error' => 'Unable to register new user. Please try again'])->withInput();
        }

        return redirect()->route('login')->with(['success' => 'New user successfully created']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
