<?php

namespace App\Livewire\Posts;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Illuminate\Support\Str;
use League\CommonMark\Extension\HeadingPermalink\HeadingPermalinkExtension;

class Show extends Component
{
    use AuthorizesRequests;

    public Post $post;

    public function mount($id)
    {
        $post = Post::findOrFail($id);

        $post->html_content = Str::markdown($post->content, [new HeadingPermalinkExtension()]);

        $this->post = $post;
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

    public function deleteComment($id)
    {
        $comment = Comment::findOrFail($id);

        $this->authorize('delete', $comment);

        $comment->delete();
    }

    #[Title('Post Details')]
    public function render()
    {
        return view('livewire.posts.show');
    }
}
