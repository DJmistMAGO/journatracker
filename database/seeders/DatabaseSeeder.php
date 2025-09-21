<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Database\Seeders\MediaSeeder;
use Database\Seeders\ArticleSeeder;


class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        //Create Media
        $this->call(MediaSeeder::class);
        //Create Articles
        $this->call(ArticleSeeder::class);
        $this->call([UsersTableSeeder::class]);

    }
}
