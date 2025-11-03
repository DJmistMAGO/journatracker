@extends('layouts/contentNavbarLayout')

@section('title', 'SPJ | Article Management')

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/masonry/masonry.js') }}"></script>
@endsection

@section('content')
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">SPJ / Article Management /</span> Edit Article</h4>

    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('article-management.update', $article->id) }}" method="POST" enctype="multipart/form-data"
                onsubmit="prepareTags()">
                @csrf
                @method('PUT')
                @include('_partials.errors')

                <!-- Image Upload -->
                <div class="mb-3 text-center">
                    @if ($article->image_path)
                        <div class="mt-3">
                            <img id="preview" src="{{ asset('storage/' . $article->image_path) }}" alt="Image Preview"
                                class="img-fluid rounded" style="max-height: 250px;">
                        </div>
                    @else
                        <div class="mt-3">
                            <img id="preview" src="#" alt="Image Preview" class="img-fluid d-none rounded"
                                style="max-height: 250px;">
                        </div>
                    @endif
                    <input class="form-control mt-2" type="file" name="image_path" id="articleImage" accept="image/*"
                        onchange="previewImage(event)">
                </div>

                <div class="row mb-3">
                    <!-- Title -->
                    <div class="col-12 col-md-6">
                        <label for="articleTitle" class="form-label">Article Title</label>
                        <input type="text" class="form-control" id="articleTitle" name="title"
                            value="{{ old('title', $article->title) }}" placeholder="Enter article title" required>
                    </div>

                    <!-- Category -->
                    <div class="col-12 col-md-3">
                        <label for="category" class="form-label">Category</label>
                        <select class="form-select" id="category" name="category" required>
                            <option disabled>-- Select Category --</option>
                            <option value="News" {{ old('category', $article->category) == 'News' ? 'selected' : '' }}>News</option>
                            <option value="Features" {{ old('category', $article->category) == 'Features' ? 'selected' : '' }}>Features</option>
                            <option value="Editorial" {{ old('category', $article->category) == 'Editorial' ? 'selected' : '' }}>Editorial</option>
                            <option value="Sports" {{ old('category', $article->category) == 'Sports' ? 'selected' : '' }}>Sports</option>
                            <option value="Column" {{ old('category', $article->category) == 'Column' ? 'selected' : '' }}>Column</option>
                            <option value="Sci-Tech" {{ old('category', $article->category) == 'Sci-Tech' ? 'selected' : '' }}>Sci-Tech</option>
                        </select>
                    </div>

                    <!-- Date -->
                    <div class="col-12 col-md-3">
                        <label for="articleDate" class="form-label">Date</label>
                        <input type="date" class="form-control" id="articleDate" name="date_submitted"
                            value="{{ old('date_submitted', $article->date_submitted?->format('Y-m-d')) }}" required>
                    </div>
                </div>

                <!-- Content (Rich Text Editor) -->
                <div class="mb-3">
                    <label for="description" class="form-label">Article Content</label>
                    <x-trix-input
                        id="description"
                        name="description"
                        :value="old('description', (string) $article->description)"
                    />
                    @error('description')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Tags -->
                <div class="mb-3">
                    <label for="tagInput" class="form-label">Tags</label>
                    <div class="input-group">
                        <input type="text" id="tagInput" class="form-control" placeholder="Type a tag">
                        <button type="button" class="btn btn-outline-primary" onclick="handleAddTag()">Add Tag</button>
                    </div>
                    <div id="tagsContainer" class="mt-2">
                        @php
                            $existingTags = old('tags') ? json_decode(old('tags'), true) : $article->tags;
                        @endphp
                        @if (!empty($existingTags))
                            @foreach ($existingTags as $tag)
                                <span class="badge bg-secondary me-2 mb-2">
                                    {{ $tag }}
                                    <button type="button" class="btn-close btn-close-white btn-sm ms-1"
                                        onclick="removeTag(this)"></button>
                                </span>
                            @endforeach
                        @endif
                    </div>
					<span class="form-text">Press Enter or click "Add Tag" to add a tag.</span>

                </div>

                <input type="hidden" name="tags" id="tagsField">

                <div class="text-end">
                    <button type="submit" class="btn btn-primary">Update Article</button>
                    <a href="{{ url()->previous() }}" class="btn btn-danger">Cancel</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        function previewImage(event) {
            const preview = document.getElementById('preview');
            preview.src = URL.createObjectURL(event.target.files[0]);
            preview.classList.remove('d-none');
        }

        const tagInput = document.getElementById('tagInput');
        const tagsContainer = document.getElementById('tagsContainer');
        const tagsField = document.getElementById('tagsField');

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
            document.getElementById('tagsField').value = JSON.stringify(tags);
        }
    </script>
@endsection
