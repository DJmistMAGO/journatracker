@extends('layouts/contentNavbarLayout')

@section('title', 'User - Create')

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
		Create User
	</h4>
	@include('_partials.errors')
	<form action="{{ route('user-management.store') }}" method="POST">
		@csrf
		<div class="row">

			<div class="col-lg-8 mb-3">
				<div class="card h-100">
					<div class="card-header">
						<h5 class="card-title mb-0">Personal Information</h5>
					</div>
					<div class="card-body">

						<div class="row">
							<div class="col-md-5 mb-3">
								<div class="form-floating form-floating-outline">
									<input class="form-control @error('first_name') is-invalid @enderror" type="text" id="firstName" name="first_name" value="{{ old('first_name') }}" placeholder="Enter your first name" required autofocus autocomplete="none" />
									<label for="firstName">First Name <span class="text-danger">*</span></label>
								</div>
							</div>

							<div class="col-md-3 mb-3">
								<div class="form-floating form-floating-outline">
									<input class="form-control @error('middle_name') is-invalid @enderror" type="text" id="middleName" name="middle_name" value="{{ old('middle_name') }}" placeholder="Enter your middle name"  autofocus autocomplete="none" />
									<label for="middleName">Middle Name <span class="text-muted">(Optional)</span></label>
								</div>
							</div>


							<div class="col-md-4 mb-3">
								<div class="form-floating form-floating-outline">
									<input class="form-control @error('last_name') is-invalid @enderror" type="text" id="lastName" name="last_name" value="{{ old('last_name') }}" placeholder="Enter your last name" required autocomplete="none" />
									<label for="lastName">Last Name <span class="text-danger">*</span></label>
								</div>
							</div>


							<div class="mb-3">
								<div class="form-floating form-floating-outline">
									<input class="form-control @error('penname') is-invalid @enderror" type="text" id="penName" name="penname" value="{{ old('penname') }}"  placeholder="Enter pen name (optional)" autocomplete="none" />
									<label for="penName">Pen Name <small class="text-muted">(Optional)</small></label>
								</div>
							</div>


							<div class="mb-0">
								<div class="form-floating form-floating-outline">
									<input class="form-control @error('email') is-invalid @enderror" type="email" id="email" name="email" value="{{ old('email') }}"
										placeholder="example@email.com" required autocomplete="none" />
									<label for="email">Email Address <span class="text-danger">*</span></label>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-4 mb-3">
				<div class="card h-100">
					<div class="card-header">
						<h5 class="card-title mb-0">Role & Position</h5>
					</div>
					<div class="card-body">
						{{-- USER ROLE --}}
						<div class="mb-3">
							<div class="form-floating form-floating-outline">
								<select class="form-select @error('role') is-invalid @enderror" id="role" name="role" required>
									<option value="" disabled {{ old('role') ? '' : 'selected' }}>Choose a role...</option>

									@if(Auth::user()->hasRole('admin'))
										<option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
										<option value="teacher" {{ old('role') == 'teacher' ? 'selected' : '' }}>Teacher</option>
									@endif

									@if(Auth::user()->hasRole('teacher'))
										<option value="student" selected>Student</option>
									@endif
								</select>
								<label for="role">User Role <span class="text-danger">*</span></label>
							</div>
						</div>

						{{-- USER POSITION --}}
						<div class="mb-3">
							<div class="form-floating form-floating-outline">
								<select
									class="form-select @error('position') is-invalid @enderror"
									id="position"
									name="position"
									@if(Auth::user()->hasRole('teacher')) disabled @endif
									@if(Auth::user()->hasRole('admin')) required @endif
								>
									<option value="" disabled selected>Choose a position...</option>
									<option value="Print Media" {{ old('position') == 'Print Media' ? 'selected' : '' }}>Print Media</option>
									<option value="Advanced Print Media" {{ old('position') == 'Advanced Print Media' ? 'selected' : '' }}>Advanced Print Media</option>
									<option value="Radio Broadcasting" {{ old('position') == 'Radio Broadcasting' ? 'selected' : '' }}>Radio Broadcasting</option>
									<option value="TV Broadcasting" {{ old('position') == 'TV Broadcasting' ? 'selected' : '' }}>TV Broadcasting</option>
								</select>
								<label for="position">User Position <span class="text-danger">*</span></label>
							</div>
						</div>

						<div class="mb-0">
							<div class="form-floating form-floating-outline">
								<select
									class="form-select @error('subject_specialization') is-invalid @enderror"
									id="subject_specialization"
									name="subject_specialization"
									@if(Auth::user()->hasRole('admin')) required @endif
									@if(Auth::user()->hasRole('teacher')) disabled @endif
								>
									<option value="" disabled selected>Choose a subject specialization...</option>
									<option value="English" {{ old('subject_specialization') == 'English' ? 'selected' : '' }}>English</option>
									<option value="Filipino" {{ old('subject_specialization') == 'Filipino' ? 'selected' : '' }}>Filipino</option>
								</select>
								<label for="subject_specialization">User Language <span class="text-danger">*</span></label>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		@if(Auth::user()->hasRole('teacher'))
			<input type="hidden" name="role" value="student">
			<input type="hidden" name="position" value="{{ Auth::user()->position }}">
			<input type="hidden" name="subject_specialization" value="{{ Auth::user()->subject_specialization }}">
		@endif

		<button type="submit" class="btn btn-success">Create User</button>
		<a href="{{ route('user-management') }}" class="btn btn-secondary">Cancel</a>
	</form>
</div>

@push('scripts')
	<script>
		document.addEventListener('DOMContentLoaded', function() {
			const roleSelect = document.getElementById('role');
			const positionSelect = document.getElementById('position');
			const subjectSelect = document.getElementById('subject_specialization');

			const isTeacher = {{ Auth::user()->hasRole('teacher') ? 'true' : 'false' }};

			function toggleFields() {
				if (isTeacher) {
					return;
				}

				if (roleSelect.value === 'admin') {
					positionSelect.disabled = true;
					positionSelect.value = '';
					subjectSelect.disabled = false;
					subjectSelect.value = '';
				} else {
					positionSelect.disabled = false;
					subjectSelect.disabled = false;
				}
			}

			if (!isTeacher) {
				roleSelect.addEventListener('change', toggleFields);
				toggleFields();
			}
		});
	</script>
@endpush

@endsection
