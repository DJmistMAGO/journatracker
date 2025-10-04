@php
    $containerNav = $containerNav ?? 'container-fluid';
    $navbarDetached = $navbarDetached ?? '';

@endphp

@if (isset($navbarDetached) && $navbarDetached == 'navbar-detached')
    <nav class="layout-navbar {{ $containerNav }} navbar navbar-expand-xl {{ $navbarDetached }} align-items-center bg-navbar-theme"
        id="layout-navbar">
@endif

@if (isset($navbarDetached) && $navbarDetached == '')
    <nav class="layout-navbar navbar navbar-expand-xl align-items-center bg-navbar-theme" id="layout-navbar">
        <div class="{{ $containerNav }}">
@endif
@if (!isset($navbarHideToggle))
    <div
        class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0{{ isset($menuHorizontal) ? ' d-xl-none ' : '' }} {{ isset($contentNavbar) ? ' d-xl-none ' : '' }}">
        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
            <i class="mdi mdi-menu mdi-24px"></i>
        </a>
    </div>
@endif
<div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
    <div class="navbar-nav navbar-nav-right align-items-center">
        <!-- ms-auto pushes this UL to the right -->
        <ul class="navbar-nav flex-row align-items-center ms-auto me-2">

            {{-- Notification here --}}
            <li class="nav-item dropdown me-3">
                <a class="nav-link position-relative" href="#" id="navbarDropdown" role="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="mdi mdi-bell-outline mdi-24px"></i>
                    @if (auth()->user()->unreadNotifications->count() > 0 )
                        <span
                            class="position-absolute mt-1 top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            {{ auth()->user()->unreadNotifications->count() }}
                            <span class="visually-hidden">unread notifications</span>
                        </span>
                    @endif
                </a>

                <ul class="dropdown-menu dropdown-menu-end p-0 shadow" aria-labelledby="navbarDropdown"
                    style="width: 400px;">
                    <li
                        class="dropdown-header px-3 py-2 bg-light d-flex justify-content-between align-items-center fw-bold">
                        Notifications
                        <a href="#" onclick="markAllNotificationsRead()" class="small text-primary">Mark all as
                            read</a>
                    </li>

                    <li>
                        @forelse(auth()->user()->unreadNotifications as $notification)
                            @php
								$data = $notification->data ?? [];
								$type = $data['type'] ?? null;
								$id = $data['id'] ?? null;

								if (auth()->user()->hasRole('student')) {
									if ($type === 'Article') {
										$href = route('article-management.show', $id);
									} elseif ($type === 'Media') {
										$href = route('media-management.show', $id);
									} elseif ($type === 'Incident Report') {
										$href = route('incident-report.show', $id); // Student incident report route
									} else {
										$href = '#';
									}
								} elseif (auth()->user()->hasAnyRole(['admin', 'eic'])) {
									if ($type === 'Incident Report') {
										$href = route('incident-report.show', $id); // Admin/EIC incident report route
									} elseif ($type) {
										$href = route('publication-management.show', [
											'type' => $type,
											'id' => $id,
										]);
									} else {
										$href = '#';
									}
								} else {
									$href = '#';
								}
							@endphp
                            <a class="dropdown-item" href="{{ $href }}"
                                onclick="markNotificationRead('{{ $notification->id }}')">
                                <div>
                                    <i class="mdi mdi-bullhorn-variant-outline me-2 text-primary"></i>
                                    <span
                                        class="small text-muted">{{ $notification->created_at->diffForHumans() }}</span>
                                </div>
                                <div>
                                    {{ $notification->data['message'] }}
                                </div>
                            </a>
                        @empty
                            <span class="dropdown-item text-center text-muted">No notifications</span>
                        @endforelse
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <a class="dropdown-item text-center text-primary fw-bold" href="{{ route('notifications.index') }}">View all
                            notifications</a>
                    </li>
                </ul>
            </li>

            <li class="nav-item me-3">
                <a class="nav-link d-flex align-items-center" href="javascript:void(0);">
                    <i class="ti ti-user me-1"></i> {{ Auth::user()->first_name }} | {{ Auth::user()->penname ?? '' }}
                </a>
            </li>

            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                <a class="nav-link dropdown-toggle hide-arrow p-0" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                        @if (Auth::user()->profile_photo_path)
                            <img src="{{ asset('storage/' . Auth::user()->profile_photo_path) }}" alt
                                class="w-px-40 h-40 w-40 rounded-circle">
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
                                            <img src="{{ asset('storage/' . Auth::user()->profile_photo_path) }}" alt
                                                class="w-px-40 h-40 w-40 rounded-circle">
                                        @else
                                            <span class="avatar-initial rounded-circle bg-label-primary">
                                                {{ strtoupper(substr(Auth::user()->first_name, 0, 2)) }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-0">{{ Auth::user()->first_name }}
                                        {{ Auth::user()->last_name ?? '' }}</h6>
                                    <small class="text-muted">{{ Auth::user()->roles->first()->name ?? '' }}</small>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <div class="dropdown-divider my-1"></div>
                    </li>

                    {{-- @unless (Auth::user()->roles->first()->name == 'admin')
                        <li>
                            <a class="dropdown-item" href="javascript:void(0);">
                                <i class="mdi mdi-account-outline me-1 mdi-20px"></i>
                                <span class="align-middle">My Profile</span>
                            </a>
                        </li>
                    @endunless --}}

                    <li>
                        <a class="dropdown-item" href="{{ route('profile.index') }}">
                            <i class='mdi mdi-cog-outline me-1 mdi-20px'></i>
                            <span class="align-middle">Settings</span>
                        </a>
                    </li>
                    <li>
                        <div class="dropdown-divider my-1"></div>
                    </li>

                    <li>
                        <a class="dropdown-item" href="#"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
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
    @if (!isset($navbarDetached))
</div>
@endif
</nav>

@push('scripts')
    <script>
        function markAllNotificationsRead() {
            fetch("{{ route('notifications.markRead') }}", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    "Accept": "application/json"
                }
            }).then(res => {
                // Remove the badge
                const badge = document.querySelector('.badge');
                if (badge) badge.style.display = 'none';

                // Optional: remove unread styling from each dropdown item
                document.querySelectorAll('.dropdown-item').forEach(item => {
                    item.classList.remove('fw-bold'); // example
                });
            });
        }

        function markNotificationRead(notificationId) {
            fetch(`/notifications/${notificationId}/read`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                }
            }).then(res => {
                // Optional: remove the badge if no unread left
                const badge = document.querySelector('.badge');
                if (badge) {
                    let count = parseInt(badge.textContent);
                    count = Math.max(count - 1, 0);
                    badge.textContent = count;
                    if (count === 0) badge.style.display = 'none';
                }
            });
        }




    </script>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



@endpush
