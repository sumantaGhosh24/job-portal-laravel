<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Models\Experience;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class ExperienceController extends Controller
{
    public function add(Request $request): RedirectResponse {
        $request->validate([
            'job_title' => ['required', 'string', 'min:3', 'max:100'],
            'company_name' => ['required', 'string', 'min:3', 'max:100'],
            'location' => ['required', 'string', 'min:3', 'max:100'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date'],
        ]);

        Experience::create(['job_title' => $request->job_title, 'company_name' => $request->company_name, 'location' => $request->location, 'start_date' => $request->start_date, 'end_date' => $request->end_date, 'user_id' => $request->user()->id]);

        return redirect()->route('profile', ['id' => $request->user()->id])->with('message', 'Experience added successfully!');
    }

    public function update(Request $request, string $id): RedirectResponse {
        $request->validate([
            'job_title' => ['required', 'string', 'min:3', 'max:100'],
            'company_name' => ['required', 'string', 'min:3', 'max:100'],
            'location' => ['required', 'string', 'min:3', 'max:100'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date'],
        ]);

        $experience = Experience::find($id);

        $experience->update(['job_title' => $request->job_title, 'company_name' => $request->company_name, 'location' => $request->location, 'start_date' => $request->start_date, 'end_date' => $request->end_date]);

        return redirect()->route('profile', ['id' => $request->user()->id])->with('message', 'Experience updated successfully!');
    }

    public function destroy(Request $request, string $id): RedirectResponse {
        $experience = Experience::find($id);

        $experience->delete();

        return redirect()->route('profile', ['id' => $request->user()->id])->with('message', 'Experience deleted successfully!');
    }
}