@extends('layouts/contentNavbarLayout')

@section('title', 'SPJ | View Article')

@section('content')
<h4 class="py-3 mb-4">
    <span class="text-muted fw-light">SPJ / Article Management /</span> View Article
</h4>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">{{ $article->title }}</h5>
        <a href="{{ route('article-management') }}" class="btn btn-primary btn-sm">
            <i class="mdi mdi-arrow-left me-1"></i> Back to List
        </a>
    </div>

    <div class="card-body">
        <!-- Author, Date, Status, Category -->
        <!-- Image -->
        @if($article->image_path)
            <div class="mb-3 text-center">
                <img src="{{ asset('/storage/' . $article->image_path) }}" alt="Image" class="img-fluid rounded" style="max-height: 300px;">
            </div>
        @endif
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


        <!-- Content -->
        <div class="mb-3">
            <h6>Content:</h6>
            <p>{!! nl2br(e($article->description)) !!}</p>
        </div>

        <!-- Tags -->
        @if(!empty($article->tags))
            <div class="mb-3">
                <h6>Tags:</h6>
                @foreach($article->tags as $tag)
                    <span class="badge bg-secondary me-1 mb-1">{{ $tag }}</span>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection
