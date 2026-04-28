<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $setting->site_name ?? config('app.name', 'Company Profile') }}</title>

    <style>
        :root {
            --primary: #5b8def;
            --primary-dark: #1e293b;
            --secondary: #8dd7c7;
            --soft-blue: #eef6ff;
            --soft-mint: #effaf7;
            --bg: #f8fafc;
            --white: #ffffff;
            --text: #0f172a;
            --muted: #64748b;
            --border: #e2e8f0;
            --shadow: 0 28px 80px rgba(15, 23, 42, .10);
        }

        * {
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            margin: 0;
            font-family: Inter, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            color: var(--text);
            background: var(--bg);
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        img {
            max-width: 100%;
            display: block;
        }

        .container {
            width: min(1160px, calc(100% - 32px));
            margin-inline: auto;
        }

        .navbar {
            position: sticky;
            top: 0;
            z-index: 50;
            border-bottom: 1px solid rgba(226, 232, 240, .75);
            background: rgba(248, 250, 252, .82);
            backdrop-filter: blur(18px);
        }

        .navbar-inner {
            min-height: 78px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 24px;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 900;
            letter-spacing: -.04em;
            color: var(--primary-dark);
        }

        .brand-logo {
            width: 46px;
            height: 46px;
            display: grid;
            place-items: center;
            overflow: hidden;
            border-radius: 17px;
            color: white;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            box-shadow: 0 14px 34px rgba(91, 141, 239, .24);
        }

        .brand-logo img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            padding: 7px;
            background: white;
        }

        .nav-menu {
            display: flex;
            align-items: center;
            gap: 28px;
            font-size: 14px;
            font-weight: 800;
            color: var(--muted);
        }

        .nav-menu a:hover {
            color: var(--primary);
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 999px;
            padding: 13px 21px;
            border: 1px solid transparent;
            font-size: 14px;
            font-weight: 900;
            transition: .22s ease;
        }

        .btn-primary {
            color: white;
            background: linear-gradient(135deg, var(--primary), #49b6d6);
            box-shadow: 0 18px 38px rgba(91, 141, 239, .28);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 22px 48px rgba(91, 141, 239, .34);
        }

        .btn-white {
            color: var(--primary-dark);
            background: white;
            border-color: var(--border);
        }

        .hero {
            position: relative;
            overflow: hidden;
            padding: 96px 0 78px;
            background:
                radial-gradient(circle at 10% 8%, rgba(141, 215, 199, .55), transparent 30%),
                radial-gradient(circle at 88% 10%, rgba(91, 141, 239, .22), transparent 34%),
                linear-gradient(180deg, #ffffff, #f8fafc);
        }

        .hero::before {
            content: "";
            position: absolute;
            inset: auto -80px -160px auto;
            width: 420px;
            height: 420px;
            border-radius: 999px;
            background: rgba(91, 141, 239, .12);
            filter: blur(10px);
        }

        .hero-grid {
            position: relative;
            z-index: 2;
            display: grid;
            grid-template-columns: 1.03fr .97fr;
            align-items: center;
            gap: 54px;
        }

        .eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            border-radius: 999px;
            padding: 9px 14px;
            color: #2563eb;
            background: rgba(91, 141, 239, .11);
            font-size: 13px;
            font-weight: 900;
        }

        .hero-title {
            margin: 22px 0 0;
            max-width: 720px;
            color: var(--primary-dark);
            font-size: clamp(42px, 5.5vw, 76px);
            line-height: .95;
            letter-spacing: -.075em;
            font-weight: 950;
        }

        .hero-desc {
            margin: 24px 0 0;
            max-width: 610px;
            color: var(--muted);
            font-size: 18px;
            line-height: 1.8;
        }

        .hero-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 14px;
            margin-top: 34px;
        }

        .hero-visual {
            position: relative;
            min-height: 460px;
            border-radius: 42px;
            padding: 26px;
            background:
                linear-gradient(135deg, rgba(255,255,255,.86), rgba(255,255,255,.62)),
                radial-gradient(circle at top left, rgba(141, 215, 199, .52), transparent 35%);
            border: 1px solid rgba(226, 232, 240, .85);
            box-shadow: var(--shadow);
            overflow: hidden;
        }

        .hero-panel {
            height: 100%;
            min-height: 408px;
            border-radius: 32px;
            padding: 24px;
            color: white;
            background:
                radial-gradient(circle at 20% 10%, rgba(255,255,255,.30), transparent 22%),
                linear-gradient(135deg, #1e3a8a, #4f8bd8 48%, #8dd7c7);
            position: relative;
            overflow: hidden;
        }

        .hero-panel::after {
            content: "";
            position: absolute;
            width: 260px;
            height: 260px;
            right: -80px;
            bottom: -80px;
            border-radius: 999px;
            background: rgba(255,255,255,.22);
            filter: blur(2px);
        }

        .mini-dashboard {
            position: relative;
            z-index: 2;
            display: grid;
            gap: 16px;
        }

        .mini-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .mini-dot {
            display: flex;
            gap: 7px;
        }

        .mini-dot span {
            width: 10px;
            height: 10px;
            border-radius: 999px;
            background: rgba(255,255,255,.72);
        }

        .mini-card {
            border-radius: 24px;
            padding: 20px;
            background: rgba(255,255,255,.16);
            border: 1px solid rgba(255,255,255,.22);
            backdrop-filter: blur(16px);
        }

        .mini-card strong {
            display: block;
            font-size: 36px;
            letter-spacing: -.06em;
        }

        .mini-card span {
            display: block;
            margin-top: 6px;
            color: rgba(255,255,255,.78);
            font-size: 13px;
        }

        section {
            padding: 88px 0;
        }

        .section-head {
            max-width: 700px;
            margin: 0 auto 46px;
            text-align: center;
        }

        .section-head h2 {
            margin: 16px 0 0;
            color: var(--primary-dark);
            font-size: clamp(32px, 4vw, 50px);
            line-height: 1.08;
            letter-spacing: -.055em;
        }

        .section-head p {
            margin: 16px 0 0;
            color: var(--muted);
            line-height: 1.8;
        }

        .grid-3 {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
        }

        .card {
            border-radius: 30px;
            background: white;
            border: 1px solid var(--border);
            box-shadow: 0 18px 55px rgba(15, 23, 42, .06);
            overflow: hidden;
            transition: .22s ease;
        }

        .card:hover {
            transform: translateY(-6px);
            box-shadow: var(--shadow);
        }

        .service-card {
            padding: 28px;
        }

        .icon-box {
            width: 58px;
            height: 58px;
            border-radius: 20px;
            display: grid;
            place-items: center;
            margin-bottom: 22px;
            background: linear-gradient(135deg, var(--soft-blue), var(--soft-mint));
            color: var(--primary);
            font-weight: 950;
        }

        .card h3 {
            margin: 0;
            color: var(--primary-dark);
            font-size: 20px;
            letter-spacing: -.03em;
        }

        .card p {
            margin: 12px 0 0;
            color: var(--muted);
            line-height: 1.75;
            font-size: 14px;
        }

        .section-white {
            background: white;
        }

        .project-img,
        .gallery-img {
            width: 100%;
            height: 230px;
            object-fit: cover;
            background: linear-gradient(135deg, var(--soft-blue), var(--soft-mint));
        }

        .card-body {
            padding: 22px;
        }

        .tag {
            display: inline-flex;
            margin-bottom: 13px;
            border-radius: 999px;
            padding: 6px 11px;
            color: #2563eb;
            background: rgba(91, 141, 239, .10);
            font-size: 12px;
            font-weight: 900;
        }

        .contact-section {
            background:
                radial-gradient(circle at top left, rgba(141,215,199,.42), transparent 28%),
                linear-gradient(135deg, #ffffff, #eef6ff);
        }

        .contact-box {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 34px;
            padding: 38px;
            border-radius: 40px;
            background: white;
            border: 1px solid var(--border);
            box-shadow: var(--shadow);
        }

        .contact-box h2 {
            margin: 18px 0 0;
            color: var(--primary-dark);
            font-size: clamp(32px, 4vw, 46px);
            line-height: 1.08;
            letter-spacing: -.055em;
        }

        .contact-box p {
            color: var(--muted);
            line-height: 1.8;
        }

        .contact-item {
            margin-top: 14px;
            padding: 18px;
            border-radius: 22px;
            border: 1px solid var(--border);
            background: #f8fafc;
        }

        .contact-item small {
            display: block;
            color: var(--muted);
            font-size: 12px;
            font-weight: 900;
            letter-spacing: .06em;
            text-transform: uppercase;
        }

        .contact-item span {
            display: block;
            margin-top: 6px;
            color: var(--primary-dark);
            font-weight: 850;
            line-height: 1.5;
        }

        .socials {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 18px;
        }

        .socials a {
            display: inline-flex;
            border-radius: 999px;
            padding: 10px 14px;
            background: var(--soft-blue);
            color: #2563eb;
            font-size: 13px;
            font-weight: 900;
        }

        .footer {
            padding: 34px 0;
            color: rgba(255,255,255,.74);
            background: var(--primary-dark);
        }

        .footer-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 24px;
        }

        .footer strong {
            color: white;
        }

        @media (max-width: 960px) {
            .nav-menu {
                display: none;
            }

            .hero-grid,
            .contact-box {
                grid-template-columns: 1fr;
            }

            .grid-3 {
                grid-template-columns: repeat(2, 1fr);
            }

            .hero {
                padding-top: 62px;
            }
        }

        @media (max-width: 640px) {
            .container {
                width: min(100% - 24px, 1160px);
            }

            .navbar-inner {
                min-height: 68px;
            }

            .btn {
                padding: 11px 15px;
                font-size: 13px;
            }

            .hero-title {
                font-size: 42px;
            }

            .hero-desc {
                font-size: 16px;
            }

            .hero-visual {
                min-height: 360px;
                padding: 16px;
                border-radius: 30px;
            }

            .hero-panel {
                min-height: 328px;
                border-radius: 24px;
            }

            .grid-3 {
                grid-template-columns: 1fr;
            }

            .contact-box {
                padding: 22px;
                border-radius: 28px;
            }

            .footer-inner {
                flex-direction: column;
                text-align: center;
            }
        }
    </style>
</head>
<body>
    @yield('content')
</body>
</html>