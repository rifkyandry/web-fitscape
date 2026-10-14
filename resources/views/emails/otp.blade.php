<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f4; margin: 0; padding: 20px; }
        .container { max-width: 500px; margin: 0 auto; background: #ffffff; border-radius: 10px; overflow: hidden; }
        .header { background: #1A56DB; padding: 30px; text-align: center; }
        .header h1 { color: #ffffff; margin: 0; font-size: 22px; }
        .body { padding: 30px; }
        .otp-box { background: #f0f4ff; border: 2px dashed #1A56DB; border-radius: 8px;
                   text-align: center; padding: 20px; margin: 24px 0; }
        .otp-code { font-size: 42px; font-weight: bold; color: #1A56DB; letter-spacing: 10px; }
        .footer { background: #f8f8f8; padding: 16px; text-align: center;
                  font-size: 12px; color: #999; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🏋️ Fitscape Studio</h1>
        </div>
        <div class="body">
            <p>Halo, <strong>{{ $memberName }}</strong>!</p>
            <p>Gunakan kode OTP berikut untuk login:</p>

            <div class="otp-box">
                <div class="otp-code">{{ $otpCode }}</div>
            </div>

            <p>⏱️ Kode berlaku selama <strong>5 menit</strong>.</p>
            <p>Jika Anda tidak merasa melakukan login, abaikan email ini.</p>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} Fitscape Studio. All rights reserved.
        </div>
    </div>
</body>
</html>