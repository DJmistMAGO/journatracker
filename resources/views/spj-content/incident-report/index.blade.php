@extends('layouts/contentNavbarLayout')

@section('title', 'SPJ | Incident Report')

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/masonry/masonry.js') }}"></script>
@endsection

@section('content')
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">SPJ /</span> Incident Report</h4>

    <div class="card">
        <h5 class="card-header">Incident Report List</h5>
        <div class="table-responsive">
			<div class="col-12">
				<form method="GET" action="{{ route('incident-report') }}" class="row mb-3 align-items-center col-12">
            <!-- Status Filter -->
            <div class="col-12 col-md-3">
                <select name="status" class="form-select ms-3" >
                    <option value="">All Statuses</option>
                    <option value="Pending" {{ request('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                    <option value="Under Review" {{ request('status') == 'Under Review' ? 'selected' : '' }}>Under Review</option>
					<option value="Resolved" {{ request('status') == 'Resolved' ? 'selected' : '' }}>Resolved</option>
                    <option value="Rejected" {{ request('status') == 'Rejected' ? 'selected' : '' }}>Rejected</option>
                </select>
            </div>

            <!-- Filter Button -->
            <div class="col-12 col-md-2 d-grid">
                <button type="submit" class="btn btn-primary">Filter</button>
            </div>
        </form>
			</div>
            <table class="table">
                <thead>
                    <tr>
                        <th>Student Name</th>
                        <th>Date Submitted</th>
                        <th>Status</th>
                        <th>Date Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse($incidents as $incident)
                        <tr>
                            <td>{{ $incident->student_name }}</td>
                            <td>{{ $incident->date_submitted->format('F j, Y')}}</td>
                            <td>
                                <span class="badge bg-label-success me-1">{{ $incident->status }}</span>
                            </td>
                            <td>{{ $incident->date_status ? $incident->date_status->format('F j, Y') : 'N/A' }}</td>
                            <td>
                                <a href="{{ route('incident-report.show', $incident->id ) }}"
                                    class="btn btn-info btn-sm">View</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">No incident reports found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>


@endsection
