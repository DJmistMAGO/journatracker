<!-- Footer-->
<footer class="content-footer footer bg-footer-theme" style="background-color: #000000;">
  <div class="{{ (!empty($containerNav) ? $containerNav : 'container-fluid') }}">
    <div class="footer-container d-flex align-items-center justify-content-between py-3 flex-md-row flex-column">
      <div class="text-body mb-2 mb-md-0">
        © <script>
          document.write(new Date().getFullYear())
        </script>, made with <span class="text-danger"><i class="tf-icons mdi mdi-heart"></i></span> by MistmagoKen
      </div>
      <div  class="d-none d-lg-inline-block">
        <a href="#" class="footer-link me-3" target="_blank">SPJ - School Project Journal</a>
        <a href="#" target="_blank" class="footer-link me-3">FB Page link here</a>
        {{-- <a href="#" target="_blank" class="footer-link me-3">Documentation</a>
        <a href="#" target="_blank" class="footer-link d-none d-sm-inline-block">Support</a> --}}
      </div>
    </div>
  </div>
</footer>


<!--/ Footer-->
