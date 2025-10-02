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

		@php
			$featured = $articles->first();
		@endphp
        <div class="row g-5">
            <article class="col-lg-8">
                @if($featured)
					<div class="card w-100">
						<img src="{{ $featured->image_path
						? asset('storage/' . $featured->image_path)
						: 'https://picsum.photos/600/400' }}"
						class="card-img-top h-20"
						alt="{{ $featured->title }}"
						style="height: 250px;"
						onerror="this.onerror=null;this.src='https://picsum.photos/600/400';">

							@php
								$author = $featured->user;
								$initials = strtoupper(substr($author->name, 0, 2)); // first 2 letters
							@endphp
						<div class="card-body">
							<h1 class="fw-bold display-6 mb-2">
								<a href="
									{{ route('articles.show', $featured->id) }}">
									{{ $featured->title }}
								</a>

							<div class="d-flex align-items-center mb-2">
								@if($author->profile_photo_path)
									<img src="{{ asset('storage/' . $author->profile_photo_path) }}"
										alt="Author" class="rounded-circle me-2" width="40" height="40">
								@else
									<div class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center me-2"
										style="width: 40px; height: 40px; font-weight: bold;">
										{{ $initials }}
									</div>
								@endif
								<small class="text-muted">By {{ $featured->author->name ?? 'Unknown' }} •
									{{ $featured->date_publish->format('M d, Y') }}
								</small>
							</div>
						</div>
					</div>
				@endif

                <h2 class="mt-5 mb-3 text-white">Latest Articles</h2>
				<div class="row g-4">
					@foreach($articles->skip(1) as $article)
						<div class="col-md-6">
							<div class="card shadow-sm h-100 border-0">
								<img src="{{ 'storage/' . $article->image_path ?? 'https://picsum.photos/600/400' }}"
									class="card-img-top" alt="{{ $article->title }}">
								<div class="card-body">
									<h5 class="card-title">{{ $article->title }}</h5>
									<p class="card-text">{{ Str::limit($article->content, 100) }}</p>
									<a href="{{ route('articles.show', $article->id) }}" class="btn btn-outline-theme btn-sm">Read More</a>
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
						<ul class="list-styled">
							@foreach($articles->take(5) as $article)
								<li>
									<a href="{{ route('articles.show', $article->id) }}" class="text-black">
										{{ $article->title }}
									</a>
								</li>
							@endforeach
						</ul>
                    </div>
                </div>

                <!-- Popular Tags -->
                <div class="card border-0 shadow-sm mb-4">
					<div class="card-body">
						<h5 class="fw-bold mb-3" style="color: var(--theme-color)">Popular Tags</h5>
						@forelse($tags as $tag)
							<span class="badge bg-secondary me-1">{{ $tag }}</span>
						@empty
							<small class="text-muted">No tags yet</small>
						@endforelse
					</div>
				</div>




                <!-- Incident Report -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body ">
                        <h5 class="fw-bold mb-3" style="color: var(--theme-color)">Incident Report</h5>
                        <form action="{{ route('incident-report.store-report') }}" method="POST" enctype="multipart/form-data"
                            onsubmit="prepareTags()">
                            @csrf
                            @include('_partials.errors')
							 @include('_partials.success')
                            <div class="mb-2">
                                <label for="formFile" class="form-label">Name of Reporter</label>
                                <input type="text" class="form-control mb-2" name="student_name" placeholder="Name of Reporter" />
                            </div>
                            <div class="mb-2">
                                <label for="formFile" class="form-label">Upload Your Student I.D.</label>
                                <input class="form-control" type="file" id="formFile" name="student_id_image">
                            </div>
                            <div class="mb-2">
                                <label for="formFile" class="form-label">Incident Description</label>
                                <textarea class="form-control h-px-75" aria-label="With textarea" name="incident_description" placeholder="Type here..."></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Upload Proof of the Incident</label>
                                <input class="form-control" type="file" id="formFile" name="image_proof">
                            </div>

                            <button type="submit" class="btn btn-theme w-100">Submit Report</button>
                        </form>
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
