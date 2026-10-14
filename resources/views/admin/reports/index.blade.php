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
</style>

{{-- Header --}}
<div style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:12px; margin-bottom:24px;">
    <div>
        <h2 style="font-size:22px; font-weight:800; margin:0 0 4px; color: var(--white);">📊 Laporan Absensi</h2>
        <p style="margin:0; font-size:12px; color: var(--dim2); font-weight: 500;">Rekap kehadiran member Fitscape Studio</p>
    </div>
   <a href="{{ route('admin.reports.export-pdf', ['filter_mode' => $filterMode, 'date_from' => $dateFrom, 'date_to' => $dateTo, 'month' => $month, 'year' => $year]) }}"
       style="background:var(--red); color:#fff; padding:10px 18px; border-radius:12px; font-weight:700; font-size:13px; text-decoration:none; display:inline-flex; align-items:center; gap:6px; transition:0.2s; box-shadow: 0 4px 12px rgba(222,67,49,0.15);"
       onmouseover="this.style.background='var(--red2)'"
       onmouseout="this.style.background='var(--red)'">
       📄 Export PDF
    </a>
</div>

{{-- Filter --}}
<div style="background:var(--dark3); border:1px solid var(--border); border-radius:20px; padding:20px; margin-bottom:20px; box-shadow: 0 4px 12px rgba(0,0,0,0.02);">

    {{-- Tab Mode --}}
    <div style="display:flex; gap:8px; margin-bottom:20px;">
        <button onclick="switchMode('month')" id="tab-month"
            style="padding:8px 20px; border-radius:100px; font-size:12px; font-weight:700; letter-spacing:1px; cursor:pointer; transition:0.2s; border:1px solid {{ $filterMode === 'month' ? 'var(--red)' : 'var(--border)' }}; background:{{ $filterMode === 'month' ? 'rgba(222,67,49,0.1)' : 'var(--dark2)' }}; color:{{ $filterMode === 'month' ? 'var(--red)' : 'var(--dim2)' }};">
            📅 Per Bulan
        </button>
        <button onclick="switchMode('range')" id="tab-range"
            style="padding:8px 20px; border-radius:100px; font-size:12px; font-weight:700; letter-spacing:1px; cursor:pointer; transition:0.2s; border:1px solid {{ $filterMode === 'range' ? 'var(--red)' : 'var(--border)' }}; background:{{ $filterMode === 'range' ? 'rgba(222,67,49,0.1)' : 'var(--dark2)' }}; color:{{ $filterMode === 'range' ? 'var(--red)' : 'var(--dim2)' }};">
            📆 Rentang Tanggal
        </button>
    </div>

    <form method="GET" id="filter-form" style="display:flex; flex-wrap:wrap; gap:12px; align-items:flex-end;">
        <input type="hidden" name="filter_mode" id="filter_mode_input" value="{{ $filterMode }}">

        {{-- Mode: Per Bulan --}}
        <div id="mode-month" style="display:{{ $filterMode === 'month' ? 'flex' : 'none' }}; gap:12px; flex-wrap:wrap; flex:1;">
            <div style="flex:1; min-width:140px;">
                <label style="display:block; font-size:11px; color:var(--dim); font-weight:700; margin-bottom:6px; text-transform:uppercase; letter-spacing:1px;">Bulan</label>
                <select name="month" style="width:100%; background:var(--dark2); border:1px solid var(--border); color:var(--white); border-radius:12px; padding:10px 14px; font-size:13px; outline:none; transition:0.2s;" onfocus="this.style.borderColor='var(--red)'" onblur="this.style.borderColor='var(--border)'">
                    @for($m = 1; $m <= 12; $m++)
                        <option value="{{ $m }}" {{ ($month ?? now()->month) == $m ? 'selected' : '' }}>
                            {{ \Carbon\Carbon::create()->month($m)->format('F') }}
                        </option>
                    @endfor
                </select>
            </div>
            <div style="flex:1; min-width:120px;">
                <label style="display:block; font-size:11px; color:var(--dim); font-weight:700; margin-bottom:6px; text-transform:uppercase; letter-spacing:1px;">Tahun</label>
                <select name="year" style="width:100%; background:var(--dark2); border:1px solid var(--border); color:var(--white); border-radius:12px; padding:10px 14px; font-size:13px; outline:none; transition:0.2s;" onfocus="this.style.borderColor='var(--red)'" onblur="this.style.borderColor='var(--border)'">
                    @for($y = 2024; $y <= 2027; $y++)
                        <option value="{{ $y }}" {{ ($year ?? now()->year) == $y ? 'selected' : '' }}>{{ $y }}</option>
                    @endfor
                </select>
            </div>
        </div>

        {{-- Mode: Rentang Tanggal --}}
        <div id="mode-range" style="display:{{ $filterMode === 'range' ? 'flex' : 'none' }}; gap:12px; flex-wrap:wrap; flex:1;">
            <div style="flex:1; min-width:160px;">
                <label style="display:block; font-size:11px; color:var(--dim); font-weight:700; margin-bottom:6px; text-transform:uppercase; letter-spacing:1px;">Dari Tanggal</label>
                <input type="date" name="date_from" value="{{ $dateFrom }}"
                    style="width:100%; background:var(--dark2); border:1px solid var(--border); color:var(--white); border-radius:12px; padding:10px 14px; font-size:13px; outline:none; transition:0.2s;" onfocus="this.style.borderColor='var(--red)'" onblur="this.style.borderColor='var(--border)'">
            </div>
            <div style="flex:1; min-width:160px;">
                <label style="display:block; font-size:11px; color:var(--dim); font-weight:700; margin-bottom:6px; text-transform:uppercase; letter-spacing:1px;">Sampai Tanggal</label>
                <input type="date" name="date_to" value="{{ $dateTo }}"
                    style="width:100%; background:var(--dark2); border:1px solid var(--border); color:var(--white); border-radius:12px; padding:10px 14px; font-size:13px; outline:none; transition:0.2s;" onfocus="this.style.borderColor='var(--red)'" onblur="this.style.borderColor='var(--border)'">
            </div>
        </div>

        {{-- Shortcut Rentang --}}
        <div id="shortcuts" style="display:{{ $filterMode === 'range' ? 'flex' : 'none' }}; gap:6px; flex-wrap:wrap; width:100%; margin-top:-4px;">
            <span style="font-size:11px; font-weight:700; color:var(--dim); margin-right:4px; align-self:center;">Cepat:</span>
            <button type="button" onclick="setRange(7)"   style="padding:5px 12px; border-radius:100px; font-size:11px; font-weight:700; background:var(--dark2); border:1px solid var(--border); color:var(--dim2); cursor:pointer; transition:0.2s;" onmouseover="this.style.borderColor='var(--red)'; this.style.color='var(--red)'" onmouseout="this.style.borderColor='var(--border)'; this.style.color='var(--dim2)'">7 Hari</button>
            <button type="button" onclick="setRange(30)"  style="padding:5px 12px; border-radius:100px; font-size:11px; font-weight:700; background:var(--dark2); border:1px solid var(--border); color:var(--dim2); cursor:pointer; transition:0.2s;" onmouseover="this.style.borderColor='var(--red)'; this.style.color='var(--red)'" onmouseout="this.style.borderColor='var(--border)'; this.style.color='var(--dim2)'">1 Bulan</button>
            <button type="button" onclick="setRange(90)"  style="padding:5px 12px; border-radius:100px; font-size:11px; font-weight:700; background:var(--dark2); border:1px solid var(--border); color:var(--dim2); cursor:pointer; transition:0.2s;" onmouseover="this.style.borderColor='var(--red)'; this.style.color='var(--red)'" onmouseout="this.style.borderColor='var(--border)'; this.style.color='var(--dim2)'">3 Bulan</button>
            <button type="button" onclick="setRange(180)" style="padding:5px 12px; border-radius:100px; font-size:11px; font-weight:700; background:var(--dark2); border:1px solid var(--border); color:var(--dim2); cursor:pointer; transition:0.2s;" onmouseover="this.style.borderColor='var(--red)'; this.style.color='var(--red)'" onmouseout="this.style.borderColor='var(--border)'; this.style.color='var(--dim2)'">6 Bulan</button>
            <button type="button" onclick="setRange(365)" style="padding:5px 12px; border-radius:100px; font-size:11px; font-weight:700; background:var(--dark2); border:1px solid var(--border); color:var(--dim2); cursor:pointer; transition:0.2s;" onmouseover="this.style.borderColor='var(--red)'; this.style.color='var(--red)'" onmouseout="this.style.borderColor='var(--border)'; this.style.color='var(--dim2)'">1 Tahun</button>
        </div>

        <button type="submit"
            style="background:var(--red); color:#fff; border:none; padding:10px 24px; border-radius:12px; font-weight:700; font-size:13px; cursor:pointer; white-space:nowrap; align-self:flex-end; transition:0.2s; box-shadow: 0 4px 12px rgba(222,67,49,0.15);" onmouseover="this.style.background='var(--red2)'" onmouseout="this.style.background='var(--red)'">
            Tampilkan
        </button>
    </form>
</div>

{{-- Period Info --}}
<div style="background:rgba(41, 128, 185, 0.08); border:1px solid rgba(41, 128, 185, 0.2); border-radius:12px; padding:12px 18px; margin-bottom:20px; display:flex; align-items:center; gap:8px;">
    <span style="font-size:14px;">📅</span>
    <span style="font-size:13px; color:#2980B9; font-weight:600;">
        Menampilkan data: 
        <strong>{{ \Carbon\Carbon::parse($dateFrom)->format('d M Y') }}</strong> 
        — 
        <strong>{{ \Carbon\Carbon::parse($dateTo)->format('d M Y') }}</strong>
    </span>
</div>

{{-- Stats --}}
<div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(160px, 1fr)); gap:14px; margin-bottom:20px;">
    <div style="background:var(--dark3); border:1px solid var(--border); border-radius:18px; padding:18px; text-align:center; box-shadow: 0 4px 12px rgba(0,0,0,0.02);">
        <p style="margin:0; font-size:10px; font-weight:700; color:var(--dim2); text-transform:uppercase; letter-spacing:2px;">Total Member</p>
        <p style="margin:8px 0 0; font-size:28px; font-weight:900; color:#27AE60;">{{ $totalMembers }}</p>
    </div>
    <div style="background:var(--dark3); border:1px solid var(--border); border-radius:18px; padding:18px; text-align:center; box-shadow: 0 4px 12px rgba(0,0,0,0.02);">
        <p style="margin:0; font-size:10px; font-weight:700; color:var(--dim2); text-transform:uppercase; letter-spacing:2px;">Total Kehadiran</p>
        <p style="margin:8px 0 0; font-size:28px; font-weight:900; color:#2980B9;">{{ $totalPresences }}</p>
    </div>
    <div style="background:var(--dark3); border:1px solid var(--border); border-radius:18px; padding:18px; text-align:center; box-shadow: 0 4px 12px rgba(0,0,0,0.02);">
        <p style="margin:0; font-size:10px; font-weight:700; color:var(--dim2); text-transform:uppercase; letter-spacing:2px;">Paling Rajin</p>
        <p style="margin:8px 0 0; font-size:16px; font-weight:800; color:#D4AF37;">
            {{ $topMember ? $topMember->user->name : '-' }}
        </p>
        @if($topMember)
        <p style="margin:2px 0 0; font-size:11px; font-weight:500; color:var(--dim2);">{{ $topMember->total }}x hadir</p>
        @endif
    </div>
