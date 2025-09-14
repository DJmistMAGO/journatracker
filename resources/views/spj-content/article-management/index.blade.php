@extends('layouts/contentNavbarLayout')

@section('title', 'SPJ | Article Management')

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/masonry/masonry.js') }}"></script>
@endsection

@section('content')
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">SPJ /</span> Article Management</h4>
    {{-- content --}}

    <div class="card">
        <div class="card-title d-flex justify-content-between align-items-center ps-0 p-3">
            <h5 class="card-header mb-0">Article List</h5>
            <a href="#" class="btn btn-success btn-md"><i class="mdi mdi-text-box-plus-outline me-1"></i>Write Article</a>
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
                    <tr>
                        <td>
                            <span>Tours Project</span>
                        </td>
                        <td>Albert Cook</td>
                        <td>
                            August 8, 2023
                        </td>
                        <td><span class="badge bg-label-primary me-1">Active</span></td>
                        <td class="">
                            <div class="d-flex gap-2">
                                <!-- View Button -->
                                <button type="button" class="btn btn-sm btn-info">
                                    <i class="mdi mdi-file-eye"></i>
                                </button>

                                <!-- Edit -->
                                <button type="button" class="btn btn-sm btn-warning">
                                    <i class="mdi mdi-file-edit"></i>
                                </button>

                                <!-- Delete -->
                                <button type="button" class="btn btn-sm btn-danger">
                                    <i class="mdi mdi-delete"></i>
                                </button>
                            </div>
                        </td>

                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    {{-- content end --}}

@endsection
