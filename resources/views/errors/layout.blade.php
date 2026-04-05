<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title', __('Terjadi Kesalahan'))</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-Mc8HLZ3gi/96uH7vBu+7L6qft7LtQov0MS5XUVm4eCUzxPlc501gVvAYt5XAWPqHLj7V6qSDntfza7wFhKzYtQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <style>
            :root {
                font-family: "DM Sans", ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif;
                --bg: #F5E9D8;
                --panel: #FEFEFC;
                --panel-dark: #1B2B40;
                --text: #10243A;
                --muted: #61728F;
                --accent: #C9A84C;
                --accent-dark: #DAA76B;
                --border: rgba(16, 36, 58, 0.12);
                --shadow: 0 32px 85px rgba(16, 36, 58, 0.12);
            }

            *, *::before, *::after {
                box-sizing: border-box;
            }

            html, body {
                margin: 0;
                min-height: 100%;
                background: radial-gradient(circle at top left, rgba(201,168,76,0.14), transparent 20%), radial-gradient(circle at bottom right, rgba(16,36,58,0.08), transparent 24%), linear-gradient(180deg, #F9EFE3 0%, #F5E9D8 100%);
                color: var(--text);
            }

            body {
                display: grid;
                place-items: center;
                padding: 24px;
                overflow-x: hidden;
            }

            body::before {
                content: "";
                position: fixed;
                inset: 0;
                background-image: linear-gradient(180deg, rgba(255,255,255,0.08) 0%, rgba(255,255,255,0) 8%, rgba(255,255,255,0) 92%, rgba(255,255,255,0.08) 100%);
                pointer-events: none;
                z-index: 0;
            }

            .split-shell {
                position: relative;
                width: min(100%, 1140px);
                min-height: min(100vh, 680px);
                display: grid;
                grid-template-columns: 1fr 0.95fr;
                background: rgba(254,254,252,0.98);
                border: 1px solid var(--border);
                border-radius: 32px;
                box-shadow: var(--shadow);
                overflow: hidden;
                z-index: 1;
            }

            .panel {
                position: relative;
                padding: 52px 46px;
                display: flex;
                flex-direction: column;
                justify-content: center;
                gap: 24px;
            }

            .panel-left {
                background: linear-gradient(180deg, rgba(249,243,232,0.96) 0%, rgba(255,255,255,0.97) 100%);
            }

            .panel-right {
                background: linear-gradient(180deg, #1B2B40 0%, #142137 100%);
                color: #F5E9D8;
                padding: 44px;
                justify-content: space-between;
            }

            .panel-right::before {
                content: "";
                position: absolute;
                inset: 0;
                background: radial-gradient(circle at top left, rgba(201,168,76,0.18), transparent 18%), radial-gradient(circle at bottom right, rgba(255,255,255,0.06), transparent 26%);
                pointer-events: none;
            }

            .panel-right .overlay {
                position: relative;
                z-index: 1;
            }

            .error-brand {
                display: inline-flex;
                align-items: center;
                gap: 12px;
                padding: 10px 18px;
                border-radius: 999px;
                background: rgba(201,168,76,0.16);
                color: var(--panel-dark);
                font-size: 0.95rem;
                font-weight: 700;
                letter-spacing: 0.08em;
                text-transform: uppercase;
            }

            .error-brand i {
                font-size: 0.95rem;
                color: var(--accent-dark);
            }

            .error-code {
                margin: 0;
                font-size: clamp(3.8rem, 6vw, 5.4rem);
                line-height: 0.94;
                color: var(--accent-dark);
                letter-spacing: -0.06em;
            }

            .error-title {
                margin: 0;
                font-size: clamp(2.2rem, 4.5vw, 3.4rem);
                line-height: 1.02;
                color: var(--panel-dark);
                text-transform: uppercase;
            }

            .error-message {
                margin: 0;
                max-width: 620px;
                font-size: 1.05rem;
                line-height: 1.8;
                color: var(--muted);
                padding-right: 10px;
            }

            .error-subtitle {
                margin: 0;
                max-width: 620px;
                font-size: 0.98rem;
                line-height: 1.75;
                color: #49596E;
            }

            .error-actions {
                margin-top: 10px;
                display: flex;
                flex-wrap: wrap;
                gap: 14px;
            }

            .btn {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                min-width: 155px;
                padding: 14px 24px;
                border-radius: 999px;
                font-weight: 700;
                text-decoration: none;
                transition: transform 0.22s ease, box-shadow 0.22s ease, background 0.22s ease;
            }

            .btn-primary {
                background: linear-gradient(135deg, #C9A84C 0%, #E2C176 100%);
                color: #10243A;
            }

            .btn-secondary {
                background: rgba(16,36,58,0.12);
                color: #10243A;
            }

            .btn:hover {
                transform: translateY(-1px);
                box-shadow: 0 18px 34px rgba(16,36,58,0.14);
            }

            .split-visual {
                position: relative;
                min-height: 100%;
                padding: 24px 0 20px;
                display: flex;
                flex-direction: column;
                justify-content: space-between;
                z-index: 1;
            }

            .visual-mark {
                display: grid;
                place-items: center;
                width: 100%;
                min-height: 320px;
                color: #F5E9D8;
            }

            .visual-mark i {
                font-size: clamp(5rem, 12vw, 10rem);
                color: rgba(245,233,216,0.95);
                opacity: 0.92;
                animation: drift 10s ease-in-out infinite alternate;
            }

            @keyframes drift {
                0% { transform: translateY(0) scale(1); }
                100% { transform: translateY(-12px) scale(1.02); }
            }

            .visual-note {
                margin-top: 18px;
                color: rgba(245,233,216,0.92);
                font-size: 0.95rem;
                line-height: 1.75;
                max-width: 320px;
            }

            .bottom-note {
                margin-top: 32px;
                font-size: 0.88rem;
                color: #8B94A2;
                letter-spacing: 0.02em;
            }

            @media (max-width: 980px) {
                .split-shell {
                    grid-template-columns: 1fr;
                    min-height: auto;
                }

                .panel-right {
                    padding: 36px 32px;
                }
            }

            @media (max-width: 700px) {
                body {
                    padding: 16px;
                }

                .split-shell {
                    border-radius: 24px;
                }

                .panel {
                    padding: 28px 24px;
                }

                .error-code {
                    font-size: 3.6rem;
                }

                .error-title {
                    font-size: 2.4rem;
                }

                .error-actions {
                    flex-direction: column;
                }

                .btn {
                    width: 100%;
                }

                .visual-mark {
                    min-height: 260px;
                }
            }
        </style>
    </head>
    <body>
        <main class="split-shell">
            <section class="panel panel-left">
                <span class="error-brand">Nevandra Error</span>

                <div>
                    <p class="error-code">@yield('code', 'Oops')</p>
                    <h1 class="error-title">@yield('title', __('Maaf!'))</h1>
                    <p class="error-message">@yield('message', __('Terjadi sesuatu pada halaman ini. Silakan coba lagi, atau kembali ke beranda.'))</p>
                    <p class="error-subtitle">@yield('subtitle', __('Silakan kembali ke beranda atau muat ulang halaman.'))</p>
                </div>

                <div class="error-actions">
                    <a href="{{ url('/') }}" class="btn btn-primary"><i class="fas fa-home" aria-hidden="true"></i> Beranda</a>
                    <a href="{{ url()->previous() ?: url('/') }}" class="btn btn-secondary"><i class="fas fa-arrow-left" aria-hidden="true"></i> Kembali</a>
                </div>

                <div class="bottom-note">{{ date('Y') }} · Nevandra • Tampilan error split-screen.</div>
            </section>

            <section class="panel panel-right">
                <div class="split-visual overlay">
                    <div class="visual-mark">
                        <i class="fas fa-bolt"></i>
                    </div>
                    <div class="visual-note">Gaya layar terbagi ini memberi nuansa mirip halaman masuk dengan visual retro lembut dan fokus informasi di panel kiri.</div>
                </div>
            </section>
        </main>
    </body>
</html>
