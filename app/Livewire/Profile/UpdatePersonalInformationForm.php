<?php

namespace App\Livewire\Profile;

use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Attributes\Validate;
use Livewire\Component;

class UpdatePersonalInformationForm extends Component
{
    use AuthorizesRequests;

    public User $user;

    #[Validate('required|string|min:3|max:20')]
    public ?string $first_name;

    #[Validate('required|string|min:3|max:20')]
    public ?string $last_name;

    #[Validate('required|string|min:10|max:15')]
    public ?string $mobile_number;

    #[Validate('required|string|min:3|max:50')]
    public ?string $city;

    #[Validate('required|string|min:2|max:50')]
    public ?string $state;

    #[Validate('required|string|min:2|max:50')]
    public ?string $country;

    #[Validate('required|string|min:3|max:20')]
    public ?string $zip;

    #[Validate('required|string|min:3|max:100')]
    public ?string $addressline;

    #[Validate('required|string|min:3|max:50')]
    public ?string $desired_job_title;

    #[Validate('required|string|min:3|max:50')]
    public ?string $desired_job_type;

    public function mount(string $id)
    {
        $user = User::findOrFail($id);

        $this->user = $user;
        $this->first_name = $user->first_name;
        $this->last_name = $user->last_name;
        $this->mobile_number = $user->mobile_number;
        $this->city = $user->city;
        $this->state = $user->state;
        $this->country = $user->country;
        $this->zip = $user->zip;
        $this->addressline = $user->addressline;
        $this->desired_job_title = $user->desired_job_title;
        $this->desired_job_type = $user->desired_job_type;
    }

    public function update()
    {
        $this->validate();

        $this->authorize('update', $this->user);

        $this->user->update([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'mobile_number' => $this->mobile_number,
            'city' => $this->city,
            'state' => $this->state,
            'country' => $this->country,
            'zip' => $this->zip,
            'addressline' => $this->addressline,
            'desired_job_title' => $this->desired_job_title,
            'desired_job_type' => $this->desired_job_type,
        ]);

        return session()->flash('message', 'User profile personal information updated successfully!');
    }

    public function render()
    {
        return view('livewire.profile.update-personal-information-form');
    }
}
