<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register — Fitscape Studio</title>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        
        :root {
            /* Menggunakan palet warna yang sama dengan Homepage & Login */
            --red: #DE4331; 
            --red2: #B93626;
            --dark: #EBE9E1;   /* Krem Terang */
            --dark2: #F7F6F1;  /* Krem Lebih Terang */
            --dark3: #FFFFFF;  /* Putih */
            --border: #D4D2C7; /* Abu-abu terang */
            --dim: #333333;    /* Teks abu-abu gelap */
            --dim2: #666666;   /* Teks info tambahan */
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
            font-size: 52px; font-weight: 800; line-height: 1; 
            letter-spacing: -2px; margin-bottom: 20px; color: var(--white);
        }
        .left-content h1 span { color: var(--red); }
        .left-content p { font-size: 14px; color: var(--dim); line-height: 1.7; max-width: 360px; }
        
        .steps { margin-top: 30px; display: flex; flex-direction: column; gap: 15px; z-index: 1; }
        .step-item { display: flex; align-items: center; gap: 15px; }
        .step-num { 
            width: 28px; height: 28px; border-radius: 50%; 
            border: 1px solid var(--red); display: flex; align-items: center; 
            justify-content: center; font-size: 11px; color: var(--red); 
            font-weight: 700; flex-shrink: 0;
        }
        .step-text { font-size: 13px; color: var(--dim); font-weight: 500; }
        
        .left-footer { font-size: 11px; color: var(--dim2); letter-spacing: 1px; z-index: 1; }
        
        .right-panel {
            flex: 1; display: flex; align-items: center; 
            justify-content: center; padding: 40px; 
            position: relative; z-index: 1;
        }
        
        .form-box { width: 100%; max-width: 380px; }
        .form-label { font-size: 11px; color: var(--red); font-weight: 700; letter-spacing: 3px; text-transform: uppercase; margin-bottom: 8px; }
        .form-title { font-size: 28px; font-weight: 800; margin-bottom: 8px; letter-spacing: -1px; color: var(--white); }
        .form-sub { font-size: 13px; color: var(--dim); margin-bottom: 30px; }
        
        .form-group { margin-bottom: 18px; }
        .form-group label { display: block; font-size: 11px; color: var(--dim); letter-spacing: 1px; text-transform: uppercase; margin-bottom: 8px; font-weight: 700; }
        .form-group input {
            width: 100%; background: var(--dark3); border: 1px solid var(--border);
            border-radius: 8px; padding: 13px 16px; color: var(--white);
            font-size: 14px; font-family: 'Space Grotesk', sans-serif; transition: 0.2s;
        }
        .form-group input::placeholder { color: #A0A0A0; }
        .form-group input:focus { 
            outline: none; border-color: var(--red); background: #FFFFFF;
            box-shadow: 0 0 0 3px rgba(222,67,49,0.1); 
        }
        .form-error { font-size: 12px; color: var(--red); margin-top: 6px; }
        
        .btn-submit {
            width: 100%; padding: 15px; background: var(--red); color: #fff;
            border: none; border-radius: 8px; font-size: 14px; font-weight: 800;
            font-family: 'Space Grotesk', sans-serif; cursor: pointer;
            letter-spacing: 1px; text-transform: uppercase; transition: all 0.2s;
            margin-bottom: 20px; margin-top: 5px;
        }
        .btn-submit:hover { background: var(--red2); transform: translateY(-2px); box-shadow: 0 4px 12px rgba(222,67,49,0.2); }
        
        .login-link { text-align: center; font-size: 13px; color: var(--dim); }
        .login-link a { color: var(--red); text-decoration: none; font-weight: 700; transition: color 0.2s;}
        .login-link a:hover { color: var(--red2); text-decoration: underline; }

        /* Toggle password wrapper */
        .pass-wrapper { position: relative; }
        .pass-wrapper input { padding-right: 46px; }
        .toggle-btn {
            position: absolute; right: 14px; top: 50%; transform: translateY(-50%);
            background: none; border: none; cursor: pointer; padding: 0;
            color: var(--dim2); transition: color 0.2s;
        }
        .toggle-btn:hover { color: var(--red); }

        /* Show password checkbox row */
        .show-pass-row {
            display: flex; align-items: center; gap: 8px;
            margin-top: 10px; margin-bottom: 4px;
        }
        .show-pass-row input[type="checkbox"] { accent-color: var(--red); cursor: pointer; }
        .show-pass-row label { font-size: 13px; font-weight: 500; color: var(--dim); cursor: pointer; }

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
            <h1>JOIN<br><span>FITSCAPE.</span></h1>
            <p>Daftarkan diri Anda dan dapatkan akses ke sistem membership gym premium dengan teknologi QR Code dinamis.</p>
            <div class="steps">
                <div class="step-item">
                    <div class="step-num">1</div>
                    <div class="step-text">Daftar akun — otomatis dapat Member ID unik</div>
                </div>
                <div class="step-item">
                    <div class="step-num">2</div>
                    <div class="step-text">Verifikasi email dengan kode OTP</div>
                </div>
                <div class="step-item">
                    <div class="step-num">3</div>
                    <div class="step-text">Pilih paket membership & tunggu konfirmasi admin</div>
                </div>
                <div class="step-item">
                    <div class="step-num">4</div>
                    <div class="step-text">Generate QR Code & mulai absensi!</div>
                </div>
            </div>
        </div>
        <div class="left-footer">© 2026 FITSCAPE FITNESS STUDIO</div>
    </div>

    {{-- Right Panel --}}
    <div class="right-panel">
        <div class="form-box">
            <div class="form-label">New Member</div>
            <div class="form-title">Create Account</div>
            <div class="form-sub">Isi form di bawah untuk membuat akun baru</div>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" name="name" value="{{ old('name') }}" required autofocus placeholder="John Doe">
                    @error('name')<div class="form-error">{{ $message }}</div>@enderror
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required placeholder="email@example.com">
                    @error('email')<div class="form-error">{{ $message }}</div>@enderror
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <div class="pass-wrapper">
                        <input type="password" name="password" id="passInput" required placeholder="Min. 8 karakter">
                        <button type="button" class="toggle-btn" onclick="togglePass('passInput','eyeOn1','eyeOff1','showPass1')"
                            onmouseover="this.style.color='var(--red)'"
                            onmouseout="this.style.color='var(--dim2)'">
                            <svg id="eyeOn1" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                <circle cx="12" cy="12" r="3"/>
                            </svg>
                            <svg id="eyeOff1" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="display:none;">
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
                        <input type="password" name="password_confirmation" id="passConfirmInput" required placeholder="Ulangi password">
                        <button type="button" class="toggle-btn" onclick="togglePass('passConfirmInput','eyeOn2','eyeOff2','showPass2')"
                            onmouseover="this.style.color='var(--red)'"
                            onmouseout="this.style.color='var(--dim2)'">
                            <svg id="eyeOn2" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                <circle cx="12" cy="12" r="3"/>
                            </svg>
                            <svg id="eyeOff2" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="display:none;">
                                <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94"/>
                                <path d="M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19"/>
                                <line x1="1" y1="1" x2="23" y2="23"/>
                            </svg>
                        </button>
                    </div>
                    @error('password_confirmation')<div class="form-error">{{ $message }}</div>@enderror
                </div>

                {{-- Checkbox tampilkan password --}}
                <div class="show-pass-row">
                    <input type="checkbox" id="showPassAll" onchange="toggleAllPass()">
                    <label for="showPassAll">Tampilkan password</label>
                </div>

                <button type="submit" class="btn-submit">Daftar Sekarang</button>

                <div class="login-link">
                    Sudah punya akun? <a href="{{ route('login') }}">Login di sini</a>
                </div>
            </form>
        </div>
    </div>

<script>
    // Toggle satu input password via ikon mata
    function togglePass(inputId, eyeOnId, eyeOffId, checkboxId) {
        const input  = document.getElementById(inputId);
        const eyeOn  = document.getElementById(eyeOnId);
        const eyeOff = document.getElementById(eyeOffId);

        const isVisible = input.type === 'text';
        input.type = isVisible ? 'password' : 'text';
        eyeOn.style.display  = isVisible ? 'block' : 'none';
        eyeOff.style.display = isVisible ? 'none'  : 'block';

        // Sync checkbox jika semua visible
        syncCheckbox();
    }

    // Toggle semua password via checkbox
    function toggleAllPass() {
        const checkbox = document.getElementById('showPassAll');
        const inputs   = ['passInput', 'passConfirmInput'];
        const icons    = [
            { on: 'eyeOn1', off: 'eyeOff1' },
            { on: 'eyeOn2', off: 'eyeOff2' },
        ];

        inputs.forEach((id, i) => {
            const input = document.getElementById(id);
            input.type  = checkbox.checked ? 'text' : 'password';
            document.getElementById(icons[i].on).style.display  = checkbox.checked ? 'none'  : 'block';
            document.getElementById(icons[i].off).style.display = checkbox.checked ? 'block' : 'none';
        });
    }

    // Sync state checkbox dengan kondisi input
    function syncCheckbox() {
        const p1 = document.getElementById('passInput').type === 'text';
        const p2 = document.getElementById('passConfirmInput').type === 'text';
        document.getElementById('showPassAll').checked = p1 && p2;
    }
</script>
</body>
</html>