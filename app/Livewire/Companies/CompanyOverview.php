<?php

namespace App\Livewire\Companies;

use App\Models\Company;
use App\Models\CompanyJob;
use App\Models\CompanyPost;
use App\Models\Member;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CompanyOverview extends Component
{
    use AuthorizesRequests;
    public Company $company;

    public ?Member $member = null;

    public function mount(string $id)
    {
        $this->company = Company::findOrFail($id);

        $userId = Auth::id();
        $this->member = Member::where('user_id', $userId)->where('company_id', $id)->first();
    }

    public function follow(): void
    {
        $user = auth()->user();
        if (!$user->isFollowingCompany($this->company)) {
            $user->followedCompanies()->syncWithoutDetaching([$this->company->id]);
        }

        session()->flash('message', 'You are now following ' . $this->company->name);
    }

    public function unfollow(): void
    {
        $user = auth()->user();
        if ($user->isFollowingCompany($this->company)) {
            $user->followedCompanies()->detach($this->company->id);
        }

        session()->flash('message', 'You have unfollowed ' . $this->company->name);
    }

    public function deletePost(string $id): void
    {
        $post = CompanyPost::find($id);

        $this->authorize('update', $this->company);

        if (!$post || $post->company_id !== $this->company->id) {
            session()->flash('message', 'Post not found!');
            return;
        }

        $post->delete();

        session()->flash('message', 'Post deleted successful!');
    }

    public function deleteJob(string $id): void
    {
        $job = CompanyJob::find($id);

        $this->authorize('update', $this->company);

        if (!$job || $job->company_id !== $this->company->id) {
            session()->flash('message', 'Job not found!');
            return;
        }

        $job->delete();

        session()->flash('message', 'Job posting deleted successfully!');
    }

    public function render()
    {
        return view('livewire.companies.company-overview');
    }
}
