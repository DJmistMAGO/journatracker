<!-- Footer-->
<footer class="content-footer footer bg-white border-top">
  <div class="container py-4">
    <div class="row align-items-center text-center text-md-start">

      <!-- Member Portal Button -->
      <div class="col-12 col-md-4 mb-3 mb-md-0 d-flex justify-content-center justify-content-md-start">
        <a href="{{ route('login') }}" class="btn btn-success btn-lg rounded-pill shadow-sm">
          Member Portal
        </a>
      </div>

      <!-- Logos -->
      <div class="col-12 col-md-4 mb-3 mb-md-0 d-flex justify-content-center align-items-center">
        <img src="{{ asset('assets/img/spj/schl_logo.png') }}" alt="School Logo" height="80" class="me-2 mb-2 mb-md-0">
        <img src="{{ asset('assets/img/spj/spj_logo.png') }}" alt="SPJ Logo" height="80" class="mb-2 mb-md-0">
      </div>

      <!-- About / Contact -->
      <div class="col-12 col-md-4 d-flex flex-column flex-md-row justify-content-center justify-content-md-end align-items-center align-items-md-end">
        <div>
          <h5 class="fw-bold mb-2" style="color: var(--theme-color)">Contact Us</h5>
          <ul class="list-unstyled mb-0">
            <li>Special Program in Journalism </li>
			<li>Phone: +639123456789</li>
			<li>Email: spjournalism5@gmail.com</li>
          </ul>
        </div>
      </div>

    </div>

    <hr class="my-3">

    <!-- Copyright -->
    <div class="text-center text-muted small">
      &copy; {{ date('Y') }} SPJ. All rights reserved.
    </div>
  </div>
</footer>
<!--/ Footer-->
