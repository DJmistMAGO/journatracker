@extends('layouts/commonMaster')

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/loader.css') }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">


<style>
  :root {
    --theme-color: #00A23F;
  }

  .btn-theme { background-color: var(--theme-color); border: none; color: #fff; }
  .btn-theme:hover { background-color: #008a36; color: #fff; }
  .btn-outline-theme { border: 1px solid var(--theme-color); color: var(--theme-color); }
  .btn-outline-theme:hover { background-color: var(--theme-color); color: #fff; }

  h2.section-title {
    border-left: 6px solid var(--theme-color);
    padding-left: 12px;
    color: #222;
  }

  .card {
    display: block;
    background-color: #fff;
    border-radius: 0.5rem;
    overflow: hidden;
  }
  .card .card-body {
    padding: 1rem;
  }

  .hero-img {
    height: 400px;
    width: 100%;
    object-fit: cover;
    display: block;
  }
  .card-img-top {
    height: 200px;
    width: 100%;
    object-fit: cover;
    display: block;
  }

  @media (max-width: 575.98px) {
    .hero-img { height: 220px; }
    .card-img-top { height: 140px; }
  }

  @media (min-width: 992px) {
    aside.col-lg-4 {
      position: sticky;
      top: 100px;
    }
  }

  .landing-page {
     background-image: linear-gradient(rgba(22, 97, 14, 0.8), rgba(22, 97, 14, 0.8)), url('{{ asset('assets/img/spj/snhs bg.jpg') }}');
  background-size: cover;
  background-attachment: fixed;
  background-repeat: no-repeat;
  background-position: center;
"
  }
</style>
@endpush

@section('layoutContent')

@include('_partials.loader')

<div class="landing-page">
    <div class="mb-4 sticky-top shadow-sm" style="background-color: #f6bb26; z-index: 1030;">
      <nav class="layout-navbar navbar navbar-expand-xl align-items-center bg-navbar-theme" id="layout-navbar">
        <div class="container-xxl d-flex align-items-center justify-content-center">
          <div class="app-brand demo d-flex align-items-center mt-3">
            <a href="#" class="app-brand-link gap-2">
              <img src="{{ asset('assets/img/spj/schl_logo.png') }}" alt="School Logo" height="50" class="me-2">
              <span class="app-brand-text display-5 fw-bold" style="color:#186309;">Special Program in Journalism</span>
              <img src="{{ asset('assets/img/spj/spj_logo.png') }}" alt="SPJ Logo" height="45" class="ms-2">
            </a>
          </div>
        </div>
      </nav>

      <nav class="navbar navbar-expand-xl mt-2">
        <div class="container-xxl d-flex align-items-center justify-content-center">
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-ex-2">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbar-ex-2">
            <div class="navbar-nav me-auto">
              <a class="nav-item nav-link text-black" href="#">Home</a>
              <a class="nav-item nav-link text-black" href="#">News</a>
              <a class="nav-item nav-link text-black" href="#">Features</a>
              <a class="nav-item nav-link text-black" href="#">Editorial</a>
              <a class="nav-item nav-link text-black" href="#">Column</a>
              <a class="nav-item nav-link text-black" href="#">Sci-Tech</a>
              <ul class="navbar-nav me-auto">
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle text-black" href="#" data-bs-toggle="dropdown">Media</a>
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

    <main class="container-xxl my-5">
    <div class="row g-5">
        <article class="col-lg-8">
            <div class="card w-100">
            <img src="https://picsum.photos/600/400?random=1" class="card-img-top h-20" alt="..." style="height: 300px;" >
                <div class="card-body">
                    <h1 class="fw-bold display-6 mb-2">The Future of Green Technology</h1>
                            <div class="d-flex align-items-center mb-2">
                                <img src="https://picsum.photos/50" alt="Author" class="rounded-circle me-2" width="40" />
                                <small class="text-muted">By Jane Doe • Sept 8, 2025</small>
                            </div>
                </div>
            </div>



      <h2 class="mt-5 mb-3 text-white">Latest Articles</h2>
      <div class="row g-4">
        <div class="col-md-6">
          <div class="card shadow-sm h-100 border-0">
            <img src="https://picsum.photos/600/400?random=1" class="card-img-top" alt="News 1">
            <div class="card-body">
              <h5 class="card-title">Solar Farms Powering Cities</h5>
              <p class="card-text">Entire urban districts are now running on renewable solar energy thanks to massive solar farms.</p>
              <a href="#" class="btn btn-outline-theme btn-sm">Read More</a>
            </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="card shadow-sm h-100 border-0">
            <img src="https://picsum.photos/600/400?random=2" class="card-img-top" alt="News 2">
            <div class="card-body">
              <h5 class="card-title">Electric Cars Beyond 2030</h5>
              <p class="card-text">Governments plan to phase out fossil fuel vehicles in favor of electric alternatives.</p>
              <a href="#" class="btn btn-outline-theme btn-sm">Read More</a>
            </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="card shadow-sm h-100 border-0">
            <img src="https://picsum.photos/600/400?random=3" class="card-img-top" alt="News 3">
            <div class="card-body">
              <h5 class="card-title">Smart Cities of the Future</h5>
              <p class="card-text">Urban landscapes are evolving with green infrastructure and AI-driven planning.</p>
              <a href="#" class="btn btn-outline-theme btn-sm">Read More</a>
            </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="card shadow-sm h-100 border-0">
            <img src="https://picsum.photos/600/400?random=4" class="card-img-top" alt="News 4">
            <div class="card-body">
              <h5 class="card-title">Schools Going Green</h5>
              <p class="card-text">From solar panels to zero-waste programs, schools are leading the eco-friendly movement.</p>
              <a href="#" class="btn btn-outline-theme btn-sm">Read More</a>
            </div>
          </div>
        </div>
      </div>
    </article>

        <!-- Sidebar -->
        <aside class="col-lg-4">
          <!-- Related Articles -->
          <div class="card border-0 shadow-sm mb-4">
            <div class="card-body">
              <h5 class="fw-bold mb-3" style="color: var(--theme-color)">Related Articles</h5>
              <ul class="list-unstyled">
                <li><a href="#" class="text-decoration-none">Sustainable Homes of the Future</a></li>
                <li><a href="#" class="text-decoration-none">Electric Cars: Beyond 2030</a></li>
                <li><a href="#" class="text-decoration-none">How Schools Go Green</a></li>
              </ul>
            </div>
          </div>

          <!-- Popular Tags -->
          <div class="card border-0 shadow-sm mb-4">
            <div class="card-body">
              <h5 class="fw-bold mb-3" style="color: var(--theme-color)">Popular Tags</h5>
              <span class="badge bg-secondary me-1">GreenTech</span>
              <span class="badge bg-secondary me-1">Renewable</span>
              <span class="badge bg-secondary me-1">Sustainability</span>
              <span class="badge bg-secondary me-1">Climate</span>
            </div>
          </div>

          <!-- Share Buttons -->
          <div class="card border-0 shadow-sm mb-4">
            <div class="card-body text-center">
              <h5 class="fw-bold mb-3" style="color: var(--theme-color)">Share This</h5>
              <a href="#" class="btn btn-outline-theme btn-sm me-2"><i class="ti ti-brand-facebook"></i></a>
              <a href="#" class="btn btn-outline-theme btn-sm me-2"><i class="ti ti-brand-twitter"></i></a>
              <a href="#" class="btn btn-outline-theme btn-sm"><i class="ti ti-brand-linkedin"></i></a>
            </div>
          </div>

          <!-- Newsletter Subscription -->
          <div class="card border-0 shadow-sm">
            <div class="card-body text-center">
              <h5 class="fw-bold mb-3" style="color: var(--theme-color)">Subscribe</h5>
              <form>
                <input type="email" class="form-control mb-2" placeholder="Your email" />
                <button type="submit" class="btn btn-theme w-100">Subscribe</button>
              </form>
            </div>
          </div>
        </aside>
      </div>
    </main>

    @include('layouts.sections.footer.footer')

    @push('scripts')
    <script src="{{ asset('assets/js/loader.js') }}"></script>
    <script src="{{ asset('assets/js/updateTime.js') }}"></script>

    </script>
</div>

@endpush

@endsection
