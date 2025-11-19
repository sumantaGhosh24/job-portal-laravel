<?php

namespace App\Livewire\Jobs;

use App\Models\CompanyJob;
use App\Models\JobApplication;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class Show extends Component
{
    use WithFileUploads;

    public CompanyJob $job;

    public function mount($id)
    {
        $this->job = CompanyJob::with('company')->findOrFail($id);
    }

    #[Validate('required|string')]
    public $cover_letter;

    #[Validate('required|file|mimes:pdf,doc,docx|max:2048')]
    public $resume;

    public function save()
    {
        $this->validate();

        if (!$this->job->is_active) {
            return session()->flash('message', 'This job posting is not active anymore.');
        }

        $alreadySubmitted = JobApplication::where('company_job_id', $this->job->id)
            ->where('user_id', Auth::id())
            ->where('status', 'pending')
            ->first();

        if ($alreadySubmitted) {
            return session()->flash('message', 'You have already submitted an application for this job!');
        }

        $resume_path = $this->resume->store('resumes', 'public');

        JobApplication::create([
            'cover_letter' => $this->cover_letter,
            'resume_path' => $resume_path,
            'status' => 'pending',
            'company_job_id' => $this->job->id,
            'user_id' => Auth::id()
        ]);

        $this->reset('cover_letter', 'resume');

        return session()->flash('message', 'Job application submitted successfully!');
    }

    #[Title('Job Details')]
    public function render()
    {
        return view('livewire.jobs.show');
    }
}
