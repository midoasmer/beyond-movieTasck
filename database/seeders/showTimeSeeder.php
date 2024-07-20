<?php

namespace Database\Seeders;

use App\Models\showTimes;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class showTimeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        showTimes::insert([
            [
                'from' => '18:00',
                'to' => '20:00',
                'status' => 1
            ],
            [
                'from' => '20:30',
                'to' => '22:30',
                'status' => 1
            ],
            [
                'from' => '23:00',
                'to' => '01:00',
                'status' => 1
            ]
        ]);
    }
}
