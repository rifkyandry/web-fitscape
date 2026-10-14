@extends('admin.layout')

@section('content')
<style>
    :root {
        /* Palet warna Light Mode */
        --red: #DE4331; 
        --red2: #B93626;
        --dark: #EBE9E1;   /* Krem Terang (biasanya diset di admin.layout) */
        --dark2: #F7F6F1;  /* Krem Lebih Terang untuk item list */
        --dark3: #FFFFFF;  /* Putih bersih untuk Card */
        --border: #D4D2C7; /* Garis Abu-abu terang */
        --dim: #333333;    /* Teks abu-abu gelap */
        --dim2: #666666;   /* Teks info tambahan */
        --white: #111111;  /* Teks hitam pekat */
    }

    .stat-card {
        background: var(--dark3);
        border: 1px solid var(--border);
        border-radius: 16px;
        padding: 24px;
        transition: all 0.2s;
        position: relative;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0,0,0,0.02);
    }
    .stat-card:hover { border-color: var(--red); transform: translateY(-3px); box-shadow: 0 8px 16px rgba(222,67,49,0.08); }
    .stat-card::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0;
        height: 4px;
        border-radius: 16px 16px 0 0;
    }
    
    /* Warna aksen garis atas kartu statistik disesuaikan untuk latar terang */
    .stat-card.gold::before { background: linear-gradient(90deg, #D4AF37, #F1C40F); }
    .stat-card.green::before { background: linear-gradient(90deg, #27AE60, #2ECC71); }
    .stat-card.red::before { background: linear-gradient(90deg, var(--red), var(--red2)); }
    .stat-card.blue::before { background: linear-gradient(90deg, #2980B9, #3498DB); }
    
    .stat-icon {
        width: 44px; height: 44px;
        border-radius: 12px;
        display: flex; align-items: center; justify-content: center;
        font-size: 20px;
        margin-bottom: 16px;
    }
    
    .stat-value { font-size: 36px; font-weight: 900; letter-spacing: -1px; margin-bottom: 4px; color: var(--white); }
    .stat-label { font-size: 12px; color: var(--dim2); text-transform: uppercase; letter-spacing: 1px; font-weight: 700; }
    .stat-sub { font-size: 11px; color: #888888; margin-top: 8px; font-weight: 500; }

    .activity-item {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 14px 0;
        border-bottom: 1px solid var(--border);
    }
    .activity-item:last-child { border-bottom: none; }
    
    .activity-avatar {
        width: 36px; height: 36px;
        border-radius: 50%;
        background: rgba(222, 67, 49, 0.1);
        display: flex; align-items: center; justify-content: center;
        font-weight: 800; font-size: 14px; color: var(--red);
        flex-shrink: 0;
    }
    
    .pending-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 14px;
        background: var(--dark2);
        border: 1px solid var(--border);
        border-radius: 12px;
        margin-bottom: 10px;
        transition: 0.2s;
    }
    .pending-item:hover { border-color: var(--red); background: #FFFFFF; }
    
    .btn-confirm {
        background: rgba(46, 204, 113, 0.1);
        border: 1px solid rgba(46, 204, 113, 0.3);
        color: #27AE60;
        padding: 6px 14px;
        border-radius: 8px;
        font-size: 11px;
        font-weight: 700;
        cursor: pointer;
        transition: 0.2s;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }
    .btn-confirm:hover { background: rgba(46, 204, 113, 0.2); }
    
    .btn-reject {
        background: rgba(222, 67, 49, 0.1);
        border: 1px solid rgba(222, 67, 49, 0.3);
        color: var(--red);
        padding: 6px 14px;
        border-radius: 8px;
        font-size: 11px;
        font-weight: 700;
        cursor: pointer;
        transition: 0.2s;
        text-decoration: none;
    }
    .btn-reject:hover { background: rgba(222, 67, 49, 0.2); }
</style>

{{-- Header --}}
<div style="margin-bottom: 28px;">
    <h1 style="font-size: 24px; font-weight: 800; margin: 0 0 4px; color: var(--white);">Dashboard</h1>
    <p style="font-size: 13px; color: var(--dim2); margin: 0; font-weight: 500;">{{ now()->format('l, d F Y') }}</p>
</div>

{{-- Stats Grid --}}
<div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px; margin-bottom: 28px;">
    <div class="stat-card gold">
        <div class="stat-icon" style="background: rgba(212,175,55,0.1);">👥</div>
        <div class="stat-value" style="color: #D4AF37;">{{ $totalMembers }}</div>
        <div class="stat-label">Total Member</div>
        <div class="stat-sub">{{ $activeMembers }} aktif</div>
    </div>
    <div class="stat-card green">
        <div class="stat-icon" style="background: rgba(39,174,96,0.1);">✅</div>
        <div class="stat-value" style="color: #27AE60;">{{ $todayPresences }}</div>
        <div class="stat-label">Hadir Hari Ini</div>
        <div class="stat-sub">dari {{ $totalMembers }} member</div>
    </div>
    <div class="stat-card red">
        <div class="stat-icon" style="background: rgba(222,67,49,0.1);">⏳</div>
        <div class="stat-value" style="color: var(--red);">{{ $pendingMembers }}</div>
        <div class="stat-label">Pending Konfirmasi</div>
        <div class="stat-sub">menunggu diproses</div>
    </div>
    <div class="stat-card blue">
        <div class="stat-icon" style="background: rgba(41,128,185,0.1);">⚠️</div>
        <div class="stat-value" style="color: #2980B9;">{{ $expiringMembers }}</div>
        <div class="stat-label">Akan Expired</div>
        <div class="stat-sub">dalam 7 hari ke depan</div>
    </div>
</div>

{{-- Row 2: Pending + Aktivitas --}}
<div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 28px;">

    {{-- Pending Membership --}}
    <div style="background: var(--dark3); border: 1px solid var(--border); border-radius: 16px; padding: 24px; box-shadow: 0 4px 12px rgba(0,0,0,0.02);">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <div>
                <h3 style="font-size: 14px; font-weight: 800; margin: 0 0 2px; color: var(--white);">⏳ Pending Konfirmasi</h3>
                <p style="font-size: 11px; color: var(--dim2); margin: 0; font-weight: 500;">Member yang menunggu aktivasi</p>
            </div>
            @if($pendingMembers > 0)
            <span style="background: rgba(222,67,49,0.1); color: var(--red); font-size: 11px; font-weight: 700; padding: 4px 10px; border-radius: 100px;">
                {{ $pendingMembers }} pending
            </span>
            @endif
        </div>

        @forelse($pendingList as $member)
        <div class="pending-item">
            <div style="display: flex; align-items: center; gap: 12px;">
                <div class="activity-avatar">{{ substr($member->name, 0, 1) }}</div>
                <div>
                    <p style="margin: 0; font-size: 13px; font-weight: 700; color: var(--white);">{{ $member->name }}</p>
                    <p style="margin: 0; font-size: 11px; color: var(--dim2); font-weight: 500;">{{ $member->member_id }} · {{ $member->pendingPackage->name ?? '-' }}</p>
                </div>
            </div>
            <div style="display: flex; gap: 8px;">
                <form method="POST" action="{{ route('admin.members.confirm', $member) }}">
                    @csrf
                    <button type="submit" class="btn-confirm">✓ OK</button>
                </form>
                <form method="POST" action="{{ route('admin.members.reject', $member) }}">
                    @csrf
                    <button type="submit" class="btn-reject">✕</button>
                </form>
            </div>
        </div>
        @empty
        <div style="text-align: center; padding: 30px 0; color: var(--dim2); font-size: 13px; font-weight: 500;">
            Tidak ada permintaan pending 🎉
        </div>
        @endforelse
    </div>

    {{-- Aktivitas Absensi Terbaru --}}
    <div style="background: var(--dark3); border: 1px solid var(--border); border-radius: 16px; padding: 24px; box-shadow: 0 4px 12px rgba(0,0,0,0.02);">
        <div style="margin-bottom: 20px;">
            <h3 style="font-size: 14px; font-weight: 800; margin: 0 0 2px; color: var(--white);">📋 Absensi Terbaru</h3>
            <p style="font-size: 11px; color: var(--dim2); margin: 0; font-weight: 500;">10 kehadiran terakhir</p>
        </div>

        @forelse($recentPresences as $presence)
        <div class="activity-item">
            <div class="activity-avatar">{{ substr($presence->user->name ?? 'U', 0, 1) }}</div>
            <div style="flex: 1;">
                <p style="margin: 0; font-size: 13px; font-weight: 700; color: var(--white);">{{ $presence->user->name ?? '-' }}</p>
                <p style="margin: 0; font-size: 11px; color: var(--dim2); font-weight: 500;">{{ $presence->member_id }}</p>
            </div>
            <div style="text-align: right;">
                <p style="margin: 0; font-size: 11px; color: #27AE60; font-weight: 700;">Hadir</p>
                <p style="margin: 0; font-size: 10px; color: var(--dim2); font-weight: 600;">{{ \Carbon\Carbon::parse($presence->check_in_at)->format('H:i') }}</p>
            </div>
        </div>
        @empty
        <div style="text-align: center; padding: 30px 0; color: var(--dim2); font-size: 13px; font-weight: 500;">
            Belum ada absensi hari ini
        </div>
        @endforelse
    </div>
</div>

{{-- Member Akan Expired --}}
@if($expiringList->count() > 0)
<div style="background: var(--dark3); border: 1px solid rgba(41,128,185,0.3); border-radius: 16px; padding: 24px; box-shadow: 0 4px 12px rgba(0,0,0,0.02);">
    <div style="margin-bottom: 16px;">
        <h3 style="font-size: 14px; font-weight: 800; margin: 0 0 2px; color: var(--white);">⚠️ Membership Akan Expired</h3>
        <p style="font-size: 11px; color: var(--dim2); margin: 0; font-weight: 500;">Member dengan membership habis dalam 7 hari</p>
    </div>
    <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 12px;">
        @foreach($expiringList as $member)
        <div style="background: var(--dark2); border: 1px solid var(--border); border-radius: 12px; padding: 16px;">
            <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 10px;">
                <div class="activity-avatar" style="width:30px; height:30px; font-size:11px;">{{ substr($member->name, 0, 1) }}</div>
                <div>
                    <p style="margin: 0; font-size: 12px; font-weight: 700; color: var(--white);">{{ $member->name }}</p>
                    <p style="margin: 0; font-size: 10px; color: var(--dim2); font-weight: 500;">{{ $member->member_id }}</p>
                </div>
            </div>
            <p style="margin: 0; font-size: 11px; color: #2980B9; font-weight: 600;">
                Expired: {{ \Carbon\Carbon::parse($member->membership_end_date)->format('d M Y') }}
            </p>
            <p style="margin: 0; font-size: 11px; color: var(--dim); margin-top: 4px; font-weight: 600;">
                {{ \Carbon\Carbon::parse($member->membership_end_date)->diffInDays(now()) }} hari lagi
            </p>
        </div>
        @endforeach
    </div>
</div>
@endif

@endsection