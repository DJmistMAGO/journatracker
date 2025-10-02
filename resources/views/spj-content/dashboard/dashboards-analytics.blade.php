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
		{{-- <img src="{{asset('assets/img/icons/misc/triangle-light.png')}}" class="scaleX-n1-rtl position-absolute bottom-0 end-0" width="166" alt="triangle background">
		<img src="{{asset('assets/img/illustrations/trophy.png')}}" class="scaleX-n1-rtl position-absolute bottom-0 end-0 me-4 mb-4 pb-2" width="83" alt="view sales"> --}}
		</div>
	</div>
	<!--/ Congratulations card -->

	<!-- Transactions -->
	<div class="col-lg-8">
		<div class="card">
		<div class="card-header">
			<div class="d-flex align-items-center justify-content-between">
			<h5 class="card-title m-0 me-2">Articles</h5>
			{{-- <div class="dropdown">
				<button class="btn p-0" type="button" id="transactionID" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<i class="mdi mdi-dots-vertical mdi-24px"></i>
				</button>
				<div class="dropdown-menu dropdown-menu-end" aria-labelledby="transactionID">
				<a class="dropdown-item" href="javascript:void(0);">Refresh</a>
				<a class="dropdown-item" href="javascript:void(0);">Share</a>
				<a class="dropdown-item" href="javascript:void(0);">Update</a>
				</div>
			</div> --}}
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
	<!--/ Transactions -->

	<!-- Weekly Overview Chart -->
	{{-- Articles Card --}}
<div class="col-xl-4 col-md-6">
    <div class="card">
        <div class="card-header">
            <h5 class="mb-1">Articles Overview</h5>
        </div>
        <div class="card-body">
            {{-- Articles Chart --}}
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

