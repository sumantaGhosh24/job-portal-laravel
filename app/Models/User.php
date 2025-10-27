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
}
