@extends('layouts/contentNavbarLayout')

@section('title', 'Account settings - Account')

@section('page-script')
<script src="{{asset('assets/js/pages-account-settings-account.js')}}"></script>
@endsection

@push('styles')
	<link rel="stylesheet" href="{{ asset('assets/css/snackbar.css') }}">
@endpush

@section('content')
	<h4 class="py-3 mb-4">
		<span class="text-muted fw-light">Account Settings /</span> Account
	</h4>

	<div class="row">
	<div class="col-md-12">
		<ul class="nav nav-pills flex-column flex-md-row mb-4 gap-2 gap-lg-0">
		<li class="nav-item"><a class="nav-link active" href="{{ route('profile.index') }}"><i class="mdi mdi-account-outline mdi-20px me-1"></i>Account</a></li>
		<li class="nav-item"><a class="nav-link" href="{{ route('notifications.index') }}"><i class="mdi mdi-bell-outline mdi-20px me-1"></i>Notifications</a></li>
		</ul>
		@include('_partials.errors')
		@include('_partials.success')
		<div class="card mb-4">
			<h4 class="card-header">Profile Details</h4>
			<form id="formAccountSettings" action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
				@csrf
				@method('PUT')
				<div class="card-body">
					<div class="row">
						<div class="col-md-4 text-center">
							<div class="position-relative d-inline-block">
								@if ($user->profile_photo_path)
									<img src="{{ asset('storage/' . $user->profile_photo_path) }}"
										alt="user-avatar"
										class="d-block w-px-150 h-px-150 rounded mb-3"
										id="avatarDisplay"
										data-original="image"
										data-original-src="{{ asset('storage/' . $user->profile_photo_path) }}" />
								@else
									<span id="avatarDisplay"
										class="avatar-initial rounded-circle bg-label-primary d-inline-flex justify-content-center align-items-center mb-3"
										style="width: 150px; height: 150px; font-size: 3rem;"
										data-original="initials"
										data-initials="{{ strtoupper(substr($user->first_name, 0, 2)) }}">
										{{ strtoupper(substr($user->first_name, 0, 2)) }}
									</span>
								@endif
							</div>

							<div class="button-wrapper">
								<label for="upload" class="btn btn-primary w-100 mb-2" tabindex="0">
									<span>Upload new photo</span>
									<input
										type="file"
										id="upload"
										name="profile_picture"
										class="account-file-input"
										hidden
										accept="image/png, image/jpeg, image/gif"
									/>
								</label>
								<div class="text-muted small">
									Allowed JPG, GIF or PNG. Max size of 2mb
								</div>
							</div>
						</div>

						<div class="col-md-8">
							<div class="row gy-4">
								<div class="col-md-4">
									<div class="form-floating form-floating-outline">
										<input class="form-control" type="text" id="firstName" name="first_name" value="{{ old('first_name', $user->first_name) }}" autofocus />
										<label for="firstName">First Name</label>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-floating form-floating-outline">
										<input class="form-control" type="text" id="middleName" name="middle_name" value="{{ old('middle_name', $user->middle_name) }}" />
										<label for="middleName">Middle Name</label>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-floating form-floating-outline">
										<input class="form-control" type="text" id="lastName" name="last_name" value="{{ old('last_name', $user->last_name) }}" />
										<label for="lastName">Last Name</label>
									</div>
								</div>

								<div class="col-md-12">
									<div class="form-floating form-floating-outline">
										<input class="form-control" type="text" id="penname" name="penname" value="{{ old('penname', $user->penname) }}"/>
										<label for="penname">Pen name / Nickname</label>
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-floating form-floating-outline">
										<input class="form-control" type="email" id="email" name="email" value="{{ old('email', $user->email) }}" placeholder="john.doe@example.com" />
										<label for="email">E-mail</label>
									</div>
								</div>

								{{-- password --}}
								<div class="col-md-6">
									<div class="form-password-toggle">
										<div class="input-group input-group-merge">
										<div class="form-floating form-floating-outline">
											<input type="password" id="password" class="form-control" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
											<label for="password">Password</label>
										</div>
										<span class="input-group-text cursor-pointer"><i class="mdi mdi-eye-off-outline"></i></span>
										</div>
									</div>
									<small class="text-muted">Leave blank to keep current password</small>
								</div>
							</div>

							<div class="mt-4">
								<button type="submit" class="btn btn-primary me-2">Save changes</button>
								<button type="reset" class="btn btn-outline-danger">
									<i class="mdi mdi-reload me-1"></i> Reset
								</button>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

@push('scripts')
	<script>
		const uploadInput = document.getElementById('upload');
		const resetButton = document.querySelector('button[type="reset"]');

		// Handle preview when uploading
		uploadInput.addEventListener('change', function(event) {
			let avatarDisplay = document.getElementById('avatarDisplay'); // re-query fresh node
			if (event.target.files && event.target.files[0]) {
				const reader = new FileReader();
				reader.onload = function(e) {
					if (avatarDisplay.tagName.toLowerCase() === 'span') {
						const img = document.createElement('img');
						img.id = 'avatarDisplay';
						img.className = 'd-block w-px-150 h-px-150 rounded mb-3';
						img.alt = 'user-avatar';
						img.dataset.original = avatarDisplay.dataset.original;
						img.dataset.originalSrc = avatarDisplay.dataset.originalSrc || '';
						img.dataset.initials = avatarDisplay.dataset.initials || '';
						img.src = e.target.result;
						avatarDisplay.replaceWith(img);
					} else {
						avatarDisplay.src = e.target.result;
					}
				};
				reader.readAsDataURL(event.target.files[0]);
			}
		});

		// Handle reset
		resetButton.addEventListener('click', function() {
			let avatarDisplay = document.getElementById('avatarDisplay'); // re-query fresh node
			const originalType = avatarDisplay.dataset.original;
			if (originalType === 'image') {
				avatarDisplay.src = avatarDisplay.dataset.originalSrc;
			} else if (originalType === 'initials') {
				const span = document.createElement('span');
				span.id = 'avatarDisplay';
				span.className = 'avatar-initial rounded-circle bg-label-primary d-inline-flex justify-content-center align-items-center mb-3';
				span.style = 'width: 150px; height: 150px; font-size: 3rem;';
				span.dataset.original = 'initials';
				span.dataset.initials = avatarDisplay.dataset.initials;
				span.textContent = avatarDisplay.dataset.initials;
				avatarDisplay.replaceWith(span);
			}
			uploadInput.value = ""; // clear selected file
		});
	</script>
@endpush


@endsection
