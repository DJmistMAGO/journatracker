@extends('layouts/commonMaster' )

@section('layoutContent')

<!-- Content -->
@yield('content')
    <header class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <a class="navbar-brand" href="#">MyBlog</a>
        <div class="collapse navbar-collapse">
        <ul class="navbar-nav mx-auto">
            <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Categories</a></li>
            <li class="nav-item"><a class="nav-link" href="#">About</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Contact</a></li>
        </ul>
        <div class="navbar-nav">
            <a class="nav-link" href="#"><i class="ti ti-search"></i></a>

            <a class="nav-link" href="#"><img src="avatar.png" alt="User" class="avatar-sm rounded-circle" /></a>
        </div>
        </div>
    </header>
    {{-- @include('layouts.sections.navbar.navbar') --}}

  <!-- Hero Section -->
  <section class="container my-5">
    <div class="card py-5 px-4 border-0 shadow-sm">
      <h1 class="display-4 mb-3">This is Your Article Title</h1>
      <p class="lead text-muted mb-4">A concise and inviting summary to draw readers in.</p>
      <div class="d-flex align-items-center mb-4">
        <img src="author.jpg" alt="Author" class="rounded-circle me-2" width="40" />
        <small class="text-muted">By Jane Doe • Sept 8, 2025</small>
      </div>
      <a href="#content" class="btn btn-primary">Continue Reading</a>
    </div>
  </section>

  <!-- Main Content + Sidebar -->
  <main class="container mb-5" id="content">
    <div class="row">
      <article class="col-lg-8">
        <h2>Subheading</h2>
        <p>Lead and other content, styled cleanly and readable.</p>
        <blockquote class="blockquote px-3 py-2 bg-light border-start">
          "A highlighted blockquote emphasizing key points."
        </blockquote>
        <h3>Another Subheading</h3>
        <p>Further content, maybe with an image:</p>
        <figure class="figure">
          <img src="image.jpg" class="figure-img img-fluid rounded" alt="Captioned Image" />
          <figcaption class="figure-caption text-muted">Image caption here</figcaption>
        </figure>
      </article>

      <aside class="col-lg-4">
        <div class="card mb-4 shadow-sm">
          <div class="card-body">
            <h5>Related Posts</h5>
            <ul class="list-unstyled">
              <li><a href="#">Another blog post title</a></li>
              <li><a href="#">Yet another article</a></li>
              <li><a href="#">More posts to explore</a></li>
            </ul>
          </div>
        </div>
        <div class="card mb-4 shadow-sm">
          <div class="card-body">
            <h5>Tags</h5>
            <span class="badge bg-secondary me-1">Design</span>
            <span class="badge bg-secondary me-1">Development</span>
            <span class="badge bg-secondary me-1">UI</span>
          </div>
        </div>
        <div class="card mb-4 shadow-sm">
          <div class="card-body text-center">
            <h5>Share this</h5>
            <a href="#" class="me-2"><i class="icon-facebook"></i></a>
            <a href="#" class="me-2"><i class="icon-twitter"></i></a>
            <a href="#"><i class="icon-linkedin"></i></a>
          </div>
        </div>
        <div class="card mb-4 shadow-sm">
          <div class="card-body text-center">
            <h5>Subscribe to our newsletter</h5>
            <form>
              <input type="email" class="form-control mb-2" placeholder="Your email" />
              <button type="submit" class="btn btn-primary w-100">Subscribe</button>
            </form>
          </div>
        </div>
      </aside>
    </div>
  </main>

  <!-- Footer -->
  {{-- <footer class="bg-white py-4 shadow-sm">
    <div class="container d-flex flex-column flex-md-row justify-content-between align-items-center">
      <p class="mb-1 mb-md-0">&copy; 2025 MyBlog. All rights reserved.</p>
      <div>
        <a class="text-decoration-none me-3" href="#">Privacy Policy</a>
        <a class="text-decoration-none me-3" href="#">Terms</a>
        <a class="text-decoration-none" href="#">Contact</a>
      </div>
    </div>
  </footer> --}}
<!--/ Content -->

@include('layouts.sections.footer.footer')

@endsection
