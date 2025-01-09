<?php

namespace Database\Seeders;

use App\Models\Announcement;
use App\Models\ForumPost;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class AnnouncementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jsonData = File::get(database_path('/seeders/data/announcements.json'));
        $posts = json_decode($jsonData, true);

        foreach ($posts as $post) {
            Announcement::create($post);
        }
        Announcement::factory()->count(2)->create();
    }
}
