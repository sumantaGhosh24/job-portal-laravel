<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class ProjectController extends Controller
{
    public function add(Request $request): RedirectResponse {
        $request->validate([
            'title' => ['required', 'string', 'min:3', 'max:150'],
            'description' => ['required', 'string', 'min:3', 'max:500'],
            'github_url' => ['required', 'url'],
        ]);

        Project::create(['title' => $request->title, 'description' => $request->description, 'github_url' => $request->github_url, 'user_id' => $request->user()->id]);

        return redirect()->route('profile', ['id' => $request->user()->id])->with('message', 'Project added successfully!');
    }

    public function update(Request $request, string $id): RedirectResponse {
        $request->validate([
            'title' => ['required', 'string', 'min:3', 'max:150'],
            'description' => ['required', 'string', 'min:3', 'max:500'],
            'github_url' => ['required', 'url'],
        ]);

        $project = Project::find($id);

        $project->update(['title' => $request->title, 'description' => $request->description, 'github_url' => $request->github_url]);

        return redirect()->route('profile', ['id' => $request->user()->id])->with('message', 'Project updated successfully!');
    }

    public function destroy(Request $request, string $id): RedirectResponse {
        $project = Project::find($id);

        $project->delete();

        return redirect()->route('profile', ['id' => $request->user()->id])->with('message', 'Project deleted successfully!');
    }
}