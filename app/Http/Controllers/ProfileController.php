<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        // dd(Auth::user());
        return view('spj-content.profile-settings.index', [
            'user' => Auth::user(),
        ]);
    }

    public function update(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'penname' => 'nullable|string|max:255',
            'email' => 'required|email|unique:users,email,' . Auth::id(),
            'password' => 'nullable|string|min:8',
            'profile_picture' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $user = User::find(Auth::id());
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->penname = $request->penname;
        $user->password = $request->password ? bcrypt($request->password) : $user->password;
        $user->has_changed_password = $request->password ? true : $user->has_changed_password;
        $user->email = $request->email;

        if ($request->hasFile('profile_picture')) {
            // Delete old thumbnail if exists (any extension)
            $oldFiles = Storage::disk('public')->files('thumbnails');
            foreach ($oldFiles as $oldFile) {
                if (preg_match("/user_{$user->id}\./", basename($oldFile))) {
                    Storage::disk('public')->delete($oldFile);
                }
            }

            $file = $request->file('profile_picture');
            $extension = $file->getClientOriginalExtension();

            // Always use user ID in filename
            $filename = "user_{$user->id}.{$extension}";

            // Save to thumbnails folder with consistent filename
            $path = $file->storeAs('thumbnails', $filename, 'public');
            $user->profile_photo_path = $path;
        }

        $user->save();

        return back()->with('success', 'Profile updated!');
    }

    public function uploadProfilePicture(Request $request)
    {
        $request->validate([
            'profile_picture' => 'required|image|mimes:jpg,jpeg,png,gif|max:800', // max 800KB
        ]);

        $path = $request->file('profile_picture')->store('profile_pictures', 'public');

        $user = User::find(Auth::id());
        $user->profile_picture = $path;
        $user->save();

        return back()->with('success', 'Profile picture updated!');
    }
}
