<?php

namespace Database\Seeders;

use App\Models\ForumPost;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ForumPost::factory()->count(10)->create();
    }
}
