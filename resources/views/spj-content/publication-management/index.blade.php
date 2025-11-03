@extends('layouts/contentNavbarLayout')

@section('title', 'SPJ | Publication Management')

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/masonry/masonry.js') }}"></script>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/snackbar.css') }}">
@endpush

@section('content')
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">SPJ /</span> Publication Management</h4>

    @include('_partials.errors')
    @include('_partials.success')

    <div class="card">
        <h5 class="card-header">Publication List</h5>

        {{-- Table for larger screens --}}
        <div class="table-responsive d-none d-sm-block">
            <div class="col-12">
                <form method="GET" action="{{ route('publication-management.index') }}"
                    class="row mb-3 align-items-center col-12">
                    <!-- Search Input -->
                    <div class="col-12 col-md-3">
                        <input type="text" name="search" class="form-control ms-3" placeholder="Search title..."
                            value="{{ request('search') }}">
                    </div>

                    <!-- Status Filter -->
                    <div class="col-12 col-md-2">
                        <select name="status" class="form-select">
                            <option value="">All Statuses</option>

                            @role('teacher')
                                <option value="Submitted" {{ request('status') == 'Submitted' ? 'selected' : '' }}>Submitted
                                </option>
                                <option value="Resubmitted" {{ request('status') == 'Resubmitted' ? 'selected' : '' }}>
                                    Resubmitted</option>
                            @endrole

                            @role('admin')
                                <option value="For Publish" {{ request('status') == 'For Publish' ? 'selected' : '' }}>For
                                    Publish</option>
                                <option value="Scheduled" {{ request('status') == 'Scheduled' ? 'selected' : '' }}>Scheduled
                                </option>
                            @endrole

                        </select>
                    </div>

                    <!-- Filter Button -->
                    <div class="col-12 col-md-2 d-grid">
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </div>
                </form>
            </div>
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th class="d-none d-md-table-cell">Category</th>
                        <th class="d-none d-md-table-cell">Type</th>
                        <th>Author</th>
                        <th class="d-none d-md-table-cell">Date Submitted</th>
                        <th>Status</th>
                        <th>Manage</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($items as $item)
                        <tr>
                            <td class="text-truncate" style="max-width: 200px;" title="{{ $item->title }}">
                                {{ $item->title }}
                            </td>
                            <td class="d-none d-md-table-cell">{{ $item->category }}</td>
                            <td class="d-none d-md-table-cell">{{ $item->type }}</td>
                            <td>{{ $item->user->name ?? 'N/A' }}</td>
                            <td class="d-none d-md-table-cell">
                                {{ $item->date_submitted ? \Carbon\Carbon::parse($item->date_submitted)->format('M. d, Y') : '-' }}
                            </td>
                            <td>
                                <span
                                    class="badge
                                @if ($item->status === 'Submitted') bg-label-primary
                                @elseif($item->status === 'Resubmitted') bg-label-warning
                                @elseif($item->status === 'For Publish') bg-label-primary
                                @elseif($item->status === 'Scheduled') bg-label-info
                                @else bg-label-info @endif">

                                    @if ($item->status === 'Scheduled' && $item->publish_at)
                                        {{ $item->status }} <br>
                                        <small>{{ \Carbon\Carbon::parse($item->publish_at)->format('M d, Y h:i A') }}</small>
                                    @else
                                        {{ $item->status }}
                                    @endif
                                </span>
                            </td>
                            <td class="text-nowrap">
                                <a href="{{ route('publication-management.show', ['id' => $item->id, 'type' => strtolower($item->type)]) }}"
                                    class="btn btn-sm btn-info d-inline-block me-1 mb-1 mb-md-0" title="View">
                                    <i class="mdi mdi-eye"></i> View
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">No records found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Card layout for mobile --}}
        <div class="d-block d-sm-none">
            @forelse ($items as $item)
                <div class="card mb-4 mt-3 shadow-lg">
                    <div class="card-body d-flex flex-column gap-2">
                        <h5 class="card-title text-truncate" title="{{ $item->title }}">
                            {{ $item->title }}
                        </h5>
                        <p class="mb-0"><strong>Category:</strong> {{ $item->category }}</p>
                        <p class="mb-0"><strong>Type:</strong> {{ $item->type }}</p>
                        <p class="mb-0"><strong>Author:</strong> {{ $item->user->name ?? 'N/A' }}</p>
                        <p class="mb-0"><strong>Date Submitted:</strong>
                            {{ $item->date_submitted ? \Carbon\Carbon::parse($item->date_submitted)->format('Y-m-d') : '-' }}
                        </p>
                        <p class="mb-0"><strong>Status:</strong>
                            <span
                                class="badge
                            @if ($item->status === 'Draft') bg-secondary
                            @elseif($item->status === 'Approved') bg-warning
                            @elseif($item->status === 'Published') bg-success
                            @elseif($item->status === 'Revision') bg-warning
                            @elseif($item->status === 'Rejected') bg-danger
                            @elseif($item->status === 'Scheduled') bg-primary
                            @else bg-info @endif">

                                @if ($item->status === 'Scheduled' && $item->publish_at)
                                    {{ $item->status }} <br>
                                    <small>{{ \Carbon\Carbon::parse($item->publish_at)->format('M d, Y h:i A') }}</small>
                                @else
                                    {{ $item->status }}
                                @endif
                            </span>
                        </p>

                        <div class="d-flex gap-2 mt-2 flex-wrap">
                            <a href="{{ route('publication-management.show', ['id' => $item->id, 'type' => strtolower($item->type)]) }}"
                                class="btn btn-sm btn-info flex-fill" title="View">
                                <i class="mdi mdi-eye me-1"></i> View
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-center">No records found.</p>
            @endforelse
        </div>
    </div>

    @push('styles')
        <style>
            /* Truncate long titles inside cards */
            .card-title.text-truncate {
                max-width: 100%;
                overflow: hidden;
                white-space: nowrap;
                text-overflow: ellipsis;
            }
        </style>
    @endpush
@endsection
