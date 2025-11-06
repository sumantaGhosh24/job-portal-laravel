<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class AuthenticationController extends Controller {
    public function create() {
        return view('auth.register');
    }

    public function store(Request $request) {
        $request->validate([
            'first_name' => ['required', 'string', 'min:3', 'max:20'],
            'last_name' => ['required', 'string', 'min:3', 'max:20'],
            'username' => ['required', 'alpha_num:ascii', 'min:3', 'max:20'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:20', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect()->route('home')->with('message', 'User registered successfully!');
    }

    public function login_create() {
        return view('auth.login');
    }

    public function login_store(LoginRequest $request) {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(route('home'))->with('message', 'User login successfully!');
    }
}