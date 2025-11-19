<?php

namespace App\Livewire\Profile;

use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;
use Livewire\Component;

class UpdateBackgroundImageForm extends Component
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

        if (!empty($this->user->background_image)) {
            Storage::disk('public')->delete($this->user->background_image);
        }

        $path = $this->image->store('backgrounds', 'public');

        $this->user->update(['background_image' => $path]);

        $this->reset('image');

        return session()->flash('message', 'User background image updated successfully!');
    }

    public function render()
    {
        return view('livewire.profile.update-background-image-form');
    }
}
