@extends('layouts/contentNavbarLayout')

@section('title', 'SPJ | Publication Management')

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/masonry/masonry.js') }}"></script>
@endsection

@section('content')
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">SPJ / Publication Management /</span> View Item</h4>

    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div class="card-title">
                <h4 class="mb-0">{{ $item['title'] }}</h4>
            </div>
            <div class="back-button">
                <a href="{{ route('publication-management.index') }}" class="btn btn-primary btn-sm">
                    <i class="mdi mdi-arrow-left me-1"></i> Back to List
                </a>
            </div>
        </div>

        <div class="card-body">
            <p><strong>Type:</strong> {{ $item['type'] }}</p>
            <p><strong>Author:</strong> {{ $item['author'] }}</p>
            <p><strong>Date:</strong> {{ $item['date'] }}</p>
            <p><strong>Status:</strong> {{ $item['status'] }}</p>

            {{-- Article specific fields --}}
            @if($type === 'article')
                <p><strong>Category:</strong> {{ $item['category'] ?? 'N/A' }}</p>
                <p><strong>Thumbnail:</strong></p>
                @if($item['thumbnail'])
                    <img src="{{ asset('storage/' . $item['thumbnail']) }}" alt="Thumbnail" class="img-fluid mb-3" style="max-height: 250px;">
                @endif
                <p><strong>Content:</strong></p>
                <div class="border p-2 mb-3">{!! nl2br(e($item['content'])) !!}</div>
            @endif

            {{-- Media specific fields --}}
            @if($type === 'media')
                <p><strong>Media Type:</strong> {{ ucfirst(str_replace('_', ' ', $item['media_type'])) }}</p>

                @if(in_array($item['media_type'], ['photojournalism', 'cartooning']))
                    <p><strong>Image:</strong></p>
                    @if($item['image_path'])
                        <img src="{{ asset('storage/' . $item['image_path']) }}" alt="Media Image" class="img-fluid mb-3" style="max-height: 250px;">
                    @endif
                @else
                    <p><strong>Link:</strong></p>
                    @if($item['link'])
                        <iframe src="{{ $item['link'] }}" frameborder="0" allowfullscreen class="w-100" style="height: 400px;"></iframe>
                    @endif
                @endif
                <p><strong>Description:</strong> {{ $item['description'] ?? 'No description provided.' }}</p>
            @endif
			<p><strong>Tags:</strong>
                    @if(!empty($item['tags']))
                        @foreach($item['tags'] as $tag)
                            <span class="badge bg-secondary me-1 mb-1">{{ $tag }}</span>
                        @endforeach
                    @else
                        None
                    @endif
                </p>
        </div>
    </div>
@endsection
