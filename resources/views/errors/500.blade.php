<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>500 - Internal Server Error</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
    :root {
        --primary-light: #D6EFD8;
        --primary: #80AF81;
        --primary-dark: #508D4E;
        --primary-darker: #1A5319;
    }
    * { box-sizing: border-box; margin: 0; padding: 0; }
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: var(--primary-light);
        color: #1a1a1a;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        min-height: 100vh;
        padding: 20px;
        text-align: center;
        overflow: hidden;
    }
    .illustration { margin-bottom: 30px; max-width: 220px; animation: float 3s ease-in-out infinite; }
    @keyframes float { 0%,100%{transform:translateY(0);} 50%{transform:translateY(-15px);} }
    h1 { font-size: 4rem; color: var(--primary-dark); margin-bottom: 15px; animation: fadeScale 1s ease forwards; opacity: 0; transform: scale(0.8); }
    p { font-size: 1.25rem; margin-bottom: 30px; color: #333; animation: fadeUp 1s ease 0.5s forwards; opacity: 0; transform: translateY(10px); }
    .btn-home { padding: 12px 28px; font-weight: 600; color: #fff; background: var(--primary); border-radius: 8px; text-decoration: none; transition: 0.3s; box-shadow: 0 4px 6px rgba(0,0,0,0.1); animation: fadeUp 1s ease 1s forwards; opacity: 0; transform: translateY(10px); }
    .btn-home:hover { background: var(--primary-dark); transform: translateY(-2px); }
    @keyframes fadeScale { to {opacity:1; transform:scale(1);} }
    @keyframes fadeUp { to {opacity:1; transform:translateY(0);} }
</style>
</head>
<body>
<div class="illustration">
    <svg viewBox="0 0 200 200" fill="none">
        <circle cx="100" cy="100" r="60" fill="#f0fdf4"/>
        <rect x="80" y="70" width="40" height="60" fill="#cbd5e1"/>
        <path d="M100 130v20" stroke="#508D4E" stroke-width="4"/>
        <circle cx="100" cy="160" r="6" fill="#508D4E"/>
        <path d="M70 90h60" stroke="#80AF81" stroke-width="4"/>
        <path d="M85 110h30" stroke="#80AF81" stroke-width="4"/>
    </svg>
</div>
<h1>500</h1>
<p>Something went wrong on our end.<br>Please try refreshing the page or come back later.</p>
<a href="{{ url('/') }}" class="btn-home">Back to Homepage</a>
</body>
</html>
