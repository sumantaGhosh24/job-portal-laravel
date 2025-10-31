<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'first_name',
        'last_name',
        'username',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function languages() {
        return $this->hasMany(Language::class);
    }

    public function certificates() {
        return $this->hasMany(Certificate::class);
    }

    public function projects() {
        return $this->hasMany(Project::class);
    }

    public function skills() {
        return $this->hasMany(Skill::class);
    }

    public function educations() {
        return $this->hasMany(Education::class);
    }

    public function experiences() {
        return $this->hasMany(Experience::class);
    }

    public function followers() {
        return $this->belongsToMany(User::class, 'follows', 'following_id', 'follower_id');
    }

    public function following() {
        return $this->belongsToMany(User::class, 'follows', 'follower_id', 'following_id');
    }

    public function isFollowing(User $user) {
        return $this->following()->where('following_id', $user->id)->exists();
    }

    public function posts() {
        return $this->hasMany(Post::class)->latest();
    }

    public function company()
    {
        return $this->hasOne(Company::class, 'owner_id');
    }

    public function membership()
    {
        return $this->hasOne(Member::class);
    }
}
