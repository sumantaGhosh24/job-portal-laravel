<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = ['email', 'password', 'first_name', 'last_name', 'username', 'mobile_number', 'city', 'state', 'country', 'zip', 'addressline', 'desired_job_title', 'desired_job_type', 'profile_image', 'background_image', 'headline', 'professional_summary', 'resume', 'linkedin_url', 'github_url', 'website_url'];

    protected $hidden = ['password', 'remember_token'];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function languages()
    {
        return $this->hasMany(Language::class);
    }

    public function certificates()
    {
        return $this->hasMany(Certificate::class);
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    public function skills()
    {
        return $this->hasMany(Skill::class);
    }

    public function educations()
    {
        return $this->hasMany(Education::class);
    }

    public function jobApplications()
    {
        return $this->hasMany(JobApplication::class);
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'follows', 'following_id', 'follower_id');
    }

    public function following()
    {
        return $this->belongsToMany(User::class, 'follows', 'follower_id', 'following_id');
    }

    public function isFollowing(User $user)
    {
        return $this->following()->where('following_id', $user->id)->exists();
    }

    public function posts()
    {
        return $this->hasMany(Post::class)->latest();
    }

    public function company()
    {
        return $this->hasOne(Company::class, 'owner_id');
    }

    public function memberships()
    {
        return $this->hasMany(Member::class);
    }

    public function followedCompanies()
    {
        return $this->belongsToMany(Company::class, 'company_follows', 'user_id', 'company_id');
    }

    public function isFollowingCompany(Company $company)
    {
        return $this->followedCompanies()->where('company_id', $company->id)->exists();
    }
}
