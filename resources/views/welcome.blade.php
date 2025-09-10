@extends('layouts/commonMaster')

@section('layoutContent')

<!-- Content -->
<!-- Materio Compliant Header -->
<div class="mb-4 sticky-top shadow-sm" style="background-color: white; z-index: 1030;">

  <!-- Row 1: Brand -->
  <nav class="layout-navbar navbar navbar-expand-xl align-items-center bg-navbar-theme mt-2" id="layout-navbar">
    <div class="container-xxl d-flex align-items-center justify-content-center">
      <div class="app-brand demo d-flex align-items-center mt-3">
        <a href="#" class="app-brand-link gap-2">
          <img src="{{ asset('assets/img/spj/schl_logo.png') }}" alt="School Logo" height="50" class="me-2">
          <span class="app-brand-text display-5 fw-bold" style="color: #16610e">Special Program in Journalism</span>
          <img src="{{ asset('assets/img/spj/spj_logo.png') }}" alt="SPJ Logo" height="45" class="ms-2">
        </a>
      </div>
    </div>
  </nav>

  <!-- Row 2: Nav Links -->
  <nav class="navbar navbar-expand-xl mt-2">
    <div class="container-xxl d-flex align-items-center justify-content-center">

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-ex-2">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbar-ex-2">
        <div class="navbar-nav me-auto">
          <a class="nav-item nav-link" href="#">Home</a>
          <a class="nav-item nav-link" href="#">News</a>
          <a class="nav-item nav-link" href="#">Features</a>
          <a class="nav-item nav-link" href="#">Editorial</a>
          <a class="nav-item nav-link" href="#">Column</a>
          <a class="nav-item nav-link" href="#">Sci-Tech</a>
          <ul class="navbar-nav me-auto">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Media</a>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="#">Editorial Cartooning</a>
                <a class="dropdown-item" href="#">Photojournalism</a>
                <a class="dropdown-item" href="#">Radio Broadcasting</a>
                <a class="dropdown-item" href="#">TV Broadcasting</a>
              </div>
            </li>
          </ul>
        </div>

        <span class="navbar-text">
          <div id="datetime" style="color: black;"></div>
        </span>
      </div>
    </div>
  </nav>
</div>





<!-- Hero Section -->
<section class="container mt-2 mb-5">
  <div class="card border-0 shadow-sm">
    <img src="https://picsum.photos/1200/400" class="card-img-top rounded-3" alt="Hero Image" height="280">
    <a href="">
<div class="card-body py-4 px-4">
      <h1 class="display-6 fw-bold mb-3">The Future of Green Technology</h1>
      {{-- <p class="lead text-muted mb-4">How innovations in renewable energy are reshaping the world we live in.</p> --}}
      <div class="d-flex align-items-center mb-4">
        <img src="https://picsum.photos/50" alt="Author" class="rounded-circle me-2" width="40" />
        <small class="text-muted">By Jane Doe • Sept 8, 2025</small>
      </div>
      {{-- <a href="#content" class="btn btn-primary">Continue Reading</a> --}}
    </div>
    </a>

  </div>
</section>

