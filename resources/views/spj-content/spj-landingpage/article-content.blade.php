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
            <article class="col-lg-8 mx-auto">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <!-- Article Header -->
                        <header class="mb-4">
                            <h1 class="fw-bold">{{ $item->title }}</h1>
                            <div class="text-muted small">
                                Published on {{ $item->date_publish->format('F j, Y') }}
                                by <span class="fw-semibold">{{ $item->user->penname ?? $item->user->name }}</span>
                            </div>
                        </header>

                        <!-- Article Image / Link / Video -->
@if ($item->type === 'Article')
    <figure class="mb-4 text-center">
        <img src="{{ asset('/storage/' . $item->image_path) }}" alt="Future of Technology"
            class="img-fluid rounded shadow-sm">
    </figure>

@elseif ($item->type === 'Media')

    {{-- Show image if Photojournalism or Cartooning --}}
    @if (in_array($item->category, ['Photojournalism', 'Cartooning']))
        @if ($item->image_path)
            <div class="text-center my-3">
                <img src="{{ asset('storage/' . $item->image_path) }}" alt="{{ $item->title }}"
                    class="img-fluid rounded shadow-sm" style="max-height: 400px;">
            </div>
        @else
            <p class="text-center">No image available.</p>
        @endif
    @endif

    {{-- Show iframe if TV or Radio Broadcasting --}}
    @if (in_array($item->category, ['TV Broadcasting', 'Radio Broadcasting']))
        @if ($item->link)
            <div class="ratio ratio-16x9 my-3">
                <iframe src="{{ $item->link }}"
                    width="560" height="314"
                    style="border:none;overflow:hidden"
                    scrolling="no"
                    frameborder="0"
                    allowfullscreen="true"
                    allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share">
                </iframe>
            </div>
        @endif
    @endif

@endif




                        <!-- Article Content -->
                        <section class="article-body mb-5">
                            {{ $item->description }}
                        </section>

                        <!-- Tags Section -->
                        <div class="mb-4">
                            <strong>Tags: </strong>
                            @php
                                $tags = is_array($item->tags) ? $item->tags : json_decode($item->tags, true);
                            @endphp

                            @if (!empty($tags))
                                @foreach ($tags as $tag)
                                    <span class="badge bg-primary me-1 mb-1">{{ $tag }}</span>
                                @endforeach
                            @else
                                None
                            @endif
                        </div>

                        {{-- <!-- Back Button -->
                        <footer class="mt-4">
                            <a href="#" class="btn btn-outline-secondary">
                                ← Back to Articles
                            </a>
                        </footer> --}}
                    </div>
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
                        <a href="#" class="btn btn-outline-theme btn-sm me-2"><i class="ti ti-brand-facebook"></i></a>
                        <a href="#" class="btn btn-outline-theme btn-sm me-2"><i class="ti ti-brand-twitter"></i></a>
                        <a href="#" class="btn btn-outline-theme btn-sm"><i class="ti ti-brand-linkedin"></i></a>
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
