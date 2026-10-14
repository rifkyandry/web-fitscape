
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — Fitscape Studio</title>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        
        :root {
            /* Menggunakan palet warna yang sama dengan Homepage */
            --red: #DE4331; 
            --red2: #B93626;
            --dark: #EBE9E1;   /* Krem Terang */
            --dark2: #F7F6F1;  /* Krem Lebih Terang */
            --dark3: #FFFFFF;  /* Putih */
            --border: #D4D2C7; /* Abu-abu terang */
            --dim: #333333;    /* Teks abu-abu gelap */
            --dim2: #666666;
            --white: #111111;  /* Teks hitam pekat */
        }

        body {
            background: var(--dark);
            font-family: 'Space Grotesk', sans-serif;
            min-height: 100vh;
            display: flex;
            color: var(--white);
        }

        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background-image: 
                linear-gradient(rgba(17,17,17,0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(17,17,17,0.03) 1px, transparent 1px);
            background-size: 60px 60px;
            pointer-events: none;
            z-index: 0;
        }

        .left-panel {
            width: 55%;
            background: var(--dark2);
            border-right: 1px solid var(--border);
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
            bottom: -100px;
            left: -100px;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(222,67,49,0.08) 0%, transparent 70%);
            pointer-events: none;
        }
        .brand { display: flex; align-items: center; gap: 12px; z-index: 1; }
        .brand img { width: 45px; height: 45px; object-fit: contain; border-radius: 50%; }
        .brand-text { font-size: 16px; font-weight: 800; letter-spacing: 2px; color: var(--white); }
        .brand-text span { color: var(--red); }
        
        .left-content { z-index: 1; }
        .left-content h1 {
            font-size: 52px;
            font-weight: 800;
            line-height: 1;
            letter-spacing: -2px;
            margin-bottom: 20px;
            color: var(--white);
        }
        .left-content h1 span { color: var(--red); }
        .left-content p { font-size: 14px; color: var(--dim); line-height: 1.7; max-width: 360px; }
        .left-footer { font-size: 11px; color: var(--dim2); letter-spacing: 1px; z-index: 1; }

        .right-panel {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px;
            position: relative;
            z-index: 1;
        }
        .form-box { width: 100%; max-width: 380px; }
        .form-label {
            font-size: 11px;
            color: var(--red);
            font-weight: 700;
            letter-spacing: 3px;
            text-transform: uppercase;
            margin-bottom: 8px;
        }
        .form-title {
            font-size: 28px;
            font-weight: 800;
            margin-bottom: 8px;
            letter-spacing: -1px;
            color: var(--white);
        }
        .form-sub { font-size: 13px; color: var(--dim); margin-bottom: 35px; }
        
        .form-group { margin-bottom: 20px; }
        .form-group label {
            display: block;
            font-size: 11px;
            color: var(--dim);
            letter-spacing: 1px;
            text-transform: uppercase;
            margin-bottom: 8px;
            font-weight: 700;
        }
        .form-group input {
            width: 100%;
            background: var(--dark3);
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 14px 16px;
            color: var(--white);
            font-size: 14px;
            font-family: 'Space Grotesk', sans-serif;
            transition: 0.2s;
        }
        .form-group input::placeholder { color: #A0A0A0; }
        .form-group input:focus {
            outline: none;
            border-color: var(--red);
            background: #FFFFFF;
            box-shadow: 0 0 0 3px rgba(222,67,49,0.1);
        }
        .form-error { font-size: 12px; color: var(--red); margin-top: 6px; }
        
        .remember-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }
        .remember-row label {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 13px;
            color: var(--dim);
            cursor: pointer;
            font-weight: 500;
        }
        .remember-row input[type="checkbox"] { accent-color: var(--red); }
        .forgot-link { font-size: 12px; color: var(--dim2); text-decoration: none; transition: color 0.2s; font-weight: 600;}
        .forgot-link:hover { color: var(--red); }
        
        .btn-submit {
            width: 100%;
            padding: 15px;
            background: var(--red);
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 800;
            font-family: 'Space Grotesk', sans-serif;
            cursor: pointer;
            letter-spacing: 1px;
            text-transform: uppercase;
            transition: all 0.2s;
            margin-bottom: 20px;
        }
        .btn-submit:hover { background: var(--red2); transform: translateY(-2px); box-shadow: 0 4px 12px rgba(222,67,49,0.2); }
        
        .register-link { text-align: center; font-size: 13px; color: var(--dim); }
        .register-link a { color: var(--red); text-decoration: none; font-weight: 700; transition: color 0.2s;}
        .register-link a:hover { color: var(--red2); text-decoration: underline; }
        
        .alert-info {
            background: rgba(46, 204, 113, 0.1);
            border: 1px solid #2ECC71;
            border-radius: 8px;
            padding: 12px 16px;
            font-size: 13px;
            color: #27AE60;
            margin-bottom: 20px;
            font-weight: 600;
        }

        @media (max-width: 768px) {
            body { flex-direction: column; }
            .left-panel { width: 100%; padding: 30px 25px; min-height: auto; border-right: none; border-bottom: 1px solid var(--border); }
            .left-content h1 { font-size: 36px; }
            .right-panel { padding: 30px 25px; }
        }
    </style>