<!-- Main Content + Sidebar -->
<main class="container mb-5" id="content">
  <div class="row">
    <div class="col-lg-12">
      <h2 class="fw-bold display-6">Latest Articles</h2>
      <div class="row">
        <div class="col-sm-3">
          <div class="card">
            <img src="https://picsum.photos/1200/400" class="card-img-top" alt="..." height="150">
            <div class="card-body">
              <a href="#"><h5 class="card-title">Israel launches strike on target in Qatar</h5></a>
            </div>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="card">
            <img src="https://picsum.photos/1200/400" class="card-img-top" alt="..." height="150">
            <div class="card-body">
              <a href="#"><h5 class="card-title">Kanlaon Volcano emits ash; Alert Level 2 remains</h5></a>
            </div>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="card">
            <img src="https://picsum.photos/1200/400" class="card-img-top" alt="..." height="150">
            <div class="card-body">
              <a href="#"><h5 class="card-title">Jinggoy Estrada, Joel Villanueva in flood control</h5></a>
            </div>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="card">
            <img src="https://picsum.photos/1200/400" class="card-img-top" alt="..." height="150">
            <div class="card-body">
              <a href="#"><h5 class="card-title">Jinggoy Estrada denies links to flood control projects</h5></a>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <a href="" class="btn btn-sm mt-3" style="background-color: #1f4920; color: white;">VIEW MORE ➤ </a>
        </div>
      </div>
    </div>
  </div>

  <div class="row mt-4">
    <div class="col-lg-12">
      <h2 class="fw-bold display-6">Top News</h2>
      <div class="row">
        <div class="col-sm-3">
          <div class="card">
            <img src="https://picsum.photos/1200/400" class="card-img-top" alt="..." height="150">
            <div class="card-body">
              <a href="#"><h5 class="card-title">Israel launches strike on target in Qatar</h5></a>
              {{-- <p class="card-text">Some quick example text to build on.</p> --}}
              {{-- <a href="#" class="btn btn-primary">Read More</a> --}}
            </div>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="card">
            <img src="https://picsum.photos/1200/400" class="card-img-top" alt="..." height="150">
            <div class="card-body">
              <a href="#"><h5 class="card-title">Kanlaon Volcano emits ash; Alert Level 2 remains</h5></a>
            </div>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="card">
            <img src="https://picsum.photos/1200/400" class="card-img-top" alt="..." height="150">
            <div class="card-body">
              <a href="#"><h5 class="card-title">Jinggoy Estrada, Joel Villanueva in flood control</h5></a>
              {{-- <p class="card-text">Some quick example text to build on.</p> --}}
              {{-- <a href="#" class="btn btn-primary">Read More</a> --}}
            </div>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="card">
            <img src="https://picsum.photos/1200/400" class="card-img-top" alt="..." height="150">
            <div class="card-body">
              <a href="#"><h5 class="card-title">Jinggoy Estrada denies links to flood control projects</h5></a>
              {{-- <p class="card-text">Some quick example text to build on.</p> --}}
              {{-- <a href="#" class="btn btn-primary">Read More</a> --}}
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <a href="" class="btn btn-sm mt-3" style="background-color: #1f4920; color: white;">VIEW MORE ➤ </a>
        </div>
      </div>
    </div>
  </div>

  <div class="row mt-4">
    <div class="col-lg-12">
      <h2 class="fw-bold display-6">Gallery of the Month</h2>
      <div class="row">
        <div class="col-sm-3">
          <div class="card">
            <img src="https://picsum.photos/1200/400" class="card-img-top" alt="..." height="150">
            <div class="card-body">
              <a href="#"><h5 class="card-title">Israel launches strike on target in Qatar</h5></a>
              {{-- <p class="card-text">Some quick example text to build on.</p> --}}
              {{-- <a href="#" class="btn btn-primary">Read More</a> --}}
            </div>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="card">
            <img src="https://picsum.photos/1200/400" class="card-img-top" alt="..." height="150">
            <div class="card-body">
              <a href="#"><h5 class="card-title">Kanlaon Volcano emits ash; Alert Level 2 remains</h5></a>
            </div>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="card">
            <img src="https://picsum.photos/1200/400" class="card-img-top" alt="..." height="150">
            <div class="card-body">
              <a href="#"><h5 class="card-title">Jinggoy Estrada, Joel Villanueva in flood control</h5></a>
              {{-- <p class="card-text">Some quick example text to build on.</p> --}}
              {{-- <a href="#" class="btn btn-primary">Read More</a> --}}
            </div>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="card">
            <img src="https://picsum.photos/1200/400" class="card-img-top" alt="..." height="150">
            <div class="card-body">
              <a href="#"><h5 class="card-title">Jinggoy Estrada denies links to flood control projects</h5></a>
              {{-- <p class="card-text">Some quick example text to build on.</p> --}}
              {{-- <a href="#" class="btn btn-primary">Read More</a> --}}
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <a href="" class="btn btn-sm mt-3" style="background-color: #1f4920; color: white;">VIEW MORE ➤ </a>
        </div>
      </div>
    </div>
  </div>
</main>

<!-- Footer -->
@include('layouts.sections.footer.footer')

<script>
    function updateDateTime() {
      const options = {
        timeZone: 'Asia/Manila',
        weekday: 'long',
        year: 'numeric',
        month: 'long',
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit',
        second: '2-digit'
      };
      const now = new Date().toLocaleString('en-PH', options);
      document.getElementById('datetime').textContent = now;
    }

    // Update every second
    setInterval(updateDateTime, 1000);
    updateDateTime();
  </script>
  <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
@endsection
