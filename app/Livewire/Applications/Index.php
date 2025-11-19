<?php

namespace App\Livewire\Applications;

use App\Models\JobApplication;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination, WithoutUrlPagination;

    #[Title('My Applications')]
    public function render()
    {
        $applications = JobApplication::where('user_id', Auth::id())
            ->with('job.company')
            ->latest()
            ->paginate(10);

        return view('livewire.applications.index', [
            'applications' => $applications,
        ]);
    }
}
