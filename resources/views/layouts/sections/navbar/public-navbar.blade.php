@push('styles')
    <style>
        @media (max-width: 426px) {
            .navbar .app-brand .app-brand-text {
                font-size: 16px !important;
            }

            .navbar .app-brand img {
                height: 30px !important;
                margin: 0px 0px 0px 0px !important;
            }
        }

        @media (max-width: 426px) {
            .navbar .navbar-toggler {
                margin-right: auto;
                margin-left: 0;
            }

            .navbar .container-xxl {
                justify-content: flex-start !important;
            }
        }
    </style>
@endpush

<div class="landing-page">
    <div class="mb-4 sticky-top shadow-sm navtop">
        <nav class="layout-navbar navbar navbar-expand-xl align-items-center bg-navbar-theme" id="layout-navbar"
            style="backdrop-filter: none !important;">
            <div class="container-xxl d-flex align-items-center justify-content-center">
                <div class="app-brand demo d-flex align-items-center mt-3">
                    <a href="#" class="app-brand-link gap-2">
                        <img src="{{ asset('assets/img/spj/schl_logo.png') }}" alt="School Logo" height="50"
                            class="me-2">
                        <span class="app-brand-text display-5 fw-bold" style="color:#186309;">Special Program in
                            Journalism</span>
                        <img src="{{ asset('assets/img/spj/spj_logo.png') }}" alt="SPJ Logo"
                            height="45"class="ms-2 ">
                    </a>
                </div>
            </div>
        </nav>

        <nav class="navbar navbar-expand-xl mt-2">
            <div class="container-xxl d-flex align-items-center justify-content-center">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-ex-2">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbar-ex-2">
                    <div class="navbar-nav me-auto">
                        <a class="nav-item nav-link {{ Route::is('welcome') ? 'text-black' : '' }}" href="{{ route('welcome') }}">Home</a>
                        <a class="nav-item nav-link  {{ request()->route('category') === 'News' ? 'text-black' : '' }}" href="{{ route('category.view', ['category' => 'News']) }}">News</a>
                        <a class="nav-item nav-link  {{ request()->route('category') === 'Features' ? 'text-black' : '' }}" href="{{ route('category.view', ['category' => 'Features']) }}">Features</a>
                        <a class="nav-item nav-link  {{ request()->route('category') === 'Editorial' ? 'text-black' : '' }}" href="{{ route('category.view', ['category' => 'Editorial']) }}">Editorial</a>
                        <a class="nav-item nav-link  {{ request()->route('category') === 'Column' ? 'text-black' : '' }}" href="{{ route('category.view', ['category' => 'Column']) }}">Column</a>
                        <a class="nav-item nav-link  {{ request()->route('category') === 'Sci-Tech' ? 'text-black' : '' }}" href="{{ route('category.view', ['category' => 'Sci-Tech']) }}">Sci-Tech</a>
                        <ul class="navbar-nav me-auto">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Media</a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{ route('category.view', ['category' => 'Editorial Cartooning']) }}">Editorial Cartooning</a>
                                    <a class="dropdown-item" href="{{ route('category.view', ['category' => 'Photojournalism']) }}">Photojournalism</a>
                                    <a class="dropdown-item" href="{{ route('category.view', ['category' => 'Radio Broadcasting']) }}">Radio Broadcasting</a>
                                    <a class="dropdown-item" href="{{ route('category.view', ['category' => 'TV Broadcasting']) }}">TV Broadcasting</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <span class="navbar-text">
                        <div id="datetime" style="color: black;"></div>
					</span>
                </div>
            </div>
        </nav>
    </div>
</div>
