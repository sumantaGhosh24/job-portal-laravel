<?php

namespace App\Livewire\Profile;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Validate;
use Livewire\Component;

class DeleteUserForm extends Component
{
    use AuthorizesRequests;

    #[Validate('required|current_password')]
    public string $password = '';

    public function destroy()
    {
        $this->validate();

        $user = Auth::user();

        $this->authorize('delete', $user);

        $user->languages()->delete();
        $user->certificates()->delete();
        $user->projects()->delete();
        $user->skills()->delete();
        $user->educations()->delete();

        if (!empty($user->profile_image)) {
            Storage::disk('public')->delete($user->profile_image);
        }

        if (!empty($user->background_image)) {
            Storage::disk('public')->delete($user->background_image);
        }

        if (!empty($user->resume)) {
            Storage::disk('public')->delete($user->resume);
        }

        Auth::logout();

        $user->delete();

        session()->invalidate();
        session()->regenerateToken();

        return redirect()->route('home');
    }

    public function render()
    {
        return view('livewire.profile.delete-user-form');
    }
}
