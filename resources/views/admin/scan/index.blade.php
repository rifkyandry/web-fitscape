@extends('admin.layout')

@section('content')

<style>
@keyframes popIn {
    from { transform: scale(0.7); opacity: 0; }
    to   { transform: scale(1);   opacity: 1; }
}
@keyframes drawCheck {
    to { stroke-dashoffset: 0; }
}
</style>

<div style="max-width:480px; margin:0 auto;">

    <div style="margin-bottom:24px;">
        <h2 style="font-size:22px;font-weight:800;margin:0 0 4px;">
            📷 Scanner Absensi
        </h2>

        <p style="margin:0;font-size:12px;color:#777;">
            Arahkan kamera ke QR Code Member
        </p>
    </div>

    {{-- Scanner --}}
    <div id="scanner-box" style="
        background:#111;
        border:1px solid #222;
        border-radius:24px;
        padding:20px;
        margin-bottom:20px;">

        <div id="reader"
            style="
            width:100%;
            border-radius:16px;
            overflow:hidden;">
        </div>

        <p style="
            text-align:center;
            font-size:11px;
            color:#555;
            margin-top:12px;
            letter-spacing:1px;
            text-transform:uppercase;">
            Scan otomatis saat QR terdeteksi
        </p>

    </div>

    {{-- Result (isinya diisi lewat JavaScript) --}}
    <div id="result"
        style="
        display:none;
        background:#111;
        border:1px solid #222;
        border-radius:24px;
        padding:24px;
        text-align:center;">
    </div>

</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/html5-qrcode/2.3.8/html5-qrcode.min.js"></script>
<script>
    let html5QrCode = null;
    let isProcessing = false;

    // ── Tampilan hasil scan (ceklis / silang) ──
    function showResult(success, title, message) {
        document.getElementById('scanner-box').style.display = 'none';

        const result = document.getElementById('result');
        result.style.display = 'block';

        if (success) {
            result.innerHTML = `
                <div style="text-align:center; padding: 20px 0;">
                    <div style="
                        width: 100px; height: 100px; border-radius: 50%;
                        background: rgba(0,230,118,0.12);
                        border: 3px solid #00E676;
                        display: flex; align-items: center; justify-content: center;
                        margin: 0 auto 24px;
                        animation: popIn 0.4s cubic-bezier(.175,.885,.32,1.275);
                    ">
                        <svg width="52" height="52" viewBox="0 0 52 52" fill="none">
                            <circle cx="26" cy="26" r="25" stroke="#00E676" stroke-width="2"/>
                            <path d="M14 26L22 34L38 18"
                                stroke="#00E676" stroke-width="3.5"
                                stroke-linecap="round" stroke-linejoin="round"
                                stroke-dasharray="40" stroke-dashoffset="40"
                                style="animation: drawCheck 0.5s 0.2s ease forwards;"/>
                        </svg>
                    </div>
                    <h3 style="font-size:22px; font-weight:800; color:#00E676; margin-bottom:8px;">${title}</h3>
                    <p style="font-size:13px; color:#888; margin-bottom:28px; line-height:1.6;">${message}</p>
                    <button onclick="resetScanner()" style="
                        background:#00E676; color:#000; border:none;
                        padding:14px 32px; border-radius:12px;
                        font-weight:800; font-size:13px; cursor:pointer;
                        letter-spacing:1px; text-transform:uppercase;">
                        ⚡ Scan Berikutnya
                    </button>
                </div>`;
        } else {
            result.innerHTML = `
                <div style="text-align:center; padding: 20px 0;">
                    <div style="
                        width: 100px; height: 100px; border-radius: 50%;
                        background: rgba(239,68,68,0.1);
                        border: 3px solid #ef4444;
                        display: flex; align-items: center; justify-content: center;
                        margin: 0 auto 24px;
                        animation: popIn 0.4s cubic-bezier(.175,.885,.32,1.275);
                    ">
                        <svg width="52" height="52" viewBox="0 0 52 52" fill="none">
                            <circle cx="26" cy="26" r="25" stroke="#ef4444" stroke-width="2"/>
                            <path d="M18 18L34 34M34 18L18 34"
                                stroke="#ef4444" stroke-width="3.5"
                                stroke-linecap="round"
                                style="animation: popIn 0.3s 0.2s ease both;"/>
                        </svg>
                    </div>
                    <h3 style="font-size:22px; font-weight:800; color:#ef4444; margin-bottom:8px;">${title}</h3>
                    <p style="font-size:13px; color:#888; margin-bottom:28px; line-height:1.6;">${message}</p>
                    <button onclick="resetScanner()" style="
                        background:rgba(239,68,68,0.1); color:#ef4444; border:1px solid rgba(239,68,68,0.3);
                        padding:14px 32px; border-radius:12px;
                        font-weight:800; font-size:13px; cursor:pointer;
                        letter-spacing:1px; text-transform:uppercase;">
                        🔄 Coba Lagi
                    </button>
                </div>`;
        }

        if (navigator.vibrate) {
            navigator.vibrate(success ? 150 : [100, 60, 100]);
        }
    }

    // ── Buka kamera ──
    function startScanner() {
        document.getElementById('scanner-box').style.display = 'block';
        document.getElementById('result').style.display = 'none';
        isProcessing = false;

        html5QrCode = new Html5Qrcode("reader");

        html5QrCode.start(
            { facingMode: "environment" },
            {
                fps: 10,
                qrbox: { width: 250, height: 250 },
                aspectRatio: 1.0
            },
            onScanSuccess,
            function () { /* abaikan error per-frame */ }
        )
        .catch(function (err) {
            console.error("ERROR START CAMERA :", err);
            alert(
                "Gagal membuka kamera.\n\n" + err + "\n\n" +
                "Pastikan izin kamera diberikan, kamera tidak dipakai aplikasi lain, dan web berjalan di HTTPS."
            );
        });
    }

    // ── Saat QR terbaca ──
    function onScanSuccess(decodedText) {
        if (isProcessing) return;
        isProcessing = true;

        html5QrCode.stop()
            .then(function () {
                html5QrCode.clear();
                return fetch("{{ route('admin.scan.verify') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "Accept": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({ qr_data: decodedText })
                });
            })
            .then(function (res) { return res.json(); })
            .then(function (data) {
                if (data.success) {
                    showResult(
                        true,
                        'Absensi Berhasil!',
                        data.member.name + ' (' + data.member.member_id + ')<br>Paket: ' + data.member.package
                    );
                } else {
                    showResult(false, 'Scan Gagal!', data.message || 'QR Code tidak valid.');
                }
            })
            .catch(function (err) {
                console.error(err);
                showResult(false, 'Error!', 'Gagal menghubungi server. Coba lagi.');
            });
    }

    function resetScanner() {
        startScanner();
    }

    window.onload = function () {
        startScanner();
    };
</script>

@endsection