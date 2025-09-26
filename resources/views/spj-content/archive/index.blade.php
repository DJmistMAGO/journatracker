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
						<th>Type</th>
						<th>Views</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse($items as $item)
                        <tr>
                            <td>{{ $item->title }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->date)->format('M d, Y') }}</td>
                            <td>{{ $item->user->name ?? 'N/A' }}</td>
							<td>{{ $item->type }}</td>
							<td>00</td>
                            <td>
                                <span class="badge bg-label-primary me-1">{{ $item->status }}</span>
                            </td>
                            <td>
                                <a href="{{route('publication-management.show',  ['id' => $item->id, 'type' => strtolower($item->type)])}}" class="btn btn-sm btn-primary">
									View
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">No records found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- content end --}}

@endsection
