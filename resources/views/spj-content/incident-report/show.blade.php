@extends('layouts/contentNavbarLayout')

@section('title', 'SPJ | View Incident Report')

@section('content')
    <h4 class="py-3 mb-4">
        <span class="text-muted fw-light">SPJ / Incident Report / <strong>View</strong></span>
    </h4>

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">
                Submitted by <strong>{{ $incident->student_name }}</strong>
                on <strong>{{ $incident->date_submitted->format('F d, Y') }}</strong>
            </h5>
            <a href="{{ route('incident-report') }}" class="btn btn-primary btn-sm">
                <i class="mdi mdi-arrow-left me-1"></i> Back to List
            </a>
        </div>

        <div class="card-body">
            <p><strong>Status: {{ $incident->status }} </strong> as of
                <strong>{{ $incident->date_status->format('F d, Y') }}

				</strong>
			</p>
			<hr>
            {{-- Incident description --}}
            <p><strong>Email:</strong> {{ $incident->email }}</p>
            <hr>
            {{-- Incident description --}}
            <p><strong>Description:</strong> {{ $incident->incident_description }}</p>
            <hr>
            {{-- Images section --}}
            <div class="row">
                {{-- Student ID Image --}}
                <div class="col-md-6 mb-3">
                    <p><strong>Student ID Image:</strong></p>
                    @if ($incident->student_id_image)
                        <img src="{{ asset('storage/' . $incident->student_id_image) }}"
                            class="img-fluid rounded shadow-sm w-100" style="max-height: 300px; object-fit: contain;">
                    @else
                        <p class="text-muted">No ID image uploaded</p>
                    @endif
                </div>

                {{-- Incident Image Proof --}}
                <div class="col-md-6 mb-3">
                    <p><strong>Image Proof:</strong></p>
                    @if ($incident->image_proof)
                        <img src="{{ asset('storage/' . $incident->image_proof) }}"
                            class="img-fluid rounded shadow-sm w-100" style="max-height: 300px; object-fit: contain;">
                    @else
                        <p class="text-muted">No image proof uploaded</p>
                    @endif
                </div>
            </div>
            <hr>
            {{-- Remarks Section --}}
            <p><strong>Remarks:</strong> {{ $incident->remarks ?? 'N/A' }}</p>
        </div>
        {{-- Card Footer --}}
        <div class="card-footer d-flex justify-content-end align-items-center">
			@role('admin|eic')
            @if ($incident->status !== 'Resolved')
                <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#statusModal">
                    Manage Status
                </button>
            @endif
			@endrole
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="statusModal" tabindex="-1" aria-labelledby="statusModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('incident-report.update-status', $incident->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="statusModalLabel">Update Incident Status</h5>
                    </div>
                    <div class="modal-body">

                        <div class="mb-3">
                            <label for="status" class="form-label">Select Status</label>
                            <select name="status" id="status" class="form-select" required>
                                <option value="Pending" {{ $incident->status == 'Pending' ? 'selected' : '' }}>Pending
                                </option>
                                <option value="Under Review" {{ $incident->status == 'Under Review' ? 'selected' : '' }}>
                                    Under Review</option>
                                <option value="Resolved" {{ $incident->status == 'Resolved' ? 'selected' : '' }}>Resolved
                                </option>
                                <option value="Rejected" {{ $incident->status == 'Rejected' ? 'selected' : '' }}>Rejected
                                </option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="date_status" class="form-label">Date Status</label>
                            <input type="date" name="date_status" id="date_status" class="form-control"
                                value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                        </div>
                        <div class="mb-3">
                            <label for="remarks" class="form-label">Remarks (optional)</label>
                            <textarea name="remarks" id="remarks" class="form-control" rows="3">{{ old('remarks') }}</textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Update Status</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
