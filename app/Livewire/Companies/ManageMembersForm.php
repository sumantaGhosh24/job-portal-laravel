<?php

namespace App\Livewire\Companies;

use App\Models\Company;
use App\Models\Member;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Attributes\Validate;
use Livewire\Component;

class ManageMembersForm extends Component
{
    use AuthorizesRequests;

    public Company $company;

    public function mount(string $id)
    {
        $this->company = Company::findOrFail($id);
    }

    public $user_id;

    public $position;

    public $department;

    public function save(): void
    {
        $this->validate([
            'user_id' => 'required|integer|exists:users,id',
            'position' => 'required|string|max:100',
            'department' => 'required|string|max:100',
        ]);

        $this->authorize('update', $this->company);

        $existing = Member::where('user_id', $this->user_id)->where('status', 'active')->first();
        if ($existing) {
            session()->flash('message', 'User already belongs to another company!');
            return;
        }

        Member::create([
            'company_id' => $this->company->id,
            'user_id' => $this->user_id,
            'role' => 'employee',
            'position' => $this->position,
            'department' => $this->department,
            'status' => 'active',
            'joining_date' => now(),
        ]);

        $this->reset('user_id', 'position', 'department');

        session()->flash('message', 'Employee added successfully!');
    }

    public ?Member $member = null;

    public ?string $member_position;

    public ?string $member_department;

    public function edit(string $id)
    {
        $member = Member::findOrFail($id);

        $this->member = $member;
        $this->member_position = $member->position;
        $this->member_department = $member->department;
    }

    public function update(): void
    {
        $this->validate([
            "member_position" => 'required|string|max:100',
            "member_department" => 'required|string|max:100',
        ]);

        $this->authorize('update', $this->company);

        $member = Member::where('company_id', $this->company->id)->where('id', $this->member->id)->where('status', 'active')->first();

        if (!$member) {
            session()->flash('message', 'User not found!');
            return;
        }

        $this->member->update([
            'position' => $this->member_position,
            'department' => $this->member_department,
        ]);

        $this->reset('member', 'member_position', 'member_department');

        session()->flash('message', 'Employee updated successfully!');
    }

    public function remove(string $id)
    {
        $this->authorize('update', $this->company);

        $member = Member::find($id);

        if (!$member || $member->company_id !== $this->company->id) {
            session()->flash('message', 'User not found!');
            return;
        }

        if ($member->role === 'admin') {
            session()->flash('message', 'Cannot remove admin from company!');
            return;
        }

        $member->update([
            'status' => 'ex-employee',
            'role' => 'ex-employee',
            'leaving_date' => now(),
        ]);

        return session()->flash('message', 'Employee marked as ex-employee!');
    }

    public function render()
    {
        return view('livewire.companies.manage-members-form');
    }
}