</head>
<body>

    {{-- Left Panel --}}
    <div class="left-panel">
       <a href="{{ url('/') }}" style="text-decoration: none; color: inherit;">
    <div class="brand">
        <img src="{{ asset('images/logo.jpeg') }}" alt="Logo">
        <div class="brand-text">FITSCAPE <span>STUDIO</span></div>
    </div>
</a>
        <div class="left-content">
            <h1>WELCOME<br><span>BACK.</span></h1>
            <p>Login ke akun Anda untuk mengakses dashboard, QR Code absensi, dan riwayat kehadiran Anda.</p>
        </div>
        <div class="left-footer">© 2026 FITSCAPE FITNESS STUDIO</div>
    </div>

    {{-- Right Panel --}}
    <div class="right-panel">
        <div class="form-box">
            <div class="form-label">Member Access</div>
            <div class="form-title">Sign In</div>
            <div class="form-sub">Masukkan kredensial Anda untuk melanjutkan</div>

            @if(session('status'))
                <div class="alert-info">{{ session('status') }}</div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="email@example.com">
                    @error('email')<div class="form-error">{{ $message }}</div>@enderror
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <div style="position:relative;">
                        <input type="password" name="password" id="passwordInput" required autocomplete="current-password" placeholder="••••••••" style="padding-right:46px;">
                        <button type="button" onclick="togglePassword()" id="toggleBtn"
                            style="position:absolute; right:14px; top:50%; transform:translateY(-50%);
                                   background:none; border:none; cursor:pointer; padding:0; color:var(--dim2); transition:color 0.2s;"
                            onmouseover="this.style.color='var(--red)'"
                            onmouseout="this.style.color='var(--dim2)'">
                            <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                <circle cx="12" cy="12" r="3"/>
                            </svg>
                            <svg id="eyeOffIcon" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="display:none;">
                                <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94"/>
                                <path d="M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19"/>
                                <line x1="1" y1="1" x2="23" y2="23"/>
                            </svg>
                        </button>
                    </div>
                    @error('password')<div class="form-error">{{ $message }}</div>@enderror
                </div>

                <div class="remember-row">
                    <label>
                        <input type="checkbox" id="showPassCheckbox" onchange="togglePassword()">
                        Tampilkan password
                    </label>
                    @if(Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="forgot-link">Lupa password?</a>
                    @endif
                </div>

                <button type="submit" class="btn-submit">Login</button>

                <div class="register-link">
                    Belum punya akun? <a href="{{ route('register') }}">Daftar sekarang</a>
                </div>
            </form>
        </div>
    </div>

<script>
function togglePassword() {
    const input    = document.getElementById('passwordInput');
    const checkbox = document.getElementById('showPassCheckbox');
    const eyeOn    = document.getElementById('eyeIcon');
    const eyeOff   = document.getElementById('eyeOffIcon');

    const isVisible = input.type === 'text';

    input.type       = isVisible ? 'password' : 'text';
    checkbox.checked = !isVisible;
    eyeOn.style.display  = isVisible ? 'block' : 'none';
    eyeOff.style.display = isVisible ? 'none'  : 'block';
}
</script>
</body>
</html>

```