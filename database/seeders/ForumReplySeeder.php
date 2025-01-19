<?php

namespace Database\Seeders;

use App\Models\ForumPost;
use App\Models\ForumReply;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class ForumReplySeeder extends Seeder
{
    public function run(): void
    {
        $jsonData = File::get(database_path('/seeders/data/replies.json'));
        $posts = json_decode($jsonData, true);

        foreach ($posts as $post) {
            ForumReply::create($post);
        }
        ForumReply::factory()->count(17)->create();
    }
}
