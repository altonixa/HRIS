<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class SystemSettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            ['key' => 'company_name', 'value' => 'Altonixa Group Ltd'],
            ['key' => 'company_logo', 'value' => null],
            ['key' => 'primary_color', 'value' => '#8b5cf6'],
            ['key' => 'secondary_color', 'value' => '#06b6d4'],
            ['key' => 'currency', 'value' => 'FCFA'],
            ['key' => 'contact_email', 'value' => 'altonixa@gmail.com'],
            ['key' => 'whatsapp_feedback_number', 'value' => '+2376xxxxxxxx'],
        ];

        foreach ($settings as $setting) {
            DB::table('system_settings')->updateOrInsert(
                ['key' => $setting['key']],
                ['value' => $setting['value'], 'created_at' => now(), 'updated_at' => now()]
            );
        }
    }
}
