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

        /*mobile responsive for novtop*/
    </style>
@endpush

@section('layoutContent')
    @include('_partials.loader')
    @include('layouts.sections.navbar.public-navbar')
    <div class="landing-page">
        <main class="container-xxl my-5">
            <div class="row g-5">
                <article class="col-lg-8">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <!-- Article Header -->
                            <header class="mb-4">
                                <h1 class="fw-bold">{{ $item->title }}</h1>
                                @php
                                    $author = $item->user;
                                    $initials = strtoupper(substr($author->name, 0, 2));
                                @endphp
                                <div class="d-flex align-items-center mb-3">
                                    @if ($author->profile_photo_path)
                                        <img src="{{ asset('storage/' . $author->profile_photo_path) }}" alt="Author"
                                            class="rounded-circle me-2" width="40" height="40">
                                    @else
                                        <div class="rounded-circle bg-success text-white d-flex align-items-center justify-content-center me-2"
                                            style="width: 40px; height: 40px; font-weight: 600;">
                                            {{ $initials }}
                                        </div>
                                    @endif
                                    <div class="text-muted small">
                                        Published on {{ $item->date_publish->format('F j, Y   h:i A') }}
                                        by <span class="fw-semibold">{{ $item->user->penname ?? $item->user->name }}</span>
                                    </div>
                                </div>
                            </header>

                            <!-- Article Image / Link / Video -->
                            @if ($item->type === 'Article')
                                <figure class="mb-4 text-center">
                                    <img src="{{ asset('/storage/' . $item->image_path) }}" alt="Article Image"
                                        class="img-fluid rounded shadow-sm">
                                </figure>
                            @elseif ($item->type === 'Media')
                                {{-- Show image if Photojournalism or Cartooning --}}
                                @if (in_array($item->category, ['Photojournalism', 'Cartooning']))
                                    @if ($item->image_path)
                                        <div class="text-center my-3">
                                            <img src="{{ asset('storage/' . $item->image_path) }}"
                                                alt="{{ $item->title }}" class="img-fluid rounded shadow-sm"
                                                style="max-height: 400px;">
                                        </div>
                                    @else
                                        <p class="text-center">No image available.</p>
                                    @endif
                                @endif

                                {{-- Show iframe if TV or Radio Broadcasting --}}
                                @if (in_array($item->category, ['TV Broadcasting', 'Radio Broadcasting']))
                                    @if ($item->link)
                                        <div class="ratio ratio-16x9 my-3">
                                            <iframe src="{{ $item->link }}" width="560" height="314"
                                                style="border:none;overflow:hidden" scrolling="no" frameborder="0"
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

                            <!-- Back Button with publication views count -->
                            <div class="d-flex justify-content-between align-items-center">
                                <a href="{{ url()->previous() }}" class="btn btn-outline-theme">
                                    <i class="ti ti-arrow-left me-1"></i> Back
                                </a>
                                <span class="text-muted">
                                    <i class="ti ti-eye me-1"></i> {{ $item->publication->views ?? 0 }}
                                    {{ ($item->publication->views ?? 0) == 1 ? 'view' : 'views' }}
                                </span>
                            </div>
                        </div>
                    </div>

                </article>
				<aside class="col-lg-4">
					<div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <h5 class="fw-bold mb-3" style="color: var(--theme-color)">Report A Problem</h5>
            <form action="{{ route('incident-report.store-report') }}" method="POST" enctype="multipart/form-data" onsubmit="prepareTags()">
                @csrf
                @include('_partials.errors')
                @include('_partials.success')

                <div class="mb-2">
                    <label class="form-label">Name of Reporter</label>
                    <input type="text" class="form-control" name="student_name" placeholder="Name of Reporter" />
                </div>

                <div class="mb-2">
                    <label class="form-label">Upload Your Student I.D.</label>
                    <input class="form-control" type="file" name="student_id_image">
                </div>

                <div class="mb-2">
                    <label class="form-label">Incident Description</label>
                    <textarea class="form-control h-px-75" name="incident_description" placeholder="Type here..."></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Upload Proof of the Incident</label>
                    <input class="form-control" type="file" name="image_proof">
                </div>

                <button type="submit" class="btn btn-theme w-100">Submit Report</button>
            </form>
        </div>
    </div>

    {{-- Share Buttons --}}
    <div class="card border-0 shadow-sm mb-4 text-center p-3">
        <div class="card-body">
            <h5 class="fw-bold mb-3" style="color: var(--theme-color)">Share This</h5>
            <div class="d-flex justify-content-center gap-2">
                <a href="#" class="btn btn-outline-theme btn-icon btn-sm rounded-circle p-2"
                   onmouseover="this.style.backgroundColor='var(--theme-color)'; this.style.color='#fff';"
                   onmouseout="this.style.backgroundColor='transparent'; this.style.color='var(--theme-color)';">
                    <i class="mdi mdi-facebook"></i>
                </a>
                <a href="#" class="btn btn-outline-theme btn-icon btn-sm rounded-circle p-2"
                   onmouseover="this.style.backgroundColor='var(--theme-color)'; this.style.color='#fff';"
                   onmouseout="this.style.backgroundColor='transparent'; this.style.color='var(--theme-color)';">
                    <i class="mdi mdi-twitter"></i>
                </a>
                <a href="#" class="btn btn-outline-theme btn-icon btn-sm rounded-circle p-2"
                   onmouseover="this.style.backgroundColor='var(--theme-color)'; this.style.color='#fff';"
                   onmouseout="this.style.backgroundColor='transparent'; this.style.color='var(--theme-color)';">
                    <i class="mdi mdi-linkedin"></i>
                </a>
            </div>
        </div>
				</aside>
            </div>
    </div>
    </main>
    </div>

    @include('layouts.sections.footer.footer')

    @push('scripts')
        <script src="{{ asset('assets/js/loader.js') }}"></script>
        <script src="{{ asset('assets/js/updateTime.js') }}"></script>

        </script>
        </div>
    @endpush
@endsection