</div>

{{-- Chart --}}
<div style="background:var(--dark3); border:1px solid var(--border); border-radius:20px; padding:20px; margin-bottom:20px; box-shadow: 0 4px 12px rgba(0,0,0,0.02);">
    <p style="font-size:13px; font-weight:800; color:var(--white); margin:0 0 16px;">Grafik Kehadiran</p>
    <div style="overflow-x:auto;">
        <canvas id="attendanceChart" height="80" style="min-width:400px;"></canvas>
    </div>
</div>

{{-- Tabel --}}
<div style="background:var(--dark3); border:1px solid var(--border); border-radius:20px; overflow:hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.02);">
    <div style="padding:16px 20px; border-bottom:1px solid var(--border); background: var(--dark2);">
        <p style="margin:0; font-size:13px; font-weight:700; color:var(--white);">
            Detail Absensi — 
            {{ \Carbon\Carbon::parse($dateFrom)->format('d M Y') }} 
            s/d 
            {{ \Carbon\Carbon::parse($dateTo)->format('d M Y') }}
        </p>
    </div>
    <div style="overflow-x:auto;">
        <table style="width:100%; border-collapse:collapse; min-width:500px;">
            <thead>
                <tr style="background:var(--dark2); border-bottom: 1px solid var(--border);">
                    <th style="padding:12px 16px; text-align:left; font-size:10px; font-weight:800; color:var(--dim2); text-transform:uppercase; letter-spacing:1px; white-space:nowrap;">No</th>
                    <th style="padding:12px 16px; text-align:left; font-size:10px; font-weight:800; color:var(--dim2); text-transform:uppercase; letter-spacing:1px; white-space:nowrap;">Member ID</th>
                    <th style="padding:12px 16px; text-align:left; font-size:10px; font-weight:800; color:var(--dim2); text-transform:uppercase; letter-spacing:1px; white-space:nowrap;">Nama</th>
                    <th style="padding:12px 16px; text-align:left; font-size:10px; font-weight:800; color:var(--dim2); text-transform:uppercase; letter-spacing:1px; white-space:nowrap;">Tanggal</th>
                    <th style="padding:12px 16px; text-align:left; font-size:10px; font-weight:800; color:var(--dim2); text-transform:uppercase; letter-spacing:1px; white-space:nowrap;">Jam Masuk</th>
                    <th style="padding:12px 16px; text-align:left; font-size:10px; font-weight:800; color:var(--dim2); text-transform:uppercase; letter-spacing:1px; white-space:nowrap;">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($presences as $index => $presence)
                <tr style="border-bottom:1px solid var(--border); transition:background 0.15s;"
                    onmouseover="this.style.background='var(--dark2)'"
                    onmouseout="this.style.background='transparent'">
                    <td style="padding:12px 16px; font-size:12px; font-weight:600; color:var(--dim);">{{ $index + 1 }}</td>
                    <td style="padding:12px 16px; font-size:12px; color:var(--red); font-family:monospace; font-weight:700;">{{ $presence->member_id }}</td>
                    <td style="padding:12px 16px; font-size:13px; font-weight:600; color:var(--white);">{{ $presence->user->name ?? '-' }}</td>
                    <td style="padding:12px 16px; font-size:12px; font-weight:500; color:var(--dim); white-space:nowrap;">{{ \Carbon\Carbon::parse($presence->check_in_at)->format('d M Y') }}</td>
                    <td style="padding:12px 16px; font-size:12px; font-weight:500; color:var(--dim); white-space:nowrap;">{{ \Carbon\Carbon::parse($presence->check_in_at)->format('H:i') }} WIB</td>
                    <td style="padding:12px 16px;">
                        <span style="background:rgba(46, 204, 113, 0.1); color:#27AE60; border:1px solid rgba(46, 204, 113, 0.3); padding:3px 10px; border-radius:100px; font-size:10px; font-weight:700;">
                            {{ $presence->status }}
                        </span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="padding:40px; text-align:center; color:var(--dim2); font-weight:500; font-size:13px;">
                        Tidak ada data absensi untuk periode ini.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Chart
