<?php

namespace App\Livewire\Applications;

use App\Models\Company;
use App\Models\CompanyJob;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Title;
use Livewire\Component;

class Manage extends Component
{
    public $jobs = [];

    public function mount(): void
    {
        $company = Company::where('owner_id', Auth::id())->pluck('id')->first();
        if (!$company) {
            $this->jobs = [];
            return;
        }

        $this->jobs = CompanyJob::where('company_id', $company)->with(['applications.user'])->get();
    }

    #[Title('Manage Applications')]
    public function render()
    {
        return view('livewire.applications.manage');
    }
}
