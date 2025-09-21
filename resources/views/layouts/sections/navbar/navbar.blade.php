@php
$containerNav = $containerNav ?? 'container-fluid';
$navbarDetached = ($navbarDetached ?? '');

@endphp

	@if(isset($navbarDetached) && $navbarDetached == 'navbar-detached')
    	<nav class="layout-navbar {{$containerNav}} navbar navbar-expand-xl {{$navbarDetached}} align-items-center bg-navbar-theme" id="layout-navbar">
    @endif

    @if(isset($navbarDetached) && $navbarDetached == '')
    	<nav class="layout-navbar navbar navbar-expand-xl align-items-center bg-navbar-theme" id="layout-navbar">
        <div class="{{$containerNav}}">
    @endif
	@if(!isset($navbarHideToggle))
		<div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0{{ isset($menuHorizontal) ? ' d-xl-none ' : '' }} {{ isset($contentNavbar) ?' d-xl-none ' : '' }}">
			<a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
			<i class="mdi mdi-menu mdi-24px"></i>
			</a>
		</div>
	@endif
	<div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
		<div class="navbar-nav navbar-nav-right align-items-center">
			<!-- ms-auto pushes this UL to the right -->
			<ul class="navbar-nav flex-row align-items-center ms-auto me-2">
				<li class="nav-item me-3">
					<a class="nav-link d-flex align-items-center" href="javascript:void(0);">
						<i class="ti ti-user me-1"></i> {{ Auth::user()->first_name}} | {{ Auth::user()->penname ?? '' }}
					</a>
				</li>

				<li class="nav-item navbar-dropdown dropdown-user dropdown">
					<a class="nav-link dropdown-toggle hide-arrow p-0" href="javascript:void(0);" data-bs-toggle="dropdown">
						<div class="avatar avatar-online">
							@if (Auth::user()->profile_photo_path)
								<img src="{{ asset('storage/' . Auth::user()->profile_photo_path) }}" alt class="w-px-40 h-40 w-40 rounded-circle">
							@else
								<span class="avatar-initial rounded-circle bg-label-primary">
									{{ strtoupper(substr(Auth::user()->first_name, 0, 2)) }}
								</span>
							@endif
						</div>
					</a>
					<ul class="dropdown-menu dropdown-menu-end mt-3 py-2">
						<li>
							<a class="dropdown-item pb-2 mb-1" href="javascript:void(0);">
								<div class="d-flex align-items-center">
									<div class="flex-shrink-0 me-2 pe-1">
										<div class="avatar avatar-online">
											@if (Auth::user()->profile_photo_path)
												<img src="{{ asset('storage/' . Auth::user()->profile_photo_path) }}" alt class="w-px-40 h-40 w-40 rounded-circle">
											@else
												<span class="avatar-initial rounded-circle bg-label-primary">
													{{ strtoupper(substr(Auth::user()->first_name, 0, 2)) }}
												</span>
											@endif
										</div>
									</div>
									<div class="flex-grow-1">
										<h6 class="mb-0">{{ Auth::user()->first_name}}  {{ Auth::user()->last_name ?? '' }}</h6>
										<small class="text-muted">{{ Auth::user()->roles->first()->name ?? '' }}</small>
									</div>
								</div>
							</a>
						</li>
						<li><div class="dropdown-divider my-1"></div></li>

						@unless (Auth::user()->roles->first()->name == 'admin')
							<li>
								<a class="dropdown-item" href="javascript:void(0);">
									<i class="mdi mdi-account-outline me-1 mdi-20px"></i>
									<span class="align-middle">My Profile</span>
								</a>
							</li>
						@endunless

						<li>
							<a class="dropdown-item" href="{{ route('profile.index') }}">
								<i class='mdi mdi-cog-outline me-1 mdi-20px'></i>
								<span class="align-middle">Settings</span>
							</a>
						</li>
						<li><div class="dropdown-divider my-1"></div></li>

						<li>
							<a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
								<i class='mdi mdi-power me-1 mdi-20px text-danger'></i>
								<span class="align-middle text-danger">Log Out</span>
							</a>
							<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
								@csrf
							</form>
						</li>
					</ul>
				</li>
			</ul>
		</div>
		@if(!isset($navbarDetached))
		</div>
		@endif

	</nav>
