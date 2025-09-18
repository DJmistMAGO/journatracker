@extends('layouts/contentNavbarLayout')

@section('title', 'SPJ | Article Management')

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/masonry/masonry.js') }}"></script>
@endsection

@section('content')
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">SPJ /</span> Article Management</h4>

	@include('_partials.errors')
	@include('_partials.success')

    <div class="card">
        <div class="card-title d-flex justify-content-between align-items-center ps-0 p-3">
            <h5 class="card-header mb-0">Article List</h5>
            <a href="{{ route('article-management.create') }}" class="btn btn-success btn-md">
                <i class="mdi mdi-text-box-plus-outline me-1"></i>Write Article
            </a>
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Date Created</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse($articles as $article)
                        <tr>
                            <td>{{ $article->title_article }}</td>
                            <td>{{ $article->user->name ?? 'Unknown' }}</td>
                            <td>{{ $article->date_written->format('F d, Y') }}</td>
                            <td>
                                <span class="badge {{ $article->status == 'published' ? 'bg-label-success' : 'bg-label-secondary' }}">
                                    {{ ucfirst($article->status) }}
                                </span>
                            </td>
                            <td>
                                <div class="d-flex gap-2">
                                    <!-- View Button -->
                                    <a href="{{ route('article-management.show', $article->id) }}" class="btn btn-sm btn-info">
                                        <i class="mdi mdi-file-eye"></i>
                                    </a>

                                    <!-- Edit -->
                                    <a href="{{ route('article-management.edit', $article->id) }}" class="btn btn-sm btn-warning">
                                        <i class="mdi mdi-file-edit"></i>
                                    </a>

                                    <!-- Delete -->
                                    <form action="{{ route('article-management.destroy', $article->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this article?')">
                                            <i class="mdi mdi-delete"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">No articles found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
