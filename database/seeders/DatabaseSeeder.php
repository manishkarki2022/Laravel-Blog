<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Post;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $post =  collect([
            [
                'title' => 'Post One',
                'slug' => 'post-one',
                'excerpt' => 'Excerpt of post one',
                'description' => 'Description of post one',
                'is_published' => true,
                'min_to_read' => 2,
            ],
            [
                'title' => 'Post Two',
                'slug' => 'post-two',
                'excerpt' => 'Excerpt of post two',
                'description' => 'Description of post two',
                'is_published' => true,
                'min_to_read' => 2,
            ],
            [
                'title' => 'Post Three',
                'slug' => 'post-three',
                'excerpt' => 'Excerpt of post three',
                'description' => 'Description of post three',
                'is_published' => true,
                'min_to_read' => 2,
            ]
        ]);
        foreach ( $post as $post) {
            Post::create($post);
        }









    }
}
