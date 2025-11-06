<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model {
    use HasFactory;

    protected $fillable = ['degree', 'field_of_study', 'institution_name', 'location', 'graduation_date', 'user_id'];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
