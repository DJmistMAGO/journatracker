<?php

namespace App\Http\Controllers\authentications;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginBasic extends Controller
{
    public function index()
    {
        return view('content.authentications.auth-login-basic');
    }

    public function authenticate(Request $request)
    {
        // Validate login input
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Attempt login with remember me option
        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $user = Auth::user();

            // Check if account is deactivated
            if ($user->status === 'deactivated') {
                Auth::logout();

                return back()
                    ->withErrors([
                        'email' => 'Your account has been deactivated. Please contact an administrator.',
                    ])
                    ->onlyInput('email');
            }

            // Regenerate session for security
            $request->session()->regenerate();

            // Redirect to intended page or dashboard
            return redirect()->intended('/dashboard');
        }

        // Invalid credentials
        return back()
            ->withErrors([
                'email' => 'Invalid email or password.',
            ])
            ->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
