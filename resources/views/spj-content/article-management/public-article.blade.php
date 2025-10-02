@extends('layouts/commonMaster')

@section('layoutContent')
<main class="container my-5">
    <!-- Back Button -->
    <div class="mb-3">
        <a href="{{ route('welcome') }}" class="btn btn-outline-theme">
            ← Back to Home
        </a>
    </div>

    <article class="card shadow-sm border-0">
        <img src="{{ asset('storage/' . $article->image_path ?? 'storage/articles/default.jpg') }}"
             class="card-img-top"
             alt="{{ $article->title }}">
        <div class="card-body">
            <h1 class="fw-bold">{{ $article->title }}</h1>
            <div class="d-flex align-items-center mb-3">
                @if($article->user->profile_photo_path)
                    <img src="{{ asset('storage/' . $article->user->profile_photo_path) }}"
                         class="rounded-circle me-2" width="40" height="40" alt="Author">
                @else
                    <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center me-2"
                         style="width:40px;height:40px;color:#fff;">
                        {{ strtoupper(substr($article->user->name,0,2)) }}
                    </div>
                @endif
                <small class="text-muted">
                    By {{ $article->user->name }} • {{ $article->published_at?->format('M d, Y') }}
                </small>
            </div>
            <div class="article-body">
                {!! $article->description !!}
            </div>
        </div>
    </article>
</main>
@endsection

