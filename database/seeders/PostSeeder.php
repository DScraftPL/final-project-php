<?php

namespace Database\Seeders;

use App\Models\ForumPost;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jsonData = File::get(database_path('/seeders/data/posts.json'));
        $posts = json_decode($jsonData, true);

        foreach ($posts as $post) {
            ForumPost::create($post);
        }
        ForumPost::factory()->count(6)->create();
    }
}
