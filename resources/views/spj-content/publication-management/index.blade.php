@extends('layouts/contentNavbarLayout')

@section('title', 'SPJ | Publication Management')

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/masonry/masonry.js') }}"></script>
@endsection

@section('content')
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">SPJ /</span> Publication Management</h4>

    <div class="card">
        <h5 class="card-header">Publication List</h5>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Type</th>
                        <th>Author</th>
                        <th>Date Created</th>
                        <th>Status</th>
                        <th>Manage</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($items as $item)
                        <tr>
                            <td>{{ $item['title'] }}</td>
                            <td>{{ $item['type'] }}</td>
                            <td>{{ $item['author'] }}</td>
                            <td>{{ $item['date'] }}</td>
                            <td><span class="badge bg-label-primary">{{ $item['status'] }}</span></td>
							<td>
								<a href="{{ route('publication-management.show', ['id' => $item['id'], 'type' => strtolower($item['type'])]) }}" class="btn btn-sm btn-info">
									View
								</a>
							</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
