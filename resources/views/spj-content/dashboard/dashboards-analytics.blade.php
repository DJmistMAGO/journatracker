@extends('layouts/contentNavbarLayout')

@section('title', 'Dashboard - Analytics')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/apex-charts/apex-charts.css')}}">
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/loader.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/snackbar.css') }}">

@endpush

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>
@endsection

@section('page-script')
<script src="{{asset('assets/js/dashboards-analytics.js')}}"></script>
@endsection

@section('content')
@include('_partials/loader')
<div class="row gy-4">

	<div class="col-md-12 col-lg-4">
		<div class="card">
			<div class="card-body">
				<h4 class="card-title mb-1">Welcome {{ Auth::user()->name }}! 🎉</h4>
				<p class="pb-0">Here is your dashboard</p>
				@role('admin')
					<h4 class="text-primary mb-1">{{ $usersCount }}</h4>
					<p class="mb-2 pb-1">
						<span class="fw-medium">
							{{ $activeUsersCount }} active users
							({{ $usersCount > 0 ? round(($activeUsersCount / $usersCount) * 100, 2) : 0 }}%)
						</span>
					</p>
					<a href="{{ route('user-management') }}" class="btn btn-sm btn-primary">View Users</a>
				@endrole

				@role('teacher')
					<h4 class="text-primary mb-1">{{ $articlesCount + $mediaCount }}</h4>
					<p class="mb-2 pb-1">
						<span class="fw-medium">
							{{ $articlesPublishedCount + $mediaPublishedCount }} published articles and media
							{{-- ({{ $articlesCount > 0 ? round(($articlesPublishedCount  + $mediaPublishedCount / $articlesCount) * 100, ) : 0 }}%) --}}
						</span>
					</p>
					<a href="{{ route('archive') }}" class="btn btn-sm btn-primary">View Articles</a>
				@endrole

				@role('student')
					<h4 class="text-primary mb-1">{{ $articlesCount }}</h4>
					<p class="mb-2 pb-1">
						<span class="fw-medium">
							{{ $articlesPublishedCount }} published articles
							{{-- ({{ $articlesCount > 0 ? round(($articlesPublishedCount / $articlesCount) * 100, 2) : 0 }}%) --}}
						</span>
					</p>
					<a href="{{ route('article-management') }}" class="btn btn-sm btn-primary">View My Articles</a>
				@endrole
			</div>
			</div>
		</div>

		<div class="col-lg-8">
			<div class="card">
				<div class="card-header">
					<h5 class="card-title m-0">Articles & Media</h5>
					@role('admin')
						<p class="mt-2">
							<span class="fw-medium">
								<i class="mdi mdi-file-document-outline text-primary me-1"></i>
								Total {{ $articlesPublishedCount }} published articles and
								{{ $mediaPublishedCount }} published media files
							</span> this month
						</p>
					@endrole
					@unlessrole('admin')
						<p class="mt-2">
							<span class="fw-medium">
								<i class="mdi mdi-file-document-outline text-primary me-1"></i>
								You have Total {{ $articlesPublishedCount }} published articles and
								{{ $mediaPublishedCount }} published media files
							</span> this month
						</p>
					@endunlessrole
				</div>
				<div class="card-body">
					<div class="row g-3">
						<x-dashboard-stat title="Published Articles" :count="$articlesPublishedCount" icon="mdi-file-document-outline" color="primary"/>
						<x-dashboard-stat title="Media" :count="$mediaPublishedCount" icon="mdi-camera" color="success"/>
						<x-dashboard-stat title="Submitted" :count="$draftCount" icon="mdi-pencil" color="warning"/>
						<x-dashboard-stat title="Scheduled" :count="$articlesScheduledCount" icon="mdi-archive" color="secondary"/>
					</div>
				</div>
			</div>
		</div>

		{{-- Articles Card --}}
		<div class="col-xl-4 col-md-6">
			<div class="card">
				<div class="card-header">
					<h5 class="mb-1">Articles Overview</h5>
				</div>
				<div class="card-body">
					<div id="publicationOverviewChart"></div>

					<div class="mt-3">
						<div class="d-flex align-items-center gap-3">
							<h3 class="mb-0">{{ $articlesCount }}</h3>
							<p class="mb-0">Total Articles</p>
						</div>

						<div class="d-flex align-items-center gap-3 mt-2">
							<span class="badge bg-success">{{ $articlesPublishedCount }}</span>
							<p class="mb-0">Published</p>
						</div>

						<div class="d-flex align-items-center gap-3 mt-2">
							<span class="badge bg-warning">{{ $articlesDraftCount }}</span>
							<p class="mb-0">Submitted</p>
						</div>

						<div class="d-flex align-items-center gap-3 mt-2">
							<span class="badge bg-secondary">{{ $articlesScheduledCount }}</span>
							<p class="mb-0">Scheduled</p>
						</div>

						<div class="d-grid mt-3">
							<a href="{{ route('article-management') }}" class="btn btn-primary">View Articles</a>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-xl-4 col-md-6">
			<div class="card">
				<div class="card-header">
					<h5 class="mb-1">Media Overview</h5>
				</div>
				<div class="card-body">
					{{-- Media Chart --}}
					<div id="mediaOverviewChart"></div>

					<div class="mt-3">
						<div class="d-flex align-items-center gap-3">
							<h3 class="mb-0">{{ $mediaCount }}</h3>
							<p class="mb-0">Total Media Files</p>
						</div>

						<div class="d-flex align-items-center gap-3 mt-2">
							<span class="badge bg-success">{{ $mediaPublishedCount }}</span>
							<p class="mb-0">Published</p>
						</div>

						<div class="d-flex align-items-center gap-3 mt-2">
							<span class="badge bg-warning">{{ $mediaDraftCount }}</span>
							<p class="mb-0">Submitted</p>
						</div>

						<div class="d-flex align-items-center gap-3 mt-2">
							<span class="badge bg-secondary">{{ $mediaScheduledCount }}</span>
							<p class="mb-0">Scheduled</p>
						</div>

						<div class="d-grid mt-3">
							<a href="{{ route('media-management') }}" class="btn btn-primary">View Media</a>
						</div>
					</div>
				</div>
			</div>
		</div>



		<div class="col-xl-4 col-md-6">
			<div class="card shadow-sm border-0">
				<div class="card-header bg-white py-2 px-3">
					<h6 class="card-title m-0">Notifications</h6>
				</div>
				<div class="card-body p-2">
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

									<span class="d-inline-flex align-items-center justify-content-center {{ $badgeClass }} text-white fs-5 rounded-circle"
									style="width:32px; height:32px; min-width:32px; min-height:32px;">
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

					{{-- Optional fallback for empty --}}
					@if($notifications->isEmpty())
						<p class="text-center text-muted small">No notifications available.</p>
					@endif

					{{-- Materio-style pagination --}}
					<nav aria-label="Page navigation" class="d-flex justify-content-center mt-2">
						<ul class="pagination pagination-sm">
							{{-- Previous Page Link --}}
							@if ($notifications->onFirstPage())
								<li class="page-item disabled"><span class="page-link">&laquo;</span></li>
							@else
								<li class="page-item"><a class="page-link" href="{{ $notifications->previousPageUrl() }}" rel="prev">&laquo;</a></li>
							@endif

							{{-- Pagination Elements --}}
							@foreach ($notifications->getUrlRange(1, $notifications->lastPage()) as $page => $url)
								<li class="page-item {{ $notifications->currentPage() == $page ? 'active' : '' }}">
									<a class="page-link" href="{{ $url }}">{{ $page }}</a>
								</li>
							@endforeach

							{{-- Next Page Link --}}
							@if ($notifications->hasMorePages())
								<li class="page-item"><a class="page-link" href="{{ $notifications->nextPageUrl() }}" rel="next">&raquo;</a></li>
							@else
								<li class="page-item disabled"><span class="page-link">&raquo;</span></li>
							@endif
						</ul>
					</nav>
				</div>
			</div>
		</div>

	</div>
	@push('styles')
		<style>
			.hover-light:hover {
				background-color: #f7f7f7;
				transition: 0.2s;
				box-shadow: 0 4px 8px rgba(5, 85, 12, 0.1);
				border: rgba(5, 85, 12, 0.1) solid 1px;
			}

			.xsmall {
				font-size: 0.75rem;
			}

			/* Unread notifications styling */
			.bg-light.border-start.border-primary {
				background-color: #e6f4ea !important;
				border-left: 3px solid #28a745 !important;
			}
		</style>
	@endpush

	@push('scripts')
		<script src="{{ asset('assets/js/loader.js') }}"></script>
		<script>
			// Articles Chart
			var articleOptions = {
				chart: {
					type: 'donut',
					height: 250
				},
				labels: ['Published', 'Submitted', 'Scheduled'],
				series: [{{ $articlesPublishedCount }}, {{ $articlesDraftCount }}, {{ $articlesScheduledCount }}],
				colors: ['#28a745', '#ffc107', '#6c757d']
			};
			new ApexCharts(document.querySelector("#publicationOverviewChart"), articleOptions).render();

			// Media Chart
			var mediaOptions = {
				chart: {
					type: 'donut',
					height: 250
				},
				labels: ['Published', 'Submitted', 'Scheduled'],
				series: [{{ $mediaPublishedCount }}, {{ $mediaDraftCount }}, {{ $mediaScheduledCount }}],
				colors: ['#17a2b8', '#ffc107', '#6c757d']
			};
			new ApexCharts(document.querySelector("#mediaOverviewChart"), mediaOptions).render();
		</script>


	@endpush
@endsection
