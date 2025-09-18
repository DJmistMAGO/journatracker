@extends('layouts/contentNavbarLayout')

@section('title', 'User - Management')

@section('vendor-style')
    {{-- <link rel="stylesheet" href="{{asset('assets/vendor/libs/apex-charts/apex-charts.css')}}"> --}}
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/loader.css') }}">
@endpush

@section('vendor-script')
    {{-- <script src="{{asset('assets/vendor/libs/apex-charts/apexcharts.js')}}"></script> --}}
@endsection

@section('page-script')
    {{-- <script src="{{asset('assets/js/dashboards-analytics.js')}}"></script> --}}
@endsection


@section('content')
@include('_partials.loader')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row g-6 mb-6">
                {{-- <div class="col-sm-6 col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div class="me-1">
                                    <p class="text-heading mb-1">Users</p>
                                    <div class="d-flex align-items-center">
                                        <h4 class="mb-1 me-2">{{ $users->count() }}</h4>
                                    </div>
                                    <small class="mb-0">Total Users</small>
                                </div>
                                <div class="avatar">
                                    <div class="avatar-initial bg-success rounded shadow">
                                        <i class="mdi mdi-account-outline mdi-24px"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div class="me-1">
                                    <p class="text-heading mb-1">Verified Users</p>
                                    <div class="d-flex align-items-center">
                                        <h4 class="mb-1 me-2">0</h4>
                                        <p class="text-success mb-1">(+95%)</p>
                                    </div>
                                    <small class="mb-0">Recent analytics</small>
                                </div>
                                <div class="avatar">
                                    <div class="avatar-initial bg-primary rounded shadow">
                                        <i class="mdi mdi-account-outline mdi-24px"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div class="me-1">
                                    <p class="text-heading mb-1">Duplicate Users</p>
                                    <div class="d-flex align-items-center">
                                        <h4 class="mb-1 me-2">0</h4>
                                        <p class="text-danger mb-1">(0%)</p>
                                    </div>
                                    <small class="mb-0">Recent analytics</small>
                                </div>
                                <div class="avatar">
                                    <div class="avatar-initial bg-danger rounded shadow">
                                        <i class="mdi mdi-account-outline mdi-24px"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div class="me-1">
                                    <p class="text-heading mb-1">Verification Pending</p>
                                    <div class="d-flex align-items-center">
                                        <h4 class="mb-1 me-2">3</h4>
                                        <p class="text-success mb-1">(+6%)</p>
                                    </div>
                                    <small class="mb-0">Recent analytics</small>
                                </div>
                                <div class="avatar">
                                    <div class="avatar-initial bg-warning rounded shadow">
                                        <i class="mdi mdi-account-outline mdi-24px"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>


            <div class="card mt-4">
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
									<th>Id</th>
									<th>User</th>
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
										<td>{{ $user->id }}</td>
										<td>
											<div class="d-flex align-items-center">
											<div class="avatar avatar-sm me-3">
												@if($user->profile_photo_path)
												<img src="{{ asset('storage/' . $user->profile_photo_path) }}" alt="Avatar" class="rounded-circle">
												@else
												<span class="avatar-initial rounded-circle bg-label-primary">
													{{ strtoupper(substr($user->name, 0, 2)) }}
												</span>
												@endif
											</div>
											<div>
												<a href="{{ url('app/user/view/' . $user->id) }}" class="text-heading fw-medium">
												{{ $user->name }}
												</a>
											</div>
											</div>
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
												<span class="badge bg-label-success">Changed</span>
											@else
												<span class="badge bg-label-warning">Not Changed</span>
											@endif
										</td>
										<td>
											<div class="d-flex align-items-center gap-2">
												<a href="{{ route('user-management.edit', $user->id) }}" class="btn btn-sm btn-secondary">
													<i class="mdi mdi-pencil-outline"></i>
												</a>

												<a href="{{ route('user-management.reset-password', $user->id) }}" class="btn btn-sm btn-warning">
													<i class="mdi mdi-lock-reset"></i>
												</a>

												<form action="{{ route('user-management.destroy', $user->id) }}" method="POST" class="d-inline">
													@csrf
													@method('DELETE')
													<button type="submit" class="btn btn-sm btn-icon btn-danger delete-record">
														<i class="mdi mdi-delete-outline"></i>
													</button>
												</form>

												<div class="dropdown">
													<button class="btn btn-sm btn-icon btn-text-secondary rounded-pill dropdown-toggle hide-arrow"
													data-bs-toggle="dropdown">
													<i class="mdi mdi-dots-vertical"></i>
													</button>
													<div class="dropdown-menu dropdown-menu-end">
														<a href="{{ url('user-management/show/' . $user->id) }}" class="dropdown-item">
															<i class="mdi mdi-eye-outline me-2"></i> View
														</a>
														<a href="javascript:;" class="dropdown-item">
															<i class="mdi mdi-account-off-outline me-2"></i> Suspend
														</a>
													</div>
												</div>
											</div>
										</td>
									</tr>
								@endif
							@endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
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
@endpush
@endsection
