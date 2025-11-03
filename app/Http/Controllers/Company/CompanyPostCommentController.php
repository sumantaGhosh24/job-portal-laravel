<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\CompanyPost;
use App\Models\PostComment;
use Illuminate\Http\Request;

class CompanyPostCommentController extends Controller
{
    public function store(Request $request, CompanyPost $post)
    {
        $request->validate(['comment' => 'required|string|max:200']);

        $post->comments()->create([
            'user_id' => $request->user()->id,
            'content' => $request->comment,
        ]);

        return back();
    }

    public function destroy(Request $request, PostComment $comment)
    {
        if ($comment->user_id === $request->user()->id) {
            $comment->delete();
        }

        return back();
    }
}
