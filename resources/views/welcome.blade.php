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
	<div class="landing-page text-white">
		{{-- <div class="container">
			<h1 class="display-4 text-primary fw-bold">Welcome to the Student Press Journal</h1>
			<p class="lead mb-4 text-black">Your source for student journalism, media, and creative works.  </p>
			<a href="#latestArticles" class="btn btn-theme btn-lg rounded-pill px-4 py-2">Explore Articles</a>
		</div> --}}
		<main class="container-xxl my-5">
			@php
				$featured = $items->first();
			@endphp
			<div class="row g-5">
				<article class="col-lg-8">
					@if($featured)
					<div class="card w-100 shadow-sm border-0 rounded-4 overflow-hidden">
						{{-- Featured image --}}
						<div class="position-relative">
							<img src="{{ $featured->image_path ? asset('storage/' . $featured->image_path) : 'https://picsum.photos/600/400' }}"
								class="card-img-top"
								alt="{{ $featured->title }}"
								style="height: 250px; object-fit: cover;"
								onerror="this.onerror=null;this.src='https://picsum.photos/600/400';">

							{{-- Optional overlay for effect --}}
							<div class="position-absolute top-0 start-0 w-100 h-100 bg-gradient-to-bottom opacity-25"></div>
						</div>

						{{-- Card body --}}
						@php
							$author = $featured->user;
							$initials = strtoupper(substr($author->name, 0, 2));
						@endphp
						<div class="card-body px-3 py-3">
							{{-- Title --}}
							<h3 class="card-title fw-bold mb-3" style="font-size: 1.5rem;">
								<a href="{{ route('article.read', [$featured->type, $featured->id]) }}"
								class="text-dark text-decoration-none hover-underline">
								{{ $featured->title }}
								</a>
							</h3>

							{{-- Author info --}}
							<div class="d-flex align-items-center mb-3">
								@if($author->profile_photo_path)
									<img src="{{ asset('storage/' . $author->profile_photo_path) }}"
										alt="Author"
										class="rounded-circle me-2"
										width="40"
										height="40">
								@else
									<div class="rounded-circle bg-success text-white d-flex align-items-center justify-content-center me-2"
										style="width: 40px; height: 40px; font-weight: 600;">
										{{ $initials }}
									</div>
								@endif
								<div class="small text-muted">
									By {{ $featured->author->name ?? 'Unknown' }} •
									{{ $featured->date_publish->format('M d, Y') }}
								</div>
							</div>

							<div class="d-flex align-items-center justify-content-between mt-3">
								<a href="{{ route('article.read', [$featured->type, $featured->id]) }}"
									class="btn btn-success btn-sm rounded-pill px-3 py-1 shadow-sm d-flex align-items-center">
									<i class="mdi mdi-book-open-variant me-2"></i>
									Read More
								</a>

								<div class="d-flex align-items-center text-muted">
									<i class="mdi mdi-eye-outline me-1"></i>
									<span>{{ $featured->publication->views ?? 0 }}</span>
								</div>
							</div>
						</div>
					</div>

					@endif

					<h2 class="mt-5 mb-3 text-white" id="latestArticles">Latest Articles</h2>
					<div class="row g-4">
						@foreach($items->skip(1) as $item)
							<div class="col-md-6">
								<div class="card shadow-sm border-0 rounded-4 overflow-hidden h-100 hover-shadow" style="transition: transform 0.2s;">

									{{-- Uniform Media Container --}}
									<div class="position-relative" style="height: 250px; overflow: hidden;">
										@if($item->type === 'Article')
											{{-- Article Image --}}
											<img src="{{ $item->image_path ? asset('storage/' . $item->image_path) : 'https://picsum.photos/600/400' }}"
												class="w-100 h-100"
												style="object-fit: cover;"
												alt="{{ $item->title }}"
												onerror="this.onerror=null;this.src='https://picsum.photos/600/400';">
										@elseif($item->type === 'Media')
											{{-- Photojournalism / Cartooning --}}
											@if(in_array($item->category, ['Photojournalism', 'Cartooning']))
												<img src="{{ $item->image_path ? asset('storage/' . $item->image_path) : 'https://picsum.photos/600/400' }}"
													class="w-100 h-100"
													style="object-fit: cover;"
													alt="{{ $item->title }}"
													onerror="this.onerror=null;this.src='https://picsum.photos/600/400';">
											@endif

											{{-- TV / Radio --}}
											@if(in_array($item->category, ['TV Broadcasting', 'Radio Broadcasting']) && $item->link)
												<iframe src="{{ $item->link }}"
														style="width: 100%; height: 100%; border:0; position: absolute; top:0; left:0;"
														allowfullscreen
														allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share">
												</iframe>
											@endif
										@endif

										{{-- Gradient Overlay --}}
										<div class="position-absolute top-0 start-0 w-100 h-100 bg-gradient-to-bottom opacity-25"></div>
									</div>

									{{-- Card Body --}}
									@php
										$author = $item->user;
										$initials = strtoupper(substr($author->name ?? 'U', 0, 2));
									@endphp
									<div class="card-body px-3 py-3 d-flex flex-column">

										{{-- Title --}}
										<h5 class="card-title fw-bold mb-2">
											<a href="{{ route('article.read', [$item->type, $item->id]) }}"
											class="text-dark text-decoration-none hover-underline">
											{{ $item->title }}
											</a>
										</h5>

										{{-- Author Info --}}
										<div class="d-flex align-items-center mb-3">
											@if($author && $author->profile_photo_path)
												<img src="{{ asset('storage/' . $author->profile_photo_path) }}"
													alt="Author"
													class="rounded-circle me-2"
													width="36"
													height="36">
											@else
												<div class="rounded-circle bg-success text-white d-flex align-items-center justify-content-center me-2"
													style="width: 36px; height: 36px; font-weight: 600;">
													{{ $initials }}
												</div>
											@endif
											<div class="small text-muted">
												By {{ $author->name ?? 'Unknown' }} • {{ $item->date_publish->format('M d, Y') }}
											</div>
										</div>

										{{-- Excerpt --}}
										<p class="card-text mb-3">{{ Str::limit($item->content, 100) }}</p>

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
						@endforeach
					</div>



					{{-- Hover lift effect --}}
					<style>
					.hover-shadow:hover {
						transform: translateY(-5px);
						box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.15) !important;
					}
					.hover-underline:hover {
						text-decoration: underline;
					}
					</style>


				</article>

				<!-- Sidebar -->
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

        </script>
    @endpush
@endsection
