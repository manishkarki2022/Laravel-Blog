<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Post::create([
            'title' => 'Post One',
            'slug' => 'post-one',
            'excerpt' => 'Excerpt of post one',
            'description' => 'Description of post one',
            'is_published' => true,
            'min_to_read' => 2,
        ]);


    }
}
