@extends('layouts/contentNavbarLayout')

@section('title', 'View Media - ' . $media->title)

@section('content')
    <div class="container mt-4">
        <div class="card shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div class="card-title">
                    <h4 class="mb-0">{{ $media->title }}</h4>
                </div>
                <div class="back-button">
                    <a href="{{ route('media-management') }}" class="btn btn-primary btn-sm">
                        <i class="mdi mdi-arrow-left me-1"></i> Back
                    </a>
                </div>
            </div>

					<div class="card-body">
						<p><strong>Status:</strong> {{ ucfirst(str_replace('_', ' ', $media->status)) }}</p>
						<p><strong>Category:</strong> {{ ucfirst(str_replace('_', ' ', $media->category)) }}</p>
						<p><strong>Description:</strong> {!! $media->description ?? 'No description provided.' !!}</p>
						{{-- <div></div> --}}

						<p><strong>Date:</strong> {{ \Carbon\Carbon::parse($media->date_submitted)->format('M d, Y') }}</p>

						<!-- Tags -->
						@if (!empty($media->tags))
							@php
								$tags = is_string($media->tags) ? json_decode($media->tags, true) : $media->tags;
							@endphp

							<div class="mb-3">
								<p><strong>Tags:</strong>
									@foreach ($tags as $tag)
										<span class="badge bg-secondary me-1 mb-1">{{ $tag }}</span>
									@endforeach
								</p>
							</div>
						@endif

						{{-- Show image if type is photojournalism or cartooning --}}
						@if (in_array($media->category, ['Photojournalism', 'Cartooning']))
							@if ($media->image_path)
								<div class="text-center my-3">
									<img src="{{ asset('storage/' . $media->image_path) }}" alt="{{ $media->title }}"
										class="img-fluid rounded shadow-sm" style="max-height: 400px;">
								</div>
							@else
								<p>No image available.</p>
							@endif
						@endif

						{{-- Show iframe if type is tv or radio broadcasting --}}
						@if (in_array($media->category, ['TV Broadcasting', 'Radio Broadcasting']))
							@if ($media->link)
								<div class="ratio ratio-16x9 my-3">
									<iframe
										src="{{ $media->link }}"
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
					</div>
        	</div>
    	</div>
    </div>
@endsection