{{-- Media Card --}}
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


	<!--/ Weekly Overview Chart -->

	<!-- Total Earnings -->
	<div class="col-xl-4 col-md-6">
		<div class="card">
		<div class="card-header d-flex align-items-center justify-content-between">
			<h5 class="card-title m-0 me-2">Notifications</h5>
			{{-- <div class="dropdown">
			<button class="btn p-0" type="button" id="totalEarnings" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<i class="mdi mdi-dots-vertical mdi-24px"></i>
			</button>
			<div class="dropdown-menu dropdown-menu-end" aria-labelledby="totalEarnings">
				<a class="dropdown-item" href="javascript:void(0);">Last 28 Days</a>
				<a class="dropdown-item" href="javascript:void(0);">Last Month</a>
				<a class="dropdown-item" href="javascript:void(0);">Last Year</a>
			</div>
			</div>--}}
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
	<!-- Data Tables -->
	{{-- <div class="col-12">
		<div class="card">
		<div class="table-responsive">
			<table class="table">
			<thead class="table-light">
				<tr>
				<th class="text-truncate">User</th>
				<th class="text-truncate">Email</th>
				<th class="text-truncate">Role</th>
				<th class="text-truncate">Age</th>
				<th class="text-truncate">Salary</th>
				<th class="text-truncate">Status</th>
				</tr>
			</thead>
			<tbody>
				<tr>
				<td>
					<div class="d-flex align-items-center">
					<div class="avatar avatar-sm me-3">
						<img src="{{asset('assets/img/avatars/1.png')}}" alt="Avatar" class="rounded-circle">
					</div>
					<div>
						<h6 class="mb-0 text-truncate">Jordan Stevenson</h6>
						<small class="text-truncate">@amiccoo</small>
					</div>
					</div>
				</td>
				<td class="text-truncate">susanna.Lind57@gmail.com</td>
				<td class="text-truncate"><i class="mdi mdi-laptop mdi-24px text-danger me-1"></i> Admin</td>
				<td class="text-truncate">24</td>
				<td class="text-truncate">34500$</td>
				<td><span class="badge bg-label-warning rounded-pill">Pending</span></td>
				</tr>
				<tr>
				<td>
					<div class="d-flex align-items-center">
					<div class="avatar avatar-sm me-3">
						<img src="{{asset('assets/img/avatars/3.png')}}" alt="Avatar" class="rounded-circle">
					</div>
					<div>
						<h6 class="mb-0 text-truncate">Benedetto Rossiter</h6>
						<small class="text-truncate">@brossiter15</small>
					</div>
					</div>
				</td>
				<td class="text-truncate">estelle.Bailey10@gmail.com</td>
				<td class="text-truncate"><i class="mdi mdi-pencil-outline text-info mdi-24px me-1"></i> Editor</td>
				<td class="text-truncate">29</td>
				<td class="text-truncate">64500$</td>
				<td><span class="badge bg-label-success rounded-pill">Active</span></td>
				</tr>
				<tr>
				<td>
					<div class="d-flex align-items-center">
					<div class="avatar avatar-sm me-3">
						<img src="{{asset('assets/img/avatars/2.png')}}" alt="Avatar" class="rounded-circle">
					</div>
					<div>
						<h6 class="mb-0 text-truncate">Bentlee Emblin</h6>
						<small class="text-truncate">@bemblinf</small>
					</div>
					</div>
				</td>
				<td class="text-truncate">milo86@hotmail.com</td>
				<td class="text-truncate"><i class="mdi mdi-cog-outline text-warning mdi-24px me-1"></i> Author</td>
				<td class="text-truncate">44</td>
				<td class="text-truncate">94500$</td>
				<td><span class="badge bg-label-success rounded-pill">Active</span></td>
				</tr>
				<tr>
				<td>
					<div class="d-flex align-items-center">
					<div class="avatar avatar-sm me-3">
						<img src="{{asset('assets/img/avatars/5.png')}}" alt="Avatar" class="rounded-circle">
					</div>
					<div>
						<h6 class="mb-0 text-truncate">Bertha Biner</h6>
						<small class="text-truncate">@bbinerh</small>
					</div>
					</div>
				</td>
				<td class="text-truncate">lonnie35@hotmail.com</td>
				<td class="text-truncate"><i class="mdi mdi-pencil-outline text-info mdi-24px me-1"></i> Editor</td>
				<td class="text-truncate">19</td>
				<td class="text-truncate">4500$</td>
				<td><span class="badge bg-label-warning rounded-pill">Pending</span></td>
				</tr>
				<tr>
				<td>
					<div class="d-flex align-items-center">
					<div class="avatar avatar-sm me-3">
						<img src="{{asset('assets/img/avatars/4.png')}}" alt="Avatar" class="rounded-circle">
					</div>
					<div>
						<h6 class="mb-0 text-truncate">Beverlie Krabbe</h6>
						<small class="text-truncate">@bkrabbe1d</small>
					</div>
					</div>
				</td>
				<td class="text-truncate">ahmad_Collins@yahoo.com</td>
				<td class="text-truncate"><i class="mdi mdi-chart-donut mdi-24px text-success me-1"></i> Maintainer</td>
				<td class="text-truncate">22</td>
				<td class="text-truncate">10500$</td>
				<td><span class="badge bg-label-success rounded-pill">Active</span></td>
				</tr>
				<tr>
				<td>
					<div class="d-flex align-items-center">
					<div class="avatar avatar-sm me-3">
						<img src="{{asset('assets/img/avatars/7.png')}}" alt="Avatar" class="rounded-circle">
					</div>
					<div>
						<h6 class="mb-0 text-truncate">Bradan Rosebotham</h6>
						<small class="text-truncate">@brosebothamz</small>
					</div>
					</div>
				</td>
				<td class="text-truncate">tillman.Gleason68@hotmail.com</td>
				<td class="text-truncate"><i class="mdi mdi-pencil-outline text-info mdi-24px me-1"></i> Editor</td>
				<td class="text-truncate">50</td>
				<td class="text-truncate">99500$</td>
				<td><span class="badge bg-label-warning rounded-pill">Pending</span></td>
				</tr>
				<tr>
				<td>
					<div class="d-flex align-items-center">
					<div class="avatar avatar-sm me-3">
						<img src="{{asset('assets/img/avatars/6.png')}}" alt="Avatar" class="rounded-circle">
					</div>
					<div>
						<h6 class="mb-0 text-truncate">Bree Kilday</h6>
						<small class="text-truncate">@bkildayr</small>
					</div>
					</div>
				</td>
				<td class="text-truncate">otho21@gmail.com</td>
				<td class="text-truncate"><i class="mdi mdi-account-outline mdi-24px text-primary me-1"></i> Subscriber</td>
				<td class="text-truncate">23</td>
				<td class="text-truncate">23500$</td>
				<td><span class="badge bg-label-success rounded-pill">Active</span></td>
				</tr>
				<tr class="border-transparent">
				<td>
					<div class="d-flex align-items-center">
					<div class="avatar avatar-sm me-3">
						<img src="{{asset('assets/img/avatars/1.png')}}" alt="Avatar" class="rounded-circle">
					</div>
					<div>
						<h6 class="mb-0 text-truncate">Breena Gallemore</h6>
						<small class="text-truncate">@bgallemore6</small>
					</div>
					</div>
				</td>
				<td class="text-truncate">florencio.Little@hotmail.com</td>
				<td class="text-truncate"><i class="mdi mdi-account-outline mdi-24px text-primary me-1"></i> Subscriber</td>
				<td class="text-truncate">33</td>
				<td class="text-truncate">20500$</td>
				<td><span class="badge bg-label-secondary rounded-pill">Inactive</span></td>
				</tr>
			</tbody>
			</table>
		</div>
		</div>
	</div> --}}
	<!--/ Data Tables -->
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
