<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Company extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'logo', 'banner', 'sector', 'size', 'location', 'description', 'phone_number', 'email', 'slogan', 'linkedin_url', 'twitter_url', 'facebook_url', 'youtube_url', 'instagram_url', 'website_url', 'owner_id'];

    public function members()
    {
        return $this->hasMany(Member::class);
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function posts()
    {
        return $this->hasMany(CompanyPost::class)->latest();
    }

    public function jobs()
    {
        return $this->hasMany(CompanyJob::class);
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'company_follows', 'company_id', 'user_id');
    }

    public function isFollowedBy(User $user)
    {
        return $this->followers()->where('user_id', $user->id)->exists();
    }
}
