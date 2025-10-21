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
		<div class="row">
			<div class="col-md-4 mb-3">
				<div class="form-floating form-floating-outline">
					<input class="form-control" type="text" id="firstName" name="first_name" value="{{ old('first_name') }}" placeholder="" required autofocus />
					<label for="firstName">First Name</label>
				</div>
			</div>
			<div class="col-md-4 mb-3">
				<div class="form-floating form-floating-outline">
					<input class="form-control" type="text" id="lastName" name="last_name" value="{{ old('last_name') }}" placeholder="" required />
					<label for="lastName">Last Name</label>
				</div>
			</div>
			<div class="col-md-4 mb-3">
				<div class="form-floating form-floating-outline">
					<input class="form-control" type="text" id="penName" name="penname" value="{{ old('penname') }}" placeholder="" />
					<label for="penName">Pen Name</label>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 mb-3">
				<div class="form-floating form-floating-outline">
					<input class="form-control" type="email" id="email" name="email" value="{{ old('email') }}" placeholder="" required />
					<label for="email">Email</label>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4 mb-3">
				<div class="form-floating form-floating-outline">
					<input class="form-control" type="text" id="position" name="position" value="{{ old('position') }}" placeholder="" />
					<label for="position">Position</label>
				</div>
			</div>
			<div class="col-md-4 mb-3">
				<div class="form-floating form-floating-outline">
					<select class="form-select" id="role" name="role" required>
						<option disabled {{ old('role') ? '' : 'selected' }}>Select User Role</option>
						@foreach($roles as $role)
							<option value="{{ $role->name }}" {{ old('role') == $role->name ? 'selected' : '' }}>
								{{ ucfirst($role->name) }}
							</option>
						@endforeach
					</select>
					<label for="role">Select User Role</label>
				</div>
			</div>

		</div>

		<button type="submit" class="btn btn-success">Create User</button>
		<a href="{{ route('user-management') }}" class="btn btn-secondary">Cancel</a>
	</form>
</div>
@endsection
