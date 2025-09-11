<?php

namespace App\Http\Controllers\authentications;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Password;

class ForgotPasswordBasic extends Controller
{
  public function index()
  {
    return view('content.authentications.auth-forgot-password-basic');
  }

  public function sendResetLink(Request $request)
  {
    $request->validate(['email' => 'required|email']);

    $status = Password::sendResetLink($request->only('email'));

    return $status === Password::RESET_LINK_SENT
      ? back()->with(['status' => __($status)])
      : back()->withErrors(['email' => __($status)]);
  }
}
