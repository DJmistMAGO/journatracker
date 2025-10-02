@extends('layouts/contentNavbarLayout')

@section('title', 'Dashboard - Analytics')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/apex-charts/apex-charts.css')}}">
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/loader.css') }}">
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
	<!-- Congratulations card -->
	<div class="col-md-12 col-lg-4">
		<div class="card">
		<div class="card-body">
			<h4 class="card-title mb-1">Welcome {{ Auth::user()->name }}! 🎉</h4>
			<p class="pb-0">Here is your dashboard</p>
			<h4 class="text-primary mb-1">{{ $usersCount }}</h4>
			<p class="mb-2 pb-1">
				<span class="fw-medium">
					{{ $activeUsersCount }} active users ({{ $usersCount > 0 ? round(($activeUsersCount / $usersCount) * 100, 2) : 0 }}%)
				</span>
			</p>
			<a href="{{ route('user-management') }}" class="btn btn-sm btn-primary">View Users</a>
		</div>
		</div>
	</div>


	<!-- Transactions -->
	<div class="col-lg-8">
		<div class="card">
		<div class="card-header">
			<div class="d-flex align-items-center justify-content-between">
			<h5 class="card-title m-0 me-2">Articles</h5>

			</div>
			<p class="mt-3">
				<span class="fw-medium">
					<i class="mdi mdi-file-document-outline text-primary me-1"></i>
					Total {{ $articlesPublishedCount }} pulished articles and  {{ $mediaPublishedCount }} published media files
				</span>
				this month
			</p>
		</div>
		<div class="card-body">
			<div class="row g-3">
			<div class="col-md-3 col-6">
				<div class="d-flex align-items-center">
				<div class="avatar">
					<div class="avatar-initial bg-primary rounded shadow">
					<i class="mdi mdi-file-document mdi-24px"></i>
					</div>
				</div>
				<div class="ms-3">
					<div class="small mb-1">Published Articles</div>
					<h5 class="mb-0">{{ $articlesPublishedCount }}</h5>
				</div>
				</div>
			</div>
			<div class="col-md-3 col-6">
				<div class="d-flex align-items-center">
				<div class="avatar">
					<div class="avatar-initial bg-success rounded shadow">
					<i class="mdi mdi-camera mdi-24px"></i>
					</div>
				</div>
				<div class="ms-3">
					<div class="small mb-1">Media</div>
					<h5 class="mb-0">{{ $mediaPublishedCount }}</h5>
				</div>
				</div>
			</div>
			<div class="col-md-3 col-6">
				<div class="d-flex align-items-center">
					<div class="avatar">
						<div class="avatar-initial bg-warning rounded shadow">
						<i class="mdi mdi-pencil mdi-24px"></i>
						</div>
					</div>
					<div class="ms-3">
						<div class="small mb-1">Drafts</div>
						<h5 class="mb-0">{{ $articlesDraftCount }}</h5>
					</div>
				</div>
			</div>
			<div class="col-md-3 col-6">
				<div class="d-flex align-items-center">
					<div class="avatar">
						<div class="avatar-initial bg-danger rounded shadow">
						<i class="mdi mdi-pencil mdi-24px"></i>
						</div>
					</div>
					<div class="ms-3">
						<div class="small mb-1">Archived</div>
						<h5 class="mb-0">{{ $articlesArchivedCount }}</h5>
					</div>
				</div>
			</div>
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
						<p class="mb-0">Drafts</p>
					</div>

					<div class="d-flex align-items-center gap-3 mt-2">
						<span class="badge bg-secondary">{{ $articlesArchivedCount }}</span>
						<p class="mb-0">Archived</p>
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
						<p class="mb-0">Drafts</p>
					</div>

					<div class="d-flex align-items-center gap-3 mt-2">
						<span class="badge bg-secondary">{{ $mediaArchivedCount }}</span>
						<p class="mb-0">Archived</p>
					</div>

					<div class="d-grid mt-3">
						<a href="{{ route('media-management') }}" class="btn btn-primary">View Media</a>
					</div>
				</div>
			</div>
		</div>
	</div>



	<div class="col-xl-4 col-md-6">
		<div class="card">
		<div class="card-header d-flex align-items-center justify-content-between">
			<h5 class="card-title m-0 me-2">Notifications</h5>
		</div>
		<div class="card-body">
			<ul class="p-0 m-0">
				@foreach($notifications as $notification)
					<li class="d-flex mb-4 pb-1">
						<div class="avatar flex-shrink-0 me-3">
							<img src="{{ asset('assets/img/avatars/1.png') }}" alt="Avatar" class="rounded-circle">
						</div>
						<div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
							<div class="me-2">
								<h6 class="mb-0">{{ $notification->data['type'] }}</h6>
								<small class="text-muted">{{ $notification->data['message'] }}</small>
							</div>
							<div class="user-progress d-flex align-items-center gap-1">
								<span class="text-muted">{{ $notification->created_at->diffForHumans() }}</span>
							</div>
						</div>
					</li>
				@endforeach
			</ul>
			<div class="d-grid">
				<a href="#" class="btn btn-primary">View All Notifications</a>
			</div>
		</div>
	</div>
	</div>

	@push('scripts')
		<script src="{{ asset('assets/js/loader.js') }}"></script>
		<script>
			// Articles Chart
			var articleOptions = {
				chart: {
					type: 'donut',
					height: 250
				},
				labels: ['Published', 'Draft', 'Archived'],
				series: [{{ $articlesPublishedCount }}, {{ $articlesDraftCount }}, {{ $articlesArchivedCount }}],
				colors: ['#28a745', '#ffc107', '#6c757d']
			};
			new ApexCharts(document.querySelector("#publicationOverviewChart"), articleOptions).render();

			// Media Chart
			var mediaOptions = {
				chart: {
					type: 'donut',
					height: 250
				},
				labels: ['Published', 'Draft', 'Archived'],
				series: [{{ $mediaPublishedCount }}, {{ $mediaDraftCount }}, {{ $mediaArchivedCount }}],
				colors: ['#17a2b8', '#ffc107', '#6c757d']
			};
			new ApexCharts(document.querySelector("#mediaOverviewChart"), mediaOptions).render();
		</script>


	@endpush
@endsection
