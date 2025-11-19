<?php

namespace App\Livewire\Profile;

use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class UpdateProfileImageForm extends Component
{
    use AuthorizesRequests, WithFileUploads;

    public User $user;

    public function mount($id)
    {
        $this->user = User::findOrFail($id);
    }

    #[Validate('required|image|mimes:jpeg,png,jpg,gif|max:2048')]
    public $image;

    public function update()
    {
        $this->validate();

        $this->authorize('update', $this->user);

        if (!empty($this->user->profile_image)) {
            Storage::disk('public')->delete($this->user->profile_image);
        }

        $path = $this->image->store('profiles', 'public');

        $this->user->update(['profile_image' => $path]);

        $this->reset('image');

        session()->flash('message', 'User profile image updated successfully!');
    }

    public function render()
    {
        return view('livewire.profile.update-profile-image-form');
    }
}
