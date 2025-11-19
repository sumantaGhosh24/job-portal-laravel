<?php

namespace App\Livewire;

use App\Models\Company;
use App\Models\CompanyPost;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;

class Home extends Component
{
    use WithPagination, WithoutUrlPagination;

    public function mount(): void {}

    public function followUser(int $id): void
    {
        $user = Auth::user();
        if (!$user) {
            return;
        }

        $user->following()->syncWithoutDetaching([$id]);
        session()->flash('message', 'Followed user successfully');
        $this->resetPage('postsPage');
    }

    public function followCompany(int $id): void
    {
        $user = Auth::user();
        if (!$user) {
            return;
        }

        $user->followedCompanies()->syncWithoutDetaching([$id]);
        session()->flash('message', 'Followed company successfully');
        $this->resetPage('companyPostsPage');
    }

    public function destroyPost(string $id)
    {
        $post = Post::find($id);

        $this->authorize('update', $this->user);

        if (!$post) {
            return session()->flash('message', 'Post not found.');
        }

        if ($post->user_id !== $this->user->id) {
            return session()->flash('message', 'Not authorized to delete this post.');
        }

        $post->delete();

        return session()->flash('message', 'Post deleted successful!');
    }

    public function render()
    {
        $user = Auth::user();
        if (!$user) {
            return view('livewire.home', [
                'suggested' => collect(),
                'posts' => collect(),
                'suggestedCompanies' => collect(),
                'companyPosts' => collect(),
            ]);
        }

        $followingIds = $user->following()->pluck('users.id')->toArray();

        $suggested = User::whereNotIn('id', $followingIds)
            ->where('id', '!=', $user->id)
            ->inRandomOrder()
            ->take(5)
            ->get();

        $posts = Post::with('user')
            ->whereIn('user_id', array_merge($followingIds, [$user->id]))
            ->latest()
            ->paginate(10, ['*'], 'postsPage');

        $followedCompanyIds = $user->followedCompanies()->pluck('companies.id')->toArray();

        $suggestedCompanies = Company::whereNotIn('id', $followedCompanyIds)
            ->inRandomOrder()
            ->take(5)
            ->get();

        $companyPosts = CompanyPost::with('company')
            ->whereIn('company_id', $followedCompanyIds)
            ->latest()
            ->paginate(10, ['*'], 'companyPostsPage');

        return view('livewire.home', [
            'suggested' => $suggested,
            'posts' => $posts,
            'suggestedCompanies' => $suggestedCompanies,
            'companyPosts' => $companyPosts,
        ]);
    }
}
