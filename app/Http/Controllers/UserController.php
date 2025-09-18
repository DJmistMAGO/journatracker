<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = \App\Models\User::with('roles')->get();
        $search = request()->query('search');
        if ($search) {
            $users = \App\Models\User::where('name', 'like', '%' . $search . '%')
                ->orWhere('email', 'like', '%' . $search . '%')
                ->with('roles')
                ->get();
        }

        return view('content.user-management.user-management', compact('users'));
    }

    public function create()
    {
        return view('content.user-management.user-create');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $user = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        // dd($user);

        User::create([
            'name' => $user['name'],
            'email' => $user['email'],
            'password' => bcrypt($user['password']),
        ])->assignRole('student');

        return redirect()
            ->route('user-management')
            ->with('success', 'User created successfully.');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('content.user-management.user-edit', compact('user'));
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8',
        ]);

        $user->name = $data['name'];
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
        return view('content.user-management.user-view', compact('user'));
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
