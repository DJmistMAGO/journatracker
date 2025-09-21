@extends('layouts/contentNavbarLayout')

@section('title', 'User - Edit')

@section('content')
<div class="container">
	<h4 class="py-3 mb-2">
		<span class="text-muted fw-light">SPJ / User Management /</span>
		Edit User
	</h4>
	@include('_partials.errors')
	<form action="{{ route('user-management.update', $user->id) }}" method="POST">
		@csrf
		@method('PUT')
		<div class="row">
			<div class="col-md-4 mb-3">
				<div class="form-floating form-floating-outline">
					<input class="form-control" type="text" id="firstName" name="first_name" value="{{ old('first_name', $user->first_name) }}" placeholder="" required autofocus />
					<label for="firstName">First Name</label>
				</div>
			</div>
			<div class="col-md-4 mb-3">
				<div class="form-floating form-floating-outline">
					<input class="form-control" type="text" id="lastName" name="last_name" value="{{ old('last_name', $user->last_name) }}" placeholder="" required />
					<label for="lastName">Last Name</label>
				</div>
			</div>
			<div class="col-md-4 mb-3">
				<div class="form-floating form-floating-outline">
					<input class="form-control" type="text" id="penName" name="penname" value="{{ old('penname', $user->penname) }}" placeholder="" />
					<label for="penName">Pen Name</label>
				</div>
			</div>
			<div class="col-md-12 mb-3">
				<div class="form-floating form-floating-outline">
					<input class="form-control" type="email" id="email" name="email" value="{{ old('email', $user->email) }}" placeholder="" required />
					<label for="email">Email</label>
				</div>
			</div>
		</div>
		<button type="submit" class="btn btn-success">Update User</button>
		{{-- cancel --}}
		<a href="{{ route('user-management') }}" class="btn btn-outline-danger">Cancel</a>
	</form>
</div>
@endsection
