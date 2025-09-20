@extends('layouts/contentNavbarLayout')

@section('title', 'SPJ | Publication Management')

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/masonry/masonry.js') }}"></script>
@endsection

@section('content')
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">SPJ / Publication Management </h4>

    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div class="card-title">
                <h4 class="mb-0">{{ $item['title'] }}</h4>
            </div>
            <div class="back-button">
                <a href="{{ route('publication-management.index') }}" class="btn btn-primary btn-sm">
                    <i class="mdi mdi-arrow-left me-1"></i> Back to List
                </a>
            </div>
        </div>

        <div class="card-body">
            <p><strong>Type:</strong> {{ $item['type'] }}</p>
            <p><strong>Author:</strong> {{ $item['author'] }}</p>
            <p><strong>Date:</strong> {{ $item['date'] }}</p>
            <p><strong>Status:</strong> {{ $item['status'] }}</p>

            {{-- Article specific fields --}}
            @if ($type === 'article')
                <p><strong>Category:</strong> {{ $item['category'] ?? 'N/A' }}</p>
                <p><strong>Thumbnail:</strong></p>
                @if ($item['thumbnail'])
                    <img src="{{ asset('storage/' . $item['thumbnail']) }}" alt="Thumbnail" class="img-fluid mb-3"
                        style="max-height: 250px;">
                @endif
                <p><strong>Content:</strong></p>
                <div class="border p-2 mb-3">{!! nl2br(e($item['content'])) !!}</div>
            @endif

            {{-- Media specific fields --}}
            @if ($type === 'media')
                <p><strong>Media Type:</strong> {{ ucfirst(str_replace('_', ' ', $item['media_type'])) }}</p>

                @if (in_array($item['media_type'], ['photojournalism', 'cartooning']))
                    <p><strong>Image:</strong></p>
                    @if ($item['image_path'])
                        <img src="{{ asset('storage/' . $item['image_path']) }}" alt="Media Image" class="img-fluid mb-3"
                            style="max-height: 250px;">
                    @endif
                @else
                    <p><strong>Link:</strong></p>
                    @if ($item['link'])
                        <iframe src="{{ $item['link'] }}"></iframe>
                    @endif
                @endif
                <p><strong>Description:</strong> {{ $item['description'] ?? 'No description provided.' }}</p>
            @endif
            <p><strong>Tags:</strong>
                @if (!empty($item['tags']))
                    @foreach ($item['tags'] as $tag)
                        <span class="badge bg-secondary me-1 mb-1">{{ $tag }}</span>
                    @endforeach
                @else
                    None
                @endif
            </p>
        </div>
        <div class="card-footer">
            <button class="btn btn-lg col-12 btn-info" data-bs-toggle="modal"
                data-bs-target="#statusModal-{{ $item['id'] }}">
                Manage
            </button>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="statusModal-{{ $item['id'] }}" tabindex="-1"
        aria-labelledby="statusModalLabel-{{ $item['id'] }}" aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST" action="">
                @csrf
                @method('PATCH')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="statusModalLabel-{{ $item['id'] }}">Manage Status</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="status-{{ $item['id'] }}" class="form-label">Status</label>
                            <select name="status" id="status-{{ $item['id'] }}" class="form-select"
                                onchange="toggleFields({{ $item['id'] }})" required>
                                <option value="">-- Select --</option>
                                <option value="publish">Publish</option>
                                <option value="revision">Revision</option>
                                <option value="declined">Declined</option>
                            </select>
                        </div>

                        <div class="mb-3 d-none" id="publishDate-{{ $item['id'] }}">
                            <label class="form-label">Publication Date</label>
                            <input type="date" name="publish_date" class="form-control">
                        </div>

                        <div class="mb-3 d-none" id="remarks-{{ $item['id'] }}">
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

            if (status === 'publish') {
                publishDate.classList.remove('d-none');
                remarks.classList.add('d-none');
            } else if (status === 'revision' || status === 'declined') {
                remarks.classList.remove('d-none');
                publishDate.classList.add('d-none');
            } else {
                publishDate.classList.add('d-none');
                remarks.classList.add('d-none');
            }
        }
    </script>
@endsection
