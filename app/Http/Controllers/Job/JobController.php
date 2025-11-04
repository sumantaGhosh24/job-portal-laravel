<?php

namespace App\Http\Controllers\Job;

use App\Http\Controllers\Controller;
use App\Models\CompanyJob;
use App\Models\Company;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index()
    {
        $jobs = CompanyJob::where('is_active', true)
            ->orderBy('created_at', 'desc')
            ->with('company')
            ->paginate(10);
            
        return view('jobs.index', ['jobs' => $jobs]);
    }

    public function create(string $id)
    {
        $company = Company::find($id);
        return view('jobs.create', ['company' => $company]);
    }

    public function store(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|string|min:5|max:150',
            'description' => 'required|string|min:5|max:255',
            'location' => 'required|string|min:5|max:100',
            'type' => 'required|string|max:50',
            'salary' => 'required|numeric',
            'deadline' => 'required|date',
        ]);

        CompanyJob::create(['title' => $request->title, 'description' => $request->description, 'location' => $request->location, 'type' => $request->type, 'salary' => $request->salary, 'deadline' => $request->deadline, 'company_id' => $id]);

        return redirect()->route('jobs.create', ['id' => $id])->with('message', 'Job posting created successfully!');
    }

    public function show(string $id)
    {
        $job = CompanyJob::with('company')->findOrFail($id);
        return view('jobs.show', ['job' => $job]);
    }

    public function edit(string $id)
    {
        $job = CompanyJob::find($id);
        return view('jobs.edit', ['job' => $job]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|string|min:5|max:150',
            'description' => 'required|string|min:5|max:255',
            'location' => 'required|string|min:5|max:100',
            'type' => 'required|string|max:50',
            'salary' => 'required|numeric',
            'deadline' => 'required|date',
            'is_active' => 'boolean',
        ]);

        $job = CompanyJob::find($id);

        $job->update(['title' => $request->title, 'description' => $request->description, 'location' => $request->location, 'type' => $request->type, 'salary' => $request->salary, 'deadline' => $request->deadline, 'is_active' => $request->is_active]);

        return redirect()->route('jobs.edit', ['id' => $id])->with('message', 'Job posting updated successfully!');
    }

    public function destroy(string $id)
    {
        $job = CompanyJob::find($id);
        
        $job->delete();
        
        return redirect()->route('companies.show', ['id' => $job->company_id])->with('success', 'Job posting deleted successfully!');
    }
}
