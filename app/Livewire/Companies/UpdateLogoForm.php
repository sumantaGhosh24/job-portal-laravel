<?php

namespace App\Livewire\Companies;

use App\Models\Company;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class UpdateLogoForm extends Component
{
    use AuthorizesRequests, WithFileUploads;

    public Company $company;

    public function mount($id)
    {
        $this->company = Company::findOrFail($id);
    }

    #[Validate('required|image|mimes:jpeg,png,jpg,gif|max:2048')]
    public $image;

    public function update(): void
    {
        $this->validate();

        $this->authorize('update', $this->company);

        if (!empty($this->company->logo)) {
            Storage::disk('public')->delete($this->company->logo);
        }

        $logo_path = $this->image->store('logos', 'public');

        $this->company->update(['logo' => $logo_path]);

        session()->flash('message', 'Company logo updated successfully!');
    }

    public function render()
    {
        return view('livewire.companies.update-logo-form');
    }
}
