<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Compro CMS') }}</title>

    <style>
        :root {
            --primary: #2563eb;
            --primary-soft: #dbeafe;
            --cyan: #06b6d4;
            --dark: #0f172a;
            --muted: #64748b;
            --border: #e2e8f0;
            --bg: #f8fafc;
            --white: #ffffff;
            --shadow: 0 30px 80px rgba(15, 23, 42, .16);
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: Inter, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            color: var(--dark);
            background:
                radial-gradient(circle at top left, rgba(37, 99, 235, .12), transparent 34%),
                radial-gradient(circle at bottom right, rgba(6, 182, 212, .14), transparent 32%),
                var(--bg);
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        .auth-page {
            min-height: 100vh;
            display: grid;
            grid-template-columns: 1.05fr .95fr;
        }

        .auth-visual {
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 48px;
            color: #fff;
            background:
                linear-gradient(135deg, rgba(15, 23, 42, .96), rgba(30, 64, 175, .94) 48%, rgba(8, 145, 178, .9)),
                radial-gradient(circle at 20% 20%, rgba(255,255,255,.22), transparent 28%);
        }

        .auth-visual::before,
        .auth-visual::after {
            content: "";
            position: absolute;
            border-radius: 999px;
            filter: blur(6px);
            opacity: .55;
        }

        .auth-visual::before {
            width: 360px;
            height: 360px;
            right: -120px;
            top: -100px;
            background: rgba(125, 211, 252, .36);
        }

        .auth-visual::after {
            width: 300px;
            height: 300px;
            left: -100px;
            bottom: -90px;
            background: rgba(59, 130, 246, .5);
        }

        .auth-grid {
            position: absolute;
            inset: 0;
            opacity: .12;
            background-image:
                linear-gradient(rgba(255,255,255,.7) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,.7) 1px, transparent 1px);
            background-size: 46px 46px;
            mask-image: linear-gradient(to bottom, #000, transparent);
        }

        .auth-brand,
        .auth-hero,
        .auth-preview {
            position: relative;
            z-index: 2;
        }

        .auth-brand {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .brand-logo {
            width: 52px;
            height: 52px;
            border-radius: 18px;
            display: grid;
            place-items: center;
            background: rgba(255, 255, 255, .16);
            border: 1px solid rgba(255, 255, 255, .22);
            backdrop-filter: blur(16px);
            overflow: hidden;
            font-weight: 800;
            font-size: 20px;
        }

        .brand-logo img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            padding: 8px;
            background: rgba(255,255,255,.9);
        }

        .brand-title {
            font-size: 20px;
            font-weight: 800;
            letter-spacing: -.03em;
            margin: 0;
        }

        .brand-subtitle {
            margin: 3px 0 0;
            font-size: 13px;
            color: rgba(255,255,255,.72);
        }

        .auth-hero {
            max-width: 620px;
            margin-block: 56px;
        }

        .auth-pill {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 9px 14px;
            border-radius: 999px;
            background: rgba(255,255,255,.13);
            border: 1px solid rgba(255,255,255,.18);
            color: rgba(255,255,255,.9);
            font-size: 13px;
            font-weight: 700;
            backdrop-filter: blur(12px);
        }

        .auth-hero h1 {
            margin: 26px 0 0;
            font-size: clamp(42px, 5vw, 70px);
            line-height: .95;
            letter-spacing: -.07em;
            font-weight: 900;
        }

        .auth-hero p {
            max-width: 520px;
            margin: 24px 0 0;
            color: rgba(255,255,255,.76);
            font-size: 17px;
            line-height: 1.8;
        }

        .auth-preview {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 14px;
            max-width: 650px;
        }

        .preview-card {
            padding: 18px;
            border-radius: 24px;
            background: rgba(255, 255, 255, .12);
            border: 1px solid rgba(255, 255, 255, .18);
            backdrop-filter: blur(16px);
        }

        .preview-card strong {
            display: block;
            font-size: 24px;
            letter-spacing: -.04em;
        }

        .preview-card span {
            display: block;
            margin-top: 6px;
            font-size: 12px;
            color: rgba(255,255,255,.7);
        }

        .auth-content {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 42px 24px;
        }

        .auth-wrap {
            width: 100%;
            max-width: 460px;
        }

        .mobile-brand {
            display: none;
            margin-bottom: 24px;
            text-align: center;
        }

        .mobile-brand .brand-logo {
            margin-inline: auto;
            background: linear-gradient(135deg, var(--primary), var(--cyan));
            color: #fff;
        }

        .mobile-brand h1 {
            margin: 12px 0 0;
            font-size: 22px;
            letter-spacing: -.04em;
        }

        .auth-card {
            position: relative;
            padding: 34px;
            border-radius: 34px;
            background: rgba(255, 255, 255, .88);
            border: 1px solid rgba(226, 232, 240, .9);
            box-shadow: var(--shadow);
            backdrop-filter: blur(20px);
        }

        .auth-card::before {
            content: "";
            position: absolute;
            inset: 0;
            border-radius: inherit;
            padding: 1px;
            background: linear-gradient(135deg, rgba(37,99,235,.32), rgba(6,182,212,.18), rgba(255,255,255,.1));
            -webkit-mask: linear-gradient(#000 0 0) content-box, linear-gradient(#000 0 0);
            -webkit-mask-composite: xor;
            mask-composite: exclude;
            pointer-events: none;
        }

        .auth-badge {
            display: inline-flex;
            padding: 8px 13px;
            border-radius: 999px;
            background: var(--primary-soft);
            color: #1d4ed8;
            font-size: 12px;
            font-weight: 800;
            letter-spacing: .02em;
        }

        .auth-title {
            margin: 18px 0 0;
            font-size: 34px;
            line-height: 1.05;
            letter-spacing: -.06em;
            font-weight: 900;
            color: var(--dark);
        }

        .auth-desc {
            margin: 10px 0 0;
            color: var(--muted);
            line-height: 1.7;
            font-size: 14px;
        }

        .auth-form {
            margin-top: 28px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 14px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-size: 13px;
            font-weight: 800;
            color: #334155;
        }

        .form-control-auth {
            width: 100%;
            border: 1px solid var(--border);
            border-radius: 18px;
            background: #f8fafc;
            padding: 14px 16px;
            color: var(--dark);
            font-size: 14px;
            outline: none;
            transition: .22s ease;
        }

        .form-control-auth:focus {
            border-color: rgba(37, 99, 235, .72);
            background: #fff;
            box-shadow: 0 0 0 5px rgba(37, 99, 235, .1);
        }

        .form-error {
            margin-top: 7px;
            font-size: 12px;
            color: #dc2626;
        }

        .alert-auth {
            margin-top: 18px;
            padding: 13px 15px;
            border-radius: 18px;
            font-size: 13px;
            line-height: 1.6;
        }

        .alert-danger {
            background: #fef2f2;
            color: #b91c1c;
            border: 1px solid #fecaca;
        }

        .alert-success {
            background: #f0fdf4;
            color: #15803d;
            border: 1px solid #bbf7d0;
        }

        .check-row {
            display: flex;
            align-items: center;
            gap: 10px;
            color: var(--muted);
            font-size: 13px;
        }

        .check-row input {
            width: 16px;
            height: 16px;
            accent-color: var(--primary);
        }

        .auth-link {
            color: var(--primary);
            font-size: 13px;
            font-weight: 800;
        }

        .auth-link:hover {
            color: #1d4ed8;
        }

        .auth-button {
            width: 100%;
            border: 0;
            cursor: pointer;
            border-radius: 20px;
            padding: 15px 18px;
            color: #fff;
            font-size: 14px;
            font-weight: 900;
            letter-spacing: .01em;
            background: linear-gradient(135deg, #2563eb, #0891b2);
            box-shadow: 0 18px 35px rgba(37, 99, 235, .28);
            transition: .22s ease;
        }

        .auth-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 24px 45px rgba(37, 99, 235, .34);
        }

        .auth-footer {
            margin-top: 24px;
            text-align: center;
            color: var(--muted);
            font-size: 14px;
        }

        @media (max-width: 991px) {
            .auth-page {
                grid-template-columns: 1fr;
            }

            .auth-visual {
                display: none;
            }

            .mobile-brand {
                display: block;
            }

            .auth-content {
                padding: 28px 18px;
            }

            .auth-card {
                padding: 26px;
                border-radius: 28px;
            }

            .auth-title {
                font-size: 30px;
            }
        }

        @media (max-width: 420px) {
            .auth-card {
                padding: 22px;
            }

            .form-row {
                align-items: flex-start;
                flex-direction: column;
                gap: 8px;
            }
        }
    </style>
</head>

<body>
    @php
        $setting = \App\Models\Setting::first();
        $siteName = $setting->site_name ?? config('app.name', 'Compro CMS');
    @endphp

    <main class="auth-page">
        <section class="auth-visual">
            <div class="auth-grid"></div>

            <div class="auth-brand">
                <div class="brand-logo">
                    @if (!empty($setting?->logo))
                        <img src="{{ asset('storage/' . $setting->logo) }}" alt="{{ $siteName }}">
                    @else
                        C
                    @endif
                </div>

                <div>
                    <p class="brand-title">{{ $siteName }}</p>
                    <p class="brand-subtitle">Company Profile CMS</p>
                </div>
            </div>

            <div class="auth-hero">
                <span class="auth-pill">
                    ✦ Smart Content Management
                </span>

                <h1>Manage your company profile beautifully.</h1>

                <p>
                    Kelola service, project, gallery, dan informasi perusahaan dari dashboard yang rapi, modern, dan mudah digunakan.
                </p>
            </div>

            <div class="auth-preview">
                <div class="preview-card">
                    <strong>CMS</strong>
                    <span>Kelola konten website</span>
                </div>

                <div class="preview-card">
                    <strong>Fast</strong>
                    <span>Laravel 11 ready</span>
                </div>

                <div class="preview-card">
                    <strong>Clean</strong>
                    <span>Responsive interface</span>
                </div>
            </div>
        </section>

        <section class="auth-content">
            <div class="auth-wrap">
                <div class="mobile-brand">
                    <div class="brand-logo">
                        @if (!empty($setting?->logo))
                            <img src="{{ asset('storage/' . $setting->logo) }}" alt="{{ $siteName }}">
                        @else
                            C
                        @endif
                    </div>

                    <h1>{{ $siteName }}</h1>
                </div>

                {{ $slot }}
            </div>
        </section>
    </main>
</body>
</html>