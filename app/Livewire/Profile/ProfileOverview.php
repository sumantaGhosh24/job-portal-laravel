<?php

namespace App\Livewire\Profile;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class ProfileOverview extends Component
{
    use AuthorizesRequests;
    public User $user;

    public function mount(string $id)
    {
        $this->user = User::findOrFail($id);
    }

    public function follow()
    {
        $follower = Auth::user();

        if ($follower->id === $this->user->id) {
            return session()->flash('message', 'You cannot follow yourself.');
        }

        if (!$follower->isFollowing($this->user)) {
            $follower->following()->attach($this->user->id);
        }

        return session()->flash('message', 'You are now following ' . $this->user->first_name);
    }

    public function unfollow()
    {
        $follower = Auth::user();

        if ($follower->isFollowing($this->user)) {
            $follower->following()->detach($this->user->id);
        }

        return session()->flash('message', 'You unfollowed ' . $this->user->first_name);
    }

    public function download()
    {
        if (!$this->user->resume || !Storage::disk('public')->exists($this->user->resume)) {
            return session()->flash('message', 'Resume not found.');
        }

        return Storage::disk('public')->download($this->user->resume, 'resume.pdf');
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
        return view('livewire.profile.profile-overview');
    }
}
