<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Database\Seeders\MediaSeeder;
use Database\Seeders\ArticleSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create roles if not exist
        $roles = ['admin', 'eic', 'student'];
        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role]);
        }

        // Create admin
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'default_password' => 'password',
            'has_changed_password' => false,
        ]);
        $admin->assignRole('admin');

        // Create EIC
        $eic = User::create([
            'name' => 'Editor in Chief',
            'email' => 'eic@example.com',
            'password' => Hash::make('password'),
            'default_password' => 'password',
            'has_changed_password' => false,
        ]);
        $eic->assignRole('eic');

        // Create Student
        $student = User::create([
            'name' => 'Student User',
            'email' => 'student@example.com',
            'password' => Hash::make('password'),
            'default_password' => 'password',
            'has_changed_password' => false,
        ]);
        $student->assignRole('student');

		//Create Media
		$this->call(MediaSeeder::class);

		//Create Articles
		$this->call(ArticleSeeder::class);

    }
}
