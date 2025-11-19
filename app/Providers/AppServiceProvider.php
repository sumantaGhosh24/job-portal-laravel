<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Relation::morphMap([
            'certificate' => \App\Models\Certificate::class,
            'comment' => \App\Models\Comment::class,
            'company' => \App\Models\Company::class,
            'company-job' => \App\Models\CompanyJob::class,
            'company-post' => \App\Models\CompanyPost::class,
            'education' => \App\Models\Education::class,
            'job-application' => \App\Models\JobApplication::class,
            'language' => \App\Models\Language::class,
            'like' => \App\Models\Like::class,
            'member' => \App\Models\Member::class,
            'post' => \App\Models\Post::class,
            'post-comment' => \App\Models\PostComment::class,
            'post-like' => \App\Models\PostLike::class,
            'project' => \App\Models\Project::class,
            'skill' => \App\Models\Skill::class,
            'user' => \App\Models\User::class,
        ]);
    }
}
