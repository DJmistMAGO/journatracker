@extends('layouts/contentNavbarLayout')

@section('title', 'SPJ | View Article')

@section('content')
    <h4 class="py-3 mb-4">
        <span class="text-muted fw-light">SPJ / Article Management /</span> View Article
    </h4>

    <div class="card mb-4">
        <div class="card-body pb-0">
            <a href="{{ route('article-management') }}" class="btn btn-primary btn-sm mb-3">
                <i class="mdi mdi-arrow-left me-1"></i> Back
            </a>
        </div>

        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">{{ $article->title }}</h5>
        </div>

        <div class="card-body">
            <!-- Article Image -->
            @if ($article->image_path)
                <div class="mb-3 text-center">
                    <img src="{{ asset('/storage/' . $article->image_path) }}" alt="Image" class="img-fluid rounded"
                        style="max-height: 300px;">
                </div>
            @endif

            <!-- Article Meta Information -->
            <div class="mb-3">
                <p><strong>Author:</strong> {{ $article->user->name ?? 'Unknown' }}</p>
                <p><strong>Date Written:</strong> {{ $article->date_submitted->format('F d, Y') }}</p>
                <p><strong>Status:</strong>
                    <span class="badge {{ $article->status == 'Published' ? 'bg-label-success' : 'bg-label-secondary' }}">
                        {{ ucfirst($article->status) }}
                    </span>
                </p>
                <p><strong>Category:</strong> {{ $article->category }}</p>
            </div>

            <!-- Article Content (Rich Text) -->
            <div class="mb-3">
                <h6>Content:</h6>
                <div class="trix-content">
                    {!! $article->description !!}
                </div>
            </div>

            <!-- Tags -->
            @if (!empty($article->tags))
                <div class="mb-3">
                    <h6>Tags:</h6>
                    @foreach ($article->tags as $tag)
                        <span class="badge bg-secondary me-1 mb-1">{{ $tag }}</span>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    <style>
        /* Style the rich text content */
        .trix-content {
            padding: 1rem;
            background-color: #f8f9fa;
            border-radius: 0.375rem;
            line-height: 1.8;
        }

        /* Typography styles for rich text */
        .trix-content h1 {
            font-size: 2rem;
            font-weight: 600;
            margin-top: 1rem;
            margin-bottom: 0.75rem;
        }

        .trix-content h2 {
            font-size: 1.5rem;
            font-weight: 600;
            margin-top: 0.75rem;
            margin-bottom: 0.5rem;
        }

        .trix-content p {
            margin-bottom: 1rem;
        }

        .trix-content ul,
        .trix-content ol {
            margin-left: 1.5rem;
            margin-bottom: 1rem;
        }

        .trix-content blockquote {
            border-left: 4px solid #696cff;
            padding-left: 1rem;
            margin: 1rem 0;
            font-style: italic;
            color: #666;
        }

        .trix-content pre {
            background-color: #2d2d2d;
            color: #f8f8f2;
            padding: 1rem;
            border-radius: 0.375rem;
            overflow-x: auto;
            margin-bottom: 1rem;
        }

        .trix-content code {
            background-color: #f4f4f4;
            padding: 0.2rem 0.4rem;
            border-radius: 0.25rem;
            font-family: 'Courier New', monospace;
        }

        .trix-content a {
            color: #696cff;
            text-decoration: underline;
        }

        .trix-content a:hover {
            color: #5a5fc7;
        }

        .trix-content strong {
            font-weight: 600;
        }

        .trix-content em {
            font-style: italic;
        }
    </style>
@endsection
