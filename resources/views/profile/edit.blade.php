<x-app-layout>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;600;700;800;900&family=Barlow+Condensed:wght@400;500;600;700;800;900&family=Bebas+Neue&display=swap');

    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    .profile-wrap {
        min-height: calc(100vh - 62px); /* Diperbaiki dari calc(100vh 62px) */
        background: #F4F3EF; /* Background krem terang (Warm Off-White) */
        font-family: 'Barlow', sans-serif;
        color: #141414;      /* Teks utama hitam pekat */
        padding: 32px 20px;
        position: relative;
    }
    .profile-wrap::before {
        content: '';
        position: fixed; inset: 0;
        background-image:
            linear-gradient(rgba(230,57,70,0.02) 1px, transparent 1px),
            linear-gradient(90deg, rgba(230,57,70,0.02) 1px, transparent 1px);
        background-size: 60px 60px;
        pointer-events: none; z-index: 0;
    }

    .profile-inner {
        position: relative; z-index: 1;
        max-width: 520px; margin: 0 auto;
        display: flex; flex-direction: column; gap: 16px;
    }

    .toast {
        padding: 12px 16px; border-radius: 12px;
        font-size: 13px; font-weight: 600;
        display: flex; align-items: center; gap: 8px;
    }
    .toast-success { background: rgba(16,185,129,0.1); border: 1px solid rgba(16,185,129,0.3); color: #059669; }
    .toast-error   { background: rgba(230,57,70,0.1); border: 1px solid rgba(230,57,70,0.3); color: #E63946; }

    .card {
        background: #FFFFFF; /* Card Putih Bersih */
        border: 1px solid #E5E3DB; /* Garis border lembut */
        border-radius: 16px;
        overflow: hidden;
        position: relative;
        box-shadow: 0 10px 30px rgba(0,0,0,0.02);
    }
    .card.red-top::before {
        content: '';
        position: absolute; top: 0; left: 0; right: 0; height: 3px;
        background: #E63946; /* Aksen merah coral */
    }
    .card-header { padding: 24px 28px; border-bottom: 1px solid #E5E3DB; }
    .card-body    { padding: 24px 28px; }

    .avatar-area { display: flex; align-items: center; gap: 18px; }
    .avatar-circle {
        width: 64px; height: 64px; border-radius: 50%;
        background: rgba(230,57,70,0.08);
        border: 2px solid rgba(230,57,70,0.3);
        display: flex; align-items: center; justify-content: center;
        font-family: 'Bebas Neue', sans-serif;
        font-size: 28px; color: #E63946; flex-shrink: 0;
    }
    .avatar-name {
        font-family: 'Bebas Neue', sans-serif;
        font-size: 26px; letter-spacing: 1px; color: #141414;
        line-height: 1; margin-bottom: 4px;
    }
    .avatar-id {
        font-family: 'Barlow Condensed', sans-serif;
        font-size: 12px; font-weight: 700; letter-spacing: 3px;
        color: #E63946; text-transform: uppercase;
    }

    .info-row {
        display: flex; justify-content: space-between; align-items: center;
        padding: 13px 0; border-bottom: 1px solid #F4F3EF;
    }
    .info-row:last-child { border-bottom: none; }
    .info-key {
        font-family: 'Barlow Condensed', sans-serif;
        font-size: 11px; font-weight: 700; letter-spacing: 2px;
        color: #666; text-transform: uppercase;
    }
    .info-val { font-size: 13px; font-weight: 600; color: #141414; }

    .badge {
        font-family: 'Barlow Condensed', sans-serif;
        font-size: 10px; font-weight: 700; letter-spacing: 1px;
        padding: 4px 12px; border-radius: 100px; text-transform: uppercase;
    }
    .badge-active  { background: rgba(16,185,129,0.1);  color: #059669; border: 1px solid rgba(16,185,129,0.3); }
    .badge-expired { background: rgba(230,57,70,0.1);  color: #E63946; border: 1px solid rgba(230,57,70,0.3); }
    .badge-pending { background: rgba(245,158,11,0.1); color: #D97706; border: 1px solid rgba(245,158,11,0.3); }
    .badge-none    { background: #F4F3EF; color: #666; border: 1px solid #E5E3DB; }

    .btn-ghost {
        width: 100%; background: #F9F9F8; color: #141414;
        border: 1px solid #E5E3DB; padding: 12px; border-radius: 12px;
        font-family: 'Barlow Condensed', sans-serif;
        font-size: 13px; font-weight: 700; letter-spacing: 2px;
        text-transform: uppercase; cursor: pointer; transition: 0.2s;
        text-decoration: none; display: block; text-align: center;
    }
    .btn-ghost:hover { border-color: #141414; background: #FFFFFF; }

    .btn-danger {
        width: 100%; background: #141414; color: #E63946;
        border: 1px solid #141414; padding: 12px; border-radius: 12px;
        font-family: 'Barlow Condensed', sans-serif;
        font-size: 13px; font-weight: 700; letter-spacing: 2px;
        text-transform: uppercase; cursor: pointer; transition: 0.2s;
    }
    .btn-danger:hover { background: #E63946; color: #FFFFFF; border-color: #E63946; }

    .info-note {
        display: flex; align-items: center; gap: 10px;
        background: #FFFFFF;
        border: 1px solid #E5E3DB;
        border-radius: 12px; padding: 14px 16px;
        font-size: 12px; color: #666; line-height: 1.6;
        box-shadow: 0 4px 12px rgba(0,0,0,0.01);
    }
    .info-note a {
        color: #E63946; text-decoration: none; font-weight: 700;
    }
    .info-note a:hover { text-decoration: underline; }

    @media (max-width: 480px) {
        .profile-wrap { padding: 16px 12px; }
        .card-header, .card-body { padding: 18px 18px; }
        .avatar-name { font-size: 22px; }
    }
</style>

<div class="profile-wrap">
<div class="profile-inner">

    {{-- Flash --}}
    @if(session('success'))
    <div class="toast toast-success">✅ {{ session('success') }}</div>
    @endif

    {{-- CARD 1: Info Member --}}
    <div class="card red-top">
        <div class="card-header">
            <div class="avatar-area">
                <div class="avatar-circle">{{ substr(auth()->user()->name, 0, 1) }}</div>
                <div>
                    <div class="avatar-name">{{ strtoupper(auth()->user()->name) }}</div>
                    <div class="avatar-id">{{ auth()->user()->member_id }}</div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="info-row">
                <span class="info-key">Email</span>
                <span class="info-val">{{ auth()->user()->email }}</span>
            </div>
            <div class="info-row">
                <span class="info-key">Paket</span>
                <span class="info-val">{{ auth()->user()->membershipPackage->name ?? '-' }}</span>
            </div>
            <div class="info-row">
                <span class="info-key">Status</span>
                <span>
                    @if(auth()->user()->membership_status === 'active')
                        <span class="badge badge-active">● Active</span>
                    @elseif(auth()->user()->membership_status === 'pending')
                        <span class="badge badge-pending">⏳ Pending</span>
                    @elseif(auth()->user()->membership_status === 'expired')
                        <span class="badge badge-expired">✕ Expired</span>
                    @else
                        <span class="badge badge-none">○ Inactive</span>
                    @endif
                </span>
            </div>
            <div class="info-row">
                <span class="info-key">Berlaku Hingga</span>
                <span class="info-val">
                    {{ auth()->user()->membership_end_date
                        ? \Carbon\Carbon::parse(auth()->user()->membership_end_date)->format('d M Y')
                        : '-' }}
                </span>
            </div>
            <div class="info-row">
                <span class="info-key">Bergabung</span>
                <span class="info-val">
                    {{ \Carbon\Carbon::parse(auth()->user()->created_at)->format('d M Y') }}
                </span>
            </div>
        </div>
    </div>

    {{-- Info Lupa Password --}}
    <div class="info-note">
        <span style="font-size:18px; flex-shrink:0;">🔐</span>
        <span>
            Ingin mengganti password? Gunakan fitur
            <a href="{{ route('password.request') }}">Lupa Password</a>
            di halaman login. Link reset akan dikirim ke email Anda.
        </span>
    </div>

    {{-- CARD 2: Navigasi --}}
    <div class="card">
        <div class="card-body" style="display:flex; flex-direction:column; gap:10px;">
            <a href="{{ route('dashboard') }}" class="btn-ghost">← Kembali ke Dashboard</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn-danger">Logout</button>
            </form>
        </div>
    </div>

</div>
</div>
</x-app-layout>