<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'code',
        'description',
        'category',
        'provider',
        'duration_hours',
        'status',
    ];

    public function trainings()
    {
        return $this->hasMany(Training::class);
    }
}
