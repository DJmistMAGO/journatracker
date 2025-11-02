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
        $roles = ['admin', 'teacher', 'student'];
        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role]);
        }

        // Create admin
        $admin1 = User::create([
            'first_name' => 'Rona',
            'last_name' => 'Gabrentina',
            'penname' => 'Admin1',
            'email' => 'admin1@example.com',
            'password' => Hash::make('password'),
            'default_password' => 'password',
            'subject_specialization' => 'English',
            'has_changed_password' => false,
        ]);
        $admin1->assignRole('admin');

        $admin2 = User::create([
            'first_name' => 'Julie Ann',
            'last_name' => 'Balisoro ',
            'penname' => 'Admin2',
            'email' => 'admin2@example.com',
            'password' => Hash::make('password'),
            'default_password' => 'password',
            'subject_specialization' => 'Filipino',
            'has_changed_password' => false,
        ]);
        $admin2->assignRole('admin');

        // Create Teacher
        $teacher = User::create([
            'first_name' => 'Teacher',
            'last_name' => 'User',
            'penname' => 'EIC',
            'email' => 'teacher@example.com',
            'password' => Hash::make('password'),
            'default_password' => 'password',
            'subject_specialization' => 'English',
            'position' => 'Print Media',
            'has_changed_password' => false,
        ]);
        $teacher->assignRole('teacher');

        $teacher2 = User::create([
            'first_name' => 'Teacher2',
            'last_name' => 'User',
            'penname' => 'EIC',
            'email' => 'teacher2@example.com',
            'password' => Hash::make('password'),
            'default_password' => 'password',
            'subject_specialization' => 'Filipino',
            'position' => 'TV Broadcasting',
            'has_changed_password' => false,
        ]);
        $teacher2->assignRole('teacher');

        // Create Student
        $student = User::create([
            'first_name' => 'Student',
            'last_name' => 'User',
            'penname' => 'Student',
            'email' => 'student@example.com',
            'password' => Hash::make('password'),
            'default_password' => 'password',
            'subject_specialization' => 'English',
            'position' => 'Print Media',
            'has_changed_password' => false,
        ]);
        $student->assignRole('student');
    }
}
