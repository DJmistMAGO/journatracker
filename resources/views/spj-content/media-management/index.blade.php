@extends('layouts/contentNavbarLayout')

@section('title', 'SPJ | Media Management')

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/masonry/masonry.js') }}"></script>
@endsection


@section('content')
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">SPJ /</span> Media Management</h4>

    @include('_partials.errors')
    @include('_partials.success')

    <div class="card">
        <div class="card-title d-flex justify-content-between align-items-center ps-0 p-3 pb-0">
            <h5 class="card-header mb-0">Media Library</h5>
            <a href="{{ route('media-management.create') }}" class="btn btn-success btn-md">
                <i class="mdi mdi-text-box-plus-outline me-1"></i>Submit Media
            </a>
        </div>
        <div class="card-body pt-0">
            <div class="nav-align-top nav-tabs-shadow">
                <ul class="nav nav-tabs" role="tablist">
					<li class="nav-item">
                        <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                            data-bs-target="#all" aria-controls="all" aria-selected="true">
                            All
                        </button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="nav-link " role="tab" data-bs-toggle="tab"
                            data-bs-target="#photojournalism" aria-controls="photojournalism" aria-selected="true">
                            Photojournalism
                        </button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                            data-bs-target="#cartooning" aria-controls="cartooning" aria-selected="false">
                            Cartooning
                        </button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#tv"
                            aria-controls="tv" aria-selected="false">
                            TV Broadcasting
                        </button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#radio"
                            aria-controls="radio" aria-selected="false">
                            Radio Broadcasting
                        </button>
                    </li>
                </ul>

                <div class="tab-content ps-0 pe-0">
					<div class="tab-pane fade show active" id="all" role="tabpanel">
                        @include('spj-content.media-management.partials.table', [
                            'items' => $all,
                        ])
                    </div>
                    <div class="tab-pane fade show" id="photojournalism" role="tabpanel">
                        @include('spj-content.media-management.partials.table', [
                            'items' => $photojournalism,
                        ])
                    </div>
                    <div class="tab-pane fade" id="cartooning" role="tabpanel">
                        @include('spj-content.media-management.partials.table', ['items' => $cartooning])
                    </div>
                    <div class="tab-pane fade" id="tv" role="tabpanel">
                        @include('spj-content.media-management.partials.table', ['items' => $tv])
                    </div>
                    <div class="tab-pane fade" id="radio" role="tabpanel">
                        @include('spj-content.media-management.partials.table', ['items' => $radio])
                    </div>
                </div>
            </div>
        </div>
    </div>

	<!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content p-3">
                <div class="modal-body display-6 text-center">
                    Are you sure you want to delete <strong id="deleteItemTitle"></strong>?
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

    <script>
        // Set form action dynamically
        const deleteModal = document.getElementById('deleteModal');
        deleteModal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;
            const id = button.getAttribute('data-id');
            const title = button.getAttribute('data-title');

            const form = document.getElementById('deleteForm');
            form.action = `/media-management/delete/${id}`;

            document.getElementById('deleteItemTitle').textContent = title;
        });
    </script>



@endsection
