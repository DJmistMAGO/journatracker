@extends('layouts/contentNavbarLayout')

@section('title', 'SPJ | Article Management')

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/masonry/masonry.js') }}"></script>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/snackbar.css') }}">
@endpush

@section('content')
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">SPJ /</span> Article Management</h4>

    @include('_partials.errors')
    @include('_partials.success')

    <div class="card">
        <div class=" card-header d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center ">
            <h5 class="card-title  mb-2 mb-md-0">Article List</h5>
            @role('student')
			<div>
                <a href="{{ route('article-management.create') }}" class="btn btn-success btn-md ">
                    <i class="mdi mdi-text-box-plus-outline me-1"></i> Submit Article
                </a>
			</div>
            @endrole
        </div>

        <div class="card-body pt-0">
            <form method="GET" action="{{ route('article-management') }}" class="row g-2 g-md-3 align-items-center">
                <!-- Search Input -->
                <div class="col-12 col-md-4">
                    <input type="text" name="search" class="form-control" placeholder="Search title..."
                        value="{{ request('search') }}">
                </div>

                <!-- Status Filter -->
                <div class="col-12 col-md-3">
                    <select name="status" class="form-select">
                        <option value="">All Statuses</option>
                        <option value="Submitted" {{ request('status') == 'Submitted' ? 'selected' : '' }}>Submitted
                        </option>
                        <option value="Revision" {{ request('status') == 'Revision' ? 'selected' : '' }}>Revision</option>
                    </select>
                </div>

                <!-- Filter Button -->
                <div class="col-12 col-md-2 d-grid">
                    <button type="submit" class="btn btn-primary">Filter</button>
                </div>
            </form>
        </div>

        {{-- Table for larger screens --}}
        <div class="table-responsive d-none d-sm-block">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th class="d-none d-md-table-cell">Author</th>
                        <th class="d-none d-md-table-cell">Date Created</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($articles as $article)
                        <tr>
                            <td class="text-truncate" style="max-width: 200px;" title="{{ $article->title }}">
                                {{ $article->title }}
                            </td>
                            <td class="d-none d-md-table-cell">{{ $article->user->name ?? 'Unknown' }}</td>
                            <td class="d-none d-md-table-cell">{{ $article->date_submitted->format('M. d, Y') }}</td>
                            <td>
                                <span
                                    class="badge
                                @if ($article->status == 'Submitted') bg-label-primary
                                @elseif($article->status == 'Revision') bg-label-danger
                                @else bg-label-secondary @endif">
                                    {{ ucfirst($article->status) }}
                                </span>
                            </td>
                            <td class="text-nowrap">
                                <div class="d-flex gap-1 flex-wrap">
                                    <a href="{{ route('article-management.show', $article->id) }}"
                                        class="btn btn-sm btn-info" title="View">
                                        <i class="mdi mdi-file-eye"></i>
                                    </a>
                                    <a href="{{ route('article-management.edit', $article->id) }}"
                                        class="btn btn-sm btn-warning" title="Edit">
                                        <i class="mdi mdi-file-edit"></i>
                                    </a>

                                    @role('student')
                                        @if ($article->status === 'Submitted' || $article->status === 'Revision')
                                            <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#deleteModal" data-id="{{ $article->id }}"
                                                data-title="{{ $article->title }}">
                                                <i class="mdi mdi-delete"></i>
                                            </button>
                                        @endif
                                    @endrole
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

		{{-- Materio-style pagination --}}
		<nav aria-label="Page navigation" class="d-flex justify-content-center mt-2">
			<ul class="pagination pagination-sm">

				{{-- Previous Page Link --}}
				@if ($articles->onFirstPage())
					<li class="page-item disabled"><span class="page-link">&laquo;</span></li>
				@else
					<li class="page-item">
						<a class="page-link" href="{{ $articles->previousPageUrl() }}" rel="prev">&laquo;</a>
					</li>
				@endif

				{{-- Pagination Numbers --}}
				@foreach ($articles->getUrlRange(1, $articles->lastPage()) as $page => $url)
					<li class="page-item {{ $articles->currentPage() == $page ? 'active' : '' }}">
						<a class="page-link" href="{{ $url }}">{{ $page }}</a>
					</li>
				@endforeach

				{{-- Next Page Link --}}
				@if ($articles->hasMorePages())
					<li class="page-item">
						<a class="page-link" href="{{ $articles->nextPageUrl() }}" rel="next">&raquo;</a>
					</li>
				@else
					<li class="page-item disabled"><span class="page-link">&raquo;</span></li>
				@endif

			</ul>
		</nav>

        {{-- Card layout for mobile --}}
        <div class="d-block d-sm-none">
            @forelse($articles as $article)
                <div class="card mb-4 shadow-lg">
                    <div class="card-body d-flex flex-column gap-2">
                        <h5 class="card-title text-truncate" title="{{ $article->title }}">
                            {{ $article->title }}
                        </h5>
                        <p class="mb-0"><strong>Author:</strong> {{ $article->user->name ?? 'Unknown' }}</p>
                        <p class="mb-0"><strong>Date Created:</strong> {{ $article->date_submitted->format('F d, Y') }}
                        </p>
                        <p class="mb-0"><strong>Status:</strong>
                            <span
                                class="badge
                            @if ($article->status == 'Submitted') bg-label-secondary
                            @elseif($article->status == 'For Publish') bg-label-warning
                            @elseif($article->status == 'Published') bg-label-success
                            @else bg-label-secondary @endif">
                                {{ ucfirst($article->status) }}
                            </span>
                        </p>
                        <div class="d-flex gap-2 mt-2 flex-wrap">
                            <a href="{{ route('article-management.show', $article->id) }}"
                                class="btn btn-sm btn-info flex-fill" title="View">
                                <i class="mdi mdi-file-eye me-1"></i> View
                            </a>
                            <a href="{{ route('article-management.edit', $article->id) }}"
                                class="btn btn-sm btn-warning flex-fill" title="Edit">
                                <i class="mdi mdi-file-edit me-1"></i> Edit
                            </a>
                            <button type="button" class="btn btn-sm btn-danger flex-fill" data-bs-toggle="modal"
                                data-bs-target="#deleteModal" data-id="{{ $article->id }}"
                                data-title="{{ $article->title }}">
                                <i class="mdi mdi-delete me-1"></i> Delete
                            </button>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-center">No articles found.</p>
            @endforelse
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content p-3">
                <div class="modal-body display-6 text-center">
                    Are you sure you want to delete <strong id="articleTitle"></strong>?
                </div>
                <div class="modal-footer align-items-center justify-content-center">
                    <form id="deleteForm" method="POST" action="">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            const deleteModal = document.getElementById('deleteModal');
            deleteModal.addEventListener('show.bs.modal', function(event) {
                let button = event.relatedTarget;
                let id = button.getAttribute('data-id');
                let title = button.getAttribute('data-title');

                let form = document.getElementById('deleteForm');
                let articleTitle = document.getElementById('articleTitle');

                form.action = "/article-management/delete/" + id;
                articleTitle.textContent = title;
            });
        </script>
    @endpush

    @push('styles')
        <style>
            .card-title.text-truncate {
                max-width: 100%;
                overflow: hidden;
                white-space: nowrap;
                text-overflow: ellipsis;
            }
        </style>
    @endpush
@endsection
