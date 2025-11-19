<?php

namespace App\Livewire\Jobs;

use App\Models\CompanyJob;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Edit extends Component
{
    use AuthorizesRequests;

    public CompanyJob $job;

    #[Validate('required|string|min:5|max:150')]
    public ?string $title;

    #[Validate('required|string|min:5|max:255')]
    public ?string $description;

    #[Validate('required|string|min:5|max:100')]
    public ?string $location;

    #[Validate('required|in:full-time,part-time,contract,internship,temporary')]
    public ?string $type;

    #[Validate('required|numeric|min:0')]
    public ?string $salary;

    #[Validate('required|date|after_or_equal:today')]
    public ?string $deadline;

    #[Validate('boolean')]
    public $is_active;

    public function mount(string $id)
    {
        $job = CompanyJob::findOrFail($id);

        $this->job = $job;
        $this->title = $job->title;
        $this->description = $job->description;
        $this->location = $job->location;
        $this->type = $job->type;
        $this->salary = $job->salary;
        $this->deadline = $job->deadline;
        $this->is_active = $job->is_active;
    }

    public function update(): void
    {
        $this->validate();

        $this->authorize('update', $this->job);

        $this->job->update([
            'title' => $this->title,
            'description' => $this->description,
            'location' => $this->location,
            'type' => $this->type,
            'salary' => $this->salary,
            'deadline' => $this->deadline,
            'is_active' => $this->is_active
        ]);

        session()->flash('message', 'Job posting updated successfully!');
    }

    #[Title('Update Job Post')]
    public function render()
    {
        return view('livewire.jobs.edit');
    }
}
