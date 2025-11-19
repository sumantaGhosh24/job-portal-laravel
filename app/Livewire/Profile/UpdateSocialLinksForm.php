<?php

namespace App\Livewire\Profile;

use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Attributes\Validate;
use Livewire\Component;

class UpdateSocialLinksForm extends Component
{
    use AuthorizesRequests;

    public User $user;

    #[Validate('nullable|url:http,https')]
    public ?string $linkedin_url;

    #[Validate('nullable|url:http,https')]
    public ?string $github_url;

    #[Validate('nullable|url:http,https')]
    public ?string $website_url;

    public function mount(string $id)
    {
        $user = User::findOrFail($id);

        $this->user = $user;
        $this->linkedin_url = $user->linkedin_url;
        $this->github_url = $user->github_url;
        $this->website_url = $user->website_url;
    }

    public function update()
    {
        $this->validate();

        $this->authorize('update', $this->user);

        $this->user->update([
            'linkedin_url' => $this->linkedin_url,
            'github_url' => $this->github_url,
            'website_url' => $this->website_url,
        ]);

        return session()->flash('message', 'User social links updated successfully!');
    }

    public function render()
    {
        return view('livewire.profile.update-social-links-form');
    }
}
