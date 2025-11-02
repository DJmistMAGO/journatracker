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
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            {{-- Header Section --}}
            <div class="p-4" style="background-color: #D6EFD8;">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span class="badge px-3 py-2 rounded-pill text-white"
                        style="
							background-color:
							@if ($item->status === 'Draft') #6c757d;      /* gray */
							@elseif ($item->status === 'Approved') #80AF81; /* light green */
							@elseif ($item->status === 'Published') #1A5319; /* dark green */
							@elseif ($item->status === 'Revision') #ffc107; /* yellow */
							@elseif ($item->status === 'Rejected') #dc3545; /* red */
							@elseif ($item->status === 'Scheduled') #508D4E; /* mid green */
							@else #17a2b8; /* info blue */ @endif
						">
                        {{ ucfirst($item->status) }}
                    </span>

                    <a href="{{ route('publication-management.index') }}"
                        class="btn btn-sm px-3 py-2 text-white fw-semibold btn-primary" style="border-radius: 50px;">
                        <i class="mdi mdi-arrow-left me-1"></i> Back
                    </a>
                </div>

                <h2 class="fw-bold mb-1" style="color: #1A5319;">{{ $item->title ?? 'Untitled' }}</h2>
                <div class="text-black small">
                    <span><i class="mdi mdi-account me-1"></i>Author: {{ $item->user->name }}</span> •
                    <span><i class="mdi mdi-calendar me-1"></i>Date submitted:
                        {{ $item->date_submitted->format('F j, Y') }}</span>
                </div>
            </div>

            {{-- Body Section --}}
            <div class="card-body p-4">

                {{-- Type Badge --}}
                <div class="mb-3">
                    <span class="badge rounded-pill px-3 py-2 text-white bg-primary">
                        {{ ucfirst($item->type) }}
                    </span>
                </div>

                {{-- Article-specific Content --}}
                @if ($type === 'article')
                    <div class="mb-3">
                        <p class="mb-1 text-muted text-uppercase fw-semibold small">Category</p>
                        <p class="fw-medium">{{ $item->category ?? 'N/A' }}</p>
                    </div>

                    @if ($item->image_path)
                        <div class="mb-4 text-center">
                            <img src="{{ asset('storage/' . $item->image_path) }}" alt="Thumbnail"
                                class="img-fluid rounded-4 shadow-sm" style="max-height: 350px; object-fit: cover;">
                        </div>
                    @endif

                    <div class="border-start border-4 ps-3 mb-4" style="border-color: #80AF81;">
                        <div class="trix-content">
                            {!! $item->description !!}
                        </div>
                    </div>
                @endif

                {{-- Media-specific Content --}}
                @if ($type === 'media')
                    <div class="mb-3">
                        <p class="mb-1 text-muted text-uppercase fw-semibold small">Category</p>
                        <p class="fw-medium">{{ ucfirst(str_replace('_', ' ', $item->category)) }}</p>
                    </div>

                    @if (in_array($item->category, ['Photojournalism', 'Cartooning']))
                        @if ($item->image_path)
                            <div class="text-center mb-4">
                                <img src="{{ asset('storage/' . $item->image_path) }}" alt="Media Image"
                                    class="img-fluid rounded-4 shadow-sm" style="max-height: 350px; object-fit: cover;">
                            </div>
                        @endif
                    @else
                        @if ($item->link)
                            <div class="ratio ratio-16x9 mb-4 rounded-4 overflow-hidden">
                                <iframe src="{{ $item->link }}" frameborder="0" allowfullscreen></iframe>
                            </div>
                        @endif
                    @endif

                    <div class="lh-lg" style="color: #1A5319;">
                        {{ $item->description ?? 'No description provided.' }}
                    </div>
                @endif

                {{-- Tags --}}
                <div class="mt-4">
                    <p class="mb-2 text-muted text-uppercase fw-semibold small">Tags</p>
                    @php
                        $tags = is_array($item->tags) ? $item->tags : json_decode($item->tags, true);
                    @endphp
                    @if (!empty($tags))
                        @foreach ($tags as $tag)
                            <span class="badge rounded-pill me-1 mb-1 text-white bg-primary">
                                {{ $tag }}
                            </span>
                        @endforeach
                    @else
                        <span class="text-muted">None</span>
                    @endif
                </div>

                {{-- Publication Info --}}
                @if ($item->status == 'Published')
                    <div class="mt-4 text-muted small">
                        <i class="mdi mdi-calendar-check me-1"></i>
                        Published on {{ $item->date_publish->format('F j, Y') }}
                    </div>
                @endif

                {{-- Remarks --}}
                <div class="mt-3">
                    <p class="mb-1 text text-uppercase fw-semibold small text-warning">Remarks</p>
                    <p class="fw-medium">{{ $item->remarks ?? 'N/A' }}</p>
                </div>
            </div>

            {{-- Footer Actions --}}
            @role('admin')
                @if ($item->status == 'For Publish')
                    <div class="card-footer bg-light border-0">
                        <button class="btn btn-lg w-100 text-white" style="background-color: #508D4E;" data-bs-toggle="modal"
                            data-bs-target="#statusModal-{{ $item->id }}">
                            <i class="mdi mdi-cog me-1"></i> Manage
                        </button>
                    </div>
                @endif
            @endrole

            @role('eic')
                @if ($item->status == 'Submitted' || $item->status == 'Resubmitted')
                    <div class="card-footer bg-light border-0">
                        @if ($item->type == 'Article')
                            <a href="{{ route('publication-management.article.edit', $item->id) }}"
                                class="btn btn-lg w-100 text-white" style="background-color: #508D4E;">
                                <i class="mdi mdi-pencil me-1"></i> Review Article
                            </a>
                        @endif
                        @if ($item->type == 'Media')
                            <a href="{{ route('publication-management.media.edit', $item->id) }}"
                                class="btn btn-lg w-100 text-white" style="background-color: #508D4E;">
                                <i class="mdi mdi-pencil me-1"></i> Review Media
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
                                <select name="status" id="status-{{ $item->id }}" class="form-select"
                                    onchange="toggleFields({{ $item->id }})" required>
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
                    timeInput.value = now.toTimeString().split(' ')[0].slice(0, 5); // hh:mm
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
