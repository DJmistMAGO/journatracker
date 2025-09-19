@extends('layouts/contentNavbarLayout')

@section('title', 'SPJ | Article Management')

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
                            data-bs-target="#navs-top-home" aria-controls="navs-top-home" aria-selected="true">
                            Photojournalism
                        </button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                            data-bs-target="#navs-top-profile" aria-controls="navs-top-profile" aria-selected="false">
                            Cartooning
                        </button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                            data-bs-target="#navs-top-messages" aria-controls="navs-top-messages" aria-selected="false">
                            TV Broadcasting
                        </button>
                    </li>
					<li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                            data-bs-target="#navs-top-messages" aria-controls="navs-top-messages" aria-selected="false">
                            Radio Broadcasting
                        </button>
                    </li>
                </ul>
                <div class="tab-content ps-0 pe-0">
                    <div class="tab-pane fade show active" id="navs-top-home" role="tabpanel">
                        {{-- tablle --}}
                        <div class="table-responsive">
                            <table class="table mb-0">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Date Submitted</th>
                                        <th>Creator</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><i class="icon-base ri ri-suitcase-2-line icon-22px text-danger"></i>
                                            <span>Tours Project</span></td>
                                        <td>Albert Cook</td>
                                        <td>
                                            admin
                                        </td>
                                        <td><span class="badge bg-label-primary me-1">Active</span></td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                    data-bs-toggle="dropdown"><i
                                                        class="icon-base ri ri-more-2-fill icon-18px"></i></button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="javascript:void(0);"><i
                                                            class="icon-base ri ri-pencil-line icon-18px me-1"></i>Edit</a>
                                                    <a class="dropdown-item" href="javascript:void(0);"><i
                                                            class="icon-base ri ri-delete-bin-6-line icon-18px me-1"></i>Delete</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="navs-top-profile" role="tabpanel">
                        <p>
                            Donut dragée jelly pie halvah. Danish gingerbread bonbon cookie wafer candy oat cake ice cream.
                            Gummies halvah tootsie roll muffin biscuit icing dessert gingerbread. Pastry ice cream
                            cheesecake fruitcake.
                        </p>
                        <p class="mb-0">
                            Jelly-o jelly beans icing pastry cake cake lemon drops. Muffin muffin pie tiramisu halvah cotton
                            candy liquorice caramels.
                        </p>
                    </div>
                    <div class="tab-pane fade" id="navs-top-messages" role="tabpanel">
                        <p>
                            Oat cake chupa chups dragée donut toffee. Sweet cotton candy jelly beans macaroon gummies
                            cupcake gummi bears cake chocolate.
                        </p>
                        <p class="mb-0">
                            Cake chocolate bar cotton candy apple pie tootsie roll ice cream apple pie brownie cake. Sweet
                            roll icing sesame snaps caramels danish toffee. Brownie biscuit dessert dessert. Pudding jelly
                            jelly-o tart brownie jelly.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- <!-- Delete Confirmation Modal -->
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
    </div> --}}

@endsection

@push('scripts')
    <script></script>
@endpush
