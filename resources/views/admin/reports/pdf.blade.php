<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Absensi - Fitscape Studio</title>
    <style>
        /* Pengaturan Dasar Halaman Kertas (PDF) */
        @page { size: A4; margin: 40px; }
        
        body { 
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; 
            font-size: 12px; 
            color: #333333; 
            margin: 0; 
            padding: 0; 
            background: #FFFFFF;
        }

        /* Kop Laporan */
        .header { 
            text-align: center; 
            margin-bottom: 25px; 
            padding-bottom: 15px;
            border-bottom: 3px solid #DE4331; /* Aksen Merah Khas Fitscape */
        }
        
        .header h1 { 
            font-size: 24px; 
            color: #111111; 
            margin: 0 0 5px 0; 
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 2px;
        }
        
        .header h2 { 
            font-size: 13px; 
            color: #666666; 
            margin: 0; 
            font-weight: normal; 
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .period-box { 
            display: inline-block;
            margin-top: 15px;
            background: #F7F6F1; /* Warna Krem Lembut */
            border: 1px solid #D4D2C7;
            padding: 6px 16px;
            border-radius: 4px;
            font-size: 11px;
            color: #333333; 
            font-weight: bold; 
        }

        /* Baris Statistik Ringkasan */
        .stats-container { 
            width: 100%; 
            margin-bottom: 25px; 
            border-collapse: separate;
            border-spacing: 12px 0; /* Memberi jarak antar kotak */
            table-layout: fixed;
        }
        
        .stat-box { 
            background: #FFFFFF;
            border: 1px solid #D4D2C7; 
            border-radius: 6px; 
            padding: 12px; 
            text-align: center; 
            box-shadow: 2px 2px 0px rgba(222,67,49,0.1);
        }
        
        .stat-box .number { 
            font-size: 22px; 
            font-weight: bold; 
            color: #DE4331; /* Merah */
            margin-bottom: 4px;
        }
        
        .stat-box .number-gold {
            font-size: 14px; 
            font-weight: bold; 
            color: #C9A84C; /* Emas gelap (opsional untuk yang paling rajin) */
            margin-bottom: 4px;
        }
        
        .stat-box .label { 
            font-size: 10px; 
            color: #666666; 
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: bold;
        }

        /* Tabel Data Laporan */
        table.data-table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-top: 10px; 
        }
        
        table.data-table thead th { 
            background-color: #F7F6F1; /* Krem Terang */
            color: #111111; 
            padding: 10px 12px; 
            text-align: left; 
            font-size: 11px; 
            font-weight: bold;
            text-transform: uppercase;
            border-bottom: 2px solid #D4D2C7;
            border-top: 1px solid #D4D2C7;
        }
        
        table.data-table tbody td { 
            padding: 10px 12px; 
            border-bottom: 1px solid #EEEEEE; 
            font-size: 11px; 
            color: #333333;
        }
        
        table.data-table tbody tr:nth-child(even) td { 
            background-color: #FAFAFA; /* Warna selang-seling baris agar mudah dibaca */
        }
        
        /* Badge Status */
        .badge { 
            background: #F0Fdf4; /* Hijau super tipis untuk kertas cetak */
            color: #166534; /* Hijau pekat */
            border: 1px solid #BBF7D0;
            padding: 3px 8px; 
            border-radius: 4px; 
            font-size: 10px; 
            font-weight: bold;
            text-transform: uppercase;
        }

        /* Footer Kertas */
        .footer { 
            margin-top: 40px; 
            text-align: center; 
            font-size: 10px; 
            color: #999999; 
            border-top: 1px dashed #D4D2C7; 
            padding-top: 10px; 
        }
        
        .empty-row {
            text-align: center; 
            color: #888888; 
            padding: 30px !important;
            font-style: italic;
        }
    </style>
</head>
<body>

<div class="header">
    <h1>FITSCAPE STUDIO</h1>
    <h2>Laporan Kehadiran Member</h2>
    <div class="period-box">
        Periode: {{ \Carbon\Carbon::parse($dateFrom)->format('d F Y') }} — {{ \Carbon\Carbon::parse($dateTo)->format('d F Y') }}
    </div>
</div>

<!-- Karena div dengan flex tidak selalu didukung sempurna oleh PDF generator (seperti dompdf), 
     kita gunakan tag table untuk layout statistik sejajar -->
<table class="stats-container">
    <tr>
        <td class="stat-box">
            <div class="number">{{ $totalMembers }}</div>
            <div class="label">Total Member</div>
        </td>
        <td class="stat-box">
            <div class="number">{{ $totalPresences }}</div>
            <div class="label">Total Kehadiran</div>
        </td>
        <td class="stat-box">
            <div class="number">{{ $topMember ? $topMember->total : 0 }}</div>
            <div class="label">Hadir Tertinggi</div>
        </td>
        <td class="stat-box">
            <div class="number-gold">{{ $topMember ? $topMember->user->name : '-' }}</div>
            <div class="label">Paling Rajin</div>
        </td>
    </tr>
</table>

<table class="data-table">
    <thead>
        <tr>
            <th width="5%">No</th>
            <th width="15%">Member ID</th>
            <th width="30%">Nama</th>
            <th width="20%">Tanggal</th>
            <th width="15%">Jam Masuk</th>
            <th width="15%">Status</th>
        </tr>
    </thead>
    <tbody>
        @forelse($presences as $index => $presence)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td style="font-family: monospace; font-weight: bold; color: #DE4331;">{{ $presence->member_id }}</td>
            <td style="font-weight: bold;">{{ $presence->user->name ?? '-' }}</td>
            <td>{{ \Carbon\Carbon::parse($presence->check_in_at)->format('d M Y') }}</td>
            <td>{{ \Carbon\Carbon::parse($presence->check_in_at)->format('H:i') }} WIB</td>
            <td><span class="badge">{{ $presence->status }}</span></td>
        </tr>
        @empty
        <tr>
            <td colspan="6" class="empty-row">
                Tidak ada riwayat kehadiran pada periode yang dipilih.
            </td>
        </tr>
        @endforelse
    </tbody>
</table>

<div class="footer">
    Dokumen ini dicetak secara otomatis dari sistem Fitscape Studio pada {{ \Carbon\Carbon::now()->format('d F Y - H:i') }} WIB.
</div>

</body>
</html>