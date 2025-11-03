<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Mail\SendUserCredentials;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
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
        $query = User::with('roles');

        // If the logged-in user is a teacher, show only students with same position and subject specialization
        if (Auth::user()->hasRole('teacher')) {
            $teacher = Auth::user();
            $query
                ->whereHas('roles', function ($q) {
                    $q->where('name', 'student');
                })
                ->where('position', $teacher->position)
                ->where('subject_specialization', $teacher->subject_specialization);
        }

        // Apply search filter if provided
        $search = request()->query('search');
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                    ->orWhere('last_name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $users = $query->orderBy('created_at')->get();

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
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'penname' => 'nullable|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'role' => 'required|string|max:255',
            'position' => 'nullable|string|max:255',
            'subject_specialization' => 'required|string|max:255',
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
        $authUser = Auth::user();
        $user = User::with('roles')->findOrFail($id);

        if ($authUser->hasRole('teacher')) {
            if ($user->hasRole('admin') || $user->hasRole('teacher')) {
                abort(403, 'Access denied. Teachers cannot edit Admin or other Teacher accounts.');
            }
        }

        if ($authUser->hasRole('teacher')) {
            if (
                $authUser->position !== $user->position ||
                $authUser->subject_specialization !== $user->subject_specialization
            ) {
                abort(403, 'Access denied. This student is not under your scope.');
            }
        }

        $roles = Role::all();
        return view('spj-content.user-management.user-edit', compact('user', 'roles'));
    }

    public function resetPassword($id)
    {
        $user = User::findOrFail($id);
        $defaultPassword = 'P@ssw0rd'; // Set your default password here
        $user->password = bcrypt($defaultPassword);
        $user->default_password = bcrypt($defaultPassword);
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
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'penname' => 'nullable|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8',
            'position' => 'nullable|string|max:255',
            'subject_specialization' => 'required|string|max:255',
        ]);

        $user->first_name = $data['first_name'];
        $user->middle_name = $data['middle_name'];
        $user->last_name = $data['last_name'];
        $user->penname = $data['penname'];
        $user->email = $data['email'];
        $user->position = $data['position'];
        $user->subject_specialization = $data['subject_specialization'];
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

    // public function show($id)
    // {
    //     $user = User::findOrFail($id);
    //     // dd($user);
    //     return view('spj-content.user-managament.show', compact('user'));
    // }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()
            ->route('user-management')
            ->with('success', 'User deleted successfully.');
    }

    public function toggleStatus($id)
    {
        $user = User::findOrFail($id);
        $user->status = $user->status === 'active' ? 'deactivated' : 'active';
        $user->save();

        return redirect()
            ->route('user-management')
            ->with('success', 'User status updated successfully!');
    }
}
