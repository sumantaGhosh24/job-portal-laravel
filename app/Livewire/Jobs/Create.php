<?php

namespace App\Livewire\Jobs;

use App\Models\Company;
use App\Models\CompanyJob;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Create extends Component
{
    use AuthorizesRequests;
    public Company $company;

    public function mount($id)
    {
        $this->company = Company::findOrFail($id);
    }

    #[Validate('required|string|min:5|max:150')]
    public $title;

    #[Validate('required|string|min:5|max:255')]
    public $description;

    #[Validate('required|string|min:5|max:100')]
    public $location;

    #[Validate('required|in:full-time,part-time,contract,internship,temporary')]
    public $type;

    #[Validate('required|numeric|min:0')]
    public $salary;

    #[Validate('required|date|after:today')]
    public $deadline;

    public function save()
    {
        $this->validate();

        if (Auth::id() !== $this->company->owner_id) {
            return session()->flash('message', 'You are not authorized to create a job posting.');
        }

        CompanyJob::create([
            'title' => $this->title,
            'description' => $this->description,
            'location' => $this->location,
            'type' => $this->type,
            'salary' => $this->salary,
            'deadline' => $this->deadline,
            'company_id' => $this->company->id,
            'is_active' => true
        ]);

        $this->reset(['title', 'description', 'location', 'type', 'salary', 'deadline']);

        session()->flash('message', 'Job posting created successfully!');
    }

    #[Title('Create Job Post')]
    public function render()
    {
        return view('livewire.jobs.create');
    }
}
