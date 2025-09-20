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
                        <i class="mdi mdi-arrow-left me-1"></i> Back to List
                    </a>
                </div>
            </div>

					<div class="card-body">
						<p><strong>Type:</strong> {{ ucfirst(str_replace('_', ' ', $media->type)) }}</p>
						<p><strong>Description:</strong> {{ $media->description ?? 'No description provided.' }}</p>

						<p><strong>Date:</strong> {{ \Carbon\Carbon::parse($media->date)->format('M d, Y') }}</p>

						<!-- Tags -->
						@if (!empty($media->tags))
							<div class="mb-3">
								<p><strong>Tags:</strong>
									@foreach ($media->tags as $tag)
										<span class="badge bg-secondary me-1 mb-1">{{ $tag }}</span>
									@endforeach
							</div>
						@endif

						{{-- Show image if type is photojournalism or cartooning --}}
						@if (in_array($media->type, ['photojournalism', 'cartooning']))
							@if ($media->image_path)
								<div class="text-center my-3">
									<img src="{{ asset('storage/' . $media->image_path) }}" alt="{{ $media->title }}"
										class="img-fluid rounded shadow-sm" style="max-height: 400px;">
								</div>
							@endif
						@endif

						{{-- Show iframe if type is tv or radio broadcasting --}}
						@if (in_array($media->type, ['tv_broadcasting', 'radio_broadcasting']))
							@if ($media->link)
								<div class="ratio ratio-16x9 my-3">
									<iframe src="{{ $media->link }}" frameborder="0" allowfullscreen></iframe>
								</div>
							@endif
						@endif
					</div>
					
        </div>
    </div>
    </div>
@endsection
