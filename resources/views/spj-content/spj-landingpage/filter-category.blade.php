@extends('layouts/commonMaster')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/loader.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">


    <style>
        :root {
            --theme-color: #00A23F;
        }

        .btn-theme {
            background-color: var(--theme-color);
            border: none;
            color: #fff;
        }

        .btn-theme:hover {
            background-color: #008a36;
            color: #fff;
        }

        .btn-outline-theme {
            border: 1px solid var(--theme-color);
            color: var(--theme-color);
        }

        .btn-outline-theme:hover {
            background-color: var(--theme-color);
            color: #fff;
        }

        h2.section-title {
            border-left: 6px solid var(--theme-color);
            padding-left: 12px;
            color: #222;
        }

        .card {
            display: block;
            background-color: #fff;
            border-radius: 0.5rem;
            overflow: hidden;
        }

        .card .card-body {
            padding: 1rem;
        }

        .hero-img {
            height: 400px;
            width: 100%;
            object-fit: cover;
            display: block;
        }

        .card-img-top {
            height: 200px;
            width: 100%;
            object-fit: cover;
            display: block;
        }

        @media (max-width: 575.98px) {
            .hero-img {
                height: 220px;
            }

            .card-img-top {
                height: 140px;
            }
        }

        @media (min-width: 992px) {
            aside.col-lg-4 {
                position: sticky;
                top: 100px;
            }
        }


        .landing-page {
            background-image: linear-gradient(rgba(22, 97, 14, 0.8), rgba(124, 220, 113, 0.8)), url('{{ asset('assets/img/spj/snhsbg.jpg') }}');
            background-size: cover;
            background-attachment: fixed;
            background-repeat: no-repeat;
            background-position: center;
            "

        }

        .navtop {
            background-image: url('{{ asset('assets/img/spj/bgnav.jpg') }}');
            background-size: cover;
            background-attachment: fixed;
            background-repeat: no-repeat;
            background-position: center;
        }

        /*mobile responsive for novtop*/
    </style>
@endpush

@section('layoutContent')
    @include('_partials.loader')
	@include('layouts.sections.navbar.public-navbar')
        <main class="container-xxl my-5">
            <div class="row g-5">
                <article class="col-lg-8">
                    <h2 class="mt-0 mb-3 text-white">{{ $category }}</h2>
                    <div class="row g-4">
						@foreach ($items as $item)
						<div class="col-md-6">
                            <div class="card shadow-sm h-100 border-0">
                                <img src="{{ asset('/storage/' . $item->image_path) }}" class="card-img-top" alt="{{ $item->title }}">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $item->title }}</h5>
									<small class="text-muted">Published on {{ $item->date_publish->format('F j, Y') }}</small>
                                    <p class="card-text">{{ \Illuminate\Support\Str::words($item->description, 15, '...') }}</p>
                                    <a href="{{ route('article.read', [$item->type, $item->id]) }}" class="btn btn-outline-theme btn-sm">Read More</a>
                                </div>
                            </div>
                        </div>
						@endforeach
                    </div>
                </article>

                <!-- Sidebar -->
                <aside class="col-lg-4">
                    <!-- Related Articles -->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body">
                            <h5 class="fw-bold mb-3" style="color: var(--theme-color)">Top Articles</h5>
                            <ul class="list-unstyled">
                                <li><a href="#" class="text-black">Sustainable Homes of the Future</a></li>
                                <li><a href="#" class="text-black">Electric Cars: Beyond 2030</a></li>
                                <li><a href="#" class="text-black">How Schools Go Green</a></li>
                            </ul>
                        </div>
                    </div>

                    <!-- Popular Tags -->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body">
                            <h5 class="fw-bold mb-3" style="color: var(--theme-color)">Popular Tags</h5>
                            <span class="badge bg-secondary me-1">GreenTech</span>
                            <span class="badge bg-secondary me-1">Renewable</span>
                            <span class="badge bg-secondary me-1">Sustainability</span>
                            <span class="badge bg-secondary me-1">Climate</span>
                        </div>
                    </div>

                    <!-- Share Buttons -->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body text-center">
                            <h5 class="fw-bold mb-3" style="color: var(--theme-color)">Share This</h5>
                            <a href="#" class="btn btn-outline-theme btn-sm me-2"><i
                                    class="ti ti-brand-facebook"></i></a>
                            <a href="#" class="btn btn-outline-theme btn-sm me-2"><i
                                    class="ti ti-brand-twitter"></i></a>
                            <a href="#" class="btn btn-outline-theme btn-sm"><i
                                    class="ti ti-brand-linkedin"></i></a>
                        </div>
                    </div>

                </aside>
            </div>
        </main>

        @include('layouts.sections.footer.footer')

        @push('scripts')
            <script src="{{ asset('assets/js/loader.js') }}"></script>
            <script src="{{ asset('assets/js/updateTime.js') }}"></script>

            </script>
        </div>
    @endpush
@endsection
