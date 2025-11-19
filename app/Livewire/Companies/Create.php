<?php

namespace App\Livewire\Companies;

use App\Models\Company;
use App\Models\Member;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Create extends Component
{
    public User $user;

    public bool $hasActiveMembership = false;

    public ?int $activeCompanyId = null;

    public function mount()
    {
        $id = Auth::id();
        $user = User::findOrFail($id);
        $activeMembership = Member::where('user_id', $id)->where('status', 'active')->first();

        $this->user = $user;
        $this->hasActiveMembership = (bool) $activeMembership;
        $this->activeCompanyId = $activeMembership?->company_id;
    }

    #[Validate('required|string|min:5|max:150')]
    public $name;

    #[Validate('required|string|min:5|max:50')]
    public $sector;

    #[Validate('required|string|max:50')]
    public $size;

    #[Validate('required|digits:10')]
    public $phone_number;

    #[Validate('required|string|lowercase|email')]
    public $email;

    #[Validate('required|string|min:5|max:150')]
    public $location;

    public function save(): void
    {
        $this->validate();

        if ($this->hasActiveMembership) {
            session()->flash('message', 'You are already a member of a company.');
            return;
        }

        DB::transaction(function (): void {
            $company = Company::create([
                'name' => $this->name,
                'sector' => $this->sector,
                'size' => $this->size,
                'phone_number' => $this->phone_number,
                'email' => $this->email,
                'location' => $this->location,
                'owner_id' => Auth::id(),
            ]);

            Member::create([
                'company_id' => $company->id,
                'user_id' => Auth::id(),
                'role' => 'admin',
                'status' => 'active',
                'joining_date' => now(),
            ]);
        });

        session()->flash('message', 'Company created successfully!');
    }

    #[Title('Create Company')]
    public function render()
    {
        return view('livewire.companies.create');
    }
}
