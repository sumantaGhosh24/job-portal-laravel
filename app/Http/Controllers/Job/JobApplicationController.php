<?php

namespace App\Http\Controllers\Job;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\CompanyJob;
use App\Models\JobApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class JobApplicationController extends Controller
{
    public function index()
    {
        $applications = JobApplication::where('user_id', Auth::id())
            ->with('job.company')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        return view('applications.index', ['applications' => $applications]);
    }

    public function manage()
    {
        $company = Company::where('owner_id', Auth::id())->pluck('id')->first();

        $jobs = CompanyJob::where('company_id', $company)->with('applications')->get();

        return view('applications.manage', ['jobs' => $jobs]);
    }

    public function store(Request $request, string $id)
    {
        $request->validate([
            'cover_letter' => 'nullable|string',
            'resume' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ]);

        $alreadySubmitted = JobApplication::where('company_job_id', $id)->where('user_id', $request->user()->id)->where('status', 'pending')->first();

        if ($alreadySubmitted) {
            return redirect()->route('jobs.show', ['id' => $id])->with('message', 'You have already submitted an application for this job!');
        }

        if ($request->file('resume')) {
            $image = $request->file('resume');
            $newName = time() . '-' . uniqid() . '.' . $image->getClientOriginalExtension();

            Storage::disk('public')->put($newName, file_get_contents($image));
        }

        JobApplication::create([
            'cover_letter' => $request->cover_letter, 'resume_path' => $newName, 'status' => 'pending', 'company_job_id' => $id, 'user_id' => $request->user()->id
        ]);

        return redirect()->route('jobs.show', ['id' => $id])->with('message', 'Job application submitted successfully!');
    }

    public function show(string $id)
    {
        $application = JobApplication::with('job.company')->findOrFail($id);

        return view('applications.show', ['application' => $application]);
    }

    public function updateStatus(Request $request, string $id)
    {
        $request->validate([
            'status' => 'required|string',
            'feedback' => 'required|string',
        ]);

        $application = JobApplication::find($id);
        
        $application->update([
            'status' => $request->status,
            'feedback' => $request->feedback,
        ]);

        return redirect()->back()->with('message', 'Application status updated successfully!');
    }
}
