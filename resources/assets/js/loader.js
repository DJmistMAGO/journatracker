window.addEventListener('load', function () {
  var overlay = document.getElementById('loading-overlay');
  if (overlay) {
    overlay.style.transition = 'opacity 0.5s';
    overlay.style.opacity = 0;
    setTimeout(function () {
      overlay.style.display = 'none';
    }, 500);
  }
});
