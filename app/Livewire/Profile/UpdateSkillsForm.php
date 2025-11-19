<?php

namespace App\Livewire\Profile;

use App\Models\Skill;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class UpdateSkillsForm extends Component
{
    use AuthorizesRequests;

    public User $user;

    public function mount(string $id)
    {
        $this->user = User::findOrFail($id);
    }

    public string $name;

    public string $proficiency;

    public function save()
    {
        $this->validate([
            'name' => 'required|string|min:3|max:50',
            'proficiency' => 'required|string|in:beginner,intermediate,advanced,expert',
        ]);

        $this->authorize('update', $this->user);

        Skill::create([
            'name' => $this->name,
            'proficiency' => $this->proficiency,
            'user_id' => $this->user->id,
        ]);

        $this->reset('name', 'proficiency');

        return session()->flash('message', 'Skill added successfully!');
    }

    public ?Skill $skill = null;

    public string $skill_name;

    public string $skill_proficiency;

    public function edit(string $id)
    {
        $skill = Skill::findOrFail($id);

        $this->skill = $skill;
        $this->skill_name = $skill->name;
        $this->skill_proficiency = $skill->proficiency;
    }

    public function update()
    {
        $this->validate([
            'skill_name' => 'required|string|min:3|max:50',
            'skill_proficiency' => 'required|string|in:beginner,intermediate,advanced,expert',
        ]);

        $this->authorize('update', $this->user);

        if ($this->user->id != $this->skill->user_id) {
            return session()->flash('message', 'You are not authorized to update this skill!');
        }

        $this->skill->update([
            'name' => $this->skill_name,
            'proficiency' => $this->skill_proficiency,
        ]);

        $this->reset('skill', 'skill_name', 'skill_proficiency');

        return session()->flash('message', 'Skill updated successfully!');
    }

    public function destroy(string $id)
    {
        $this->authorize('update', $this->user);

        $skill = Skill::findOrFail($id);

        $skill->delete();

        return session()->flash('message', 'Skill deleted successfully!');
    }

    public function render()
    {
        return view('livewire.profile.update-skills-form');
    }
}
