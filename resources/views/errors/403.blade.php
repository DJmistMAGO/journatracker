<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>403 - Classified Access</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
    :root {
        --primary: #00A23F;
        --primary-dark: #008533;
    }

    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: #f5f5dc;
        color: #1a1a1a;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        min-height: 100vh;
        padding: 40px 20px;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    /* Newspaper background pattern */
    body::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-image:
            repeating-linear-gradient(
                0deg,
                transparent,
                transparent 25px,
                rgba(0, 0, 0, 0.03) 25px,
                rgba(0, 0, 0, 0.03) 26px
            ),
            repeating-linear-gradient(
                90deg,
                transparent,
                transparent 2px,
                rgba(0, 0, 0, 0.02) 2px,
                rgba(0, 0, 0, 0.02) 3px
            );
        opacity: 0.6;
        z-index: 0;
    }

    /* Newspaper text effect */
    body::after {
        content: 'BREAKING NEWS • LATEST UPDATES • DAILY REPORTS • PRESS RELEASE • JOURNALISM • MEDIA COVERAGE • EXCLUSIVE STORY • FRONT PAGE • HEADLINES • EDITORIAL • BREAKING NEWS • LATEST UPDATES • DAILY REPORTS • PRESS RELEASE • JOURNALISM • MEDIA COVERAGE • EXCLUSIVE STORY • FRONT PAGE • HEADLINES • EDITORIAL • BREAKING NEWS • LATEST UPDATES • DAILY REPORTS • PRESS RELEASE • JOURNALISM • MEDIA COVERAGE • EXCLUSIVE STORY • FRONT PAGE • HEADLINES • EDITORIAL • BREAKING NEWS • LATEST UPDATES • DAILY REPORTS • PRESS RELEASE • JOURNALISM • MEDIA COVERAGE • EXCLUSIVE STORY • FRONT PAGE • HEADLINES • EDITORIAL';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        font-size: 16px;
        line-height: 1.8;
        color: rgba(0, 0, 0, 0.15);
        font-family: 'Times New Roman', Times, serif;
        word-wrap: break-word;
        padding: 20px;
        z-index: 0;
        pointer-events: none;
    }

    /* Multiple classified stamps for dramatic effect */
    .classified-watermark {
        position: absolute;
        font-size: 8rem;
        font-weight: 900;
        color: rgba(220, 0, 0, 0.25);
        letter-spacing: 15px;
        text-transform: uppercase;
        border: 8px solid rgba(220, 0, 0, 0.3);
        padding: 40px 100px;
        border-radius: 8px;
        font-family: 'Impact', 'Arial Black', sans-serif;
        text-shadow: 3px 3px rgba(0, 0, 0, 0.3);
        pointer-events: none;
        z-index: 1;
    }

    .classified-watermark.main {
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%) rotate(-12deg);
        animation: pulse 3s infinite ease-in-out;
    }

    .classified-watermark.secondary {
        top: 15%;
        right: 10%;
        font-size: 3rem;
        padding: 15px 40px;
        border-width: 4px;
        transform: rotate(25deg);
        opacity: 0.6;
        animation: pulse 3s 0.5s infinite ease-in-out;
    }

    .classified-watermark.tertiary {
        bottom: 15%;
        left: 10%;
        font-size: 3rem;
        padding: 15px 40px;
        border-width: 4px;
        transform: rotate(-20deg);
        opacity: 0.6;
        animation: pulse 3s 1s infinite ease-in-out;
    }

    @keyframes pulse {
        0%, 100% {
            opacity: 0.25;
            filter: brightness(1);
        }
        50% {
            opacity: 0.4;
            filter: brightness(1.2);
        }
    }

    /* Red diagonal stripes for extra forbidden feel */
    .danger-stripes {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: repeating-linear-gradient(
            45deg,
            transparent,
            transparent 80px,
            rgba(220, 0, 0, 0.03) 80px,
            rgba(220, 0, 0, 0.03) 100px
        );
        pointer-events: none;
        z-index: 0;
    }

    .content-wrapper {
        position: relative;
        z-index: 2;
        background: rgba(255, 255, 255, 0.95);
        padding: 50px 40px;
        border-radius: 15px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        max-width: 600px;
        backdrop-filter: blur(10px);
        border: 3px solid rgba(220, 0, 0, 0.2);
    }

    .lock-icon {
        margin-bottom: 30px;
        max-width: 120px;
        animation: shake 0.5s ease-in-out 2s, float 3s ease-in-out 3s infinite;
    }

    @keyframes shake {
        0%, 100% { transform: translateX(0) rotate(0deg); }
        25% { transform: translateX(-10px) rotate(-5deg); }
        75% { transform: translateX(10px) rotate(5deg); }
    }

    @keyframes float {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-10px); }
    }

    h1 {
        font-size: 5rem;
        color: #dc2626;
        margin-bottom: 15px;
        font-weight: 900;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
        letter-spacing: 5px;
    }

    h2 {
        font-size: 2rem;
        color: #333;
        margin-bottom: 20px;
        font-weight: 700;
    }

    p {
        font-size: 1.1rem;
        margin-bottom: 30px;
        color: #444;
        line-height: 1.6;
    }

    .warning-badge {
        display: inline-block;
        background: #dc2626;
        color: white;
        padding: 8px 20px;
        border-radius: 5px;
        font-weight: 700;
        font-size: 0.9rem;
        margin-bottom: 20px;
        letter-spacing: 2px;
        text-transform: uppercase;
    }

    .btn-home {
        display: inline-block;
        padding: 14px 32px;
        font-size: 1rem;
        font-weight: 600;
        color: #fff;
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
        border-radius: 50px;
        text-decoration: none;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(0, 162, 63, 0.4);
    }

    .btn-home:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0, 162, 63, 0.6);
    }

    .btn-home:active {
        transform: translateY(0);
    }

    @media (max-width: 768px) {
        .classified-watermark.main {
            font-size: 4rem;
            padding: 20px 50px;
            border-width: 5px;
        }
        .classified-watermark.secondary,
        .classified-watermark.tertiary {
            font-size: 2rem;
            padding: 10px 25px;
        }
        h1 { font-size: 3.5rem; }
        h2 { font-size: 1.5rem; }
        .content-wrapper {
            padding: 40px 30px;
        }
    }

    @media (max-width: 480px) {
        .classified-watermark.main {
            font-size: 3rem;
            padding: 15px 30px;
        }
        .classified-watermark.secondary,
        .classified-watermark.tertiary {
            display: none;
        }
        h1 { font-size: 2.5rem; }
    }
</style>
</head>
<body>
<div class="danger-stripes"></div>
<div class="classified-watermark main">CLASSIFIED</div>
<div class="classified-watermark secondary">RESTRICTED</div>
<div class="classified-watermark tertiary">TOP SECRET</div>

<div class="content-wrapper">
    <svg class="lock-icon" viewBox="0 0 120 140" fill="none">
        <rect x="20" y="70" width="80" height="70" rx="10" fill="#dc2626"/>
        <rect x="35" y="35" width="50" height="60" rx="25" fill="none" stroke="#dc2626" stroke-width="12"/>
        <circle cx="60" cy="95" r="8" fill="white"/>
        <rect x="57" y="95" width="6" height="20" fill="white" rx="3"/>
    </svg>


    <h1>403</h1>
    <h2>ACCESS DENIED</h2>
    <p>This content is classified and restricted to authorized personnel only. You do not have permission to view this page.</p>

    <a href="{{ url('/') }}" class="btn-home">← Return to Safety</a>
</div>

</body>
</html>
