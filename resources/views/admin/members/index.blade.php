@extends('admin.layout')

@section('content')
<style>
    :root {
        /* Palet warna Light Mode */
        --red: #DE4331; 
        --red2: #B93626;
        --dark: #EBE9E1;   
        --dark2: #F7F6F1;  
        --dark3: #FFFFFF;  
        --border: #D4D2C7; 
        --dim: #333333;    
        --dim2: #666666;   
        --white: #111111;  
    }

    /* Kustomisasi Card Filter */
    .filter-card {
        background: var(--dark3);
        border: 2px solid transparent;
        border-radius: 16px;
        padding: 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        cursor: pointer;
        transition: all 0.2s;
        box-shadow: 0 4px 12px rgba(0,0,0,0.02);
    }
    .filter-card:hover {
        border-color: var(--border);
        transform: translateY(-2px);
    }
    
    /* State aktif untuk filter card */
    .filter-card.active-all, .filter-card.active-pending {
        border-color: var(--red);
        background: rgba(222,67,49,0.02);
        box-shadow: 0 8px 16px rgba(222,67,49,0.08);
    }
    .filter-card.active-active {
        border-color: #27AE60;
        background: rgba(39,174,96,0.02);
        box-shadow: 0 8px 16px rgba(39,174,96,0.08);
    }

    /* Badge Status */
    .badge-status {
        display: inline-flex;
        align-items: center;
        padding: 4px 10px;
        border-radius: 8px;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 0.5px;
        text-transform: uppercase;
    }
    .badge-active { background: rgba(46, 204, 113, 0.1); color: #27AE60; border: 1px solid rgba(46, 204, 113, 0.3); }
    .badge-pending { background: rgba(222, 67, 49, 0.1); color: var(--red); border: 1px solid rgba(222, 67, 49, 0.3); box-shadow: 0 2px 4px rgba(222,67,49,0.1); }
    .badge-expired { background: rgba(192, 57, 43, 0.1); color: #C0392B; border: 1px solid rgba(192, 57, 43, 0.3); }
    .badge-inactive { background: var(--dark); color: var(--dim2); border: 1px solid var(--border); }
</style>

<div class="container mx-auto font-sans" style="color: var(--white);">

    {{-- Header Section --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6 gap-4">
        <div>
            <h2 class="text-2xl font-extrabold tracking-tight" style="color: var(--white);">Data Member</h2>
            <p class="text-sm mt-1 font-medium" style="color: var(--dim2);">Kelola status keanggotaan, pembayaran, dan riwayat absensi harian Fitscape Studio.</p>
        </div>
        
        {{-- Toast / Notifikasi Flash --}}
        <div class="flex flex-col gap-2 min-w-[300px]">
            @if(session('success'))
                <div class="px-4 py-2.5 rounded-xl text-xs flex items-center gap-2 shadow-sm font-semibold" style="background: rgba(46, 204, 113, 0.1); border: 1px solid rgba(46, 204, 113, 0.3); color: #27AE60;">
                    <span>✅</span> <span>{{ session('success') }}</span>
                </div>
            @endif
            @if(session('error'))
                <div class="px-4 py-2.5 rounded-xl text-xs flex items-center gap-2 shadow-sm font-semibold" style="background: rgba(222, 67, 49, 0.1); border: 1px solid rgba(222, 67, 49, 0.3); color: var(--red);">
                    <span>❌</span> <span>{{ session('error') }}</span>
                </div>
            @endif
        </div>
    </div>

    @php 
        $pendingMembers = $members->where('membership_status', 'pending'); 
        $activeMembers = $members->where('membership_status', 'active');
    @endphp

    {{-- ══════════════════════════════════════════════════════════════════════════════
         3 CARDS STATISTIK (FILTER)
         ══════════════════════════════════════════════════════════════════════════════ --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-6">
        
        {{-- Card 1: Total Member --}}
        <div onclick="filterTable('all')" id="card-all" class="filter-card active-all">
            <div>
                <p class="text-[11px] font-bold uppercase tracking-wider" style="color: var(--dim2);">Total Member Terdaftar</p>
                <h3 class="text-2xl font-black mt-1" style="color: var(--white);">{{ $members->count() }} <span class="text-sm font-medium" style="color: var(--dim);">orang</span></h3>
                <span id="text-all" class="text-[11px] font-bold mt-1 inline-block" style="color: var(--red);">✨ Menampilkan Semua</span>
            </div>
            <div class="w-12 h-12 rounded-xl flex items-center justify-center text-xl" style="background: rgba(222,67,49,0.1); border: 1px solid rgba(222,67,49,0.2);">👥</div>
        </div>
        
        {{-- Card 2: Membership Aktif --}}
        <div onclick="filterTable('active')" id="card-active" class="filter-card border-gray-200">
            <div>
                <p class="text-[11px] font-bold uppercase tracking-wider" style="color: var(--dim2);">Membership Aktif</p>
                <h3 class="text-2xl font-black mt-1" style="color: #27AE60;">{{ $activeMembers->count() }} <span class="text-sm font-medium" style="color: var(--dim);">aktif</span></h3>
                <span id="text-active" class="text-[11px] font-medium mt-1 inline-block" style="color: var(--dim2);">Klik untuk filter</span>
            </div>
            <div class="w-12 h-12 rounded-xl flex items-center justify-center text-xl" style="background: rgba(39,174,96,0.1); border: 1px solid rgba(39,174,96,0.2); color: #27AE60;">⚡</div>
        </div>

        {{-- Card 3: Menunggu Konfirmasi --}}
        <div onclick="filterTable('pending')" id="card-pending" class="filter-card border-gray-200">
            <div>
                <p class="text-[11px] font-bold uppercase tracking-wider" style="color: var(--dim2);">Menunggu Konfirmasi</p>
                <h3 class="text-2xl font-black mt-1" style="color: {{ $pendingMembers->count() > 0 ? 'var(--red)' : 'var(--white)' }};">
                    {{ $pendingMembers->count() }} <span class="text-sm font-medium" style="color: var(--dim);">request</span>
                </h3>
                <span id="text-pending" class="text-[11px] font-medium mt-1 inline-block {{ $pendingMembers->count() > 0 ? 'font-bold animate-pulse' : '' }}" style="color: {{ $pendingMembers->count() > 0 ? 'var(--red)' : 'var(--dim2)' }};">
                    {{ $pendingMembers->count() > 0 ? '⚠️ Butuh Tindakan' : 'Klik untuk filter' }}
                </span>
            </div>
            <div class="w-12 h-12 rounded-xl flex items-center justify-center text-xl" style="{{ $pendingMembers->count() > 0 ? 'background: rgba(222,67,49,0.1); border: 1px solid rgba(222,67,49,0.2);' : 'background: var(--dark2); border: 1px solid var(--border);' }}">⏳</div>
        </div>
    </div>

    {{-- Banner Notifikasi Cepat untuk Request Pending --}}
    @if($pendingMembers->count() > 0)
    <div class="mb-6 p-4 rounded-xl shadow-sm flex flex-col md:flex-row md:items-center gap-4" style="background: rgba(222,67,49,0.05); border: 1px solid rgba(222,67,49,0.2);">
        <div class="flex items-center gap-3">
            <span class="flex h-2 w-2 relative">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-2 w-2" style="background: var(--red);"></span>
            </span>
            <p class="font-bold text-sm tracking-wide" style="color: var(--red);">
                Konfirmasi Pembayaran Cash Menunggu Tindakan Anda
            </p>
        </div>
        <div class="flex flex-wrap gap-2">
            @foreach($pendingMembers as $pm)
            <a href="{{ route('admin.members.show', $pm) }}"
               class="inline-flex items-center gap-2 text-xs font-bold px-3 py-1.5 rounded-lg transition duration-150 shadow-sm"
               style="background: var(--red); color: #fff; text-decoration: none;"
               onmouseover="this.style.background='var(--red2)'" onmouseout="this.style.background='var(--red)'">
                <span>👤 {{ $pm->name }}</span>
                <span class="px-1.5 py-0.5 rounded text-[10px]" style="background: rgba(255,255,255,0.2);">
                    {{ $pm->pendingPackage->name ?? '-' }}
                </span>
            </a>
            @endforeach
        </div>
    </div>
    @endif

    {{-- Main Container Tabel --}}
    <div class="rounded-2xl shadow-sm overflow-hidden" style="background: var(--dark3); border: 1px solid var(--border);">
        <div class="overflow-x-auto">
            <table class="w-full border-collapse">
                <thead>
                    <tr class="text-left text-[10px] font-bold uppercase tracking-wider" style="background: var(--dark2); color: var(--dim2); border-bottom: 1px solid var(--border);">
                        <th class="px-6 py-4">Member ID</th>
                        <th class="px-6 py-4">Nama</th>
                        <th class="px-6 py-4">Paket Tier</th>
                        <th class="px-6 py-4 text-center">Status Akses</th>
                        <th class="px-6 py-4">Masa Berlaku</th>
                        <th class="px-6 py-4 text-center">Presensi Hari Ini</th>
                        <th class="px-6 py-4 text-center">Total Log</th>
                        <th class="px-6 py-4 text-center">Tindakan</th>
                    </tr>
                </thead>
                <tbody id="member-table-body" class="divide-y" style="border-color: var(--border);">
                    @forelse($members as $member)
                    <tr data-status="{{ $member->membership_status }}" 
                        class="member-row transition duration-150"
                        onmouseover="this.style.background='var(--dark2)'"
                        onmouseout="this.style.background='transparent'"
                        style="{{ $member->membership_status === 'pending' ? 'background: rgba(222,67,49,0.02);' : '' }}">
                        
                        {{-- Member ID --}}
                        <td class="px-6 py-4 font-mono text-sm font-bold tracking-wide" style="color: var(--red);">
                            {{ $member->member_id }}
                        </td>
                        
                        {{-- Nama Member --}}
                        <td class="px-6 py-4 font-bold text-sm" style="color: var(--white);">
                            <div class="flex items-center gap-2">
                                <span class="truncate max-w-[140px]">{{ $member->name }}</span>
                                @if($member->membership_status === 'pending')
                                    <span class="inline-block text-[9px] font-black px-1.5 py-0.5 rounded uppercase tracking-tight animate-pulse"
                                          style="background: rgba(222,67,49,0.1); color: var(--red); border: 1px solid rgba(222,67,49,0.2);">
                                        Pending
                                    </span>
                                @endif
                            </div>
                        </td>
                        
                        {{-- Nama Paket --}}
                        <td class="px-6 py-4 text-sm font-semibold">
                            @if($member->membership_status === 'pending' && $member->pendingPackage)
                                <div class="flex items-center gap-1.5">
                                    <span style="color: var(--red);">{{ $member->pendingPackage->name }}</span>
                                    <span class="text-[10px] italic" style="color: var(--dim2);">(pending)</span>
                                </div>
                            @else
                                <span style="color: {{ $member->membershipPackage ? 'var(--dim)' : 'var(--dim2)' }};">
                                    {{ $member->membershipPackage->name ?? 'Belum memilih' }}
                                </span>
                            @endif
                        </td>
                        
                        {{-- Badge Status --}}
                        <td class="px-6 py-4 text-center">
                            @if($member->membership_status === 'active')
                                <span class="badge-status badge-active">● Aktif</span>
                            @elseif($member->membership_status === 'pending')
                                <span class="badge-status badge-pending">⏳ Pending</span>
                            @elseif($member->membership_status === 'expired')
                                <span class="badge-status badge-expired">✕ Expired</span>
                            @else
                                <span class="badge-status badge-inactive">Non-Aktif</span>
                            @endif
                        </td>
                        
                        {{-- Expired Date --}}
                        <td class="px-6 py-4 text-xs font-mono font-semibold" style="color: var(--dim);">
                            {{ $member->membership_end_date ? \Carbon\Carbon::parse($member->membership_end_date)->format('d M Y') : '—' }}
                        </td>
                        
                        {{-- Kehadiran Hari Ini --}}
                        <td class="px-6 py-4 text-center">
                            @if(\App\Models\Presence::where('user_id', $member->id)->whereDate('check_in_at', today())->exists())
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider" style="background: rgba(46,204,113,0.1); color: #27AE60;">
                                    <span class="w-1.5 h-1.5 rounded-full" style="background: #27AE60;"></span> Checked In
                                </span>
                            @else
                                <span class="text-[11px] font-semibold" style="color: var(--dim2);">Belum Datang</span>
                            @endif
                        </td>
                        
                        {{-- Total Log Hadir --}}
                        <td class="px-6 py-4 text-center font-mono text-sm font-bold" style="color: var(--dim);">
                            {{ \App\Models\Presence::where('user_id', $member->id)->count() }}<span class="text-xs font-normal ml-0.5" style="color: var(--dim2);">x</span>
                        </td>
                        
                        {{-- Tombol Aksi --}}
                        <td class="px-6 py-4 text-center">
                            <a href="{{ route('admin.members.show', $member) }}"
                               class="inline-flex items-center justify-center text-[11px] font-bold px-3 py-1.5 rounded-lg transition duration-150 shadow-sm"
                               style="{{ $member->membership_status === 'pending' 
                                  ? 'background: var(--red); color: #fff; text-decoration: none;' 
                                  : 'background: var(--dark2); color: var(--dim); border: 1px solid var(--border); text-decoration: none;' }}"
                               onmouseover="this.style.background='{{ $member->membership_status === 'pending' ? 'var(--red2)' : '#FFFFFF' }}'"
                               onmouseout="this.style.background='{{ $member->membership_status === 'pending' ? 'var(--red)' : 'var(--dark2)' }}'">
                               {{ $member->membership_status === 'pending' ? '⚡ Kelola' : 'Detail' }}
                            </a>
                        </td>
                        
                    </tr>
                    @empty
                    @endforelse
                    
                    {{-- Row khusus jika pencarian filter kosong --}}
                    <tr id="no-match-row" class="hidden">
                        <td colspan="8" class="px-6 py-12 text-center" style="background: var(--dark2);">
                            <div class="text-2xl mb-2">🔍</div>
                            <p class="text-sm font-semibold" style="color: var(--dim2);">Tidak ada member dengan kriteria status ini.</p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- JavaScript Real-time Filter --}}
<script>
function filterTable(status) {
    const rows = document.querySelectorAll('.member-row');
    const noMatchRow = document.getElementById('no-match-row');
    let visibleCount = 0;

    rows.forEach(row => {
        const rowStatus = row.getAttribute('data-status');
        if (status === 'all' || rowStatus === status) {
            row.style.display = '';
            visibleCount++;
        } else {
            row.style.display = 'none';
        }
    });

    if (visibleCount === 0) {
        noMatchRow.classList.remove('hidden');
    } else {
        noMatchRow.classList.add('hidden');
    }

    // Reset dan Update Kelas Aktif pada Card Statistik
    const cards = {
        all: document.getElementById('card-all'),
        active: document.getElementById('card-active'),
        pending: document.getElementById('card-pending')
    };

    // Hapus class aktif dari semua card
    Object.keys(cards).forEach(key => {
        if(cards[key]) {
            cards[key].classList.remove('active-all', 'active-active', 'active-pending');
            cards[key].style.borderColor = 'transparent';
            
            if(key !== 'pending') {
                document.getElementById('text-' + key).innerText = 'Klik untuk filter';
                document.getElementById('text-' + key).style.color = 'var(--dim2)';
            }
        }
    });

    // Tambahkan class aktif sesuai tombol yang ditekan
    if (status === 'all') {
        cards.all.classList.add('active-all');
        document.getElementById('text-all').innerText = '✨ Menampilkan Semua';
        document.getElementById('text-all').style.color = 'var(--red)';
    } else if (status === 'active') {
        cards.active.classList.add('active-active');
        document.getElementById('text-active').innerText = '✨ Filter Aktif';
        document.getElementById('text-active').style.color = '#27AE60';
    } else if (status === 'pending') {
        cards.pending.classList.add('active-pending');
    }
}
</script>
@endsection