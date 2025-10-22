@extends('layouts/contentNavbarLayout')

@section('title', 'User - Management')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/loader.css') }}">
    <style>
        .card-title.text-truncate {
            max-width: 100%;
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
        }
    </style>
	<link rel="stylesheet" href="{{ asset('assets/css/snackbar.css') }}">
@endpush

@section('content')
@include('_partials.loader')
<div class="content-wrapper">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">SPJ / </span> User Management</h4>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <form action="{{ route('user-management') }}" method="GET" class="flex-grow-1 me-3">
            <div class="form-floating form-floating-outline">
                <input type="text" name="search" value="{{ request('search') }}" class="form-control" id="searchUser" placeholder="Search Users" aria-label="Search Users">
                <label for="searchUser"><i class="mdi mdi-magnify mdi-24px"></i> Search User</label>
            </div>
        </form>
        <a href="{{ route('user-management.create') }}" class="btn btn-success btn-md">
            <i class="mdi mdi-plus-outline me-1"></i> Add new User
        </a>
    </div>

    @include('_partials.errors')
    @include('_partials.success')

    {{-- Table for larger screens --}}
    <div class="table-responsive d-none d-sm-block">
        <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <th>User</th>
                    <th>Role</th>
                    <th>Email</th>
                    <th>Password Status</th>
                    <th>User Status</th>
                    <th>Actions</th>
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
                                    </a>
                                </div>
                            </div>
                        </td>
                        <td>
                            @php $role = $user->roles->first()->name ?? 'student'; @endphp
                            @if ($role == 'admin')
                                <span class="text-truncate"><i class="mdi mdi-laptop mdi-24px text-danger me-1"></i> Admin</span>
                            @elseif ($role == 'eic')
                                <span class="text-truncate"><i class="mdi mdi-pencil-outline mdi-24px text-warning me-1"></i> EIC</span>
                            @else
                                <span class="text-truncate"><i class="mdi mdi-account-cog mdi-24px text-info me-1"></i> Student</span>
                            @endif
                        </td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @if ($user->has_changed_password)
                                <span class="badge bg-label-secondary">Changed</span>
                            @else
                                <span class="badge bg-label-warning">Not Changed</span>
                            @endif
                        </td>
						<td>
							@if ($user->status === 'active')
								<span class="badge bg-label-success">Active</span>
							@else
								<span class="badge bg-label-danger">Deactivated</span>
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
								@if ($user->status === 'active')
									<button type="button"
										class="btn btn-sm btn-danger confirm-toggle"
										data-action="{{ route('user-management.toggleStatus', $user->id) }}"
										data-type="deactivate"
										data-header="bg-danger text-white"
										data-username="{{ $user->name }}">
										<i class="mdi mdi-account-off-outline"></i>
									</button>
								@else
									<button type="button"
										class="btn btn-sm btn-success confirm-toggle"
										data-action="{{ route('user-management.toggleStatus', $user->id) }}"
										data-type="activate"
										data-header="bg-success text-white"
										data-username="{{ $user->name }}">
										<i class="mdi mdi-account-check-outline"></i>
									</button>
								@endif
                            </div>
                        </td>
                    </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Card layout for mobile --}}
    <div class="d-block d-sm-none">
        @foreach($users as $user)
            @if($user->id !== auth()->id())
            <div class="card mb-3 shadow-sm">
                <div class="card-body d-flex flex-column gap-2">
                    <div class="d-flex align-items-center gap-3">
                        <div class="avatar avatar-sm">
                            @if($user->profile_photo_path)
                                <img src="{{ asset('storage/' . $user->profile_photo_path) }}" alt="Avatar" class="rounded-circle">
                            @else
                                <span class="avatar-initial rounded-circle bg-label-primary">
                                    {{ strtoupper(substr($user->first_name, 0, 2)) }}
                                </span>
                            @endif
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="card-title text-truncate mb-0">{{ $user->first_name . ' ' . $user->last_name }}</h6>
                            @php $role = $user->roles->first()->name ?? 'student'; @endphp
                            @if ($role == 'admin')
                                <span class="text-truncate"><i class="mdi mdi-laptop mdi-20px text-danger me-1"></i> Admin</span>
                            @elseif ($role == 'eic')
                                <span class="text-truncate"><i class="mdi mdi-pencil-outline mdi-20px text-warning me-1"></i> EIC</span>
                            @else
                                <span class="text-truncate"><i class="mdi mdi-account-cog mdi-20px text-info me-1"></i> Student</span>
                            @endif
                        </div>
                    </div>
                    <p class="mb-0"><strong>Email:</strong> {{ $user->email }}</p>
                    <p class="mb-0"><strong>Password Status:</strong>
                        @if ($user->has_changed_password)
                            <span class="badge bg-label-secondary">Changed</span>
                        @else
                            <span class="badge bg-label-warning">Not Changed</span>
                        @endif
                    </p>
                    <div class="d-flex gap-2 mt-2 flex-wrap">
                        <a href="{{ route('user-management.edit', $user->id) }}" class="btn btn-sm bg-success text-white flex-fill">
                            <i class="mdi mdi-pencil-outline me-1"></i> Edit
                        </a>
                        <button type="button"
                                class="btn btn-sm btn-warning flex-fill confirm-action"
                                data-action="{{ route('user-management.reset-password', $user->id) }}"
                                data-type="reset"
                                data-header="bg-warning text-white"
                                data-username="{{ $user->name }}">
                            <i class="mdi mdi-lock-reset me-1"></i> Reset Password
                        </button>
                        @if ($user->status === 'active')
							<button type="button"
								class="btn btn-sm btn-danger confirm-toggle"
								data-action="{{ route('user-management.toggleStatus', $user->id) }}"
								data-type="deactivate"
								data-header="bg-danger text-white"
								data-username="{{ $user->name }}">
								<i class="mdi mdi-account-off-outline"></i>
							</button>
						@else
							<button type="button"
								class="btn btn-sm btn-success confirm-toggle"
								data-action="{{ route('user-management.toggleStatus', $user->id) }}"
								data-type="activate"
								data-header="bg-success text-white"
								data-username="{{ $user->name }}">
								<i class="mdi mdi-account-check-outline"></i>
							</button>
						@endif
                    </div>
                </div>
            </div>
            @endif
        @endforeach
    </div>
