<?php

namespace App\Livewire\CompanyPosts;

use App\Models\CompanyPost;
use App\Models\PostComment;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Illuminate\Support\Str;
use League\CommonMark\Extension\HeadingPermalink\HeadingPermalinkExtension;

class Show extends Component
{
    use AuthorizesRequests;

    public CompanyPost $post;

    public function mount($id)
    {
        $post = CompanyPost::findOrFail($id);

        $post->load('company', 'likes', 'comments.user');

        $post->html_content = Str::markdown($post->content, [new HeadingPermalinkExtension()]);

        $this->post  = $post;
    }

    public function toggleLike()
    {
        $user = Auth::user();

        if (!$user) {
            return;
        }

        if ($this->post->isLikedBy($user)) {
            $this->post->likes()->where('user_id', $user->id)->delete();
        } else {
            $this->post->likes()->create(['user_id' => $user->id]);
        }

        $this->post->load('likes');

        return;
    }

    #[Validate('required|string|max:200')]
    public $comment;

    public function saveComment()
    {
        if (!Auth::check()) {
            return;
        }

        $this->validate();

        $this->post->comments()->create([
            'user_id' => Auth::id(),
            'content' => $this->comment,
        ]);

        $this->reset('comment');
        return;
    }

    public function deleteComment($commentId)
    {
        $comment = PostComment::findOrFail($commentId);

        $this->authorize('delete', $comment);

        $comment->delete();
    }

    #[Title('Company Post Details')]
    public function render()
    {
        return view('livewire.company-posts.show');
    }
}
