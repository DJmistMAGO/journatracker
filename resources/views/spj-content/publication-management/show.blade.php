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
                @if ($item->status == 'Draft')
                    <a href="{{ route('publication-management.index') }}" class="btn btn-primary btn-sm">
                        <i class="mdi mdi-arrow-left me-1"></i> Back to List
                    </a>
                @else
                    <a href="{{ route('archive') }}" class="btn btn-primary btn-sm">
                        <i class="mdi mdi-arrow-left me-1"></i> Back to List
                    </a>
                @endif

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

        </div>
        @if ($item->status == 'Draft')
            <div class="card-footer">
                <button class="btn btn-lg col-12 btn-info" data-bs-toggle="modal"
                    data-bs-target="#statusModal-{{ $item->id }}">
                    Manage
                </button>
            </div>
        @endif
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
                            <select name="status" id="status-{{ $item->id }}" class="form-select"
                                onchange="toggleFields({{ $item->id }})" required>
                                <option value="">-- Select --</option>
                                <option value="Published">Published</option>
                                <option value="Revision">Revision</option>
                                <option value="Rejected">Rejected</option>
                            </select>
                        </div>

                        <div class="mb-3 d-none" id="publishDate-{{ $item->id }}">
                            <label class="form-label">Publication Date</label>
                            <input type="date" name="date_publish" class="form-control">
                        </div>

                        <div class="mb-3 d-none" id="remarks-{{ $item->id }}">
                            <label class="form-label">Remarks</label>
                            <textarea name="remarks" class="form-control" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <script>
        function toggleFields(id) {
            const status = document.getElementById('status-' + id).value;
            const publishDate = document.getElementById('publishDate-' + id);
            const remarks = document.getElementById('remarks-' + id);

            if (status === 'Published') {
                publishDate.classList.remove('d-none');
                remarks.classList.add('d-none');
            } else if (status === 'Revision' || status === 'Rejected') {
                remarks.classList.remove('d-none');
                publishDate.classList.add('d-none');
            } else {
                publishDate.classList.add('d-none');
                remarks.classList.add('d-none');
            }
        }
    </script>
@endsection
