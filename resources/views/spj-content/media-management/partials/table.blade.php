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
            @forelse($items as $item)
                <tr>
                    <td>
                    {{ Str::limit($item->title, 30, '...') }}
                    </td>
                    <td>{{ $item->date }}</td>
                    <td>{{ $item->user->name ?? 'N/A' }}</td>
                    <td>
                        <span
                                    class="badge {{ $item->status == 'published' ? 'bg-label-secondary' : 'bg-label-success' }}">
                                    {{ ucfirst($item->status) }}
                                </span>
                    </td>
                    <td>
                        <div class="d-flex gap-2">
                            <!-- View Button -->
                            <a href="{{ route('media-management.show', $item->id) }}" class="btn btn-sm btn-info">
                                <i class="mdi mdi-file-eye"></i>
                            </a>

                            <!-- Edit -->
                            <a href="{{ route('media-management.edit', $item->id) }}" class="btn btn-sm btn-warning">
                                <i class="mdi mdi-file-edit"></i>
                            </a>

                            <!-- Delete Button (Trigger Modal) -->
                            <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                data-bs-target="#deleteModal" data-id="{{ $item->id }}"
                                data-title="{{ $item->title }}">
                                <i class="mdi mdi-delete"></i>
                            </button>
                        </div>
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
