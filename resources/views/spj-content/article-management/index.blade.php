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
                            <td>{{ $article->title }}</td>
                            <td>{{ $article->user->name ?? 'Unknown' }}</td>
                            <td>{{ $article->date_submitted->format('F d, Y') }}</td>
                            <td>
                                <span
                                    class="badge {{ $article->status == 'published' ? 'bg-label-secondary' : 'bg-label-success' }}">
                                    {{ ucfirst($article->status) }}
                                </span>
                            </td>
                            <td>
                                <div class="d-flex gap-2">
                                    <!-- View Button -->
                                    <a href="{{ route('article-management.show', $article->id) }}"
                                        class="btn btn-sm btn-info">
                                        <i class="mdi mdi-file-eye"></i>
                                    </a>

                                    <!-- Edit -->
                                    <a href="{{ route('article-management.edit', $article->id) }}"
                                        class="btn btn-sm btn-warning">
                                        <i class="mdi mdi-file-edit"></i>
                                    </a>

                                    <!-- Delete Button (Trigger Modal) -->
                                    <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal" data-id="{{ $article->id }}"
                                        data-title="{{ $article->title_article }}">
                                        <i class="mdi mdi-delete"></i>
                                    </button>
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

@endsection

@push('scripts')
    <script>
        const deleteModal = document.getElementById('deleteModal');
        deleteModal.addEventListener('show.bs.modal', function(event) {
            let button = event.relatedTarget;
            let id = button.getAttribute('data-id');
            let title = button.getAttribute('data-title');

            let form = document.getElementById('deleteForm');
            let articleTitle = document.getElementById('articleTitle');

            form.action = "/article-management/" + id; // dynamic route
            articleTitle.textContent = title;
        });
    </script>
@endpush
