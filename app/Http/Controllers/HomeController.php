<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function show()
    {
        $user = Auth::user();

        $followingIds = $user->following()->pluck('users.id')->toArray();

        $suggested = User::whereNotIn('id', $followingIds)->where('id', '!=', $user->id)->inRandomOrder()->take(5)->get();

        $posts = Post::with('user')->whereIn('user_id', values: [...$followingIds, $user->id])->latest()->paginate(10);

        return view('home', ['suggested' => $suggested, 'posts' => $posts]);
    }
}
