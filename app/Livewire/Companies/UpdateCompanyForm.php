<?php

namespace App\Livewire\Companies;

use App\Models\Company;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Attributes\Validate;
use Livewire\Component;

class UpdateCompanyForm extends Component
{
    use AuthorizesRequests;

    public Company $company;

    #[Validate('required|string|min:5|max:150')]
    public ?string $name;

    #[Validate('required|string|min:5|max:50')]
    public ?string $sector;

    #[Validate('required|digits:10')]
    public ?string $phone_number;

    #[Validate('required|string|lowercase|email')]
    public ?string $email;

    #[Validate('required|string|max:50')]
    public ?string $size;

    #[Validate('required|string|min:5|max:150')]
    public ?string $location;

    public function mount(string $id)
    {
        $company = Company::findOrFail($id);

        $this->company = $company;
        $this->name = $company->name;
        $this->sector = $company->sector;
        $this->phone_number = $company->phone_number;
        $this->email = $company->email;
        $this->size = $company->size;
        $this->location = $company->location;
    }

    public function update()
    {
        $this->validate();

        $this->authorize('update', $this->company);

        $this->company->update([
            'name' => $this->name,
            'sector' => $this->sector,
            'phone_number' => $this->phone_number,
            'email' => $this->email,
            'size' => $this->size,
            'location' => $this->location
        ]);

        session()->flash('message', 'Company information updated successfully!');
    }

    public function render()
    {
        return view('livewire.companies.update-company-form');
    }
}
