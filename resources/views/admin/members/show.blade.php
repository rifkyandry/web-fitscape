@extends('admin.layout')

@section('content')

{{-- Card Pending (prioritas utama, tampil paling atas) --}}
@if($user->membership_status === 'pending' && $user->pendingPackage)
<div style="background:rgba(230,57,70,0.05); border:1px solid rgba(230,57,70,0.25); border-radius:16px; padding:20px; margin-bottom:24px;">
    <div style="display:flex; align-items:center; gap:10px; margin-bottom:16px;">
        <span style="font-size:20px;">⏳</span>
        <h4 style="color:#E63946; margin:0; font-size:16px; font-weight:800; font-family:'Barlow Condensed',sans-serif; letter-spacing:1px;">PERMINTAAN MEMBERSHIP PENDING</h4>
    </div>
    <div style="display:grid; grid-template-columns:1fr 1fr; gap:10px; margin-bottom:16px;">
        <div style="background:#FFFFFF; border:1px solid #E5E3DB; border-radius:12px; padding:12px;">
            <p style="margin:0; font-size:10px; color:#666; text-transform:uppercase; letter-spacing:1px; font-weight:700;">Paket</p>
            <p style="margin:4px 0 0; font-size:15px; font-weight:700; color:#141414;">{{ $user->pendingPackage->name }}</p>
        </div>
        <div style="background:#FFFFFF; border:1px solid #E5E3DB; border-radius:12px; padding:12px;">
            <p style="margin:0; font-size:10px; color:#666; text-transform:uppercase; letter-spacing:1px; font-weight:700;">Durasi</p>
            <p style="margin:4px 0 0; font-size:15px; font-weight:700; color:#E63946;">{{ $user->pending_duration_months }} Bulan</p>
        </div>
    </div>
    <div style="background:#FFFFFF; border:1px solid #E5E3DB; border-radius:12px; padding:12px; margin-bottom:16px; display:flex; justify-content:space-between; align-items:center;">
        <span style="font-size:12px; color:#666; font-weight:600;">Total Tagihan</span>
        <span style="font-size:20px; font-weight:900; color:#141414; font-family:'Bebas Neue',sans-serif; letter-spacing:1px;">
            Rp {{ number_format($user->pendingPackage->price, 0, ',', '.') }}
        </span>
    </div>
    <div style="display:flex; gap:10px; flex-wrap:wrap;">
        <form method="POST" action="{{ route('admin.members.confirm', $user) }}" style="flex:1; min-width:140px;">
            @csrf
            <button type="submit"
                style="width:100%; background:#141414; color:#fff; border:none; padding:12px; border-radius:12px; font-weight:700; font-size:13px; cursor:pointer; transition:0.2s; font-family:'Barlow Condensed',sans-serif; letter-spacing:1px;"
                onmouseover="this.style.background='#3ee00d'"
                onmouseout="this.style.background='#141414'"
                onclick="return confirm('Konfirmasi dan aktifkan membership {{ $user->name }}?')">
                ✅ Konfirmasi & Aktifkan
            </button>
        </form>
        <form method="POST" action="{{ route('admin.members.reject', $user) }}" style="flex:1; min-width:140px;">
            @csrf
            <button type="submit"
                style="width:100%; background:#FFFFFF; color:#E63946; border:1px solid #E5E3DB; padding:12px; border-radius:12px; font-weight:700; font-size:13px; cursor:pointer; transition:0.2s; font-family:'Barlow Condensed',sans-serif; letter-spacing:1px;"
                onmouseover="this.style.background='#F8F9FA'"
                onmouseout="this.style.background='#FFFFFF'"
                onclick="return confirm('Tolak permintaan membership {{ $user->name }}?')">
                ❌ Tolak Permintaan
            </button>
        </form>
    </div>
</div>
@endif

{{-- Header --}}
<div style="margin-bottom:24px;">
    <h2 style="font-size:28px; font-weight:800; margin:0 0 4px; font-family:'Bebas Neue',sans-serif; letter-spacing:1px; color:#141414;">Detail Member</h2>
    <p style="margin:0; font-size:13px; color:#666; font-weight:500;">{{ $user->name }} · <span style="font-family:monospace; font-weight:700; color:#141414;">{{ $user->member_id }}</span></p>
</div>