</div>

@include('_partials.confirm-modal')

<!-- Activate User Modal -->
<div class="modal fade" id="activateModal" tabindex="-1" aria-labelledby="activateModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 rounded-4 shadow">
      <div class="modal-header bg-success text-white rounded-top-4">
        <h5 class="modal-title fw-semibold" id="activateModalLabel">Activate User</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="activateForm" method="POST">
        @csrf
        @method('PATCH')
        <div class="modal-body">
          <p class="mb-0">
            Are you sure you want to <span class="fw-semibold text-success">activate</span>
            the account of <span id="activateUserName" class="fw-semibold"></span> and restore login access?
          </p>
        </div>
        <div class="modal-footer border-0">
          <button type="button" class="btn btn-outline-secondary rounded-pill px-3" data-bs-dismiss="modal">
            Cancel
          </button>
          <button type="submit" class="btn btn-success rounded-pill px-3">
            <i class="mdi mdi-account-check-outline me-1"></i> Activate
          </button>
        </div>
      </form>
    </div>
  </div>
</div>


<!-- Deactivate User Modal -->
<div class="modal fade" id="deactivateModal" tabindex="-1" aria-labelledby="deactivateModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 rounded-4 shadow">
      <div class="modal-header bg-danger text-white rounded-top-4">
        <h5 class="modal-title fw-semibold" id="deactivateModalLabel">Deactivate User</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="deactivateForm" method="POST">
        @csrf
        @method('PATCH')
        <div class="modal-body">
          <p class="mb-0">
            Are you sure you want to <span class="fw-semibold text-danger">deactivate</span>
            the account of <span id="deactivateUserName" class="fw-semibold"></span> and prevent login access?
          </p>
        </div>
        <div class="modal-footer border-0">
          <button type="button" class="btn btn-outline-secondary rounded-pill px-3" data-bs-dismiss="modal">
            Cancel
          </button>
          <button type="submit" class="btn btn-danger rounded-pill px-3">
            <i class="mdi mdi-account-off-outline me-1"></i> Deactivate
          </button>
        </div>
      </form>
    </div>
  </div>
</div>




@push('scripts')
<script src="{{ asset('assets/js/loader.js') }}"></script>
<script src="{{ asset('assets/js/confirm-modal.js') }}"></script>
<script>
	document.addEventListener('DOMContentLoaded', function () {
		document.querySelectorAll('.confirm-toggle').forEach(button => {
			button.addEventListener('click', function () {
			const action = this.getAttribute('data-action');
			const username = this.getAttribute('data-username');
			const type = this.getAttribute('data-type');

			if (type === 'activate') {
				document.getElementById('activateForm').action = action;
				document.getElementById('activateUserName').textContent = username;
				new bootstrap.Modal(document.getElementById('activateModal')).show();
			} else if (type === 'deactivate') {
				document.getElementById('deactivateForm').action = action;
				document.getElementById('deactivateUserName').textContent = username;
				new bootstrap.Modal(document.getElementById('deactivateModal')).show();
			}
			});
		});
	});
</script>
@endpush
@endsection
