@extends('layouts/contentNavbarLayout')

@section('title', 'SPJ | Publication Management')

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/masonry/masonry.js') }}"></script>
@endsection

@section('content')
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">SPJ /</span> Publication Management</h4>

	@include('_partials.errors')
	@include('_partials.success')

    <div class="card">
        <h5 class="card-header">Publication List</h5>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Title</th>
						<th>Category</th>
                        <th>Type</th>
                        <th>Author</th>
                        <th>Date Submitted</th>
                        <th>Status</th>
                        <th>Manage</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse ($items as $item)
                        <tr>
                            <td>{{ Str::limit($item->title, 50) }}</td>
                            <td>{{ $item->category }}</td>
							<td>{{ $item->type }}</td>
                            <td>{{ $item->user->name ?? 'N/A' }}</td>
                            <td>{{ $item->date_submitted ? \Carbon\Carbon::parse($item->date_submitted)->format('Y-m-d') : '-' }}</td>
							<td>
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
							</td>

                            <td>
								@if ($item->status === 'Approved')
									<!-- Publish Button -->
									<button type="button" class="btn btn-sm btn-success"
										data-bs-toggle="modal"
										data-bs-target="#publishModal-{{ $item->id }}">
										Publish
									</button>

									<!-- Publish Modal -->
									<div class="modal fade" id="publishModal-{{ $item->id }}" tabindex="-1" aria-labelledby="publishLabel-{{ $item->id }}" aria-hidden="true">
										<div class="modal-dialog">
											<form action="{{ route('publication-management.publish', $item->id) }}" method="POST">
												@csrf
												<div class="modal-content">
													<div class="modal-header">
														<h5 class="modal-title" id="publishLabel-{{ $item->id }}">Schedule Publication</h5>
														<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
													</div>
													<div class="modal-body">
														<div class="mb-3">
															<label class="form-label">Publish Date</label>
															<input type="date" class="form-control" name="publish_date" required>
														</div>
														<div class="mb-3">
															<label class="form-label">Publish Time</label>
															<input type="time" class="form-control" name="publish_time" required>
														</div>
													</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
														<button type="submit" class="btn btn-success">Schedule</button>
													</div>
												</div>
											</form>
										</div>
									</div>


								@endif

								@if ($item->status === 'Scheduled')
									<!-- Reschedule Button -->
									<button type="button" class="btn btn-sm btn-warning"
										data-bs-toggle="modal"
										data-bs-target="#rescheduleModal-{{ $item->id }}">
										Reschedule
									</button>

									<!-- Reschedule Modal -->
									<div class="modal fade" id="rescheduleModal-{{ $item->id }}" tabindex="-1" aria-labelledby="rescheduleLabel-{{ $item->id }}" aria-hidden="true">
										<div class="modal-dialog">
											<form action="{{ route('publication-management.reschedule', $item->id) }}" method="POST">
												@csrf
												<div class="modal-content">
													<div class="modal-header">
														<h5 class="modal-title" id="rescheduleLabel-{{ $item->id }}">Reschedule Publication</h5>
														<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
													</div>
													<div class="modal-body">
														<div class="mb-3">
															<label class="form-label">Publish Date</label>
															<input type="date" class="form-control" name="publish_date" required>
														</div>
														<div class="mb-3">
															<label class="form-label">Publish Time</label>
															<input type="time" class="form-control" name="publish_time" required>
														</div>
													</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
														<button type="submit" class="btn btn-success">Reschedule</button>
													</div>
												</div>
											</form>
										</div>
									</div>
								@endif

								@if ($item->status === 'Published')
									<!-- Unpublish Button -->
									<form action="{{ route('publication-management.unpublish', $item->id) }}" method="POST" class="d-inline">
										@csrf
										<button type="submit" class="btn btn-sm btn-danger">Unpublish</button>
									</form>
								@endif



								{{-- View Button --}}
                                <a href="{{ route('publication-management.show', ['id' => $item->id, 'type' => strtolower($item->type)]) }}"
                                    class="btn btn-sm btn-info">
                                    View
                                </a>
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
    </div>
@endsection
