<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f4; margin: 0; padding: 0; }
        .container { max-width: 500px; margin: 40px auto; background: #fff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 20px rgba(0,0,0,0.1); }
        .header { background: #111; padding: 30px; text-align: center; }
        .header h1 { color: #C9A84C; font-size: 20px; margin: 0; letter-spacing: 2px; }
        .header p { color: #555; font-size: 12px; margin: 5px 0 0; }
        .body { padding: 40px 30px; }
        .alert-box { background: #fff8e6; border: 2px solid #C9A84C; border-radius: 12px; padding: 20px; text-align: center; margin: 20px 0; }
        .days-num { font-size: 52px; font-weight: 900; color: #C0392B; line-height: 1; }
        .days-label { font-size: 14px; color: #777; margin-top: 4px; }
        .info-row { display: flex; justify-content: space-between; padding: 10px 0; border-bottom: 1px solid #f0f0f0; font-size: 13px; }
        .info-row:last-child { border-bottom: none; }
        .info-label { color: #999; }
        .info-value { font-weight: 700; color: #333; }
        .btn { display: block; text-align: center; background: #C0392B; color: #fff; padding: 14px; border-radius: 8px; text-decoration: none; font-weight: 800; font-size: 14px; margin-top: 25px; letter-spacing: 1px; }
        .footer { background: #f8f8f8; padding: 20px; text-align: center; font-size: 11px; color: #bbb; border-top: 1px solid #eee; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>FITSCAPE STUDIO</h1>
            <p>Premium Membership</p>
        </div>
        <div class="body">
            <p style="font-size:15px; color:#333;">Halo, <strong>{{ $member->name }}</strong>! 👋</p>
            <p style="font-size:13px; color:#777; line-height:1.6;">Kami ingin mengingatkan bahwa membership Anda di Fitscape Studio akan segera berakhir.</p>

            <div class="alert-box">
                <div class="days-num">{{ $daysLeft }}</div>
                <div class="days-label">HARI LAGI</div>
            </div>

            <div style="background: #f9f9f9; border-radius: 10px; padding: 16px; margin: 20px 0;">
                <div class="info-row">
                    <span class="info-label">Member ID</span>
                    <span class="info-value">{{ $member->member_id }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Paket</span>
                    <span class="info-value">{{ $member->membershipPackage->name ?? '-' }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Tanggal Expired</span>
                    <span class="info-value">{{ \Carbon\Carbon::parse($member->membership_end_date)->format('d M Y') }}</span>
                </div>
            </div>

            <p style="font-size:13px; color:#777; line-height:1.6;">Segera perpanjang membership Anda agar tidak kehilangan akses ke fasilitas gym dan fitur QR Code absensi.</p>

            <a href="{{ url('/dashboard') }}" class="btn">PERPANJANG SEKARANG</a>
        </div>
        <div class="footer">
            © 2026 Fitscape Fitness Studio. All rights reserved.<br>
            Jika Anda tidak ingin menerima email ini, hubungi admin gym.
        </div>
    </div>
</body>
</html>