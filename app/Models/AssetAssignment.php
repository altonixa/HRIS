<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AssetAssignment extends Model
{
    protected $fillable = [
        'asset_id',
        'employee_id',
        'assigned_date',
        'returned_date',
        'condition_on_assign',
        'condition_on_return',
        'notes',
        'status'
    ];

    protected $casts = [
        'assigned_date' => 'date',
        'returned_date' => 'date'
    ];

    public function asset(): BelongsTo
    {
        return $this->belongsTo(Asset::class);
    }

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }
}
