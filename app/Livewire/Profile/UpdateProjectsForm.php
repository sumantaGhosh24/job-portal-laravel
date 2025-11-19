<?php

namespace App\Livewire\Profile;

use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class UpdateProjectsForm extends Component
{
    use AuthorizesRequests;

    public User $user;

    public function mount(string $id)
    {
        $this->user = User::findOrFail($id);
    }

    public string $title;

    public string $description;

    public string $github_url;


    public function save()
    {
        $this->validate([
            'title' => 'required|string|min:3|max:150',
            'description' => 'required|string|min:3|max:500',
            'github_url' => 'required|url',
        ]);

        $this->authorize('update', $this->user);

        Project::create([
            'title' => $this->title,
            'description' => $this->description,
            'github_url' => $this->github_url,
            'user_id' => $this->user->id,
        ]);

        $this->reset('title', 'description', 'github_url');

        return session()->flash('message', 'Project added successfully!');
    }

    public ?Project $project = null;

    public string $project_title;

    public string $project_description;

    public string $project_github_url;

    public function edit(string $id)
    {
        $project = Project::findOrFail($id);

        $this->project = $project;
        $this->project_title = $project->title;
        $this->project_description = $project->description;
        $this->project_github_url = $project->github_url;
    }

    public function update()
    {
        $this->validate([
            'project_title' => 'required|string|min:3|max:150',
            'project_description' => 'required|string|min:3|max:500',
            'project_github_url' => 'required|url',
        ]);

        $this->authorize('update', $this->user);

        if ($this->user->id != $this->project->user_id) {
            return session()->flash('message', 'You are not authorized to update this project!');
        }

        $this->project->update([
            'title' => $this->project_title,
            'description' => $this->project_description,
            'github_url' => $this->project_github_url,
        ]);

        $this->reset('project', 'project_title', 'project_description', 'project_github_url');

        return session()->flash('message', 'Project updated successfully!');
    }

    public function destroy(string $id)
    {
        $this->authorize('update', $this->user);

        $project = Project::findOrFail($id);

        $project->delete();

        return session()->flash('message', 'Project deleted successfully!');
    }

    public function render()
    {
        return view('livewire.profile.update-projects-form');
    }
}
