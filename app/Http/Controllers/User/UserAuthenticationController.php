<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Request\User\Auth\UserLoginRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;


class UserAuthenticationController extends Controller
{
    public function register_create(): View
    {
        return view('user.auth.register');
    }

    public function register_store(Request $request): RedirectResponse
    {
        $request->validate([
            'firstName' => ['required', 'string', 'min:3', 'max:20'],
            'lastName' => ['required', 'string', 'min:3', 'max:20'],
            'username' => ['required', 'alpha_num:ascii', 'min:3', 'max:20'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:20', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user)->via('user');

        return redirect()->route('user.dashboard')->with('message', 'User registered successfully!');
    }

    public function login_create(): View
    {
        return view('user.auth.login');
    }

    public function login_store(UserLoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(route('user.dashboard'))->with('message', 'User login successfully!');
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('user')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function password_update(Request $request): RedirectResponse
    {
        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->route('user.profile.edit')->with('message', 'User password updated successfully!');
    }
}