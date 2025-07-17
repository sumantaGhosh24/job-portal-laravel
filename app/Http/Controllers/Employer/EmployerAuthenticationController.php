<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Http\Request\Employer\Auth\EmployerLoginRequest;
use App\Models\Employer;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class EmployerAuthenticationController extends Controller
{
    public function register_create(): View
    {
        return view('employer.auth.register');
    }

    public function register_store(Request $request): RedirectResponse
    {
        $request->validate([
            'firstName' => ['required', 'string', 'min:3', 'max:20'],
            'lastName' => ['required', 'string', 'min:3', 'max:20'],
            'username' => ['required', 'alpha_num:ascii', 'min:3', 'max:20'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:20', 'unique:' . Employer::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = Employer::create([
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user)->via('employer');

        return redirect()->route('employer.dashboard')->with('message', 'Employer registered successfully!');
    }

    public function login_create(): View
    {
        return view('employer.auth.login');
    }

    public function login_store(EmployerLoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(route('employer.dashboard'))->with('message', 'Employer login successfully!');
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('employer')->logout();

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

        return redirect()->route('employer.profile.edit')->with('message', 'Employer password updated successfully!');
    }
}