<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AppraisalMetric extends Model
{
    protected $fillable = [
        'appraisal_id',
        'kpi_id',
        'self_score',
        'manager_score',
        'comments',
    ];

    public function appraisal()
    {
        return $this->belongsTo(Appraisal::class);
    }

    public function kpi()
    {
        return $this->belongsTo(KPI::class);
    }
}
