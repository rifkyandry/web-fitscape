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

    .profile-wrapper {
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 70vh;
    }
    
    .profile-card {
        width: 100%;
        max-width: 480px;
        background: var(--dark3);
        border-radius: 24px;
        border: 1px solid var(--border);
        overflow: hidden;
        box-shadow: 0 8px 24px rgba(0,0,0,0.04);
    }
    
    .profile-header {
        background: var(--dark2);
        padding: 40px;
        text-align: center;
        border-bottom: 1px solid var(--border);
    }
    
    .profile-avatar {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: rgba(222, 67, 49, 0.1);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 32px;
        font-weight: 900;
        color: var(--red);
        margin: 0 auto 15px;
        border: 2px solid var(--red);
    }
    
    .profile-body { padding: 30px 40px; }
    
    .info-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 12px 0;
        border-bottom: 1px solid var(--border);
    }
    .info-row:last-child { border-bottom: none; }
    
    .info-label { font-size: 11px; color: var(--dim); text-transform: uppercase; letter-spacing: 1px; font-weight: 700; }
    
    .info-value { font-size: 14px; color: var(--white); font-weight: 600; }
    
    .profile-footer { padding: 20px 40px 30px; display: flex; flex-direction: column; gap: 12px; }
    
    .btn-logout {
        width: 100%;
        padding: 14px;
        border-radius: 12px;
        border: 1px solid var(--red);
        background: rgba(222, 67, 49, 0.05);
        color: var(--red);
        font-size: 14px;
        font-weight: 800;
        cursor: pointer;
        transition: all 0.2s;
        letter-spacing: 1px;
    }
    .btn-logout:hover { background: var(--red); color: #fff; transform: translateY(-2px); box-shadow: 0 4px 12px rgba(222,67,49,0.15); }
    
    .btn-back {
        display: block;
        text-align: center;
        padding: 14px;
        border-radius: 12px;
        background: var(--dark2);
        border: 1px solid var(--border);
        color: var(--dim);
        font-size: 13px;
        font-weight: 700;
        text-decoration: none;
        transition: all 0.2s;
    }
    .btn-back:hover { border-color: var(--dim); color: var(--white); background: #fff; transform: translateY(-2px); }
</style>

<div class="profile-wrapper">
    <div class="profile-card">
        <div class="profile-header">
            <div class="profile-avatar">A</div>
            <p style="font-size: 22px; font-weight: 800; margin: 0; color: var(--white);">Admin Fitscape</p>
            <p style="color: var(--red); font-size: 12px; margin-top: 5px; font-weight: 700; letter-spacing: 2px;">ADMINISTRATOR</p>
        </div>

        <div class="profile-body">
            <div class="info-row">
                <span class="info-label">Email</span>
                <span class="info-value">{{ auth()->user()->email }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Role</span>
                <span class="info-value" style="color: var(--red); text-transform: uppercase; font-size: 12px; font-weight: 800; letter-spacing: 1px;">{{ auth()->user()->role }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Bergabung</span>
                <span class="info-value">{{ \Carbon\Carbon::parse(auth()->user()->created_at)->format('d M Y') }}</span>
            </div>
        </div>

        <div class="profile-footer">
            <a href="{{ route('admin.dashboard.admin') }}" class="btn-back">← Kembali ke Dashboard</a>
            <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                @csrf
                <button type="submit" class="btn-logout">LOGOUT</button>
            </form>
        </div>
    </div>
</div>
@endsection