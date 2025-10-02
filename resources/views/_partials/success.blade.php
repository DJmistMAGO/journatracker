@if (session('success'))
    <div id="success-snackbar" class="snackbar snackbar-success">
        <span>{{ session('success') }}</span>
        <button type="button" class="btn-close text-white" onclick="closeSnackbar()" aria-label="Close"></button>
    </div>
@endif

<script>
	function closeSnackbar() {
		const snackbar = document.getElementById('success-snackbar');
		snackbar.classList.remove('show');
	}

	document.addEventListener('DOMContentLoaded', () => {
		const snackbar = document.getElementById('success-snackbar');
		if (snackbar) {
			// Slide in
			setTimeout(() => snackbar.classList.add('show'), 100);

			// Auto dismiss after 4 seconds
			setTimeout(() => snackbar.classList.remove('show'), 4000);
		}
	});
	</script>
