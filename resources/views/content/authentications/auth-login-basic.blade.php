@extends('layouts/blankLayout')

@section('title', 'Login Basic - SPJ JournaTracker')

@section('page-style')
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-auth.css')}}">
<style>
	body {
		background-image: linear-gradient(rgba(251, 255, 0, 0.197), rgba(8, 106, 8, 0.566)), url('{{ asset('assets/img/bg-login.jpg') }}');
		background-repeat: no-repeat;
		background-attachment: fixed;
		background-size: cover;
		background-position: top;
	}
</style>
@endsection

@section('content')
<div class="position-relative">
    <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner py-4">
        <div class="card p-2">
            <div class="app-brand justify-content-center mt-5 flex-column align-items-center text-center">
            <a href="{{url('/')}}" class="app-brand-link gap-2 d-flex flex-column align-items-center">
                <img src="{{ asset('assets/img/spj/spj_logo.png') }}" height="70" alt="">
                <span class="app-brand-text demo text-heading fw-semibold mt-2">SPJ - JournaTracker</span>
            </a>
            </div>

            <div class="card-body mt-2">
            <h4 class="mb-2">Welcome to SPJ - JournaTracker! 👋</h4>
            <p class="mb-4">Please sign-in to your account and start the adventure</p>

            @include('_partials.errors')

            <form id="formAuthentication" class="mb-3" action="{{ route('login.post') }}" method="POST">
                @csrf
                <div class="form-floating form-floating-outline mb-3">
                <input type="text" class="form-control" id="email" name="email" placeholder="Enter your email" autofocus>
                <label for="email">Email</label>
                </div>
                <div class="mb-3">
                <div class="form-password-toggle">
                    <div class="input-group input-group-merge">
                    <div class="form-floating form-floating-outline">
                        <input type="password" id="password" class="form-control" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
                        <label for="password">Password</label>
                    </div>
                    <span class="input-group-text cursor-pointer"><i class="mdi mdi-eye-off-outline"></i></span>
                    </div>
                </div>
                </div>
                <div class="mb-3 d-flex justify-content-between">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="remember-me" name="remember">
                    <label class="form-check-label" for="remember-me">
                    Remember Me
                    </label>
                </div>

                </div>
                <div class="mb-3">
                <button class="btn btn-primary d-grid w-100" type="submit">Sign in</button>
                </div>
            </form>


            </div>
        </div>

        </div>
    </div>
</div>
@endsection
