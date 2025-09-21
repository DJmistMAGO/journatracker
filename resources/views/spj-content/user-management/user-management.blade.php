@extends('layouts/contentNavbarLayout')

@section('title', 'User - Management')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/loader.css') }}">
@endpush



@section('content')
@include('_partials.loader')
    <div class="content-wrapper">
		<h4 class="py-3 mb-4"><span class="text-muted fw-light">SPJ / </span> User Management</h4>
        <div class="card mt-2">
			@include('_partials.errors')
			@include('_partials.success')
			<div class="card-header border-bottom d-flex justify-content-between align-items-center">
				<h5 class="card-title mb-0">Users List</h5>
				<div class="d-flex align-items-center gap-3">
					<form action="{{ route('user-management') }}" method="GET">
						<div class="form-floating form-floating-outline">
							<input type="text"  name="search"
							value="{{ request('search') }}" class="form-control" id="searchUser" placeholder="Search Users" aria-label="Search Users">
							<label for="searchUser"><i class="mdi mdi-magnify mdi-24px"></i>Search User	</label>
						</div>
					</form>
					<a href="{{ route('user-management.create') }}" class="btn btn-success btn-md">
						<i class="mdi mdi-plus-outline me-1"></i>Add new User
					</a>
					</div>
				</div>
				<div class="card-datatable table-responsive">
					<table class="table datatables-users table-hover border-top">
						<thead>
							<tr>
								<th>User</th>
								<th>Role</th>
								<th>Email</th>
								<th>Default Password</th>
								<th>Password Status</th>
								<th>Actions </th>
							</tr>
							</thead>
							<tbody>
							@foreach($users as $user)
								@if($user->id !== auth()->id())
								<tr>
									<td>
										<div class="d-flex align-items-center">
										<div class="avatar avatar-sm me-3">
											@if($user->profile_photo_path)
											<img src="{{ asset('storage/' . $user->profile_photo_path) }}" alt="Avatar" class="rounded-circle">
											@else
											<span class="avatar-initial rounded-circle bg-label-primary">
												{{ strtoupper(substr($user->first_name, 0, 2)) }}
											</span>
											@endif
										</div>
										<div>
											<a href="{{ url('app/user/view/' . $user->id) }}" class="text-heading fw-medium">
												{{ $user->first_name . ' ' . $user->last_name }}
												<br>
											</a>
										</div>
										</div>
									</td>
									<td>
										@if ($user->roles->first()->name == 'admin')
											<span class="text-truncate"><i class="mdi mdi-laptop mdi-24px text-danger me-1"></i> Admin</span>
										@elseif ($user->roles->first()->name == 'eic')
											<span class="text-truncate"><i class="mdi mdi-pencil-outline mdi-24px text-warning me-1"></i> EIC</span>
										@else
											<span class="text-truncate"><i class="mdi mdi-account-cog mdi-24px text-info me-1"></i> Student</span>
										@endif
									</td>

									<td>{{ $user->email }}</td>
									<td>
										<span class="password-text d-none">{{ $user->default_password }}</span>
										<span class="password-hidden">••••••••</span>
										<button type="button" class="ms-2 btn btn-sm btn-link toggle-password">
											<i class="mdi mdi-eye"></i>
											</button>
										</td>
									<td>
										@if ($user->has_changed_password)
											<span class="badge bg-label-secondary">Changed</span>
										@else
											<span class="badge bg-label-warning">Not Changed</span>
										@endif
									</td>
									<td>
										<div class="d-flex align-items-center gap-2">
											<a href="{{ route('user-management.edit', $user->id) }}" class="btn btn-sm bg-success text-white">
												<i class="mdi mdi-pencil-outline"></i>
											</a>
											<button type="button"
													class="btn btn-sm btn-warning confirm-action"
													data-action="{{ route('user-management.reset-password', $user->id) }}"
													data-type="reset"
													data-header="bg-warning text-white"
													data-username="{{ $user->name }}">
												<i class="mdi mdi-lock-reset"></i>
											</button>
											<button type="button"
													class="btn btn-sm btn-danger confirm-action"
													data-action="{{ route('user-management.destroy', $user->id) }}"
													data-type="delete"
													data-header="bg-danger text-white"
													data-username="{{ $user->name }}">
												<i class="mdi mdi-delete-outline"></i>
											</button>
										</div>
									</td>
								</tr>
							@endif
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
		@include('_partials.confirm-modal')
    </div>
@push('scripts')
    <script src="{{ asset('assets/js/loader.js') }}"></script>
	<script>
		document.querySelectorAll('.toggle-password').forEach(button => {
			button.addEventListener('click', function () {
				const td = this.closest('td');
				const hidden = td.querySelector('.password-hidden');
				const text = td.querySelector('.password-text');
				const icon = this.querySelector('i');

				hidden.classList.toggle('d-none');
				text.classList.toggle('d-none');

				if (icon.classList.contains('mdi-eye')) {
					icon.classList.remove('mdi-eye');
					icon.classList.add('mdi-eye-off');
				} else {
					icon.classList.remove('mdi-eye-off');
					icon.classList.add('mdi-eye');
				}
			});
		});
	</script>
	<script src="{{ asset('assets/js/confirm-modal.js') }}"></script>
@endpush
@endsection
