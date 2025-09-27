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
                            <td>{{ $incident->date_resolved ? $incident->date_resolved->format('F j, Y') : 'N/A' }}</td>
                            <td>
                                <a href="{{ route('incident-report.show', $incident->id) }}"
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
