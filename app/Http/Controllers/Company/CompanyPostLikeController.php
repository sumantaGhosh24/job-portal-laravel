<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\CompanyPost;

class CompanyPostLikeController extends Controller
{
    public function toggle(CompanyPost $post)
    {
        $user = auth()->user();

        if ($post->isLikedBy($user)) {
            $post->likes()->where('user_id', $user->id)->delete();
        } else {
            $post->likes()->create(['user_id' => $user->id]);
        }

        return back();
    }
}
