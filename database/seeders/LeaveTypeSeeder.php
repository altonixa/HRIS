<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LeaveType;

class LeaveTypeSeeder extends Seeder
{
    public function run(): void
    {
        $types = [
            ['name' => 'Annual Leave', 'days_allowed' => 14, 'is_paid' => true, 'carry_forward' => true],
            ['name' => 'Sick Leave', 'days_allowed' => 10, 'is_paid' => true, 'carry_forward' => false],
            ['name' => 'Casual Leave', 'days_allowed' => 7, 'is_paid' => true, 'carry_forward' => false],
            ['name' => 'Maternity Leave', 'days_allowed' => 90, 'is_paid' => true, 'carry_forward' => false],
            ['name' => 'Unpaid Leave', 'days_allowed' => 30, 'is_paid' => false, 'carry_forward' => false],
        ];

        foreach ($types as $type) {
            LeaveType::firstOrCreate(['name' => $type['name']], $type);
        }
    }
}
