@extends('layouts/contentNavbarLayout')

@section('title', 'SPJ | Article Management')

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/masonry/masonry.js') }}"></script>
@endsection

@section('content')
<h4 class="py-3 mb-4"><span class="text-muted fw-light">SPJ / Article Management /</span> Write an Article</h4>

<div class="card mb-4">
  <div class="card-body">
    <form action="{{ route('article-management.store') }}" method="POST" enctype="multipart/form-data" onsubmit="prepareTags()">
      @csrf
      @include('_partials.errors')

      <!-- Image Upload -->
      <div class="mb-3 text-center">
        <div class="mt-3">
          @if(old('thumbnail_image'))
            <img id="preview" src="{{ asset('storage/' . old('thumbnail_image')) }}" alt="Image Preview" class="img-fluid rounded mb-2" style="max-height: 250px;">
          @else
            <img id="preview" src="#" alt="Image Preview" class="img-fluid d-none rounded" style="max-height: 250px;">
          @endif
        </div>
        <input class="form-control mt-2" type="file" name="thumbnail_image" id="articleImage" accept="image/*" onchange="previewImage(event)">
      </div>

      <div class="row mb-3">
        <!-- Title -->
        <div class="col-12 col-md-6">
          <label for="articleTitle" class="form-label">Article Title</label>
          <input type="text" class="form-control" id="articleTitle" name="title_article"
                 value="{{ old('title_article') }}" placeholder="Enter article title" required>
        </div>

        <!-- Category -->
        <div class="col-12 col-md-3">
          <label for="category" class="form-label">Category</label>
          <select class="form-select" id="category" name="category" required>
            <option disabled {{ old('category') ? '' : 'selected' }}>-- Select Category --</option>
            <option value="News" {{ old('category') == 'News' ? 'selected' : '' }}>News</option>
            <option value="Features" {{ old('category') == 'Features' ? 'selected' : '' }}>Features</option>
            <option value="Editorial" {{ old('category') == 'Editorial' ? 'selected' : '' }}>Editorial</option>
            <option value="Sports" {{ old('category') == 'Sports' ? 'selected' : '' }}>Sports</option>
			<option value="Column" {{ old('category') == 'Column' ? 'selected' : '' }}>Column</option>
			<option value="Sci-Tech" {{ old('category') == 'Sci-Tech' ? 'selected' : '' }}>Sci-Tech</option>
          </select>
        </div>

        <!-- Date -->
        <div class="col-12 col-md-3">
          <label for="articleDate" class="form-label">Date</label>
          <input type="date" class="form-control" id="articleDate" value="{{ old('date_written', date('Y-m-d')) }}" name="date_written" required>

        </div>
      </div>

      <!-- Content -->
      <div class="mb-3">
        <label for="articleContent" class="form-label">Content</label>
        <textarea class="form-control" id="articleContent" name="article_content" rows="5" placeholder="Write your content here..." required>{{ old('article_content') }}</textarea>
      </div>

      <!-- Tags -->
      <div class="mb-3">
        <label for="tagInput" class="form-label">Tags</label>
        <div class="input-group">
          <input type="text" id="tagInput" class="form-control" placeholder="Type a tag">
          <button type="button" class="btn btn-outline-primary" onclick="handleAddTag()">Add Tag</button>
        </div>

        <div id="tagsContainer" class="mt-2">
          @if(old('tags'))
            @foreach(json_decode(old('tags'), true) as $tag)
              <span class="badge bg-secondary me-2 mb-2">
                {{ $tag }}
                <button type="button" class="btn-close btn-close-white btn-sm ms-1" onclick="removeTag(this)"></button>
              </span>
            @endforeach
          @endif
        </div>
      </div>

      <!-- Hidden input to store tags as JSON -->
      <input type="hidden" name="tags" id="tagsField">

      <!-- Submit Button -->
      <div class="text-end">
        <button type="submit" class="btn btn-primary">Submit Article</button>
        <a href="{{ route('article-management') }}" class="btn btn-danger">Cancel</a>
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

  // Tags handling
  const tagInput = document.getElementById('tagInput');
  const tagsContainer = document.getElementById('tagsContainer');
  const tagsField = document.getElementById('tagsField');

  // Add tag by Enter key
  tagInput.addEventListener('keypress', function (e) {
    if (e.key === 'Enter') {
      e.preventDefault();
      handleAddTag();
    }
  });

  // Add tag by button
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
    tag.innerHTML = text + ' <button type="button" class="btn-close btn-close-white btn-sm ms-1" onclick="removeTag(this)"></button>';
    tagsContainer.appendChild(tag);
  }

  function removeTag(button) {
    button.parentElement.remove();
  }

  // Prepare tags JSON before submitting
  function prepareTags() {
    const tags = [];
    document.querySelectorAll('#tagsContainer span').forEach(tag => {
      tags.push(tag.textContent.replace('×','').trim());
    });
    document.getElementById('tagsField').value = JSON.stringify(tags);
  }

  // Set today's date only if no old value exists
//   const dateInput = document.getElementById('articleDate');
//   if (!dateInput.value) {
//     dateInput.value = new Date().toISOString().split('T')[0];
//   }
</script>

@endsection
