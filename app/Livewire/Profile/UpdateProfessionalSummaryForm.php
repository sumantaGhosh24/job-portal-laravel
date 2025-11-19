<?php

namespace App\Livewire\Profile;

use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Attributes\Validate;
use Livewire\Component;

class UpdateProfessionalSummaryForm extends Component
{
    use AuthorizesRequests;

    public User $user;

    #[Validate('required|string|min:3|max:150')]
    public ?string $headline;

    #[Validate('required|string|min:3|max:250')]
    public ?string $professional_summary;

    public function mount(string $id)
    {
        $user = User::findOrFail($id);

        $this->user = $user;
        $this->headline = $this->user->headline;
        $this->professional_summary = $this->user->professional_summary;
    }

    public function update()
    {
        $this->validate();

        $this->authorize('update', $this->user);

        $this->user->update([
            'headline' => $this->headline,
            'professional_summary' => $this->professional_summary,
        ]);

        return session()->flash('message', 'User professional summary updated successfully!');
    }

    public function render()
    {
        return view('livewire.profile.update-professional-summary-form');
    }
}
