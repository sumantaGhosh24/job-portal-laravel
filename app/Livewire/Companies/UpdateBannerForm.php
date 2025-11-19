<?php

namespace App\Livewire\Companies;

use App\Models\Company;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class UpdateBannerForm extends Component
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

        if (!empty($this->company->banner)) {
            Storage::disk('public')->delete($this->company->banner);
        }

        $banner_path = $this->image->store('banners', 'public');

        $this->company->update(['banner' => $banner_path]);

        session()->flash('message', 'Company banner updated successfully!');
    }

    public function render()
    {
        return view('livewire.companies.update-banner-form');
    }
}
