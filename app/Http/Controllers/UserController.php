<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Mail\SendUserCredentials;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Traits\HasRoles;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with('roles')->get();
        $search = request()->query('search');
        if ($search) {
            $users = User::where('first_name', 'like', '%' . $search . '%')
                ->orWhere('email', 'like', '%' . $search . '%')
                ->with('roles')
                ->get();
        }

        return view('spj-content.user-management.user-management', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('spj-content.user-management.user-create', compact('roles'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'penname' => 'nullable|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'role' => 'required|string|max:255',
            'position' => 'nullable|string|max:255',
        ]);

        // Create a random password
        $randomPassword = bin2hex(random_bytes(4)); // 8 characters

        // Add password fields (hashed version for storage)
        $userData = $validated + [
            'password' => Hash::make($randomPassword),
            'default_password' => $randomPassword,
            'has_changed_password' => false,
        ];

        // Create the user and assign role
        $user = User::create($userData);
        $user->assignRole($validated['role']);

        // send email with credentials
        Mail::to($user['email'])->queue(new SendUserCredentials($user['name'], $user['email'], $randomPassword));

        return redirect()
            ->route('user-management')
            ->with('success', 'User created successfully and credentials sent via email.');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        return view('spj-content.user-management.user-edit', compact('user', 'roles'));
    }

    public function resetPassword($id)
    {
        $user = User::findOrFail($id);
        $defaultPassword = 'P@ssw0rd'; // Set your default password here
        $user->password = bcrypt($defaultPassword);
        $user->save();

        return redirect()
            ->route('user-management')
            ->with('success', 'Password reset successfully to default password.');
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $data = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'penname' => 'nullable|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8',
            'position' => 'nullable|string|max:255',
        ]);

        $user->first_name = $data['first_name'];
        $user->last_name = $data['last_name'];
        $user->penname = $data['penname'];
        $user->email = $data['email'];
        $user->position = $data['position'];
        if (!empty($data['password'])) {
            $user->password = bcrypt($data['password']);
        }
        $user->save();
        //
        $user->penname = $data['penname'];
        $user->email = $data['email'];
        if (!empty($data['password'])) {
            $user->password = bcrypt($data['password']);
        }
        $user->save();

        return redirect()
            ->route('user-management')
            ->with('success', 'User updated successfully.');
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        dd($user);
        return view('spj-content.user-managament.show', compact('user'));
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()
            ->route('user-management')
            ->with('success', 'User deleted successfully.');
    }
}