<?php

namespace App\Livewire\CompanyPosts;

use App\Models\Company;
use App\Models\CompanyPost;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Create extends Component
{
    use AuthorizesRequests;

    public Company $company;

    public function mount($id)
    {
        $this->company = Company::findOrFail($id);
    }

    #[Validate('required|string|min:5|max:150')]
    public $title;

    #[Validate('required|string|min:3|max:200')]
    public $description;

    #[Validate('required|string|min:5|max:500')]
    public $post_content;

    public function save()
    {
        $this->validate();

        $this->authorize('create', [CompanyPost::class, $this->company]);

        CompanyPost::create([
            'title' => $this->title,
            'description' => $this->description,
            'content' => $this->post_content,
            'company_id' => $this->company->id
        ]);

        $this->reset(['title', 'description', 'post_content']);

        session()->flash('message', 'Post created successfully!');
    }

    #[Title('Create Company Post')]
    public function render()
    {
        return view('livewire.company-posts.create');
    }
}