const ctx = document.getElementById('attendanceChart').getContext('2d');
const chartData = @json($chartData);
new Chart(ctx, {
    type: 'bar',
    data: {
        labels: chartData.map(d => d.date_label),
        datasets: [{
            label: 'Jumlah Kehadiran',
            data: chartData.map(d => d.total),
            backgroundColor: 'rgba(222,67,49,0.15)', // Warna bar chart diubah kemerahan
            borderColor: '#DE4331',
            borderWidth: 2,
            borderRadius: 8,
        }]
    },
    options: {
        responsive: true,
        plugins: { legend: { labels: { color:'var(--dim)', font:{ size:11, weight:'bold' } } } },
        scales: {
            x: { ticks:{ color:'var(--dim2)', font:{size:10, weight:'600'} }, grid:{ color:'var(--border)' } },
            y: { ticks:{ color:'var(--dim2)', stepSize:1, font:{size:10, weight:'600'} }, grid:{ color:'var(--border)' }, beginAtZero:true }
        }
    }
});

// Tab switch
function switchMode(mode) {
    document.getElementById('filter_mode_input').value = mode;
    document.getElementById('mode-month').style.display  = mode === 'month' ? 'flex' : 'none';
    document.getElementById('mode-range').style.display  = mode === 'range' ? 'flex' : 'none';
    document.getElementById('shortcuts').style.display   = mode === 'range' ? 'flex' : 'none';

    const tabMonth = document.getElementById('tab-month');
    const tabRange = document.getElementById('tab-range');

    if (mode === 'month') {
        tabMonth.style.borderColor = 'var(--red)';
        tabMonth.style.background  = 'rgba(222,67,49,0.1)';
        tabMonth.style.color       = 'var(--red)';
        tabRange.style.borderColor = 'var(--border)';
        tabRange.style.background  = 'var(--dark2)';
        tabRange.style.color       = 'var(--dim2)';
    } else {
        tabRange.style.borderColor = 'var(--red)';
        tabRange.style.background  = 'rgba(222,67,49,0.1)';
        tabRange.style.color       = 'var(--red)';
        tabMonth.style.borderColor = 'var(--border)';
        tabMonth.style.background  = 'var(--dark2)';
        tabMonth.style.color       = 'var(--dim2)';
    }
}

// Shortcut range
function setRange(days) {
    const today = new Date();
    const from  = new Date();
    from.setDate(today.getDate() - days + 1);

    const fmt = d => d.toISOString().split('T')[0];
    document.querySelector('[name="date_from"]').value = fmt(from);
    document.querySelector('[name="date_to"]').value   = fmt(today);
}
</script>
@endsection 