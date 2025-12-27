<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    protected $fillable = [
        'job_posting_id',
        'full_name',
        'email',
        'phone',
        'resume_path',
        'cover_letter',
        'status',
        'notes',
    ];

    public function jobPosting()
    {
        return $this->belongsTo(JobPosting::class);
    }
}
