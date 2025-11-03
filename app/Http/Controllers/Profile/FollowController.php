<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
    public function follow(User $user)
    {
        $follower = Auth::user();

        if ($follower->id === $user->id) {
            return back()->with('error', 'You cannot follow yourself.');
        }

        if (!$follower->isFollowing($user)) {
            $follower->following()->attach($user->id);
        }

        return back()->with('message', 'You are now following ' . $user->name);
    }

    public function unfollow(User $user)
    {
        $follower = Auth::user();

        if ($follower->isFollowing($user)) {
            $follower->following()->detach($user->id);
        }

        return back()->with('message', 'You unfollowed ' . $user->name);
    }
}
