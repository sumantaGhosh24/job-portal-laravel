<?php

namespace App\Livewire\Posts;

use App\Models\Post;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Create extends Component
{
    use AuthorizesRequests;

    #[Validate('required|string|min:5|max:150')]
    public $title;

    #[Validate('required|string|min:3|max:200')]
    public $description;

    #[Validate('required|string|min:5|max:500')]
    public $post_content;

    public function save()
    {
        $this->validate();

        $this->authorize('create', Post::class);

        Post::create([
            'title' => $this->title,
            'description' => $this->description,
            'content' => $this->post_content,
            'user_id' => Auth::id()
        ]);

        $this->reset('title', 'description', 'post_content');

        return session()->flash('message', 'Post created successful!');
    }

    #[Title('Create Post')]
    public function render()
    {
        return view('livewire.posts.create');
    }
}
