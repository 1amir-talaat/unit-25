<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ServiceSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        DB::table('services')->insert([
            [
                'name' => 'Technical Support',
                'description' => '24/7 technical support for all your IT needs',
                'price' => 100.00,
                'category_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Network Troubleshooting',
                'description' => 'Diagnose and resolve network issues efficiently',
                'price' => 200.00,
                'category_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Software Installation',
                'description' => 'Professional installation of software and updates',
                'price' => 150.00,
                'category_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Data Backup and Recovery',
                'description' => 'Secure data backup and recovery solutions',
                'price' => 250.00,
                'category_id' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'IT Consultation',
                'description' => 'Expert IT consultation for your business needs',
                'price' => 300.00,
                'category_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
