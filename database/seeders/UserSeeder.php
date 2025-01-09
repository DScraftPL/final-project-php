<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class UserSeeder extends Seeder
{
    public function run(): void
    {
//        $jsonData = File::get(database_path('/seeders/users.json'));
//        $users = json_decode($jsonData, true);
//
//        foreach ($users as $user) {
//            User::create($user);
//        }

        User::factory()->count(3)->create();
    }
}
