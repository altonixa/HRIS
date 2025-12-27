<?php

namespace App\Traits;

use App\Models\AuditLog;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

trait Auditable
{
    public static function bootAuditable()
    {
        static::created(function (Model $model) {
            static::logAudit($model, 'created');
        });

        static::updated(function (Model $model) {
            static::logAudit($model, 'updated');
        });

        static::deleted(function (Model $model) {
            static::logAudit($model, 'deleted');
        });
    }

    protected static function logAudit(Model $model, string $event)
    {
        $oldValues = $event === 'updated' ? array_intersect_key($model->getOriginal(), $model->getChanges()) : null;
        $newValues = $event === 'updated' ? $model->getChanges() : ($event === 'created' ? $model->toArray() : null);

        // Remove sensitive fields or timestamps if necessary
        $sensitive = ['password', 'remember_token'];
        if ($oldValues) $oldValues = array_diff_key($oldValues, array_flip($sensitive));
        if ($newValues) $newValues = array_diff_key($newValues, array_flip($sensitive));

        AuditLog::create([
            'user_id' => auth()->id(),
            'event' => $event,
            'auditable_type' => get_class($model),
            'auditable_id' => $model->id,
            'old_values' => $oldValues,
            'new_values' => $newValues,
            'url' => Request::fullUrl(),
            'ip_address' => Request::ip(),
            'user_agent' => Request::userAgent(),
        ]);
    }
}
