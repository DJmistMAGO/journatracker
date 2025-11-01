{{-- Desktop Table --}}
<div class="table-responsive d-none d-sm-block">
	<form method="GET" action="{{ route('media-management') }}" class="row px-3 mb-3 align-items-center col-12">
            <!-- Search Input -->
            <div class="col-12 col-md-3">
                <input type="text" name="search" class="form-control" placeholder="Search title..."
                    value="{{ request('search') }}">
            </div>

            <!-- Status Filter -->
            <div class="col-12 col-md-2">
                <select name="status" class="form-select">
                    <option value="">All Statuses</option>
                    <option value="Submitted" {{ request('status') == 'Submitted' ? 'selected' : '' }}>Submitted</option>
                    <option value="Revision" {{ request('status') == 'Revision' ? 'selected' : '' }}>Revision</option>
                </select>
            </div>

            <!-- Filter Button -->
            <div class="col-12 col-md-2 d-grid">
                <button type="submit" class="btn btn-primary">Filter</button>
            </div>
        </form>
    <table class="table mb-0">
        <thead>
            <tr>
                <th>Title</th>
                <th>Date Submitted</th>
                <th>Author</th>
                <th>Category</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($items as $item)
            <tr>
                <td>{{ Str::limit($item->title, 30, '...') }}</td>
                <td>{{ $item->date_submitted }}</td>
                <td>{{ $item->user->name ?? 'N/A' }}</td>
                <td>{{ $item->category }}</td>
                <td>
                    <span class="badge
                                @if($item->status == 'Submitted') bg-label-primary
                                @elseif($item->status == 'Revision') bg-label-danger
                                @else bg-label-secondary @endif">
                                {{ ucfirst($item->status) }}
                            </span>
                </td>
                <td>
                    <div class="d-flex gap-2">
                        <a href="{{ route('media-management.show', $item->id) }}" class="btn btn-sm btn-info">
                            <i class="mdi mdi-file-eye"></i>
                        </a>
                        @if ($item->status !== 'published')
							<a href="{{ route('media-management.edit', $item->id) }}" class="btn btn-sm btn-warning">
								<i class="mdi mdi-file-edit"></i>
							</a>
							<button
								type="button"
								class="btn btn-sm btn-danger"
								data-bs-toggle="modal"
								data-bs-target="#deleteModal"
								data-id="{{ $item->id }}"
								data-title="{{ $item->title }}"
							>
								<i class="mdi mdi-delete"></i>
							</button>
						@endif

                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center">No records found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

{{-- Mobile Cards --}}
<div class="d-block d-sm-none">
    @forelse($items as $item)
    <div class="card mb-3 shadow-sm">
        <div class="card-body d-flex flex-column gap-2">
            <h5 class="card-title text-truncate" title="{{ $item->title }}">{{ $item->title }}</h5>
            <p class="mb-0"><strong>Date Submitted:</strong> {{ $item->date_submitted }}</p>
            <p class="mb-0"><strong>Author:</strong> {{ $item->user->name ?? 'N/A' }}</p>
            <p class="mb-0"><strong>Category:</strong> {{ $item->category }}</p>
            <p class="mb-0"><strong>Status:</strong>
                <span class="badge {{ $item->status == 'Published' ? 'bg-label-success' : 'bg-label-secondary' }}">
                    {{ ucfirst($item->status) }}
                </span>
            </p>
            <div class="d-flex gap-2 mt-2 flex-wrap">
                <a href="{{ route('media-management.show', $item->id) }}" class="btn btn-sm btn-info flex-fill">
                    <i class="mdi mdi-file-eye me-1"></i> View
                </a>
                <a href="{{ route('media-management.edit', $item->id) }}" class="btn btn-sm btn-warning flex-fill">
                    <i class="mdi mdi-file-edit me-1"></i> Edit
                </a>
                <button type="button" class="btn btn-sm btn-danger flex-fill" data-bs-toggle="modal"
                    data-bs-target="#deleteModal" data-id="{{ $item->id }}" data-title="{{ $item->title }}">
                    <i class="mdi mdi-delete me-1"></i> Delete
                </button>
            </div>
        </div>
    </div>
    @empty
        <p class="text-center">No records found.</p>
    @endforelse
</div>
