@extends('layouts/contentNavbarLayout')

@section('title', 'SPJ | Editorial Scheduling')

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/masonry/masonry.js') }}"></script>
@endsection

@section('content')
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">SPJ /</span> Editorial Scheduling</h4>
    {{-- content --}}

    <div class="card">
        <h5 class="card-header">Editorial Schedule List</h5>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Date Published</th>
                        <th>Author</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    <tr>
                        <td>
                        Tours Project
                        </td>
                        <td>
						Albert Cook
						</td>
                        <td>
                        test
                        </td>
                        <td><span class="badge bg-label-primary me-1">Active</span></td>
                        <td>
                        
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    {{-- content end --}}

@endsection
