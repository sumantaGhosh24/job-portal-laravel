<?php

namespace App\Livewire\Companies;

use App\Models\Company;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Attributes\Validate;
use Livewire\Component;

class UpdateSocialLinksForm extends Component
{
    use AuthorizesRequests;

    public Company $company;

    #[Validate('nullable|url:http,https')]
    public ?string $linkedin_url;

    #[Validate('nullable|url:http,https')]
    public ?string $twitter_url;

    #[Validate('nullable|url:http,https')]
    public ?string $facebook_url;

    #[Validate('nullable|url:http,https')]
    public ?string $youtube_url;

    #[Validate('nullable|url:http,https')]
    public ?string $instagram_url;

    #[Validate('nullable|url:http,https')]
    public ?string $website_url;

    public function mount($id)
    {
        $company = Company::findOrFail($id);

        $this->company = $company;
        $this->linkedin_url = $company->linkedin_url;
        $this->twitter_url = $company->twitter_url;
        $this->facebook_url = $company->facebook_url;
        $this->youtube_url = $company->youtube_url;
        $this->instagram_url = $company->instagram_url;
        $this->website_url = $company->website_url;
    }

    public function update()
    {
        $this->validate();

        $this->authorize('update', $this->company);

        $this->company->update([
            'linkedin_url' => $this->linkedin_url,
            'twitter_url' => $this->twitter_url,
            'facebook_url' => $this->facebook_url,
            'youtube_url' => $this->youtube_url,
            'instagram_url' => $this->instagram_url,
            'website_url' => $this->website_url
        ]);

        session()->flash('message', 'Company social links updated successfully!');
    }

    public function render()
    {
        return view('livewire.companies.update-social-links-form');
    }
}
