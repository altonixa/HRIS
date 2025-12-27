<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use HasFactory, SoftDeletes, \App\Traits\Auditable;

    protected $fillable = [
        'user_id',
        'employee_code',
        'department_id',
        'designation_id',
        'reporting_to',
        'joining_date',
        'status',
        'first_name',
        'last_name',
        'gender',
        'dob',
        'phone',
        'address',
        'town',
        'quarter',
        'city',
        'country',
        'profile_picture',
        'national_id_card',
        'emergency_contact_name',
        'emergency_contact_phone',
        'emergency_contact_relation',
    ];

    protected $casts = [
        'joining_date' => 'date',
        'dob' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function designation()
    {
        return $this->belongsTo(Designation::class);
    }

    public function documents()
    {
        return $this->hasMany(EmployeeDocument::class);
    }

    public function emergencyContacts()
    {
        return $this->hasMany(EmergencyContact::class);
    }

    public function manager()
    {
        return $this->belongsTo(Employee::class, 'reporting_to');
    }
}
