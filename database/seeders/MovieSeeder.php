<?php

namespace Database\Seeders;

use App\Models\Movie;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Movie::insert([
            [
                'name' => 'movie 1',
                'status' => 1
            ],
            [
                'name' => 'movie 2',
                'status' => 1
            ],
            [
                'from' => 'movie 3',
                'status' => 1
            ],
            [
                'name' => 'movie 4',
                'status' => 1
            ],
            [
                'from' => 'movie 5',
                'status' => 1
            ]
        ]);
    }
}
