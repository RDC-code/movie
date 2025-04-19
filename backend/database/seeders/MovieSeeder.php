<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        \App\Models\Movie::create([
            'title' => 'Inception',
            'director' => 'Christopher Nolan',
            'year' => 2010,
            'image_url' => 'https://via.placeholder.com/400x300',
        ]);
    }
    
}
