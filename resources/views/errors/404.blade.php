<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>404 - Page Not Found</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
    :root {
        --primary-light: #D6EFD8;
        --primary: #80AF81;
        --primary-dark: #508D4E;
        --primary-darker: #1A5319;
    }

    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

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

    .illustration {
        margin-bottom: 30px;
        max-width: 220px;
        width: 50%;
        animation: float 3s ease-in-out infinite;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-15px); }
    }

    .illustration svg {
        width: 100%;
        height: auto;
    }

    h1 {
        font-size: 4rem;
        color: var(--primary-dark);
        margin-bottom: 15px;
        animation: fadeScale 1s ease forwards;
        opacity: 0;
        transform: scale(0.8);
    }

    p {
        font-size: 1.25rem;
        margin-bottom: 30px;
        line-height: 1.5;
        color: #333;
        animation: fadeUp 1s ease 0.5s forwards;
        opacity: 0;
        transform: translateY(10px);
    }

    .btn-home {
        display: inline-block;
        padding: 12px 28px;
        font-size: 1rem;
        font-weight: 600;
        color: #fff;
        background: var(--primary);
        border-radius: 8px;
        text-decoration: none;
        transition: all 0.3s ease;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        animation: fadeUp 1s ease 1s forwards;
        opacity: 0;
        transform: translateY(10px);
    }

    .btn-home:hover {
        background: var(--primary-dark);
        transform: translateY(-2px);
        box-shadow: 0 6px 10px rgba(0,0,0,0.15);
    }

    @keyframes fadeScale {
        to { opacity: 1; transform: scale(1); }
    }

    @keyframes fadeUp {
        to { opacity: 1; transform: translateY(0); }
    }

    @media (max-width: 576px) {
        h1 {
            font-size: 3rem;
        }

        p {
            font-size: 1rem;
        }

        .illustration {
            max-width: 160px;
        }
    }
</style>
</head>
<body>
<div class="illustration">
    <svg viewBox="0 0 200 200" fill="none">
        <rect x="30" y="40" width="140" height="120" rx="12" fill="#f0fdf4"/>
        <rect x="50" y="60" width="100" height="20" rx="4" fill="#cbd5e1"/>
        <rect x="50" y="90" width="60" height="12" rx="3" fill="#f1f5f9"/>
        <rect x="50" y="110" width="80" height="12" rx="3" fill="#f1f5f9"/>
        <rect x="50" y="130" width="40" height="12" rx="3" fill="#f1f5f9"/>
        <circle cx="150" cy="150" r="18" stroke="#64748b" stroke-width="4" fill="#fff"/>
        <rect x="163" y="163" width="16" height="4" rx="2" transform="rotate(45 163 163)" fill="#64748b"/>
        <circle cx="100" cy="110" r="8" fill="#64748b"/>
        <ellipse cx="100" cy="115" rx="4" ry="2" fill="#fff"/>
    </svg>
</div>
<h1>404</h1>
<p>
    Oops! The page you’re looking for doesn’t exist.<br>
    It may have been removed or never existed.
</p>
<a href="{{ url('/') }}" class="btn-home">Back to Homepage</a>
</body>
</html>
