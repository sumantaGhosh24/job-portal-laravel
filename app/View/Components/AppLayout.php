<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class AppLayout extends Component
{
    public function render(): View|Closure|string
    {
        $userId = Auth::id();

        return view('layouts.app', [
            'user_id' => $userId,
        ]);
    }
}
