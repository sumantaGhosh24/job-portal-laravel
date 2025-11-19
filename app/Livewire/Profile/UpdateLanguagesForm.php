<?php

namespace App\Livewire\Profile;

use App\Models\Language;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class UpdateLanguagesForm extends Component
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
            'name' => 'required|string|min:3|max:20',
            'proficiency' => 'required|string|min:3|max:20'
        ]);

        $this->authorize('update', $this->user);

        Language::create([
            'name' => $this->name,
            'proficiency' => $this->proficiency,
            'user_id' => $this->user->id,
        ]);

        $this->reset('name', 'proficiency');

        return session()->flash('message', 'Language added successfully!');
    }

    public ?Language $language = null;

    public string $language_name;

    public string $language_proficiency;

    public function edit(string $id)
    {
        $language = Language::findOrFail($id);

        $this->language = $language;
        $this->language_name = $language->name;
        $this->language_proficiency = $language->proficiency;
    }

    public function update()
    {
        $this->validate([
            'language_name' => 'required|string|min:3|max:20',
            'language_proficiency' => 'required|string|min:3|max:20'
        ]);

        $this->authorize('update', $this->user);

        if ($this->user->id != $this->language->user_id) {
            return session()->flash('message', 'You are not authorized to update this language!');
        }

        $this->language->update([
            'name' => $this->language_name,
            'proficiency' => $this->language_proficiency,
        ]);

        $this->reset('language', 'language_name', 'language_proficiency');

        return session()->flash('message', 'Language updated successfully!');
    }

    public function destroy(string $id)
    {
        $this->authorize('update', $this->user);

        $language = Language::findOrFail($id);

        $language->delete();

        return session()->flash('message', 'Language deleted successfully!');
    }

    public function render()
    {
        return view('livewire.profile.update-languages-form');
    }
}
