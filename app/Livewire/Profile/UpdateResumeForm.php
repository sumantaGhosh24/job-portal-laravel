<?php

namespace App\Livewire\Profile;

use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class UpdateResumeForm extends Component
{
    use AuthorizesRequests, WithFileUploads;

    public User $user;

    public function mount($id)
    {
        $this->user = User::findOrFail($id);
    }

    #[Validate('required|file|mimes:pdf|max:3072')]
    public $resume;

    public function update()
    {
        $this->validate();

        $this->authorize('update', $this->user);

        if (!empty($this->user->resume)) {
            Storage::disk('public')->delete($this->user->resume);
        }

        $resume_path = $this->resume->store('resumes', 'public');

        $this->user->update(['resume' => $resume_path]);

        $this->reset('resume');

        session()->flash('message', 'User resume updated successfully!');
    }

    public function download()
    {
        if (! $this->user->resume) {
            return session()->flash('message', 'No resume found!');
        }

        return Storage::disk('public')->download($this->user->resume);
    }

    public function render()
    {
        return view('livewire.profile.update-resume-form');
    }
}
