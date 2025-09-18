@extends('layouts/contentNavbarLayout')

@section('title', 'User - Create')

@section('content')
<div class="container">
	<h4 class="py-3 mb-2">
		<span class="text-muted fw-light">SPJ / User Management /</span>
		Create User
	</h4>
	@include('_partials.errors')
	<form action="{{ route('user-management.store') }}" method="POST">
		@csrf
		<div class="mb-3">
			<label for="name" class="form-label">Name</label>
			<input type="text" name="name" class="form-control" id="name" required>
		</div>
		<div class="mb-3">
			<label for="email" class="form-label">Email address</label>
			<input type="email" name="email" class="form-control" id="email" required>
		</div>
		<div class="mb-3">
			<label for="password" class="form-label">Password</label>
			<input type="password" name="password" class="form-control" id="password" required>
		</div>
		<button type="submit" class="btn btn-success">Create User</button>
	</form>
</div>
@endsection
