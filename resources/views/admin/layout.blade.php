<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Fitscape Studio</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap');
        
        :root {
            /* Palet warna Light Mode */
            --red: #DE4331; 
            --red2: #B93626;
            --dark: #EBE9E1;   /* Krem Terang (Background Utama) */
            --dark2: #F7F6F1;  /* Krem Lebih Terang (Sidebar/Topbar) */
            --dark3: #FFFFFF;  /* Putih bersih */
            --border: #D4D2C7; /* Garis Abu-abu terang */
            --dim: #333333;    /* Teks abu-abu gelap */
            --dim2: #666666;   
            --white: #111111;  /* Teks hitam pekat */
        }

        * { font-family: 'Inter', sans-serif; box-sizing: border-box; }

        body {
            background: var(--dark);
            color: var(--white);
            margin: 0;
        }

        .sidebar {
            width: 260px;
            background: var(--dark2);
            border-right: 1px solid var(--border);
            min-height: 100vh;
            position: fixed;
            top: 0; left: 0;
            display: flex;
            flex-direction: column;
            z-index: 200;
            transition: transform 0.3s cubic-bezier(.4,0,.2,1);
        }
        
        .nav-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 11px 16px;
            border-radius: 12px;
            font-size: 13px;
            font-weight: 600;
            color: var(--dim2);
            text-decoration: none;
            transition: all 0.2s;
            position: relative;
            margin-bottom: 4px;
        }
        
        .nav-item:hover { background: #FFFFFF; color: var(--red); transform: translateX(3px); box-shadow: 0 2px 8px rgba(0,0,0,0.02); }
        .nav-item.active { background: #FFFFFF; color: var(--red); border: 1px solid var(--border); box-shadow: 0 2px 8px rgba(0,0,0,0.02); }
        
        .nav-item .nav-icon {
            width: 34px; height: 34px;
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 16px;
            background: var(--dark);
            transition: all 0.2s;
            flex-shrink: 0;
        }
        
        .nav-item:hover .nav-icon,
        .nav-item.active .nav-icon { background: rgba(222,67,49,0.1); transform: scale(1.08); }
        
        .nav-badge {
            margin-left: auto;
            background: var(--red);
            color: #FFFFFF;
            font-size: 10px;
            font-weight: 800;
            padding: 2px 7px;
            border-radius: 100px;
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.6; }
        }
        
        .main-content {
            margin-left: 260px;
            min-height: 100vh;
            background: var(--dark);
            transition: margin-left 0.3s cubic-bezier(.4,0,.2,1);
        }
        
        .top-nav {
            background: var(--dark2);
            border-bottom: 1px solid var(--border);
            padding: 14px 28px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky; top: 0; z-index: 100;
        }
        
        .nav-avatar {
            width: 36px; height: 36px;
            border-radius: 50%;
            background: rgba(222, 67, 49, 0.1);
            display: flex; align-items: center; justify-content: center;
            font-weight: 900; color: var(--red); font-size: 14px;
            cursor: pointer; text-decoration: none;
            transition: all 0.2s; border: 2px solid transparent;
        }
        
        .nav-avatar:hover { border-color: var(--red); transform: scale(1.05); }
        
        .hamburger {
            display: none;
            flex-direction: column;
            gap: 5px;
            cursor: pointer;
            padding: 6px;
            border-radius: 8px;
            transition: background 0.2s;
        }
        .hamburger:hover { background: var(--dark); }
        .hamburger span {
            display: block; width: 22px; height: 2px;
            background: var(--white); border-radius: 2px;
            transition: all 0.3s;
        }
        .hamburger.open span:nth-child(1) { transform: translateY(7px) rotate(45deg); }
        .hamburger.open span:nth-child(2) { opacity: 0; }
        .hamburger.open span:nth-child(3) { transform: translateY(-7px) rotate(-45deg); }
        
        .sidebar-overlay {
            display: none;
            position: fixed; inset: 0;
            background: rgba(0,0,0,0.5);
            z-index: 190;
            backdrop-filter: blur(2px);
        }
        .sidebar-overlay.show { display: block; }

        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.open { transform: translateX(0); }
            .main-content { margin-left: 0; }
            .hamburger { display: flex; }
            .brand-desktop { display: none; }
        }
        
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: var(--dark); }
        ::-webkit-scrollbar-thumb { background: #C4C2B7; border-radius: 4px; }
    </style>
</head>
<body>

<div class="sidebar-overlay" id="overlay" onclick="closeSidebar()"></div>

<aside class="sidebar" id="sidebar">
    <div style="padding:24px 20px 16px; border-bottom:1px solid var(--border);">
        <div style="display:flex; align-items:center; gap:10px;">
            <div style="width:34px; height:34px; background:rgba(222,67,49,0.1); border-radius:10px; display:flex; align-items:center; justify-content:center; font-size:16px;">
                🏋️
            </div>
            <div>
                <p style="margin:0; font-size:14px; font-weight:900; letter-spacing:2px; color:var(--white);">FITSCAPE</p>
                <p style="margin:0; font-size:10px; color:var(--red); font-weight:800; letter-spacing:1px;">ADMIN PANEL</p>
            </div>
        </div>
    </div>

    <nav style="padding:20px 12px; flex:1;">
        <a href="{{ route('admin.dashboard.admin') }}"
           class="nav-item {{ request()->routeIs('admin.dashboard.*') ? 'active' : '' }}">
            <div class="nav-icon">🏠</div>
            <span>Dashboard</span>
        </a>

        <p style="font-size:10px; color:var(--dim2); text-transform:uppercase; font-weight:700; letter-spacing:3px; margin:16px 0 10px 4px;">Menu</p>

        <a href="{{ route('admin.scan.index') }}"
           class="nav-item {{ request()->routeIs('admin.scan.*') ? 'active' : '' }}">
            <div class="nav-icon">📷</div>
            <span>Scanner Absensi</span>
        </a>

        <a href="{{ route('admin.memberships.index') }}"
           class="nav-item {{ request()->routeIs('admin.memberships.*') ? 'active' : '' }}">
            <div class="nav-icon">📦</div>
            <span>Paket Membership</span>
        </a>

        @php
            $pendingCount = \App\Models\User::where('membership_status','pending')->count();
        @endphp
        <a href="{{ route('admin.members.index') }}"
           class="nav-item {{ request()->routeIs('admin.members.*') ? 'active' : '' }}">
            <div class="nav-icon">👥</div>
            <span>Data Member</span>
            @if($pendingCount > 0)
                <span class="nav-badge">{{ $pendingCount }}</span>
            @endif
        </a>

        <a href="{{ route('admin.reports.index') }}"
           class="nav-item {{ request()->routeIs('admin.reports.*') ? 'active' : '' }}">
            <div class="nav-icon">📊</div>
            <span>Laporan Absensi</span>
        </a>

        <a href="{{ route('admin.settings.index') }}"
           class="nav-item {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
            <div class="nav-icon">⚙️</div>
            <span>Pengaturan</span>
        </a>
    </nav>

    <div style="padding:16px 12px; border-top:1px solid var(--border);">
        <a href="{{ route('admin.profile.admin') }}"
           style="display:flex; align-items:center; gap:10px; padding:10px 12px; border-radius:12px; text-decoration:none; transition:background 0.2s;"
           onmouseover="this.style.background='#FFFFFF'" onmouseout="this.style.background='transparent'">
            <div style="width:34px; height:34px; border-radius:50%; background:rgba(222,67,49,0.1); display:flex; align-items:center; justify-content:center; font-weight:900; color:var(--red); font-size:13px; flex-shrink:0;">
                A
            </div>
            <div>
                <p style="margin:0; font-size:13px; font-weight:700; color:var(--white);">Admin</p>
                <p style="margin:0; font-size:11px; font-weight:500; color:var(--dim2);">Fitscape Studio</p>
            </div>
        </a>
    </div>
</aside>

<div class="main-content">
    <nav class="top-nav">
        <div style="display:flex; align-items:center; gap:14px;">
            <div class="hamburger" id="hamburger" onclick="toggleSidebar()">
                <span></span><span></span><span></span>
            </div>
            <span style="font-size:14px; font-weight:900; letter-spacing:2px; display:none; color:var(--white);" id="brandMobile">
                FITSCAPE <span style="color:var(--red);">ADMIN</span>
            </span>
        </div>
        <div style="display:flex; align-items:center; gap:16px;">
            @if($pendingCount > 0)
            <a href="{{ route('admin.members.index') }}"
               style="display:flex; align-items:center; gap:6px; background:rgba(222,67,49,0.1); border:1px solid rgba(222,67,49,0.2); border-radius:100px; padding:6px 12px; text-decoration:none; transition:all 0.2s;"
               onmouseover="this.style.background='rgba(222,67,49,0.2)'"
               onmouseout="this.style.background='rgba(222,67,49,0.1)'">
                <span style="font-size:12px;">⏳</span>
                <span style="font-size:11px; color:var(--red); font-weight:700;">{{ $pendingCount }} Pending</span>
            </a>
            @endif
            <a href="{{ route('admin.profile.admin') }}" class="nav-avatar">A</a>
        </div>
    </nav>

    <div style="padding:28px 32px;">
        @if(session('success'))
        <div style="background:rgba(46, 204, 113, 0.1); border:1px solid #2ECC71; border-radius:12px; padding:12px 16px; margin-bottom:20px; font-size:13px; font-weight:600; color:#27AE60;">
            ✅ {{ session('success') }}
        </div>
        @endif
        @if(session('error'))
        <div style="background:rgba(222, 67, 49, 0.1); border:1px solid var(--red); border-radius:12px; padding:12px 16px; margin-bottom:20px; font-size:13px; font-weight:600; color:var(--red);">
            ❌ {{ session('error') }}
        </div>
        @endif

        @yield('content')
    </div>
</div>

<script>
    function toggleSidebar() {
        document.getElementById('sidebar').classList.toggle('open');
        document.getElementById('hamburger').classList.toggle('open');
        document.getElementById('overlay').classList.toggle('show');
    }
    function closeSidebar() {
        document.getElementById('sidebar').classList.remove('open');
        document.getElementById('hamburger').classList.remove('open');
        document.getElementById('overlay').classList.remove('show');
    }
    function checkMobile() {
        const isMobile = window.innerWidth <= 768;
        document.getElementById('brandMobile').style.display = isMobile ? 'block' : 'none';
    }
    checkMobile();
    window.addEventListener('resize', checkMobile);
    document.querySelectorAll('.nav-item').forEach(function(item) {
        item.addEventListener('click', function() {
            if (window.innerWidth <= 768) closeSidebar();
        });
    });
</script>
</body>
</html>