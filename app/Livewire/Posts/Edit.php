<?php

namespace App\Livewire\Posts;

use App\Models\Post;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Edit extends Component
{
    use AuthorizesRequests;

    public Post $post;

    #[Validate('required|string|min:5|max:150')]
    public $title;

    #[Validate('required|string|min:3|max:200')]
    public $description;

    public function mount($id)
    {
        $post = Post::findOrFail($id);

        $this->post = $post;
        $this->title = $post->title;
        $this->description = $post->description;
    }

    public function update()
    {
        $this->validate();

        $this->authorize('update', $this->post);

        $this->post->update([
            'title' => $this->title,
            'description' => $this->description
        ]);

        return session()->flash('message', 'Post updated successful!');
    }

    #[Title('Update Post')]
    public function render()
    {
        return view('livewire.posts.edit');
    }
}
