<?php

namespace App\View\Components;

use App\Models\Member;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class AppLayout extends Component {
    public function render(): View|Closure|string {
        $userId = Auth::id();

        $member = Member::where('user_id', $userId)->where('status', 'active')->first();

        return view('layouts.app', [
            'user_id' => $userId,
            'company_id' => $member->company_id ?? null,
        ]);
    }
}
