@extends('layouts/contentNavbarLayout')

@section('title', 'Account settings - Notifications')

@section('page-script')
<script src="{{asset('assets/js/pages-account-settings-account.js')}}"></script>
@endsection

@section('content')
<h4 class="py-3 mb-4">
    <span class="text-muted fw-light">Account Settings /</span> Notifications
</h4>

<div class="row">
    <div class="col-md-12">
        <ul class="nav nav-pills flex-column flex-md-row mb-4 gap-2 gap-lg-0">
            <li class="nav-item"><a class="nav-link" href="{{ route('profile.index') }}"><i class="mdi mdi-account-outline mdi-20px me-1"></i>Account</a></li>
            <li class="nav-item"><a class="nav-link active" href="{{ route('notifications.index') }}"><i class="mdi mdi-bell-outline mdi-20px me-1"></i>Notifications</a></li>
        </ul>

        @include('_partials.errors')
        @include('_partials.success')

        <div class="card mb-4">
            <h4 class="card-header">Notifications</h4>
            <div class="card-body">
                {{-- proper intro --}}
				<p class="text-muted">Manage your notification preferences and view recent notifications.</p>

				{{-- Notifications List --}}

                <ul class="list-unstyled mb-2 mt-3">
					@forelse($notifications as $notification)
						<li class="d-flex flex-column flex-sm-row mb-2 p-2 rounded-2 align-items-start hover-light justify-content-between">
							<div class="d-flex align-items-start gap-2">
								{{-- Icon with colored badge --}}
								@php
									$type = strtolower($notification->data['type']);
									$iconClass = 'mdi mdi-bell-outline';
									$badgeClass = 'bg-secondary';
									if ($type === 'media') {
										$iconClass = 'mdi mdi-camera';
										$badgeClass = 'bg-primary';
									} elseif ($type === 'article') {
										$iconClass = 'mdi mdi-file-document-outline';
										$badgeClass = 'bg-success';
									} elseif ($type === 'incident') {
										$iconClass = 'mdi mdi-account-alert';
										$badgeClass = 'bg-danger';
									}
								@endphp

								<span class="d-inline-flex align-items-center justify-content-center rounded-circle {{ $badgeClass }} text-white fs-5" style="width:32px; height:32px;">
									<i class="{{ $iconClass }}"></i>
								</span>

								<div class="d-flex flex-column ms-2">
									<h6 class="mb-0 small fw-bold">{{ $notification->data['type'] }}</h6>
									<p class="mb-0 text-muted xsmall">{{ $notification->data['message'] }}</p>
								</div>
							</div>

							<span class="text-muted small mt-1 mt-sm-0 ms-sm-3 text-end">
								{{ $notification->created_at->diffForHumans() }}
							</span>
						</li>
					@empty
						<li class="text-center text-muted py-3">No notifications found.</li>
					@endforelse
				</ul>


            </div>
        </div>
    </div>
</div>
@endsection
