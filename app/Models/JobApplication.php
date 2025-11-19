<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    protected $fillable = ['company_job_id', 'user_id', 'cover_letter', 'resume_path', 'status', 'feedback'];

    public function job()
    {
        return $this->belongsTo(CompanyJob::class, 'company_job_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
