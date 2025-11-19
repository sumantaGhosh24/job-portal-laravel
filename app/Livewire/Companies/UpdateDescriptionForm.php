<?php

namespace App\Livewire\Companies;

use App\Models\Company;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Attributes\Validate;
use Livewire\Component;

class UpdateDescriptionForm extends Component
{
    use AuthorizesRequests;

    public Company $company;

    #[Validate('required|string|min:5|max:500')]
    public ?string $description;

    #[Validate('required|string|min:5|max:250')]
    public ?string $slogan;

    public function mount($id)
    {
        $company = Company::findOrFail($id);

        $this->company = $company;
        $this->description = $company->description;
        $this->slogan = $company->slogan;
    }

    public function update(): void
    {
        $this->validate();

        $this->authorize('update', $this->company);

        $this->company->update([
            'description' => $this->description,
            'slogan' => $this->slogan
        ]);

        session()->flash('message', 'Company description updated successfully!');
    }

    public function render()
    {
        return view('livewire.companies.update-description-form');
    }
}
