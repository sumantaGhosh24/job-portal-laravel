<?php

namespace App\Livewire\Companies;

use App\Models\Company;
use Livewire\Attributes\Title;
use Livewire\Component;

class Details extends Component
{
    public Company $company;

    public function mount(string $id)
    {
        $this->company = Company::findOrFail($id);
    }

    #[Title('Company Details')]
    public function render()
    {
        return view('livewire.companies.details');
    }
}
