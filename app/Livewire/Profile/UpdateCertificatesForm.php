<?php

namespace App\Livewire\Profile;

use App\Models\Certificate;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class UpdateCertificatesForm extends Component
{
    use AuthorizesRequests;

    public User $user;

    public function mount(string $id)
    {
        $this->user = User::findOrFail($id);
    }

    public $name;

    public $issuing_organization;

    public $issue_date;

    public function save()
    {
        $this->validate([
            'name' => 'required|string|min:3|max:50',
            'issuing_organization' => 'required|string|min:3|max:100',
            'issue_date' => 'required|date'
        ]);

        $this->authorize('update', $this->user);

        Certificate::create([
            'name' => $this->name,
            'issuing_organization' => $this->issuing_organization,
            'issue_date' => $this->issue_date,
            'user_id' => $this->user->id
        ]);

        $this->reset('name', 'issuing_organization', 'issue_date');

        return session()->flash('message', 'Certificate added successfully!');
    }

    public ?Certificate $certificate = null;

    public string $certificate_name;

    public string $certificate_issuing_organization;

    public string $certificate_issue_date;

    public function edit(string $id)
    {
        $certificate = Certificate::findOrFail($id);

        $this->certificate = $certificate;
        $this->certificate_name = $certificate->name;
        $this->certificate_issuing_organization = $certificate->issuing_organization;
        $this->certificate_issue_date = $certificate->issue_date;
    }

    public function update()
    {
        $this->validate([
            'certificate_name' => 'required|string|min:3|max:50',
            'certificate_issuing_organization' => 'required|string|min:3|max:100',
            'certificate_issue_date' => 'required|date'
        ]);

        $this->authorize('update', $this->user);

        if ($this->user->id != $this->certificate->user_id) {
            return session()->flash('message', 'You are not authorized to update this certificate!');
        }

        $this->certificate->update([
            'name' => $this->certificate_name,
            'issuing_organization' => $this->certificate_issuing_organization,
            'issue_date' => $this->certificate_issue_date
        ]);

        $this->reset('certificate', 'certificate_name', 'certificate_issuing_organization', 'certificate_issue_date');

        return session()->flash('message', 'Certificate updated successfully!');
    }

    public function destroy(string $id)
    {
        $this->authorize('update', $this->user);

        $certificate = Certificate::findOrFail($id);

        $certificate->delete();

        return session()->flash('message', 'Certificate deleted successfully!');
    }

    public function render()
    {
        return view('livewire.profile.update-certificates-form');
    }
}
