<x-app-layout>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Barlow:wght@400;500;600;700;800;900&family=Barlow+Condensed:wght@400;500;600;700;800;900&display=swap');

    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    :root {
        /* Palet warna Light Mode (Krem & Merah) */
        --red: #DE4331; 
        --red2: #B93626;
        --dark: #EBE9E1;   /* Krem Terang */
        --dark2: #F7F6F1;  /* Krem Lebih Terang */
        --dark3: #FFFFFF;  /* Putih Bersih untuk Card */
        --border: #D4D2C7; /* Garis Abu-abu terang */
        --dim: #333333;    /* Teks abu-abu gelap */
        --dim2: #666666;   /* Teks info tambahan */
        --white: #111111;  /* Teks hitam pekat (pengganti putih di mode gelap) */
    }

    .dashboard-wrap {
        min-height: calc(100vh - 62px);
        background: var(--dark);
        font-family: 'Barlow', sans-serif;
        color: var(--white);
        padding: 32px;
        position: relative;
        overflow: hidden;
    }

    .dashboard-wrap::before {
        content: '';
        position: fixed; inset: 0;
        background-image:
            linear-gradient(rgba(17,17,17,0.03) 1px, transparent 1px),
            linear-gradient(90deg, rgba(17,17,17,0.03) 1px, transparent 1px);
        background-size: 60px 60px;
        pointer-events: none; z-index: 0;
    }

    .dashboard-inner { position: relative; z-index: 1; max-width: 1400px; margin: 0 auto; }

    .top-row {
        display: grid;
        grid-template-columns: 1fr 340px;
        gap: 20px;
        margin-bottom: 20px;
    }

    .hero-card {
        background: var(--dark2);
        border: 1px solid var(--border);
        border-radius: 20px;
        overflow: hidden;
        position: relative;
        min-height: 220px;
        display: flex;
        align-items: flex-end;
        padding: 32px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.02);
    }
    
    .hero-card-bg {
        position: absolute; inset: 0;
        /* Efek gradient krem tembus pandang ke gambar gym */
        background-image:
            linear-gradient(to right, rgba(247,246,241,0.95) 40%, rgba(247,246,241,0.5) 100%),
            url('{{ asset("images/gym-bg.jpg") }}');
        background-size: cover; background-position: center;
    }
    
    .hero-card-accent {
        position: absolute; top: 0; left: 0; width: 4px; height: 100%;
        background: linear-gradient(180deg, var(--red), transparent);
    }
    
    .hero-card-content { position: relative; z-index: 1; }
    
    .hero-eyebrow {
        font-family: 'Barlow Condensed', sans-serif;
        font-size: 10px; font-weight: 700; letter-spacing: 4px;
        color: var(--red); text-transform: uppercase; margin-bottom: 8px;
    }
    
    .hero-name {
        font-family: 'Bebas Neue', sans-serif;
        font-size: 48px; letter-spacing: 2px; line-height: 1;
        color: var(--white); margin-bottom: 4px;
    }
    
    .hero-id {
        font-family: 'Barlow Condensed', sans-serif;
        font-size: 14px; font-weight: 700; letter-spacing: 3px;
        color: var(--red);
    }
    
    .hero-stats-row { display: flex; gap: 32px; margin-top: 24px; }
    
    .hero-stat-val {
        font-family: 'Bebas Neue', sans-serif;
        font-size: 32px; color: var(--white); line-height: 1;
    }
    
    .hero-stat-val span { color: var(--red); }
    
    .hero-stat-label {
        font-family: 'Barlow Condensed', sans-serif;
        font-size: 10px; font-weight: 700; letter-spacing: 3px;
        color: var(--dim2); text-transform: uppercase; margin-top: 4px;
    }

    .membership-card {
        background: var(--dark3);
        border: 1px solid var(--border);
        border-radius: 20px;
        padding: 28px;
        position: relative;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0,0,0,0.02);
    }
    
    .membership-card.active-card { border-color: var(--red); box-shadow: 0 4px 15px rgba(222,67,49,0.08); }
    .membership-card.active-card::before {
        content: ''; position: absolute; top: 0; left: 0; right: 0; height: 3px;
        background: linear-gradient(90deg, var(--red), transparent);
    }
    
    .membership-card.pending-card { border-color: #C9A84C; }
    .membership-card.pending-card::before {
        content: ''; position: absolute; top: 0; left: 0; right: 0; height: 3px;
        background: linear-gradient(90deg, #C9A84C, transparent);
    }
    
    .mc-label {
        font-family: 'Barlow Condensed', sans-serif;
        font-size: 10px; font-weight: 700; letter-spacing: 4px;
        color: var(--dim2); text-transform: uppercase; margin-bottom: 16px;
    }
    
    .mc-package {
        font-family: 'Bebas Neue', sans-serif;
        font-size: 36px; letter-spacing: 2px; color: var(--red);
        line-height: 1; margin-bottom: 6px;
    }
    
    .mc-status-badge {
        display: inline-flex; align-items: center; gap: 6px;
        font-family: 'Barlow Condensed', sans-serif;
        font-size: 11px; font-weight: 700; letter-spacing: 2px;
        text-transform: uppercase; padding: 4px 12px;
        border-radius: 100px; margin-bottom: 20px;
    }
    .mc-status-badge.active  { background: rgba(46, 204, 113, 0.1);  color: #27AE60; border: 1px solid rgba(46, 204, 113, 0.3); }
    .mc-status-badge.inactive{ background: var(--dark); color: var(--dim2); border: 1px solid var(--border); }
    .mc-status-badge.pending { background: rgba(201,168,76,0.1); color: #C9A84C; border: 1px solid rgba(201,168,76,0.3); }
    
    .mc-divider { height: 1px; background: var(--border); margin: 16px 0; }
    .mc-row { display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px; }
    
    .mc-key {
        font-family: 'Barlow Condensed', sans-serif;
        font-size: 11px; font-weight: 700; letter-spacing: 2px;
        color: var(--dim2); text-transform: uppercase;
    }
    .mc-val { font-size: 13px; font-weight: 700; color: var(--white); }

    .bottom-row {
        display: grid;
        grid-template-columns: 1fr 1fr 340px;
        gap: 20px;
    }

    .qr-card {
        background: var(--dark3);
        border: 1px solid var(--border);
        border-radius: 20px;
        padding: 32px;
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        box-shadow: 0 4px 12px rgba(0,0,0,0.02);
    }
    
    .qr-card-label {
        font-family: 'Barlow Condensed', sans-serif;
        font-size: 10px; font-weight: 700; letter-spacing: 4px;
        color: var(--dim2); text-transform: uppercase; margin-bottom: 24px;
        align-self: flex-start;
    }
    
    .qr-lock-area { width: 100%; }
    .qr-lock-icon { font-size: 40px; margin-bottom: 16px; }
    .qr-lock-title {
        font-family: 'Bebas Neue', sans-serif;
        font-size: 32px; letter-spacing: 2px; margin-bottom: 8px;
        color: var(--white);
    }
    
    .qr-lock-sub { font-size: 13px; color: var(--dim); margin-bottom: 24px; line-height: 1.6; }
    
    .btn-generate {
        width: 100%;
        font-family: 'Barlow Condensed', sans-serif;
        font-size: 14px; font-weight: 700; letter-spacing: 2px;
        color: #fff; background: var(--red); border: none;
        padding: 14px 24px; text-transform: uppercase;
        cursor: pointer; transition: all 0.2s; border-radius: 8px;
    }
    .btn-generate:hover { background: var(--red2); transform: translateY(-2px); box-shadow: 0 4px 12px rgba(222,67,49,0.2); }
    
    .qr-box {
        background: #fff;
        padding: 16px; border-radius: 16px;
        margin-bottom: 16px;
        display: inline-block;
        border: 1px solid var(--border);
    }
    
    .qr-code-display {
        font-family: 'Bebas Neue', sans-serif;
        font-size: 36px; letter-spacing: 10px;
        color: var(--red); margin-bottom: 16px;
    }
    
    .qr-timer-bar { width: 100%; }
    .qr-timer-row {
        display: flex; justify-content: space-between;
        font-family: 'Barlow Condensed', sans-serif;
        font-size: 11px; font-weight: 700; letter-spacing: 2px;
        color: var(--dim2); text-transform: uppercase; margin-bottom: 8px;
    }
    .qr-timer-row span { color: var(--red); font-weight: 800; }
    .timer-track { width: 100%; background: var(--border); height: 4px; border-radius: 4px; overflow: hidden; }
    .timer-fill { height: 100%; background: var(--red); transition: width 1s linear; }

    .history-card {
        background: var(--dark3);
        border: 1px solid var(--border);
        border-radius: 20px;
        padding: 28px;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0,0,0,0.02);
    }
    
    .card-label {
        font-family: 'Barlow Condensed', sans-serif;
        font-size: 10px; font-weight: 700; letter-spacing: 4px;
        color: var(--dim2); text-transform: uppercase; margin-bottom: 20px;
    }
    
    .history-item {
        display: flex; align-items: center; gap: 14px;
        padding: 12px 0; border-bottom: 1px solid var(--border);
    }
    .history-item:last-child { border-bottom: none; }
    .h-dot { width: 8px; height: 8px; border-radius: 50%; background: var(--red); flex-shrink: 0; }
    .h-date { font-size: 14px; font-weight: 700; color: var(--white); flex: 1; }
    .h-time { font-size: 12px; font-weight: 600; color: var(--dim2); }
    .h-badge {
        font-family: 'Barlow Condensed', sans-serif;
        font-size: 10px; font-weight: 700; letter-spacing: 1px;
        color: #27AE60; background: rgba(46, 204, 113, 0.1);
        border: 1px solid rgba(46, 204, 113, 0.2);
        padding: 4px 10px; border-radius: 100px; text-transform: uppercase;
    }
    .no-history { font-size: 13px; color: var(--dim2); text-align: center; padding: 30px 0; font-weight: 500; }

    .request-card {
        background: var(--dark3);
        border: 1px solid var(--border);
        border-radius: 20px;
        padding: 28px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.02);
    }
    
    .pkg-option {
        display: flex; align-items: center; gap: 12px;
        padding: 14px; border: 1px solid var(--border);
        border-radius: 10px; margin-bottom: 10px;
        cursor: pointer; transition: all 0.2s;
        background: var(--dark2);
    }
    .pkg-option:hover { border-color: var(--red); background: #FFFFFF; }
    .pkg-option input[type="radio"] { accent-color: var(--red); transform: scale(1.1); }
    .pkg-option-name { font-size: 14px; font-weight: 700; flex: 1; color: var(--white); }
    .pkg-option-price {
        font-family: 'Barlow Condensed', sans-serif;
        font-size: 15px; font-weight: 700; color: var(--red);
    }
    .pkg-option-dur { font-size: 11px; font-weight: 600; color: var(--dim2); }
    
    .btn-request {
        width: 100%;
        font-family: 'Barlow Condensed', sans-serif;
        font-size: 14px; font-weight: 700; letter-spacing: 2px;
        color: #fff; background: var(--red); border: none;
        padding: 14px; text-transform: uppercase;
        cursor: pointer; transition: all 0.2s; border-radius: 8px; margin-top: 4px;
    }
    .btn-request:hover { background: var(--red2); transform: translateY(-2px); box-shadow: 0 4px 12px rgba(222,67,49,0.2); }
    
    .btn-cancel {
        width: 100%; margin-top: 10px;
        font-family: 'Barlow Condensed', sans-serif;
        font-size: 13px; font-weight: 700; letter-spacing: 2px;
        color: var(--dim2); background: transparent;
        border: 1px solid var(--border); padding: 12px;
        text-transform: uppercase; cursor: pointer; transition: all 0.2s; border-radius: 8px;
    }
    .btn-cancel:hover { border-color: var(--red); color: var(--red); }
    
    .alert-success {
        background: rgba(46, 204, 113, 0.1); border: 1px solid #2ECC71;
        border-radius: 8px; padding: 12px 16px; font-size: 13px; font-weight: 600;
        color: #27AE60; margin-bottom: 20px;
    }
    .alert-error {
        background: rgba(222, 67, 49, 0.1); border: 1px solid var(--red);
        border-radius: 8px; padding: 12px 16px; font-size: 13px; font-weight: 600;
        color: var(--red); margin-bottom: 20px;
    }
    
    .note-text {
        margin-top: 16px; font-size: 12px; color: var(--dim2);
        line-height: 1.6; text-align: center; font-weight: 500;
    }
    .pending-note { font-size: 13px; color: var(--dim); line-height: 1.7; margin-bottom: 24px; font-weight: 500; }
    .pending-title {
        font-family: 'Bebas Neue', sans-serif;
        font-size: 26px; letter-spacing: 1px;
        color: #C9A84C; margin-bottom: 8px;
    }
    .mc-inactive-note { font-size: 13px; font-weight: 500; color: var(--dim); line-height: 1.7; }

    @media (max-width: 1024px) {
        .bottom-row { grid-template-columns: 1fr 1fr; }
        .request-card { grid-column: span 2; }
    }

    @media (max-width: 768px) {
        .dashboard-wrap { padding: 16px; }
        .top-row { grid-template-columns: 1fr; gap: 16px; margin-bottom: 16px; }
        .bottom-row { grid-template-columns: 1fr; gap: 16px; }
        .request-card { grid-column: span 1; }
        .hero-card { min-height: 180px; padding: 24px; }
        .hero-name { font-size: 36px; }
        .hero-stats-row { gap: 20px; flex-wrap: wrap; }
        .membership-card, .qr-card, .history-card, .request-card { padding: 24px; }
    }
</style>

<div class="dashboard-wrap">
<div class="dashboard-inner">

    @if(session('success'))
    <div class="alert-success">✅ {{ session('success') }}</div>
    @endif
    @if(session('error'))
    <div class="alert-error">❌ {{ session('error') }}</div>
    @endif

    {{-- ── TOP ROW ── --}}
    <div class="top-row">

        {{-- Hero Card --}}
        <div class="hero-card">
            <div class="hero-card-bg"></div>
            <div class="hero-card-accent"></div>
            <div class="hero-card-content">
                <div class="hero-eyebrow">Fitscape Studio — Member</div>
                <div class="hero-name">{{ strtoupper($user->name) }}</div>
                <div class="hero-id">{{ $user->member_id }}</div>
                <div class="hero-stats-row">
                    <div class="hero-stat">
                        <div class="hero-stat-val">{{ $presences->count() }}<span>x</span></div>
                        <div class="hero-stat-label">Total Hadir</div>
                    </div>
                    <div class="hero-stat">
                        <div class="hero-stat-val">
                            @if($user->membership_end_date && $user->membership_status === 'active')
                                {{ max(0, \Carbon\Carbon::now()->diffInDays($user->membership_end_date, false)) }}<span>d</span>
                            @else
                                —
                            @endif
                        </div>
                        <div class="hero-stat-label">Sisa Hari</div>
                    </div>
                    <div class="hero-stat">
                        <div class="hero-stat-val">
                            {{ $presences->where('check_in_at', '>=', now()->startOfMonth())->count() }}<span>x</span>
                        </div>
                        <div class="hero-stat-label">Bulan Ini</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Membership Status Card --}}
        <div class="membership-card {{ $user->membership_status === 'active' ? 'active-card' : ($user->membership_status === 'pending' ? 'pending-card' : '') }}">
            <div class="mc-label">Membership Status</div>
            <div class="mc-package">
                {{ $user->membershipPackage->name ?? ($user->membership_status === 'pending' ? 'PENDING' : 'NO PLAN') }}
            </div>
            <div>
                @if($user->membership_status === 'active')
                    <span class="mc-status-badge active">● Active</span>
                @elseif($user->membership_status === 'pending')
                    <span class="mc-status-badge pending">⏳ Pending</span>
                @else
                    <span class="mc-status-badge inactive">○ Inactive</span>
                @endif
            </div>
            <div class="mc-divider"></div>
            @if($user->membership_status === 'active')
                <div class="mc-row">
                    <span class="mc-key">Mulai</span>
                    <span class="mc-val">{{ \Carbon\Carbon::parse($user->membership_start_date)->format('d M Y') }}</span>
                </div>
                <div class="mc-row">
                    <span class="mc-key">Expired</span>
                    <span class="mc-val" style="color:var(--red);">{{ \Carbon\Carbon::parse($user->membership_end_date)->format('d M Y') }}</span>
                </div>
            @elseif($user->membership_status === 'pending')
                <div class="mc-row">
                    <span class="mc-key">Paket</span>
                    <span class="mc-val">{{ optional(\App\Models\MembershipPackage::find($user->pending_package_id))->name ?? '-' }}</span>
                </div>
                <div style="margin-top:12px; font-size:12px; font-weight:600; color:#C9A84C; line-height:1.6;">
                    Menunggu konfirmasi admin. Silakan lakukan pembayaran di gym.
                </div>
            @else
                <div class="mc-inactive-note">
                    Belum memiliki membership aktif. Pilih paket di bawah untuk mulai.
                </div>
            @endif
        </div>
    </div>

    {{-- ── BOTTOM ROW ── --}}
    <div class="bottom-row">

        {{-- QR Card --}}
        <div class="qr-card">
            <div class="qr-card-label">Studio Entry Code</div>
            @if($user->membership_status === 'active')
                <div id="qr-lock" class="qr-lock-area">
                    <div class="qr-lock-icon">🔐</div>
                    <div class="qr-lock-title">ACCESS GRANTED</div>
                    <div class="qr-lock-sub">Generate QR Code dinamis untuk absensi. Berlaku 30 detik.</div>
                    <button class="btn-generate" onclick="showQR()">Generate QR Masuk</button>
                </div>
                <div id="qr-show" style="display:none; width:100%; text-align:center;">
                    <div class="qr-box">
                        {!! QrCode::size(180)->margin(1)->generate($qrString) !!}
                    </div>
                    <div class="qr-code-display">{{ substr($qrString, -6) }}</div>
                    <div class="qr-timer-bar">
                        <div class="qr-timer-row">
                            <span>Dynamic Auth</span>
                            <span>Refresh in <span id="timer">{{ $expiresIn }}</span>s</span>
                        </div>
                        <div class="timer-track">
                            <div class="timer-fill" id="timer-fill" style="width:{{ ($expiresIn / 30) * 100 }}%;"></div>
                        </div>
                    </div>
                </div>
            @else
                <div class="qr-lock-area">
                    <div class="qr-lock-icon">🔒</div>
                    <div class="qr-lock-title">NO ACCESS</div>
                    <div class="qr-lock-sub">Aktifkan membership untuk dapat menggunakan QR Code absensi.</div>
                </div>
            @endif
        </div>

        {{-- History Card --}}
        <div class="history-card">
            <div class="card-label">Riwayat Kehadiran</div>
            @forelse($presences as $presence)
            <div class="history-item">
                <div class="h-dot"></div>
                <div class="h-date">{{ \Carbon\Carbon::parse($presence->check_in_at)->format('d M Y') }}</div>
                <div class="h-time">{{ \Carbon\Carbon::parse($presence->check_in_at)->format('H:i') }} WIB</div>
                <div class="h-badge">{{ $presence->status }}</div>
            </div>
            @empty
            <div class="no-history">Belum ada riwayat kehadiran</div>
            @endforelse
        </div>

        {{-- Request / Status Card --}}
        <div class="request-card">
            <div class="card-label">
                {{ $user->membership_status === 'active' ? 'Perpanjang Membership' : 'Pilih Membership' }}
            </div>

            @if($user->membership_status === 'pending')
                <div style="text-align:center; padding:20px 0;">
                    <div style="font-size:40px; margin-bottom:16px;">⏳</div>
                    <div class="pending-title">MENUNGGU KONFIRMASI</div>
                    <div class="pending-note">
                        Permintaan membership Anda sedang diproses. Silakan datang ke gym untuk pembayaran.
                    </div>
                    <form method="POST" action="{{ route('membership.cancel') }}">
                        @csrf
                        <button type="submit" class="btn-cancel"
                            onclick="return confirm('Batalkan permintaan membership?')">
                            Batalkan Permintaan
                        </button>
                    </form>
                </div>
            @else
                <form method="POST" action="{{ route('membership.request') }}">
                    @csrf
                    @foreach($packages as $pkg)
                    <label class="pkg-option">
                        <input type="radio" name="package_id" value="{{ $pkg->id }}" {{ $loop->first ? 'checked' : '' }}>
                        <span class="pkg-option-name">{{ $pkg->name }}</span>
                        <div style="text-align:right;">
                            <div class="pkg-option-price">Rp {{ number_format($pkg->price, 0, ',', '.') }}</div>
                            <div class="pkg-option-dur">{{ round($pkg->duration_days / 30) }} bulan</div>
                        </div>
                    </label>
                    @endforeach
                    <button type="submit" class="btn-request">
                        {{ $user->membership_status === 'active' ? 'Perpanjang' : 'Request Membership' }}
                    </button>
                </form>
                <div class="note-text">
                    Pembayaran dilakukan langsung di gym. Admin akan mengaktifkan membership Anda setelah konfirmasi.
                </div>
            @endif
        </div>

    </div>
</div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {

    // ── Generate QR ──
    window.showQR = function() {
        var lock = document.getElementById('qr-lock');
        var show = document.getElementById('qr-show');
        if (lock) lock.style.display = 'none';
        if (show) show.style.display = 'block';

        var seconds = {{ $expiresIn }};
        var timer   = document.getElementById('timer');
        var fill    = document.getElementById('timer-fill');

        var interval = setInterval(function() {
            seconds--;
            if (timer) timer.textContent = seconds;
            if (fill)  fill.style.width = ((seconds / 30) * 100) + '%';
            if (seconds <= 0) {
                clearInterval(interval);
                location.reload();
            }
        }, 1000);
    };

    // ── Cek absensi hari ini (polling 10 detik) ──
    @if($user->membership_status === 'active')
    function checkAbsensi() {
        fetch('{{ route("absensi.status") }}', {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(function(res) { return res.json(); })
        .then(function(data) {
            if (data.sudah_absen) {
                var show = document.getElementById('qr-show');
                var lock = document.getElementById('qr-lock');
                if (show && show.style.display !== 'none') {
                    show.innerHTML = `
                        <div style="text-align:center; padding:20px 0;">
                            <div style="
                                width:80px; height:80px; border-radius:50%;
                                background:rgba(0,230,118,0.1);
                                border:2px solid #00E676;
                                display:flex; align-items:center; justify-content:center;
                                margin:0 auto 16px;
                                animation:popIn 0.4s cubic-bezier(.175,.885,.32,1.275);
                            ">
                                <svg width="36" height="36" viewBox="0 0 36 36" fill="none">
                                    <path d="M8 18L15 25L28 12"
                                        stroke="#00E676" stroke-width="3"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        stroke-dasharray="30" stroke-dashoffset="30"
                                        style="animation:drawCheck 0.5s 0.2s ease forwards;"/>
                                </svg>
                            </div>
                            <p style="font-size:18px; font-weight:800; color:#00E676; margin:0 0 6px;">Absensi Tercatat!</p>
                            <p style="font-size:12px; color:#555; margin:0;">Kehadiran Anda hari ini sudah tercatat.</p>
                        </div>`;
                }
                if (lock && show && show.style.display === 'none') {
                    // Jika belum generate QR tapi sudah absen, update lock area
                    var lockTitle = lock.querySelector('.qr-lock-title');
                    var lockSub   = lock.querySelector('.qr-lock-sub');
                    var lockBtn   = lock.querySelector('.btn-generate');
                    if (lockTitle) lockTitle.textContent = 'SUDAH ABSEN';
                    if (lockSub)   lockSub.textContent   = 'Kehadiran Anda hari ini sudah tercatat.';
                    if (lockBtn)   lockBtn.style.display = 'none';
                }
            }
        })
        .catch(function() {});
    }

    checkAbsensi();
    setInterval(checkAbsensi, 10000);
    @endif

});
</script>

<style>
@keyframes popIn {
    from { transform: scale(0.7); opacity: 0; }
    to   { transform: scale(1);   opacity: 1; }
}
@keyframes drawCheck {
    to { stroke-dashoffset: 0; }
}
</style>
</x-app-layout>