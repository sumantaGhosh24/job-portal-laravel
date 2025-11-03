<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyPost extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'content', 'company_id'];

    public function company() {
        return $this->belongsTo(Company::class);
    }

    public function likes() {
        return $this->hasMany(PostLike::class, 'post_id');
    }

    public function comments() {
        return $this->hasMany(PostComment::class, 'post_id');
    }

    public function isLikedBy(User $user) {
        return $this->likes()->where('user_id', $user->id)->exists();
    }
}
