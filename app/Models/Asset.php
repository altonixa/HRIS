<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Asset extends Model
{
    protected $fillable = [
        'name',
        'asset_code',
        'category',
        'description',
        'serial_number',
        'purchase_date',
        'warranty_expiry',
        'value',
        'status'
    ];

    protected $casts = [
        'purchase_date' => 'date',
        'warranty_expiry' => 'date',
        'value' => 'decimal:2'
    ];

    public function assignments(): HasMany
    {
        return $this->hasMany(AssetAssignment::class);
    }
}
