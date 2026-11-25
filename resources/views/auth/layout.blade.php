<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Belajar.ID</title>
    <style>
        :root {
            color-scheme: light;
            --auth-bg: #ffffff;
            --auth-ink: #24243b;
            --auth-muted: #66677b;
            --auth-border: #dedee9;
            --auth-input: #fbfbfd;
            font-family: Inter, ui-sans-serif, system-ui, -apple-system, "Segoe UI", sans-serif;
            font-synthesis: none;
            text-rendering: optimizeLegibility;
        }
        * { box-sizing: border-box; }
        body { min-height: 100vh; margin: 0; color: var(--auth-ink); background: var(--auth-bg); }
        .auth-shell { min-height: 100vh; display: grid; grid-template-columns: 1fr 1fr; }
        .auth-showcase {
            position: relative;
            min-width: 0;
            min-height: 100vh;
            display: flex;
            overflow: hidden;
            flex-direction: column;
            justify-content: space-between;
            padding: clamp(32px, 5vw, 76px);
            color: white;
            background-image:
                radial-gradient(circle, #ffffff1b 1px, transparent 1.35px),
                linear-gradient(180deg, #30276f 0%, #4d3db1 54%, #6f5ee5 100%);
            background-size: 22px 22px, 100% 100%;
        }
        .auth-showcase:before, .auth-showcase:after {
            position: absolute;
            content: "";
            border: 1px solid #ffffff21;
            border-radius: 50%;
            pointer-events: none;
        }
        .auth-showcase:before {
            width: 460px;
            height: 460px;
            top: 15%;
            right: -290px;
            box-shadow: 0 0 0 28px #ffffff08, 0 0 0 58px #ffffff06;
        }
        .auth-showcase:after { width: 270px; height: 270px; top: 27%; right: -195px; }
        .auth-brand, .showcase-content, .study-card { position: relative; z-index: 1; }
        .auth-brand { display: flex; align-items: center; gap: 12px; font-size: 19px; font-weight: 800; letter-spacing: -.5px; }
        .brand-mark {
            width: 42px;
            height: 42px;
            display: grid;
            place-items: center;
            border: 1px solid #ffffff50;
            border-radius: 14px;
            color: white;
            background: #ffffff20;
            font-size: 12px;
            letter-spacing: .3px;
            box-shadow: 0 8px 22px #241d6c35;
        }
        .showcase-content { max-width: 510px; margin: 54px 0; }
        .auth-kicker { display: inline-flex; align-items: center; gap: 8px; color: #e9e5ff; font-size: 12px; font-weight: 800; letter-spacing: 1.4px; text-transform: uppercase; }
        .auth-kicker:before { width: 7px; height: 7px; border-radius: 50%; background: #b8ffdc; box-shadow: 0 0 0 4px #b8ffdc20; content: ""; }
        .auth-showcase h2 { max-width: 470px; margin: 18px 0 14px; font-size: clamp(40px, 5vw, 64px); line-height: 1.02; letter-spacing: -2.7px; }
        .auth-showcase p { max-width: 420px; margin: 0; color: #e7e3ff; font-size: 16px; font-weight: 500; line-height: 1.8; }
        .study-card {
            max-width: 420px;
            padding: 20px;
            border: 1px solid #ffffff4d;
            border-radius: 17px;
            background: #ffffff17;
            box-shadow: 0 14px 35px #25206820;
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }
        .study-card-label { color: #e5e2ff; font-size: 11px; font-weight: 800; letter-spacing: 1px; }
        .study-card-title { margin: 9px 0 15px; color: white; font-size: 15px; font-weight: 750; }
        .study-progress { height: 8px; overflow: hidden; border-radius: 10px; background: #ffffff35; }
        .study-progress span { width: 68%; height: 100%; display: block; border-radius: inherit; background: #b8ffdc; }
        .study-card-foot { display: flex; justify-content: space-between; gap: 10px; margin-top: 10px; color: #f3f1ff; font-size: 12px; font-weight: 650; }
        .auth-card {
            position: relative;
            width: min(100%, 490px);
            justify-self: center;
            align-self: center;
            padding: 56px clamp(28px, 5vw, 64px);
        }
        .auth-theme-toggle {
            position: absolute;
            top: 28px;
            right: 30px;
            width: 40px;
            height: 40px;
            display: grid;
            place-items: center;
            border: 1px solid var(--auth-border);
            border-radius: 12px;
            color: var(--auth-ink);
            background: var(--auth-bg);
            font-size: 17px;
            cursor: pointer;
            transition: background .18s, border-color .18s, transform .18s;
        }
        .auth-theme-toggle:hover { transform: translateY(-1px); border-color: #968bea; }
        h1 { margin: 0; color: var(--auth-ink); font-size: 32px; letter-spacing: -1px; }
        .subtitle { margin: 10px 0 30px; color: var(--auth-muted); font-size: 16px; font-weight: 500; line-height: 1.65; }
        label { display: block; margin: 19px 0 7px; color: var(--auth-ink); font-size: 15px; font-weight: 750; }
        .input-icon-wrap { position: relative; }
        .input-icon {
            position: absolute;
            top: 50%;
            left: 14px;
            width: 18px;
            height: 18px;
            color: #77788e;
            pointer-events: none;
            transform: translateY(-50%);
        }
        input:not([type="checkbox"]) {
            width: 100%;
            min-height: 50px;
            padding: 12px 14px;
            border: 1px solid var(--auth-border);
            border-radius: 11px;
            outline: none;
            color: var(--auth-ink);
            background: var(--auth-input);
            font: inherit;
            font-size: 16px;
            transition: border-color .2s, box-shadow .2s, background .2s;
        }
        .input-icon-wrap input:not([type="checkbox"]) { padding-left: 43px; }
        .password-wrap input:not([type="checkbox"]) { padding-right: 50px; }
        input:not([type="checkbox"])::placeholder { color: #9293a5; }
        input:not([type="checkbox"]):focus {
            border-color: #7666e6;
            background: var(--auth-bg);
            box-shadow: 0 0 0 4px #7564e829;
        }
        .password-toggle {
            position: absolute;
            top: 50%;
            right: 8px;
            width: 36px;
            height: 36px;
            display: grid;
            place-items: center;
            padding: 0;
            border: 0;
            border-radius: 8px;
            color: #696a80;
            background: transparent;
            cursor: pointer;
            transform: translateY(-50%);
        }
        .password-toggle:hover { color: #5144c7; background: #f0eeff; }
        .password-toggle svg { width: 18px; height: 18px; }
        button, .button {
            width: 100%;
            display: block;
            padding: 13px 16px;
            border: 0;
            border-radius: 11px;
            color: white;
            font: inherit;
            font-size: 15px;
            font-weight: 750;
            text-align: center;
            text-decoration: none;
            cursor: pointer;
        }
        .auth-card .auth-theme-toggle {
            width: 40px;
            height: 40px;
            display: grid;
            padding: 0;
            border: 1px solid var(--auth-border);
            color: var(--auth-ink);
            background: var(--auth-bg);
            font-size: 17px;
        }
        .input-icon-wrap .password-toggle {
            width: 36px;
            height: 36px;
            display: grid;
            padding: 0;
            border: 0;
            color: #696a80;
            background: transparent;
        }
        .primary {
            min-height: 50px;
            margin-top: 22px;
            background: linear-gradient(105deg, #5548d2, #7666e9);
            box-shadow: 0 8px 18px #6858e833;
            transition: transform .18s, box-shadow .18s, background .18s;
        }
        .primary:hover { transform: translateY(-1px); background: linear-gradient(105deg, #493cc4, #6655dc); box-shadow: 0 11px 22px #6858e83d; }
        .link { color: #5144c7; font-weight: 750; }
        .link:hover { color: #392e9e; text-decoration: underline; }
        .foot { margin: 24px 0 0; color: var(--auth-muted); font-size: 14px; font-weight: 500; text-align: center; }
        .alert { margin-bottom: 18px; padding: 12px 14px; border: 1px solid #f3d0cc; border-radius: 11px; color: #9f302a; background: #fff2f0; font-size: 14px; line-height: 1.6; }
        .remember { display: flex; align-items: center; gap: 9px; margin-top: 16px; color: var(--auth-muted); font-size: 14px; font-weight: 600; cursor: pointer; }
        .remember input { width: 16px; height: 16px; margin: 0; accent-color: #6254dc; }
        body[data-theme="dark"] {
            color-scheme: dark;
            --auth-bg: #171725;
            --auth-ink: #f0effa;
            --auth-muted: #b2b1c5;
            --auth-border: #414157;
            --auth-input: #202033;
        }
        body[data-theme="dark"] .input-icon { color: #b2b1c5; }
        body[data-theme="dark"] .password-toggle { color: #c1c0d2; }
        body[data-theme="dark"] .password-toggle:hover { color: #ddd9ff; background: #34324c; }
        body[data-theme="dark"] .link { color: #b9b0ff; }
        :focus-visible { outline: 3px solid #8274e988; outline-offset: 3px; }
        @media (max-width: 790px) {
            .auth-shell { grid-template-columns: 1fr; }
            .auth-showcase { min-height: 390px; padding: 32px clamp(25px, 8vw, 70px); }
            .showcase-content { margin: 30px 0; }
            .auth-showcase h2 { font-size: clamp(36px, 8vw, 52px); }
            .auth-showcase p { font-size: 14px; }
            .study-card { max-width: none; }
            .auth-card { width: min(100%, 520px); padding: 50px clamp(26px, 8vw, 58px); }
        }
        @media (max-width: 480px) {
            .auth-showcase { min-height: 340px; padding: 25px 22px; }
            .showcase-content { margin: 23px 0; }
            .auth-showcase h2 { margin: 13px 0 9px; font-size: 37px; }
            .auth-showcase p { font-size: 13px; }
            .study-card { padding: 15px; }
            .auth-card { padding: 48px 24px 35px; }
            .auth-theme-toggle { top: 12px; right: 19px; width: 36px; height: 36px; }
            h1 { font-size: 28px; }
        }
    </style>
</head>
<body>
    <div class="auth-shell">
        <section class="auth-showcase">
            <div class="auth-brand"><span class="brand-mark">ID</span> Belajar.ID </div>
            <div class="showcase-content">
                <span class="auth-kicker">Ruang belajar pribadimu</span>
                <h2>Ruang untuk<br>bertumbuh.</h2>
                <p>Satukan tugas, tenggat, dan progres belajar supaya kamu bisa fokus pada hal yang paling penting.</p>
            </div>
            <div class="study-card">
                <div class="study-card-label">LANGKAH KECIL, PROGRES BESAR</div>
                <div class="study-card-title">Konsisten sedikit demi sedikit.</div>
                <div class="study-progress"><span></span></div>
                <div class="study-card-foot"><span>Terus jaga ritmemu</span><span>68%</span></div>
            </div>
        </section>
        @yield('content')
    </div>
    <script>
        (function () {
            var themeButton = document.querySelector('.auth-theme-toggle');
            var theme = localStorage.getItem('belajar-id-theme') || 'light';

            function applyTheme(value) {
                document.body.dataset.theme = value;
                if (themeButton) {
                    themeButton.querySelector('span').textContent = value === 'dark' ? '☀' : '☾';
                    themeButton.setAttribute('aria-label', value === 'dark' ? 'Aktifkan mode terang' : 'Aktifkan mode gelap');
                }
            }

            applyTheme(theme);
            if (themeButton) {
                themeButton.addEventListener('click', function () {
                    theme = document.body.dataset.theme === 'dark' ? 'light' : 'dark';
                    localStorage.setItem('belajar-id-theme', theme);
                    applyTheme(theme);
                });
            }

            var passwordToggle = document.querySelector('.password-toggle');
            if (passwordToggle) {
                passwordToggle.addEventListener('click', function () {
                    var passwordInput = document.getElementById(passwordToggle.getAttribute('aria-controls'));
                    var shouldShow = passwordInput.type === 'password';

                    passwordInput.type = shouldShow ? 'text' : 'password';
                    passwordToggle.setAttribute('aria-label', shouldShow ? 'Sembunyikan kata sandi' : 'Tampilkan kata sandi');
                    passwordToggle.querySelector('.eye-open').hidden = !shouldShow;
                    passwordToggle.querySelector('.eye-closed').hidden = shouldShow;
                });
            }
        }());
    </script>
</body>
</html>
