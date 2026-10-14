<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password — Fitscape Studio</title>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            background: #080808;
            font-family: 'Space Grotesk', sans-serif;
            min-height: 100vh;
            display: flex;
            color: #fff;
        }
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background-image:
                linear-gradient(rgba(192,57,43,0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(192,57,43,0.03) 1px, transparent 1px);
            background-size: 60px 60px;
            pointer-events: none;
            z-index: 0;
        }
        .left-panel {
            width: 55%;
            background: #0a0a0a;
            border-right: 1px solid #1a1a1a;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 50px 60px;
            position: relative;
            overflow: hidden;
        }
        .left-panel::before {
            content: '';
            position: absolute;
            bottom: -100px; left: -100px;
            width: 500px; height: 500px;
            background: radial-gradient(circle, rgba(192,57,43,0.08) 0%, transparent 70%);
            pointer-events: none;
        }
        .brand { display: flex; align-items: center; gap: 12px; z-index: 1; }
        .brand img { width: 45px; height: 45px; object-fit: contain; border-radius: 50%; }
        .brand-text { font-size: 16px; font-weight: 800; letter-spacing: 2px; }
        .brand-text span { color: #C9A84C; }
        .left-content { z-index: 1; }
        .left-content h1 {
            font-size: 52px; font-weight: 800; line-height: 1;
            letter-spacing: -2px; margin-bottom: 20px;
        }
        .left-content h1 span { color: #C0392B; }
        .left-content p { font-size: 14px; color: #aaa; line-height: 1.7; max-width: 360px; }
        .tips { margin-top: 30px; display: flex; flex-direction: column; gap: 12px; }
        .tip-item {
            display: flex; align-items: flex-start; gap: 12px;
            background: #111; border: 1px solid #1e1e1e;
            border-radius: 10px; padding: 14px;
        }
        .tip-icon { font-size: 18px; flex-shrink: 0; margin-top: 1px; }
        .tip-text { font-size: 12px; color: #ccc; line-height: 1.6; }
        .left-footer { font-size: 11px; color: #555; letter-spacing: 1px; z-index: 1; }
        .right-panel {
            flex: 1; display: flex; align-items: center;
            justify-content: center; padding: 40px;
            position: relative; z-index: 1;
        }
        .form-box { width: 100%; max-width: 380px; }
        .form-label { font-size: 11px; color: #C9A84C; letter-spacing: 3px; text-transform: uppercase; margin-bottom: 8px; }
        .form-title { font-size: 28px; font-weight: 800; margin-bottom: 8px; letter-spacing: -1px; color: #fff; }
        .form-sub { font-size: 13px; color: #aaa; margin-bottom: 30px; line-height: 1.7; }
        .form-group { margin-bottom: 18px; }
        .form-group label { display: block; font-size: 11px; color: #ccc; letter-spacing: 1px; text-transform: uppercase; margin-bottom: 8px; font-weight: 600; }
        .pass-wrapper { position: relative; }
        .pass-wrapper input { padding-right: 46px; }
        .form-group input {
            width: 100%; background: #111; border: 1px solid #222;
            border-radius: 8px; padding: 14px 16px; color: #fff;
            font-size: 14px; font-family: 'Space Grotesk', sans-serif; transition: 0.2s;
        }
        .form-group input::placeholder { color: #555; }
        .form-group input:focus { outline: none; border-color: #C0392B; background: #160d0d; }
        .form-error { font-size: 12px; color: #ff4444; margin-top: 6px; }
        .toggle-btn {
            position: absolute; right: 14px; top: 50%; transform: translateY(-50%);
            background: none; border: none; cursor: pointer; padding: 0;
            color: #777; transition: color 0.2s;
        }
        .toggle-btn:hover { color: #C9A84C; }
        .show-pass-row {
            display: flex; align-items: center; gap: 8px;
            margin-top: 10px; margin-bottom: 18px;
        }
        .show-pass-row input[type="checkbox"] { accent-color: #C0392B; cursor: pointer; }
        .show-pass-row label { font-size: 12px; color: #ccc; cursor: pointer; }
        .btn-submit {
            width: 100%; padding: 15px; background: #C0392B; color: #fff;
            border: none; border-radius: 8px; font-size: 14px; font-weight: 800;
            font-family: 'Space Grotesk', sans-serif; cursor: pointer;
            letter-spacing: 1px; text-transform: uppercase; transition: 0.2s;
            margin-bottom: 20px;
        }
        .btn-submit:hover { background: #a93226; transform: translateY(-1px); }
        .back-link { text-align: center; font-size: 13px; color: #aaa; }
        .back-link a { color: #C9A84C; text-decoration: none; font-weight: 600; }
        .back-link a:hover { text-decoration: underline; }

        @media (max-width: 768px) {
            body { flex-direction: column; }
            .left-panel { width: 100%; padding: 30px 25px; min-height: auto; }
            .left-content h1 { font-size: 36px; }
            .right-panel { padding: 30px 25px; }
        }
    </style>
</head>
<body>

    <div class="left-panel">
        <div class="brand">
            <img src="{{ asset('images/logo.jpeg') }}" alt="Fitscape">
            <div class="brand-text">FITSCAPE <span>STUDIO</span></div>
        </div>
        <div class="left-content">
            <h1>BUAT<br><span>PASSWORD</span><br>BARU.</h1>
            <p>Pastikan password baru Anda kuat dan mudah diingat.</p>
            <div class="tips">
                <div class="tip-item">
                    <div class="tip-icon">🔒</div>
                    <div class="tip-text">Minimal 8 karakter, kombinasi huruf dan angka</div>
                </div>
                <div class="tip-item">
                    <div class="tip-icon">⚡</div>
                    <div class="tip-text">Jangan gunakan password yang sama dengan akun lain</div>
                </div>
                <div class="tip-item">
                    <div class="tip-icon">✅</div>
                    <div class="tip-text">Setelah reset, Anda akan diarahkan ke halaman login</div>
                </div>
            </div>
        </div>
        <div class="left-footer">© 2026 FITSCAPE FITNESS STUDIO</div>
    </div>

    <div class="right-panel">
        <div class="form-box">
            <div class="form-label">Reset Akses</div>
            <div class="form-title">Password Baru</div>
            <div class="form-sub">Masukkan password baru untuk akun Anda.</div>

            <form method="POST" action="{{ route('password.store') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" value="{{ old('email', $request->email) }}"
                        required autofocus autocomplete="username" placeholder="email@example.com">
                    @error('email')<div class="form-error">{{ $message }}</div>@enderror
                </div>

                <div class="form-group">
                    <label>Password Baru</label>
                    <div class="pass-wrapper">
                        <input type="password" name="password" id="passNew"
                            required autocomplete="new-password" placeholder="Min. 8 karakter">
                        <button type="button" class="toggle-btn"
                            onclick="togglePass('passNew','eyeOn1','eyeOff1')">
                            <svg id="eyeOn1" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                <circle cx="12" cy="12" r="3"/>
                            </svg>
                            <svg id="eyeOff1" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="display:none;">
                                <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94"/>
                                <path d="M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19"/>
                                <line x1="1" y1="1" x2="23" y2="23"/>
                            </svg>
                        </button>
                    </div>
                    @error('password')<div class="form-error">{{ $message }}</div>@enderror
                </div>

                <div class="form-group">
                    <label>Konfirmasi Password</label>
                    <div class="pass-wrapper">
                        <input type="password" name="password_confirmation" id="passConfirm"
                            required autocomplete="new-password" placeholder="Ulangi password baru">
                        <button type="button" class="toggle-btn"
                            onclick="togglePass('passConfirm','eyeOn2','eyeOff2')">
                            <svg id="eyeOn2" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                <circle cx="12" cy="12" r="3"/>
                            </svg>
                            <svg id="eyeOff2" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="display:none;">
                                <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94"/>
                                <path d="M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19"/>
                                <line x1="1" y1="1" x2="23" y2="23"/>
                            </svg>
                        </button>
                    </div>
                    @error('password_confirmation')<div class="form-error">{{ $message }}</div>@enderror
                </div>

                <div class="show-pass-row">
                    <input type="checkbox" id="showPassAll" onchange="toggleAllPass()">
                    <label for="showPassAll">Tampilkan password</label>
                </div>

                <button type="submit" class="btn-submit">Reset Password</button>

                <div class="back-link">
                    Ingat password? <a href="{{ route('login') }}">Kembali ke Login</a>
                </div>
            </form>
        </div>
    </div>

<script>
    function togglePass(inputId, eyeOnId, eyeOffId) {
        const input  = document.getElementById(inputId);
        const eyeOn  = document.getElementById(eyeOnId);
        const eyeOff = document.getElementById(eyeOffId);
        const isVisible = input.type === 'text';
        input.type = isVisible ? 'password' : 'text';
        eyeOn.style.display  = isVisible ? 'block' : 'none';
        eyeOff.style.display = isVisible ? 'none'  : 'block';
        syncCheckbox();
    }

    function toggleAllPass() {
        const show   = document.getElementById('showPassAll').checked;
        const inputs = ['passNew', 'passConfirm'];
        const icons  = [['eyeOn1','eyeOff1'], ['eyeOn2','eyeOff2']];
        inputs.forEach((id, i) => {
            document.getElementById(id).type = show ? 'text' : 'password';
            document.getElementById(icons[i][0]).style.display = show ? 'none'  : 'block';
            document.getElementById(icons[i][1]).style.display = show ? 'block' : 'none';
        });
    }

    function syncCheckbox() {
        const p1 = document.getElementById('passNew').type === 'text';
        const p2 = document.getElementById('passConfirm').type === 'text';
        document.getElementById('showPassAll').checked = p1 && p2;
    }
</script>
</body>
</html>