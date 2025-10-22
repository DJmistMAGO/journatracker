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
		@unlessrole('admin')
        <a href="{{ route('media-management.create') }}" class="btn btn-success btn-md">
            <i class="mdi mdi-text-box-plus-outline me-1"></i> Submit Media
        </a>
		@endunlessrole
    </div>

    <div class="card-body pt-0">
        <div class="nav-align-top nav-tabs-shadow">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item"><button type="button" class="nav-link active" data-bs-toggle="tab" data-bs-target="#all">All</button></li>
                <li class="nav-item"><button type="button" class="nav-link" data-bs-toggle="tab" data-bs-target="#photojournalism">Photojournalism</button></li>
                <li class="nav-item"><button type="button" class="nav-link" data-bs-toggle="tab" data-bs-target="#cartooning">Cartooning</button></li>
                <li class="nav-item"><button type="button" class="nav-link" data-bs-toggle="tab" data-bs-target="#tv">TV Broadcasting</button></li>
                <li class="nav-item"><button type="button" class="nav-link" data-bs-toggle="tab" data-bs-target="#radio">Radio Broadcasting</button></li>
            </ul>

            <div class="tab-content ps-0 pe-0">
                @foreach(['all'=>$all, 'photojournalism'=>$photojournalism, 'cartooning'=>$cartooning, 'tv'=>$tv, 'radio'=>$radio] as $key => $items)
                    <div class="tab-pane fade {{ $key==='all' ? 'show active' : '' }}" id="{{ $key }}">
                        @include('spj-content.media-management.partials.table', ['items' => $items])
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-3">
            <div class="modal-body text-center display-6">
                Are you sure you want to delete <strong id="deleteItemTitle"></strong>?
            </div>
            <div class="modal-footer justify-content-center">
                <form id="deleteForm" method="POST">
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
    const button = event.relatedTarget;
    const id = button.getAttribute('data-id');
    const title = button.getAttribute('data-title');

    document.getElementById('deleteForm').action = `/media-management/delete/${id}`;
    document.getElementById('deleteItemTitle').textContent = title;
});
</script>
@endpush

@endsection
