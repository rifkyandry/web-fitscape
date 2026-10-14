<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi OTP - Fitscape Studio</title>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            background: #080808;
            font-family: 'Space Grotesk', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
        }
        .card {
            width: 100%;
            max-width: 420px;
            background: #111;
            border: 1px solid #1e1e1e;
            border-radius: 20px;
            padding: 50px 40px;
            text-align: center;
        }
        .logo { font-size: 14px; font-weight: 800; letter-spacing: 3px; color: #C9A84C; margin-bottom: 30px; }
        h2 { font-size: 24px; font-weight: 800; margin-bottom: 10px; }
        .subtitle { font-size: 13px; color: #555; margin-bottom: 30px; line-height: 1.6; }
        .email-badge {
            background: #1a1a1a;
            border: 1px solid #222;
            border-radius: 8px;
            padding: 10px 16px;
            font-size: 13px;
            color: #C9A84C;
            margin-bottom: 30px;
            display: inline-block;
        }
        .otp-inputs {
            display: flex;
            gap: 10px;
            justify-content: center;
            margin-bottom: 25px;
        }
        .otp-inputs input {
            width: 50px;
            height: 60px;
            background: #1a1a1a;
            border: 1px solid #2a2a2a;
            border-radius: 10px;
            color: #fff;
            font-size: 24px;
            font-weight: 800;
            text-align: center;
            font-family: 'Space Grotesk', sans-serif;
            transition: 0.2s;
        }
        .otp-inputs input:focus {
            outline: none;
            border-color: #C0392B;
            background: #1e1010;
        }
        .btn-verify {
            width: 100%;
            padding: 14px;
            background: #C0392B;
            color: #fff;
            border: none;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 800;
            font-family: 'Space Grotesk', sans-serif;
            cursor: pointer;
            letter-spacing: 1px;
            transition: 0.2s;
            margin-bottom: 15px;
        }
        .btn-verify:hover { background: #a93226; }
        .resend {
            font-size: 13px;
            color: #555;
        }
        .resend a {
            color: #C9A84C;
            text-decoration: none;
            font-weight: 600;
        }
        .resend a:hover { text-decoration: underline; }
        .error { color: #ff4444; font-size: 12px; margin-bottom: 15px; }
        .success-msg { color: #00E676; font-size: 12px; margin-bottom: 15px; }
        input[type="hidden"] { display: none; }
    </style>
</head>
<body>
    <div class="card">
        <div class="logo">FITSCAPE STUDIO</div>
        <h2>Verifikasi OTP</h2>
        <p class="subtitle">Kode 6 digit telah dikirim ke email Anda</p>

        @if(session('otp_email'))
            <div class="email-badge">📧 {{ session('otp_email') }}</div>
        @endif

        @if(session('success'))
            <div class="success-msg">✅ {{ session('success') }}</div>
        @endif

        @if($errors->any())
            <div class="error">❌ {{ $errors->first() }}</div>
        @endif

        <form method="POST" action="{{ route('otp.verify') }}" id="otp-form">
            @csrf
            <input type="hidden" name="otp" id="otp-hidden">
            <div class="otp-inputs">
                <input type="text" maxlength="1" class="otp-digit" inputmode="numeric">
                <input type="text" maxlength="1" class="otp-digit" inputmode="numeric">
                <input type="text" maxlength="1" class="otp-digit" inputmode="numeric">
                <input type="text" maxlength="1" class="otp-digit" inputmode="numeric">
                <input type="text" maxlength="1" class="otp-digit" inputmode="numeric">
                <input type="text" maxlength="1" class="otp-digit" inputmode="numeric">
            </div>
            <button type="submit" class="btn-verify">VERIFIKASI</button>
        </form>

        <div class="resend">
            Tidak dapat kode? <a href="{{ route('otp.resend') }}">Kirim ulang</a>
        </div>
    </div>

    <script>
        const digits = document.querySelectorAll('.otp-digit');
        const hidden = document.getElementById('otp-hidden');
        const form = document.getElementById('otp-form');

        digits.forEach((input, i) => {
            input.addEventListener('input', () => {
                if (input.value && i < digits.length - 1) digits[i + 1].focus();
                hidden.value = Array.from(digits).map(d => d.value).join('');
            });
            input.addEventListener('keydown', (e) => {
                if (e.key === 'Backspace' && !input.value && i > 0) digits[i - 1].focus();
            });
        });
    </script>
</body>
</html>