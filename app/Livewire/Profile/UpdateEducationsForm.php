<?php

namespace App\Livewire\Profile;

use App\Models\Education;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class UpdateEducationsForm extends Component
{
    use AuthorizesRequests;

    public User $user;

    public function mount(string $id)
    {
        $this->user = User::findOrFail($id);
    }

    public $degree;

    public $field_of_study;

    public $institution_name;

    public $location;

    public $graduation_date;

    public function save()
    {
        $this->validate([
            'degree' => 'required|string|min:3|max:50',
            'field_of_study' => 'required|string|min:3|max:50',
            'institution_name' => 'required|string|min:3|max:150',
            'location' => 'required|string|min:3|max:100',
            'graduation_date' => 'required|date'
        ]);

        $this->authorize('update', $this->user);

        Education::create([
            'degree' => $this->degree,
            'field_of_study' => $this->field_of_study,
            'institution_name' => $this->institution_name,
            'location' => $this->location,
            'graduation_date' => $this->graduation_date,
            'user_id' => $this->user->id
        ]);

        $this->reset('degree', 'field_of_study', 'institution_name', 'location', 'graduation_date');

        return session()->flash('message', 'Education added successfully!');
    }

    public ?Education $education = null;

    public $education_degree;

    public $education_field_of_study;

    public $education_institution_name;

    public $education_location;

    public $education_graduation_date;

    public function edit(string $id)
    {
        $education = Education::findOrFail($id);

        $this->education = $education;
        $this->education_degree = $education->degree;
        $this->education_field_of_study = $education->field_of_study;
        $this->education_institution_name = $education->institution_name;
        $this->education_location = $education->location;
        $this->education_graduation_date = $education->graduation_date;
    }

    public function update()
    {
        $this->validate([
            'education_degree' => 'required|string|min:3|max:50',
            'education_field_of_study' => 'required|string|min:3|max:50',
            'education_institution_name' => 'required|string|min:3|max:150',
            'education_location' => 'required|string|min:3|max:100',
            'education_graduation_date' => 'required|date'
        ]);

        $this->authorize('update', $this->user);

        if ($this->user->id != $this->education->user_id) {
            return session()->flash('message', 'You are not authorized to update this education!');
        }

        $this->education->update([
            'degree' => $this->education_degree,
            'field_of_study' => $this->education_field_of_study,
            'institution_name' => $this->education_institution_name,
            'location' => $this->education_location,
            'graduation_date' => $this->education_graduation_date
        ]);

        $this->reset('education', 'education_degree', 'education_field_of_study', 'education_institution_name', 'education_location', 'education_graduation_date');

        return session()->flash('message', 'Education updated successfully!');
    }

    public function destroy(string $id)
    {
        $this->authorize('update', $this->user);

        $education = Education::find($id);

        $education->delete();

        return session()->flash('message', 'Education deleted successfully!');
    }

    public function render()
    {
        return view('livewire.profile.update-educations-form');
    }
}
