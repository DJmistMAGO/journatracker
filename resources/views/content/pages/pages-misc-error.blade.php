@extends('layouts/blankLayout')

@section('title', '404 Not Found')

@section('layoutContent')

    <div class="container-xxl d-flex flex-column align-items-center justify-content-center py-5" style="min-height: 80vh;">

    <div class="text-center mb-4" style="max-width: 400px;">
        <lottie-player
        src="https://lottie.host/acebeb84-4e4a-4218-b9bc-4dba590f1944/Kikr3428gi.json"
        background="transparent"
        speed="1"
        loop
        autoplay
        style="width: 100%; height: 300px;">
        </lottie-player>
    </div>

    <h1 class="display-1 fw-bold text-primary mb-2">404</h1>
    <h4 class="fw-semibold mb-3">Breaking News: Page Not Found</h4>

    <p class="text-muted mb-4" style="max-width: 520px;">
        The article you’re trying to read may have been <strong>misplaced in the newsroom</strong>,
        or the link was typed incorrectly.
        Let’s get you back to where the headlines are.
    </p>

    <div class="d-flex gap-3">
        <a href="{{ url('/welcome') }}" class="btn btn-primary d-flex align-items-center">
        <i class="ti ti-home me-2"></i> Back to Headlines
        </a>
        <a href="{{ url()->previous() }}" class="btn btn-outline-secondary d-flex align-items-center">
        <i class="ti ti-arrow-left me-2"></i> Go Back
        </a>
    </div>
    </div>

<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
@endsection
