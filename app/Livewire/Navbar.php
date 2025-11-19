<?php

namespace App\Livewire;

use App\Models\Member;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Navbar extends Component
{
    public $user_id;
    public $company_id;

    public $amount;

    public function mount() {
        $this->user_id = Auth::id();
        $member = Member::where('user_id', $this->user_id)->where('status', 'active')->first();
        $this->company_id = $member ? $member->company_id : null;
    }

    public function logout() {
        Auth::guard('web')->logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect('/');
    }

    public function render()
    {
        return view('livewire.navbar');
    }
}
