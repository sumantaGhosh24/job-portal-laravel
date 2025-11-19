<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Title;
use Livewire\Component;

class Register extends Component
{
    public $first_name;

    public $last_name;

    public $username;

    public $email;

    public $password;

    public $password_confirmation;

    protected function rules()
    {
        return [
            'first_name' => ['required', 'string', 'min:3', 'max:20'],
            'last_name' => ['required', 'string', 'min:3', 'max:20'],
            'username' => ['required', 'alpha_num', 'ascii', 'min:3', 'max:20'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'password_confirmation' => ['required', 'same:password'],
        ];
    }

    public function save()
    {
        $this->validate();

        $user = User::create([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'username' => $this->username,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect()->route('home')->with('message', 'User registered successfully!');
    }

    #[Title('Register')]
    public function render()
    {
        return view('livewire.auth.register');
    }
}
