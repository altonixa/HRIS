<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ExpenseClaim extends Model
{
    protected $fillable = [
        'employee_id',
        'title',
        'category',
        'amount',
        'currency',
        'description',
        'claim_date',
        'receipt_path',
        'status',
        'approved_by',
        'approval_remarks',
        'approved_at'
    ];

    protected $casts = [
        'claim_date' => 'date',
        'approved_at' => 'datetime',
        'amount' => 'decimal:2'
    ];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    public function approver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}
