@extends('layouts/contentNavbarLayout')

@section('title', 'SPJ | Archive')

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/masonry/masonry.js') }}"></script>
@endsection

@section('content')
<h4 class="py-3 mb-4"><span class="text-muted fw-light">SPJ /</span> Archive</h4>

<div class="card">
    <h5 class="card-header">Archive List</h5>

    @include('_partials.errors')
    @include('_partials.success')

    {{-- Table for larger screens --}}
    <div class="table-responsive d-none d-sm-block">
        <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Date Published</th>
                    <th>Author</th>
                    <th class="d-none d-md-table-cell">Type</th>
                    <th class="d-none d-md-table-cell">Category</th>
                    <th class="d-none d-md-table-cell text-center">Views</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($items as $item)
                <tr>
                    <td class="text-truncate" style="max-width: 180px;" title="{{ $item->title }}">
                        {{ $item->title }}
                    </td>
                    <td>{{ \Carbon\Carbon::parse($item->date)->format('M d, Y') }}</td>
                    <td>{{ $item->user->name ?? 'N/A' }}</td>
                    <td class="d-none d-md-table-cell">{{ $item->type }}</td>
                    <td class="d-none d-md-table-cell">{{ $item->category }}</td>
                    <td class="d-none d-md-table-cell text-center">{{ $item->publication->views ?? 0 }}</td>
                    <td class="text-nowrap">
                        {{-- View --}}
                        <a href="{{ route('publication-management.show', ['id' => $item->id, 'type' => strtolower($item->type)]) }}"
                           class="btn btn-sm btn-primary d-inline-block me-1 mb-1 mb-md-0" title="View">
                            <i class="mdi mdi-eye"></i>
                        </a>

						@unlessrole('student')
                        {{-- Unpublish --}}
                        @if ($item->status === 'Published')
                        <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                data-bs-target="#unpublishModal-{{ $item->id }}">
                            <i class="mdi mdi-close-circle-outline"></i> Unpublish
                        </button>
                        @endif
						@endunless
                    </td>
                </tr>

                {{-- Unpublish Confirmation Modal --}}
                @if ($item->status === 'Published')
                <div class="modal fade" id="unpublishModal-{{ $item->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <form method="POST"
                                  action="{{ route('publication-management.update-status', ['type' => $item->type, 'id' => $item->id]) }}">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="unpublish" value="1">
                                <div class="modal-header">
                                    <h5 class="modal-title">Confirm Unpublish</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Are you sure you want to unpublish <strong>{{ $item->title }}</strong>?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-danger">Unpublish</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @endif
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
        @forelse($items as $item)
            <div class="card mb-4 mt-3 shadow-lg">
                <div class="card-body d-flex flex-column gap-2">
                    <h5 class="card-title text-truncate" title="{{ $item->title }}">
                        {{ $item->title }}
                    </h5>
                    <p class="mb-0"><strong>Date Published:</strong> {{ \Carbon\Carbon::parse($item->date)->format('M d, Y') }}</p>
                    <p class="mb-0"><strong>Author:</strong> {{ $item->user->name ?? 'N/A' }}</p>
                    <p class="mb-0"><strong>Type:</strong> {{ $item->type }}</p>
                    <p class="mb-0"><strong>Category:</strong> {{ $item->category }}</p>
                    <p class="mb-0"><strong>Views:</strong> {{ $item->publication->views ?? 0 }}</p>

                    <div class="d-flex gap-2 mt-2 flex-wrap">
                        <a href="{{ route('publication-management.show', ['id' => $item->id, 'type' => strtolower($item->type)]) }}"
                           class="btn btn-sm btn-primary flex-fill" title="View">
                            <i class="mdi mdi-eye me-1"></i> View
                        </a>
						@unlessrole('student')

                        @if ($item->status === 'Published')
							<button type="button" class="btn btn-sm btn-danger flex-fill" data-bs-toggle="modal"
									data-bs-target="#unpublishModalMobile-{{ $item->id }}">
								<i class="mdi mdi-close-circle-outline me-1"></i> Unpublish
							</button>

							{{-- Mobile modal --}}
							<div class="modal fade" id="unpublishModalMobile-{{ $item->id }}" tabindex="-1" aria-hidden="true">
								<div class="modal-dialog modal-dialog-centered">
									<div class="modal-content">
										<form method="POST"
											action="{{ route('publication-management.update-status', ['type' => $item->type, 'id' => $item->id]) }}">
											@csrf
											@method('PUT')
											<input type="hidden" name="unpublish" value="1">
											<div class="modal-header">
												<h5 class="modal-title">Confirm Unpublish</h5>
												<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
											</div>
											<div class="modal-body">
												Are you sure you want to unpublish <strong>{{ $item->title }}</strong>?
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
												<button type="submit" class="btn btn-danger">Unpublish</button>
											</div>
										</form>
									</div>
								</div>
							</div>
                        @endif
						@endunless

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
