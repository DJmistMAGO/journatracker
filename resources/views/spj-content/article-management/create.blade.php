@extends('layouts/contentNavbarLayout')

@section('title', 'SPJ | Article Management')

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/masonry/masonry.js') }}"></script>
@endsection


@section('content')
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">SPJ / Article Management /</span> Write an Article</h4>
    {{-- content --}}
    <div class="card mb-4">
  <div class="card-body">
    <!-- Image Upload -->
    <div class="mb-3 text-center">
        <div class="mt-3">
          <img id="preview" src="#" alt="Image Preview" class="img-fluid d-none rounded" style="max-height: 250px;">
        </div>
      <input class="form-control mt-2" type="file" id="articleImage" accept="image/*" onchange="previewImage(event)">
    </div>

    <div class="row mb-3">
  <!-- Title -->
  <div class="col-12 col-md-6">
    <label for="articleTitle" class="form-label">Article Title</label>
    <input type="text" class="form-control" id="articleTitle" placeholder="Enter article title">
  </div>

  <!-- Category -->
  <div class="col-12 col-md-3">
    <label for="category" class="form-label">Category</label>
    <select class="form-select" id="category">
      <option selected disabled>-- Select Category --</option>
      <option>News</option>
      <option>Features</option>
      <option>Editorial</option>
      <option>Sports</option>
    </select>
  </div>

  <!-- Date -->
  <div class="col-12 col-md-3">
    <label for="articleDate" class="form-label">Date</label>
    <input type="date" class="form-control" id="articleDate">
  </div>
</div>

    <!-- Content -->
    <div class="mb-3">
      <label for="articleContent" class="form-label">Content</label>
      <textarea class="form-control" id="articleContent" rows="5" placeholder="Write your content here..."></textarea>
    </div>


    <!-- Tags -->
    <div class="mb-3">
      <label for="tagInput" class="form-label">Tags</label>
      <div class="input-group">
        <input type="text" id="tagInput" class="form-control" placeholder="Type a tag">
        <button type="button" class="btn btn-outline-primary" onclick="handleAddTag()">Add Tag</button>
      </div>
      <div id="tagsContainer" class="mt-2"></div>
    </div>

    <!-- Submit Button -->
    <div class="text-end">
      <button type="submit" class="btn btn-primary">Submit Article</button>
      <button type="submit" class="btn btn-danger">Cancel</button>
    </div>
  </div>
</div>

    {{-- content end --}}

    <!-- Scripts -->
    <script>
  // Auto set date to today
  document.getElementById('articleDate').value = new Date().toISOString().split('T')[0];

  // Preview Image
  function previewImage(event) {
    const preview = document.getElementById('preview');
    preview.src = URL.createObjectURL(event.target.files[0]);
    preview.classList.remove('d-none');
  }

  // Tags handling
  const tagInput = document.getElementById('tagInput');
  const tagsContainer = document.getElementById('tagsContainer');

  // Add by Enter key
  tagInput.addEventListener('keypress', function (e) {
    if (e.key === 'Enter') {
      e.preventDefault();
      handleAddTag();
    }
  });

  // Add by Button
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
    </script>
@endsection
