<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    public function run(): void
    {
        $roles = ['admin', 'eic', 'student'];
        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role]);
        }

        // Create admin
        $admin = User::create([
            'first_name' => 'Admin',
            'last_name' => 'User',
            'penname' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'default_password' => 'password',
            'has_changed_password' => false,
        ]);
        $admin->assignRole('admin');

        // Create EIC
        $eic = User::create([
            'first_name' => 'Editor in Chief',
            'last_name' => 'User',
            'penname' => 'EIC',
            'email' => 'eic@example.com',
            'password' => Hash::make('password'),
            'default_password' => 'password',
            'has_changed_password' => false,
        ]);
        $eic->assignRole('eic');

        // Create Student
        $student = User::create([
            'first_name' => 'Student',
            'last_name' => 'User',
            'penname' => 'Student',
            'email' => 'student@example.com',
            'password' => Hash::make('password'),
            'default_password' => 'password',
            'has_changed_password' => false,
        ]);
        $student->assignRole('student');
    }
}
