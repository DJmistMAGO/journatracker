@extends('layouts/commonMaster')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/loader.css') }}">
@endpush

@section('layoutContent')
    {{-- loading animation --}}
    @include('_partials.loader')

    <nav class="layout-navbar navbar navbar-expand-xl align-items-center bg-navbar-theme" id="layout-navbar">
        <div class="container-xxl d-flex align-items-center justify-content-between">

            <!-- Brand -->
            <div class="app-brand demo d-flex align-items-center">
            <a href="#" class="app-brand-link gap-2">
                <img src="{{ asset('assets/img/spj/schl_logo.png') }}" alt="School Logo" height="40" class="ms-2">
                <img src="{{ asset('assets/img/spj/spj_logo.png') }}" alt="SPJ Logo" height="35" class="me-2">
                <span class="app-brand-text fw-bold ms-1">SPJ</span>
            </a>
            </div>

            <!-- Nav Links -->
            {{-- <div class="collapse navbar-collapse" id="navbar-collapse">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item"><a class="nav-link fw-semibold" href="#">Home</a></li>
                <li class="nav-item"><a class="nav-link fw-semibold" href="#">Categories</a></li>
                <li class="nav-item"><a class="nav-link fw-semibold" href="#">About</a></li>
                <li class="nav-item"><a class="nav-link fw-semibold" href="#">Contact</a></li>
            </ul>
            </div> --}}

            <!-- Right Section -->
            <ul class="navbar-nav flex-row align-items-center ms-auto">
            <!-- Login -->
            <li class="nav-item me-3">
                <a class="nav-link d-flex align-items-center" href="{{ url('auth/login-basic') }}">
                <i class="ti ti-user me-1"></i> Login
                </a>
            </li>
            <!-- Search -->
            <li class="nav-item">
                <a class="nav-link d-flex align-items-center" href="#">
                <i class="ti ti-search"></i>
                </a>
            </li>
            </ul>

        </div>
    </nav>

    <!-- Hero Section -->
    <section class="container my-5">
        <div class="card border-0 shadow-sm">
            <img src="https://picsum.photos/1200/400" class="card-img-top rounded-3" alt="Hero Image">
            <div class="card-body py-4 px-4">
            <h1 class="display-4 fw-bold mb-3">The Future of Green Technology</h1>
            <p class="lead text-muted mb-4">How innovations in renewable energy are reshaping the world we live in.</p>
            <div class="d-flex align-items-center mb-4">
                <img src="https://picsum.photos/50" alt="Author" class="rounded-circle me-2" width="40" />
                <small class="text-muted">By Jane Doe • Sept 8, 2025</small>
            </div>
            <a href="#content" class="btn btn-primary">Continue Reading</a>
            </div>
        </div>
    </section>

    <!-- Main Content + Sidebar -->
    <main class="container mb-5" id="content">
        <div class="row">
            <article class="col-lg-8">
            <h2 class="fw-bold">Why Green Technology Matters</h2>
            <p>
                As climate change accelerates, the need for sustainable solutions has never been greater. Green
                technology is no longer just a buzzword—it’s a global movement. From solar energy to electric vehicles,
                the innovations emerging today will define the quality of life for future generations.
            </p>

            <blockquote class="blockquote px-3 py-2 bg-light border-start">
                “Investing in renewable energy is not just about the planet, it’s about creating sustainable
                opportunities for the future.”
            </blockquote>

            <h3 class="fw-bold mt-4">Solar Energy: Powering Homes and Cities</h3>
            <p>
                One of the most impactful innovations in green technology is solar energy. Modern photovoltaic panels
                are more efficient and cost-effective than ever before. Cities across the globe are integrating solar
                farms to reduce dependency on fossil fuels.
            </p>
            <figure class="figure">
                <img src="https://picsum.photos/800/400" class="figure-img img-fluid rounded"
                    alt="Solar panels in the field" />
                <figcaption class="figure-caption text-muted">Solar panels in a sustainable energy farm.</figcaption>
            </figure>

            <h3 class="fw-bold mt-4">Electric Vehicles on the Rise</h3>
            <p>
                Transportation is one of the largest contributors to global emissions. The rise of electric vehicles
                (EVs) is a direct response to this challenge. Companies like Tesla, Rivian, and even traditional automakers
                are investing heavily in EV technology.
            </p>

            <figure class="figure">
                <img src="https://picsum.photos/900/400" class="figure-img img-fluid rounded"
                    alt="Electric car charging" />
                <figcaption class="figure-caption text-muted">An electric car charging at a city station.</figcaption>
            </figure>

            <p>
                With charging infrastructure expanding rapidly, EVs are becoming a viable choice for everyday drivers.
                Experts predict that by 2035, more than half of all vehicles sold will be electric.
            </p>
        </article>

        <!-- Sidebar -->
        <aside class="col-lg-4">
            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                <h5 class="fw-bold">Related Posts</h5>
                <ul class="list-unstyled mb-0">
                    <li><a href="#">10 Breakthroughs in Renewable Energy</a></li>
                    <li><a href="#">How Smart Cities Save Energy</a></li>
                    <li><a href="#">The Rise of Eco-Friendly Startups</a></li>
                </ul>
                </div>
            </div>

            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                <h5 class="fw-bold">Tags</h5>
                <span class="badge bg-label-secondary me-1">Technology</span>
                <span class="badge bg-label-secondary me-1">Environment</span>
                <span class="badge bg-label-secondary me-1">Innovation</span>
                </div>
            </div>

            <div class="card mb-4 shadow-sm">
                <div class="card-body text-center">
                <h5 class="fw-bold">Share this</h5>
                <a href="#" class="me-2"><i class="ti ti-brand-facebook"></i></a>
                <a href="#" class="me-2"><i class="ti ti-brand-twitter"></i></a>
                <a href="#"><i class="ti ti-brand-linkedin"></i></a>
                </div>
            </div>

            <div class="card mb-4 shadow-sm">
                <div class="card-body text-center">
                <h5 class="fw-bold">Subscribe to our newsletter</h5>
                <form>
                    <input type="email" class="form-control mb-2" placeholder="Your email" />
                    <button type="submit" class="btn btn-primary w-100">Subscribe</button>
                </form>
                </div>
            </div>
        </aside>
        </div>
    </main>

    <!-- Footer -->
    @include('layouts.sections.footer.footer')

    @push('scripts')
        <script src="{{ asset('assets/js/loader.js') }}"></script>
    @endpush

@endsection
