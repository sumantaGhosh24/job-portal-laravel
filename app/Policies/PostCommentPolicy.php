<?php

namespace App\Policies;

use App\Models\PostComment;
use App\Models\User;

class PostCommentPolicy
{
    public function delete(User $user, PostComment $postComment): bool
    {
        return $user->id === $postComment->user_id;
    }
}
