<?php

namespace App\Livewire\CompanyPosts;

use App\Models\CompanyPost;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Edit extends Component
{
    use AuthorizesRequests;

    public CompanyPost $post;

    #[Validate('required|string|min:5|max:150')]
    public $title;

    #[Validate('required|string|min:3|max:200')]
    public $description;

    #[Validate('required|string|min:5|max:500')]
    public $post_content;

    public function mount($id)
    {
        $post = CompanyPost::findOrFail($id);

        $this->post = $post;
        $this->title = $post->title;
        $this->description = $post->description;
        $this->post_content = $post->content;
    }

    public function update()
    {
        $this->validate();

        $this->authorize('update', $this->post);

        $this->post->update([
            'title' => $this->title,
            'description' => $this->description,
            'content' => $this->post_content
        ]);

        session()->flash('message', 'Post updated successfully!');
    }

    #[Title('Update Company Post')]
    public function render()
    {
        return view('livewire.company-posts.edit');
    }
}
