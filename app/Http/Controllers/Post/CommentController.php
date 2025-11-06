<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller {
    public function store(Request $request, Post $post) {
        $request->validate(['comment' => 'required|string|max:200']);

        $post->comments()->create([
            'user_id' => $request->user()->id,
            'content' => $request->comment,
        ]);

        return back();
    }

    public function destroy(Request $request, Comment $comment) {
        if ($comment->user_id === $request->user()->id) {
            $comment->delete();
        }

        return back();
    }
}
