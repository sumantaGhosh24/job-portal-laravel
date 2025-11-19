<?php

namespace App\Livewire\Profile;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Title;
use Livewire\Component;

class Details extends Component
{
    public User $user;

    public ?int $user_id = null;

    public function mount(string $id)
    {
        $this->user = User::with([
            'followers',
            'following',
            'languages',
            'certificates',
            'projects',
            'skills',
            'educations',
        ])->findOrFail($id);

        $this->user_id = Auth::id();
    }

    #[Title('User Profile')]
    public function render()
    {
        return view('livewire.profile.details');
    }
}
