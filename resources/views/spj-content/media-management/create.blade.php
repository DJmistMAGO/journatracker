@extends('layouts/contentNavbarLayout')

@section('title', 'SPJ | Media Management')

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/masonry/masonry.js') }}"></script>
@endsection

@section('content')
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">SPJ / Media Management /</span> Add Media</h4>

    <div class="card mb-4">
        <div class="card-body">
            {{-- Validation Errors --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input:
                    <ul class="mb-0 mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('media-management.store') }}" enctype="multipart/form-data" onsubmit="prepareTags()">
                @csrf
                <!-- Media Type -->
                <div class="mb-3 col-12">
                    <label for="mediaType" class="form-label">Select Media Type</label>
                    <select id="mediaType" name="category" class="form-select" required>
                        <option value="">-- Select --</option>
                        <option value="Photojournalism">Photojournal</option>
                        <option value="Cartooning">Cartooning</option>
                        <option value="TV Broadcasting">TV Broadcasting</option>
                        <option value="Radio Broadcasting">Radio Broadcasting</option>
                    </select>
                </div>

				<!-- Image Upload (Photojournalism/Cartooning) -->
                <div class="mb-3 d-none text-center" id="imageField">
                    <div class="mt-3">
                        @if (old('image_path'))
                            <img id="preview" src="{{ asset('storage/' . old('image_path')) }}" alt="Image Preview"
                                class="img-fluid rounded mb-2" style="max-height: 250px;">
                        @else
                            <img id="preview" src="#" alt="Image Preview" class="img-fluid d-none rounded"
                                style="max-height: 250px;">
                        @endif
                    </div>
                    <input class="form-control mt-2" type="file" name="image_path" id="image" accept="image/*"
                        onchange="previewImage(event)">
                </div>

                <!-- Broadcast Link (TV/Radio) -->
                <div class="mb-3 d-none" id="linkField">
                    <label for="link" class="form-label">Video/Audio Link</label>
                    <input type="url" class="form-control" name="link" id="link" value="{{ old('link') }}"
                        placeholder="Enter video or audio link">
                </div>

                <!-- Common Title & Date -->
                <div class="row">
                    <div class="mb-3 col-md-8 col-12">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" name="title" id="title" value="{{ old('title') }}"
                            placeholder="Enter title" required>
                    </div>
                    <div class="mb-3 col-md-4 col-12">
                        <label for="date_submitted" class="form-label">Date</label>
                        <input type="date" class="form-control" name="date_submitted" id="date" value="{{ old('date_submitted') }}"
                            required>
                    </div>
                </div>

                <!-- Description -->
                <div class="mb-3">
                    <label for="description" class="form-label">Description (Optional)</label>
                    <textarea class="form-control" name="description" id="description" rows="3">{{ old('description') }}</textarea>
                </div>



                <!-- Tags -->
                <div class="mb-3">
                    <label for="tagInput" class="form-label">Tags</label>
                    <div class="input-group">
                        <input type="text" id="tagInput" class="form-control" placeholder="Type a tag">
                        <button type="button" class="btn btn-outline-primary" onclick="handleAddTag()">Add Tag</button>
                    </div>
                    <div id="tagsContainer" class="mt-2">
						@if (old('tags'))
							@php
								$tagsOld = old('tags');
								// Ensure $tagsOld is always an array
								if (is_string($tagsOld)) {
									$tagsOld = json_decode($tagsOld, true) ?? [];
								}
							@endphp

							@foreach ($tagsOld as $tag)
								<span class="badge bg-secondary me-2 mb-2">
									{{ $tag }}
									<button type="button" class="btn-close btn-close-white btn-sm ms-1"
										onclick="removeTag(this)"></button>
								</span>
							@endforeach
						@endif
					</div>

                </div>
                <input type="hidden" name="tags" id="tagsHidden">

                <!-- Submit -->
                <div class="mt-3">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Scripts -->
    <script>
        // Preview Image
        function previewImage(event) {
            const preview = document.getElementById('preview');
            preview.src = URL.createObjectURL(event.target.files[0]);
            preview.classList.remove('d-none');
        }

        // media type change
        const mediaType = document.getElementById('mediaType');
        const imageField = document.getElementById('imageField');
        const linkField = document.getElementById('linkField');

        mediaType.addEventListener('change', function() {
            imageField.classList.add('d-none');
            linkField.classList.add('d-none');

            if (this.value === 'Photojournalism' || this.value === 'Cartooning') {
                imageField.classList.remove('d-none');
            } else if (this.value === 'TV Broadcasting' || this.value === 'Radio Broadcasting') {
                linkField.classList.remove('d-none');
            }
        });

        // Tags handling
        const tagInput = document.getElementById('tagInput');
        const tagsContainer = document.getElementById('tagsContainer');
        const tagsHidden = document.getElementById('tagsHidden');

        tagInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                handleAddTag();
            }
        });

        function handleAddTag() {
            const value = tagInput.value.trim();
            if (value !== '') {
                addTag(value);
                tagInput.value = '';
            }
        }

        function addTag(text) {
            const tag = document.createElement('span');
            tag.className = 'badge bg-secondary me-2 mb-2';
            tag.innerHTML = text +
                ' <button type="button" class="btn-close btn-close-white btn-sm ms-1" onclick="removeTag(this)"></button>';
            tagsContainer.appendChild(tag);
        }

        function removeTag(button) {
            button.parentElement.remove();
        }

        function prepareTags() {
            const tags = [];
            document.querySelectorAll('#tagsContainer span').forEach(tag => {
                tags.push(tag.textContent.replace('×', '').trim());
            });
            tagsHidden.value = JSON.stringify(tags);
        }
    </script>
@endsection
