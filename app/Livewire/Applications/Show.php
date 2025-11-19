<?php

namespace App\Livewire\Applications;

use App\Models\JobApplication;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Show extends Component
{
    use AuthorizesRequests;

    public JobApplication $application;

    #[Validate('required|in:pending,reviewing,interviewed,accepted,rejected')]
    public $status;
    #[Validate('nullable|string|max:1000')]
    public $feedback;

    public function mount(string $id): void
    {
        $this->application = JobApplication::with('job.company')->findOrFail($id);
        $this->status = $this->application->status;
        $this->feedback = $this->application->feedback;
    }

    public function updateStatus(): void
    {
        $this->validate();

        $this->authorize('update', $this->application);

        $this->application->update([
            'status' => $this->status,
            'feedback' => $this->feedback,
        ]);

        session()->flash('message', 'Application status updated successfully!');
    }

    #[Title('Application Status')]
    public function render()
    {
        return view('livewire.applications.show');
    }
}
