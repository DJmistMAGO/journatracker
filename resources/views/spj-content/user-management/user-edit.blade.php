@extends('layouts/contentNavbarLayout')

@section('title', 'User - Edit')

@push('styles')
	<style>
		select:disabled {
			cursor: not-allowed;
			background-color: #f8f9fa;
			color: #6c757d;
		}
	</style>
@endpush

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
			<!-- Personal Information Card -->
			<div class="col-lg-8 mb-3">
				<div class="card h-100">
					<div class="card-header">
						<h5 class="card-title mb-0">Personal Information</h5>
					</div>
					<div class="card-body">
						<div class="row">
							<!-- First Name -->
							<div class="col-md-5 mb-3">
								<div class="form-floating form-floating-outline">
									<input class="form-control @error('first_name') is-invalid @enderror"
										type="text" id="firstName" name="first_name"
										value="{{ old('first_name', $user->first_name) }}"
										placeholder="Enter your first name" required autofocus autocomplete="none" />
									<label for="firstName">First Name <span class="text-danger">*</span></label>
								</div>
							</div>

							<!-- Middle Name -->
							<div class="col-md-3 mb-3">
								<div class="form-floating form-floating-outline">
									<input class="form-control @error('middle_name') is-invalid @enderror"
										type="text" id="middleName" name="middle_name"
										value="{{ old('middle_name', $user->middle_name) }}"
										placeholder="Enter your middle name" autocomplete="none" />
									<label for="middleName">Middle Name <span class="text-muted">(Optional)</span></label>
								</div>
							</div>

							<!-- Last Name -->
							<div class="col-md-4 mb-3">
								<div class="form-floating form-floating-outline">
									<input class="form-control @error('last_name') is-invalid @enderror"
										type="text" id="lastName" name="last_name"
										value="{{ old('last_name', $user->last_name) }}"
										placeholder="Enter your last name" required autocomplete="none" />
									<label for="lastName">Last Name <span class="text-danger">*</span></label>
								</div>
							</div>

							<!-- Pen Name -->
							<div class="mb-3">
								<div class="form-floating form-floating-outline">
									<input class="form-control @error('penname') is-invalid @enderror"
										type="text" id="penName" name="penname"
										value="{{ old('penname', $user->penname) }}"
										placeholder="Enter pen name (optional)" autocomplete="none" />
									<label for="penName">Pen Name <small class="text-muted">(Optional)</small></label>
								</div>
							</div>

							<!-- Email -->
							<div class="mb-0">
								<div class="form-floating form-floating-outline">
									<input class="form-control @error('email') is-invalid @enderror"
										type="email" id="email" name="email"
										value="{{ old('email', $user->email) }}"
										placeholder="example@email.com" required autocomplete="none" />
									<label for="email">Email Address <span class="text-danger">*</span></label>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- Role & Position Card -->
			<div class="col-lg-4 mb-3">
				<div class="card h-100">
					<div class="card-header">
						<h5 class="card-title mb-0">Role & Position</h5>
					</div>

					<div class="card-body">
						{{-- ROLE SELECTION --}}
						<div class="mb-3">
							<div class="form-floating form-floating-outline">
								<select class="form-select @error('role') is-invalid @enderror" id="role" name="role" required>
									<option value="" disabled>Choose a role...</option>

									{{-- If logged-in user is Admin --}}
									@if(Auth::user()->hasRole('admin'))
										<option value="admin" {{ old('role', $user->roles->first()->name ?? '') == 'admin' ? 'selected' : '' }}>Admin</option>
										<option value="teacher" {{ old('role', $user->roles->first()->name ?? '') == 'teacher' ? 'selected' : '' }}>Teacher</option>
									@endif

									{{-- If logged-in user is Teacher --}}
									@if(Auth::user()->hasRole('teacher'))
										<option value="student" {{ old('role', $user->roles->first()->name ?? '') == 'student' ? 'selected' : '' }}>Student</option>
									@endif
								</select>
								<label for="role">User Role <span class="text-danger">*</span></label>
							</div>
						</div>

						{{-- POSITION SELECTION --}}
						<div class="mb-3">
							<div class="form-floating form-floating-outline">
								<select class="form-select @error('position') is-invalid @enderror"
									id="position" name="position"
									@if(Auth::user()->hasRole('admin') && old('role', $user->roles->first()->name ?? '') === 'admin')
										disabled title="Position not required for Admin accounts"
									@endif required>

									<option value="" disabled>Choose a position...</option>
									<option value="Photojournalism" {{ old('position', $user->position) == 'Photojournalism' ? 'selected' : '' }}>Photojournalism</option>
									<option value="Cartooning" {{ old('position', $user->position) == 'Cartooning' ? 'selected' : '' }}>Cartooning</option>
									<option value="Radio Broadcasting" {{ old('position', $user->position) == 'Radio Broadcasting' ? 'selected' : '' }}>Radio Broadcasting</option>
									<option value="TV Broadcasting" {{ old('position', $user->position) == 'TV Broadcasting' ? 'selected' : '' }}>TV Broadcasting</option>
								</select>
								<label for="position">User Position <span class="text-danger">*</span></label>
							</div>
						</div>

						{{-- LANGUAGE SELECTION --}}
						<div class="mb-0">
							<div class="form-floating form-floating-outline">
								<select class="form-select @error('subject_specialization') is-invalid @enderror"
									id="subject_specialization" name="subject_specialization" required>
									<option value="" disabled>Choose a language...</option>
									<option value="English" {{ old('subject_specialization', $user->subject_specialization) == 'English' ? 'selected' : '' }}>English</option>
									<option value="Filipino" {{ old('subject_specialization', $user->subject_specialization) == 'Filipino' ? 'selected' : '' }}>Filipino</option>
								</select>
								<label for="subject_specialization">User Language <span class="text-danger">*</span></label>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>

		<button type="submit" class="btn btn-success">Update User</button>
		<a href="{{ route('user-management') }}" class="btn btn-secondary">Cancel</a>
	</form>
</div>

@push('scripts')
<script>
	document.addEventListener('DOMContentLoaded', function() {
		const roleSelect = document.getElementById('role');
		const positionSelect = document.getElementById('position');

		function togglePosition() {
			if (roleSelect.value === 'admin') {
				positionSelect.disabled = true;
				positionSelect.value = '';
			} else {
				positionSelect.disabled = false;
			}
		}

		roleSelect.addEventListener('change', togglePosition);
		togglePosition(); // run on page load
	});
</script>
@endpush

@endsection
