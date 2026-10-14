<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password — Fitscape Studio</title>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        
        :root {
            /* Palet warna yang sama dengan Homepage, Login, dan Register */
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
            bottom: -100px; left: -100px;
            width: 500px; height: 500px;
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
        
        .steps { margin-top: 30px; display: flex; flex-direction: column; gap: 15px; }
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
        .form-sub { font-size: 13px; color: var(--dim); margin-bottom: 30px; line-height: 1.7; }
        
        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; font-size: 11px; color: var(--dim); letter-spacing: 1px; text-transform: uppercase; margin-bottom: 8px; font-weight: 700; }
        .form-group input {
            width: 100%; background: var(--dark3); border: 1px solid var(--border);
            border-radius: 8px; padding: 14px 16px; color: var(--white);
            font-size: 14px; font-family: 'Space Grotesk', sans-serif; transition: 0.2s;
        }
        .form-group input::placeholder { color: #A0A0A0; }
        .form-group input:focus { 
            outline: none; border-color: var(--red); background: #FFFFFF; 
            box-shadow: 0 0 0 3px rgba(222,67,49,0.1);
        }
        .form-error { font-size: 12px; color: var(--red); margin-top: 6px; }
        
        .alert-success {
            background: rgba(46, 204, 113, 0.1); 
            border: 1px solid #2ECC71;
            border-radius: 8px; padding: 12px 16px;
            font-size: 13px; color: #27AE60; margin-bottom: 20px;
            line-height: 1.6; font-weight: 600;
        }
        
        .btn-submit {
            width: 100%; padding: 15px; background: var(--red); color: #fff;
            border: none; border-radius: 8px; font-size: 14px; font-weight: 800;
            font-family: 'Space Grotesk', sans-serif; cursor: pointer;
            letter-spacing: 1px; text-transform: uppercase; transition: all 0.2s;
            margin-bottom: 20px;
        }
        .btn-submit:hover { background: var(--red2); transform: translateY(-2px); box-shadow: 0 4px 12px rgba(222,67,49,0.2); }
        
        .back-link { text-align: center; font-size: 13px; color: var(--dim); }
        .back-link a { color: var(--red); text-decoration: none; font-weight: 700; transition: color 0.2s; }
        .back-link a:hover { color: var(--red2); text-decoration: underline; }

        @media (max-width: 768px) {
            body { flex-direction: column; }
            .left-panel { width: 100%; padding: 30px 25px; min-height: auto; border-right: none; border-bottom: 1px solid var(--border); }
            .left-content h1 { font-size: 36px; }
            .right-panel { padding: 30px 25px; }
        }
    </style>
</head>
<body>

    <div class="left-panel">
        <a href="{{ url('/') }}" style="text-decoration: none; color: inherit;">
            <div class="brand">
                <img src="{{ asset('images/logo.jpeg') }}" alt="Fitscape">
                <div class="brand-text">FITSCAPE <span>STUDIO</span></div>
            </div>
        </a>
        <div class="left-content">
            <h1>LUPA<br><span>PASSWORD?</span></h1>
            <p>Tenang, kami akan kirimkan link reset password ke email Anda. Ikuti langkah berikut:</p>
            <div class="steps">
                <div class="step-item">
                    <div class="step-num">1</div>
                    <div class="step-text">Masukkan email yang terdaftar di Fitscape</div>
                </div>
                <div class="step-item">
                    <div class="step-num">2</div>
                    <div class="step-text">Cek inbox email Anda (termasuk folder Spam)</div>
                </div>
                <div class="step-item">
                    <div class="step-num">3</div>
                    <div class="step-text">Klik link reset password di email</div>
                </div>
                <div class="step-item">
                    <div class="step-num">4</div>
                    <div class="step-text">Buat password baru dan login kembali</div>
                </div>
            </div>
        </div>
        <div class="left-footer">© 2026 FITSCAPE FITNESS STUDIO</div>
    </div>

    <div class="right-panel">
        <div class="form-box">
            <div class="form-label">Reset Akses</div>
            <div class="form-title">Lupa Password</div>
            <div class="form-sub">Masukkan email Anda dan kami akan mengirimkan link untuk membuat password baru.</div>

            @if(session('status'))
                <div class="alert-success">
                    ✅ {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="email@example.com">
                    @error('email')<div class="form-error">{{ $message }}</div>@enderror
                </div>

                <button type="submit" class="btn-submit">Kirim Link Reset Password</button>

                <div class="back-link">
                    Ingat password? <a href="{{ route('login') }}">Kembali ke Login</a>
                </div>
            </form>
        </div>
    </div>

</body>
</html>