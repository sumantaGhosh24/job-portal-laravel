<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = ['name', 'logo', 'banner', 'sector', 'size', 'location', 'description', 'phone_number', 'email', 'slogan', 'linkedin_url', 'twitter_url', 'facebook_url', 'youtube_url', 'instagram_url', 'website_url', 'owner_id'];

    public function members()
    {
        return $this->hasMany(Member::class);
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }
}
