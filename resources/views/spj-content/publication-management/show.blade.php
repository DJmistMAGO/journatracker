@extends('layouts/contentNavbarLayout')

@section('title', 'SPJ | Publication Management')

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/masonry/masonry.js') }}"></script>
@endsection

@section('content')
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">SPJ / Publication Management </h4>

    @if ($errors->any())
        <div class="alert alert-danger mb-3">
            <strong>Oops!</strong> There were some problems with your input:
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div class="card-title">
                <h4 class="mb-0">{{ $item->title }}</h4>
            </div>
            <div class="back-button">

                    <a href="{{ route('publication-management.index') }}" class="btn btn-primary btn-sm">
                        <i class="mdi mdi-arrow-left me-1"></i> Back to List
                    </a>


            </div>
        </div>

        <div class="card-body">
            <p><strong>Type:</strong> {{ $item->type }}</p>
            <p><strong>Author:</strong> {{ $item->user->name }}</p>
            <p><strong>Date Submitted:</strong> {{ $item->date_submitted->format('F j, Y') }}</p>
            <p><strong>Status:</strong> {{ $item->status }}</p>

            {{-- Article specific fields --}}
            @if ($type === 'article')
                <p><strong>Category:</strong> {{ $item->category ?? 'N/A' }}</p>
                <p><strong>Thumbnail:</strong></p>
                @if ($item->image_path)
                    <img src="{{ asset('storage/' . $item->image_path) }}" alt="Thumbnail" class="img-fluid mb-3"
                        style="max-height: 250px;">
                @endif
                <p><strong>Content:</strong></p>
                <div class="border p-2 mb-3">{!! nl2br(e($item->description)) !!}</div>
            @endif

            {{-- Media specific fields --}}
            @if ($type === 'media')
                <p><strong>Category:</strong> {{ ucfirst(str_replace('_', ' ', $item->category)) }}</p>

                @if (in_array($item->category, ['Photojournalism', 'Cartooning']))
                    <p><strong>Image:</strong></p>
                    @if ($item->image_path)
                        <img src="{{ asset('storage/' . $item->image_path) }}" alt="Media Image" class="img-fluid mb-3"
                            style="max-height: 250px;">
                    @endif
                @else
                    <p><strong>Link:</strong></p>
                    @if ($item->link)
                        <iframe src="{{ $item->link }}"></iframe>
                    @endif
                @endif
                <p><strong>Description:</strong> {{ $item->description ?? 'No description provided.' }}</p>
            @endif
            <p><strong>Tags:</strong>
                @php
                    $tags = is_array($item->tags) ? $item->tags : json_decode($item->tags, true);
                @endphp

                @if (!empty($tags))
                    @foreach ($tags as $tag)
                        <span class="badge bg-secondary me-1 mb-1">{{ $tag }}</span>
                    @endforeach
                @else
                    None
                @endif
            </p>

			@if($item->status == 'Published')
			<p><strong>Date Published:</strong> {{ $item->date_publish->format('F j, Y') }}</p>
			@endif
			<p><strong>Remarks:</strong> {{ $item->remarks ?? 'N/A' }}</p>

        </div>
		@role('admin')
        @if ($item->status == 'Draft' || $item->status == 'Approved')
            <div class="card-footer">
                <button class="btn btn-lg col-12 btn-info" data-bs-toggle="modal"
                    data-bs-target="#statusModal-{{ $item->id }}">
                    Manage
                </button>
            </div>
        @endif
		@endrole
		@role('eic')
        @if ($item->status == 'Draft')
            <div class="card-footer">
				@if($item->type == 'Article')
                <a href="{{ route('publication-management.article.edit', $item->id) }}" class="btn btn-lg col-12 btn-info text-white">
                    Edit
                </a>
				@endif
				@if($item->type == 'Media')
                <a href="{{ route('publication-management.article.edit', $item->id) }}" class="btn btn-lg col-12 btn-info text-white">
                    Edit
                </a>
				@endif
            </div>
        @endif
		@endrole
    </div>

    <!-- Modal -->
    <div class="modal fade" id="statusModal-{{ $item->id }}" tabindex="-1"
        aria-labelledby="statusModalLabel-{{ $item->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST"
                action="{{ route('publication-management.update-status', ['type' => $item->type, 'id' => $item->id]) }}">
                @csrf
                @method('PUT')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="statusModalLabel-{{ $item->id }}">Manage Status</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="status-{{ $item->id }}" class="form-label">Status</label>
                            <select name="status" id="status-{{ $item->id }}" class="form-select" onchange="toggleFields({{ $item->id }})" required>
								<option value="">-- Select --</option>
								<option value="publish_now">Publish Now</option>
								<option value="schedule_later">Schedule Later</option>
								<option value="Revision">Revision</option>
								<option value="Rejected">Rejected</option>
							</select>

                        </div>

                        <div class="mb-3 d-none" id="publishDate-{{ $item->id }}">
                            <label class="form-label">Publication Date</label>
                            <input type="date" name="date_publish" class="form-control">
                        </div>

						<div class="mb-3 d-none" id="publishTime-{{ $item->id }}">
                            <label class="form-label">Publication Time</label>
                            <input type="time" name="time_publish" class="form-control">
                        </div>

                        <div class="mb-3 d-none" id="remarks-{{ $item->id }}">
                            <label class="form-label">Remarks</label>
                            <textarea name="remarks" class="form-control" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <script>
        function toggleFields(id) {
			const status = document.getElementById('status-' + id).value;
			const publishDate = document.getElementById('publishDate-' + id);
			const publishTime = document.getElementById('publishTime-' + id);
			const remarks = document.getElementById('remarks-' + id);

			if (status === 'publish_now') {
				publishDate.classList.add('d-none');
				publishTime.classList.add('d-none');
				remarks.classList.add('d-none');

				// Set hidden fields or auto-fill date/time
				const form = document.querySelector(`#statusModal-${id} form`);
				const now = new Date();
				let dateInput = form.querySelector('input[name="date_publish"]');
				let timeInput = form.querySelector('input[name="time_publish"]');

				if (!dateInput) {
					dateInput = document.createElement('input');
					dateInput.type = 'hidden';
					dateInput.name = 'date_publish';
					form.appendChild(dateInput);
				}
				if (!timeInput) {
					timeInput = document.createElement('input');
					timeInput.type = 'hidden';
					timeInput.name = 'time_publish';
					form.appendChild(timeInput);
				}

				dateInput.value = now.toISOString().split('T')[0]; // yyyy-mm-dd
				timeInput.value = now.toTimeString().split(' ')[0].slice(0,5); // hh:mm
			} else if (status === 'schedule_later') {
				publishDate.classList.remove('d-none');
				publishTime.classList.remove('d-none');
				remarks.classList.add('d-none');
			} else if (status === 'Revision' || status === 'Rejected') {
				remarks.classList.remove('d-none');
				publishDate.classList.add('d-none');
				publishTime.classList.add('d-none');
			} else {
				publishDate.classList.add('d-none');
				publishTime.classList.add('d-none');
				remarks.classList.add('d-none');
			}
		}

    </script>
@endsection
