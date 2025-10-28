<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function show()
    {
        $user = Auth::user();

        $followingIds = $user->following()->pluck('users.id')->toArray();

        $suggested = User::whereNotIn('id', $followingIds)->where('id', '!=', $user->id)->inRandomOrder()->take(5)->get();

        return view('home', ['suggested' => $suggested]);
    }
}
