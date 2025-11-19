<?php

namespace App\Livewire\Jobs;

use Livewire\Attributes\Title;
use Livewire\Component;
use App\Models\CompanyJob;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination, WithoutUrlPagination;
    

    #[Title('Available Jobs')]
    public function render()
    {
        $jobs = CompanyJob::where('is_active', true)
            ->orderBy('created_at', 'desc')
            ->with('company')
            ->paginate(10);

        return view('livewire.jobs.index', [
            'jobs' => $jobs,
        ]);
    }
}
