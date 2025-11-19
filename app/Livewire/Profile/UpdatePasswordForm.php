<?php

namespace App\Livewire\Profile;

use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password as PasswordRule;
use Livewire\Component;

class UpdatePasswordForm extends Component
{
    use AuthorizesRequests;

    public User $user;

    public string $current_password;

    public string $password;

    public string $password_confirmation;

    public function mount(string $id)
    {
        $this->user = User::findOrFail($id);
    }

    protected function rules()
    {
        return [
            'current_password' => ['required', 'current_password'],
            'password' => ['required', PasswordRule::defaults(), 'confirmed'],
            'password_confirmation' => ['required'],
        ];
    }

    public function update()
    {
        $this->validate();

        $this->user->update([
            'password' => Hash::make($this->password),
        ]);

        $this->reset('current_password', 'password', 'password_confirmation');

        return session()->flash('message', 'User password updated successfully!');
    }

    public function render()
    {
        return view('livewire.profile.update-password-form');
    }
}
