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
}
