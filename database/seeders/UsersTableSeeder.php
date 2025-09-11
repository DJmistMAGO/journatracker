<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
  public function run()
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
    ]);
    $admin->assignRole('admin');

    // Create EIC
    $eic = User::create([
      'name' => 'Editor in Chief',
      'email' => 'eic@example.com',
      'password' => Hash::make('password'),
    ]);
    $eic->assignRole('eic');

    // Create Student
    $student = User::create([
      'name' => 'Student User',
      'email' => 'student@example.com',
      'password' => Hash::make('password'),
    ]);
    $student->assignRole('student');
  }
}