{{-- Info Member (Card Putih Bersih) --}}
<div style="background:#FFFFFF; border:1px solid #E5E3DB; border-radius:16px; padding:24px; margin-bottom:20px; box-shadow: 0 10px 30px rgba(0,0,0,0.02);">
    <p style="font-size:10px; color:#666; text-transform:uppercase; letter-spacing:2px; margin:0 0 16px; font-weight:700;">Informasi Member</p>
    <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px;">
        <div>
            <p style="margin:0; font-size:11px; color:#666; font-weight:600;">Member ID</p>
            <p style="margin:4px 0 0; font-size:15px; font-weight:800; color:#141414; font-family:monospace;">{{ $user->member_id }}</p>
        </div>
        <div>
            <p style="margin:0; font-size:11px; color:#666; font-weight:600;">Email</p>
            <p style="margin:4px 0 0; font-size:13px; color:#141414; font-weight:600; word-break:break-all;">{{ $user->email }}</p>
        </div>
        <div>
            <p style="margin:0; font-size:11px; color:#666; font-weight:600;">Paket Aktif</p>
            <p style="margin:4px 0 0; font-size:13px; color:#141414; font-weight:600;">{{ $user->membershipPackage->name ?? 'Belum ada' }}</p>
        </div>
        <div>
            <p style="margin:0; font-size:11px; color:#666; font-weight:600;">Status</p>
            <div style="margin-top:4px;">
                @if($user->membership_status === 'active')
                    <span style="background:rgba(16,185,129,0.1); color:#059669; border:1px solid rgba(16,185,129,0.2); padding:4px 12px; border-radius:100px; font-size:11px; font-weight:700;">Aktif</span>
                @elseif($user->membership_status === 'pending')
                    <span style="background:rgba(245,158,11,0.1); color:#d97706; border:1px solid rgba(245,158,11,0.2); padding:4px 12px; border-radius:100px; font-size:11px; font-weight:700;">Pending</span>
                @elseif($user->membership_status === 'expired')
                    <span style="background:rgba(230,57,70,0.1); color:#E63946; border:1px solid rgba(230,57,70,0.2); padding:4px 12px; border-radius:100px; font-size:11px; font-weight:700;">Expired</span>
                @else
                    <span style="background:#F4F3EF; color:#666; border:1px solid #E5E3DB; padding:4px 12px; border-radius:100px; font-size:11px; font-weight:700;">Tidak Aktif</span>
                @endif
            </div>
        </div>
        <div>
            <p style="margin:0; font-size:11px; color:#666; font-weight:600;">Mulai</p>
            <p style="margin:4px 0 0; font-size:13px; color:#141414; font-weight:600;">{{ $user->membership_start_date ?? '-' }}</p>
        </div>
        <div>
            <p style="margin:0; font-size:11px; color:#666; font-weight:600;">Expired</p>
            <p style="margin:4px 0 0; font-size:13px; color:#141414; font-weight:600;">{{ $user->membership_end_date ?? '-' }}</p>
        </div>
    </div>
</div>

{{-- Assign Manual oleh Admin (Card Putih Bersih) --}}
<div style="background:#FFFFFF; border:1px solid #E5E3DB; border-radius:16px; padding:24px; box-shadow: 0 10px 30px rgba(0,0,0,0.02);">
    <p style="font-size:10px; color:#666; text-transform:uppercase; letter-spacing:2px; margin:0 0 16px; font-weight:700;">Assign / Perpanjang Manual</p>
    <form action="{{ route('admin.members.assign', $user) }}" method="POST">
        @csrf
        <div style="margin-bottom:16px;">
            <label style="display:block; font-size:12px; color:#666; margin-bottom:8px; font-weight:600;">Pilih Paket</label>
            <select name="membership_package_id"
                style="width:100%; background:#F9F9F8; border:1px solid #E5E3DB; color:#141414; border-radius:12px; padding:12px 14px; font-size:13px; outline:none; cursor:pointer; font-weight:500;">
                @foreach($packages as $package)
                <option value="{{ $package->id }}">
                    {{ $package->name }} — Rp {{ number_format($package->price, 0, ',', '.') }} ({{ $package->duration_days }} hari)
                </option>
                @endforeach
            </select>
        </div>
        <button type="submit"
            style="width:100%; background:#141414; color:#fff; border:none; padding:14px; border-radius:12px; font-weight:800; font-size:13px; cursor:pointer; letter-spacing:2px; text-transform:uppercase; font-family:'Barlow Condensed',sans-serif; transition:0.2s;"
            onmouseover="this.style.background='#3ee00d'"
            onmouseout="this.style.background='#141414'">
            Assign Membership
        </button>
    </form>
</div>

@endsection