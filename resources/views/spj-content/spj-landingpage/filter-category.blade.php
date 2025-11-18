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

        .card-body {
            padding: 1rem;
        }

        .card-img-top {
            height: 200px;
            width: 100%;
            object-fit: cover;
            display: block;
        }

        @media (max-width: 575.98px) {
            .card-img-top {
                height: 140px;
            }
        }

        aside.col-lg-4 {
            position: sticky;
            top: 100px;
        }

        .hover-shadow:hover {
            transform: translateY(-5px);
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
        }

        .hover-underline:hover {
            text-decoration: underline;
        }

        .landing-page {
            background-image: linear-gradient(rgba(255, 255, 255, 0.597), rgba(14, 60, 10, 0.864)), url('{{ asset('assets/img/spj/snhsbg.jpg') }}');
            background-size: cover;
            background-attachment: fixed;
            background-repeat: no-repeat;
            background-position: center;
            padding: 5px 0;

        }

        .navtop {
            background-image: url('{{ asset('assets/img/spj/bgnav.jpg') }}');
            background-size: cover;
            background-attachment: fixed;
            background-repeat: no-repeat;
            background-position: center;
        }

        .empty-library .mdi {
            font-size: 50px;
        }
    </style>
@endpush

@section('layoutContent')
    @include('_partials.loader')
    @include('layouts.sections.navbar.public-navbar')
    <div class="landing-page">
        {{-- <div class="container text-center text-white py-5">
		<h1 class="display-4 fw-bold">Category: {{ $category }}</h1>
		<p class="lead mb-4">Explore articles and media in the "{{ $category }}" category.</p>
	</div> --}}
        <main class="container-xxl my-5">
            <div class="row g-5">
                {{-- Main Content --}}
                <article class="col-lg-8">
                    <h2 class="section-title text-white mb-4">{{ $category }}</h2>

                    <div class="row g-4">
                        @forelse($items as $item)
                            <div class="col-md-6">
                                <div class="card shadow-sm border-0 rounded-4 overflow-hidden h-100 hover-shadow">

                                    {{-- Image or Video --}}
                                    @if (
                                        $item->type === 'Article' ||
                                            ($item->type === 'Media' && in_array($item->category, ['Photojournalism', 'Cartooning'])))
                                        <div class="overflow-hidden rounded shadow-sm" style="height: 200px;">
                                            <img src="{{ $item->image_path ? asset('storage/' . $item->image_path) : asset('assets/img/spj/no-image.jpg') }}"
                                                alt="{{ $item->title }}" class="w-100 h-100"
                                                style="object-fit: cover; object-position: center;"
                                                onerror="this.onerror=null;this.src='{{ asset('assets/img/spj/no-image.jpg') }}';">
                                        </div>
                                    @elseif ($item->type === 'Media' && in_array($item->category, ['TV Broadcasting', 'Radio Broadcasting']) && $item->link)
                                        <div class="ratio ratio-16x9">
                                            <iframe src="{{ $item->link }}" class="card-img-top"
                                                style="border:none;overflow:hidden" scrolling="no" frameborder="0"
                                                allowfullscreen
                                                allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share">
                                            </iframe>
                                        </div>
                                    @endif

                                    {{-- Card Body --}}
                                    @php
                                        $author = $item->user;
                                        $initials = strtoupper(substr($author->name ?? 'U', 0, 2));
                                    @endphp
                                    <div class="card-body d-flex flex-column px-3 py-3">

                                        {{-- Title --}}
                                        <h5 class="card-title fw-bold mb-2">
                                            <a href="{{ route('article.read', [$item->type, $item->id]) }}"
                                                class="text-dark text-decoration-none hover-underline">
                                                {{ $item->title }}
                                            </a>
                                        </h5>

                                        {{-- Author Info --}}
                                        <div class="d-flex align-items-center mb-2">
                                            @if ($author && $author->profile_photo_path)
                                                <img src="{{ asset('storage/' . $author->profile_photo_path) }}"
                                                    alt="Author" class="rounded-circle me-2" width="36"
                                                    height="36">
                                            @else
                                                <div class="rounded-circle bg-success text-white d-flex align-items-center justify-content-center me-2"
                                                    style="width: 36px; height: 36px; font-weight: 600;">
                                                    {{ $initials }}
                                                </div>
                                            @endif
                                            <div class="small text-muted">
                                                By {{ $author->name ?? 'Unknown' }} •
                                                {{ $item->date_publish->format('F j, Y') }}
                                            </div>
                                        </div>

                                        {{-- Excerpt --}}
                                        {{-- <p class="card-text mb-3">{!! \Illuminate\Support\Str::words($item->description, 15, '...') !!}</p> --}}

                                        {{-- Read More + Views --}}
                                        <div class="d-flex align-items-center justify-content-between mt-auto">
                                            <a href="{{ route('article.read', [$item->type, $item->id]) }}"
                                                class="btn btn-success btn-sm rounded-pill px-3 py-1 shadow-sm d-flex align-items-center">
                                                <i class="mdi mdi-book-open-variant me-2"></i>
                                                Read More
                                            </a>
                                            <div class="d-flex align-items-center text-muted">
                                                <i class="mdi mdi-eye-outline me-1"></i>
                                                <span>{{ $item->publication->views ?? 0 }}</span>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12 empty-library">
                                <div class="card shadow-sm border-0 text-center py-5">
                                    <div class="card-body">
                                        <i class="mdi mdi-library-outline text-primary icon-read-article"></i>
                                        <h5 class="mt-3">Empty Library</h5>
                                        <p class="text-muted">No content available at the moment.</p>
                                    </div>
                                </div>
                            </div>
                        @endforelse
                    </div>

                </article>

                {{-- Sidebar --}}
                <aside class="col-lg-4">
                    @include('_partials.sidebar')
                </aside>
            </div>
        </main>
    </div>

    @include('layouts.sections.footer.footer')

    @push('scripts')
        <script src="{{ asset('assets/js/loader.js') }}"></script>
        <script src="{{ asset('assets/js/updateTime.js') }}"></script>
    @endpush
@endsection
