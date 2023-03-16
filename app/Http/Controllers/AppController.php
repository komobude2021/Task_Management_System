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
        return back()->withErrors(['email' => 'Incorrect Login Credentials']);
    }

    public function register()
    {
        return view('register');
    }

    public function registerSubmit(RegisterRequest $req, AppService $appService)
    {
        $validated = $req->validated();
        if (!$appService->checkIfPasswordMatches($validated['password'], $validated['password_confirm'])) {
            return back()->withErrors(['error' => 'Passwords do not match'])->withInput();
        }

        if (!$appService->addNewUser($validated)) {
            return back()->withErrors(['error' => 'Unable to register new user. Please try again.'])->withInput();
        }

        return redirect('/')->with(['success' => 'New user successfully created.']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
