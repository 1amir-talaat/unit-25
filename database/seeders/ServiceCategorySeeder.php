<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ServiceCategory;

class ServiceCategorySeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $categories = [
            [
                'name' => 'Hardware Repair',
                'description' => 'Repair and maintenance of hardware components such as computers, printers, and peripherals.'
            ],
            [
                'name' => 'Software Troubleshooting',
                'description' => 'Identifying and resolving software issues, including errors, crashes, and performance problems.'
            ],
            [
                'name' => 'Network Setup and Configuration',
                'description' => 'Installation, configuration, and optimization of wired and wireless network infrastructure.'
            ],
            [
                'name' => 'Data Recovery',
                'description' => 'Recovery of lost or corrupted data from storage devices such as hard drives, SSDs, and memory cards.'
            ],
            [
                'name' => 'Virus and Malware Removal',
                'description' => 'Detection and removal of viruses, spyware, adware, and other malicious software.'
            ],
            [
                'name' => 'Backup Solutions',
                'description' => 'Implementation of backup strategies and solutions to safeguard data against loss or corruption.'
            ],
        ];

        foreach ($categories as $categoryData) {
            ServiceCategory::create([
                'name' => $categoryData['name'],
                'description' => $categoryData['description']
            ]);
        }
    }
}
