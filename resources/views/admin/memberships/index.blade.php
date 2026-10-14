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

    .header-action {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 24px;
    }
    
    .page-title {
        font-size: 24px;
        font-weight: 800;
        color: var(--white);
        margin: 0;
    }
    
    .btn-add {
        background: var(--red);
        color: #fff;
        padding: 10px 20px;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 700;
        text-decoration: none;
        transition: all 0.2s;
        box-shadow: 0 4px 12px rgba(222,67,49,0.15);
    }
    .btn-add:hover {
        background: var(--red2);
        transform: translateY(-2px);
    }

    .pkg-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 24px;
    }

    .pkg-card {
        background: var(--dark3);
        border: 1px solid var(--border);
        border-top: 4px solid var(--red); /* Default border top */
        border-radius: 16px;
        padding: 24px;
        display: flex;
        flex-direction: column;
        box-shadow: 0 4px 12px rgba(0,0,0,0.02);
        transition: all 0.2s;
    }
    .pkg-card:hover {
        box-shadow: 0 8px 24px rgba(0,0,0,0.06);
        transform: translateY(-3px);
    }

    .pkg-title {
        font-size: 20px;
        font-weight: 800;
        color: var(--white);
        margin: 0 0 8px 0;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .pkg-desc {
        font-size: 13px;
        color: var(--dim2);
        margin: 0 0 20px 0;
        line-height: 1.6;
        flex: 1;
    }

    .pkg-price-wrap {
        margin-bottom: 24px;
        padding-bottom: 20px;
        border-bottom: 1px solid var(--border);
    }

    .pkg-price {
        font-size: 24px;
        font-weight: 800;
        color: var(--red);
        margin: 0 0 6px 0;
    }

    .pkg-duration {
        font-size: 12px;
        color: var(--dim);
        font-weight: 600;
        margin: 0;
    }

    .pkg-actions {
        display: flex;
        gap: 12px;
    }

    .btn-edit {
        flex: 1;
        text-align: center;
        background: var(--dark2);
        border: 1px solid var(--border);
        color: var(--dim);
        padding: 10px;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 700;
        text-decoration: none;
        transition: all 0.2s;
    }
    .btn-edit:hover {
        border-color: var(--dim);
        color: var(--white);
        background: #fff;
    }

    .form-delete {
        margin: 0;
    }

    .btn-delete {
        background: rgba(222, 67, 49, 0.1);
        border: 1px solid rgba(222, 67, 49, 0.2);
        color: var(--red);
        padding: 10px 16px;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.2s;
        height: 100%;
    }
    .btn-delete:hover {
        background: var(--red);
        color: #fff;
    }
</style>

<div class="header-action">
    <h2 class="page-title">Paket Membership</h2>
    <a href="{{ route('admin.memberships.create') }}" class="btn-add">
        + Tambah Paket
    </a>
</div>

<div class="pkg-grid">
    @foreach($packages as $package)
    <!-- Warna border atas (garis) akan menggunakan warna custom paket jika disetel, atau kembali ke merah bawaan -->
    <div class="pkg-card" style="border-top-color: {{ $package->color ?? 'var(--red)' }}">
        
        <h3 class="pkg-title">{{ $package->name }}</h3>
        
        <p class="pkg-desc">{{ $package->description ?? 'Tidak ada deskripsi.' }}</p>
        
        <div class="pkg-price-wrap">
            <p class="pkg-price">Rp {{ number_format($package->price, 0, ',', '.') }}</p>
            <p class="pkg-duration">⏱ {{ $package->duration_days }} hari</p>
        </div>
        
        <div class="pkg-actions">
            <a href="{{ route('admin.memberships.edit', $package) }}" class="btn-edit">
                Edit
            </a>
            
            <form class="form-delete" action="{{ route('admin.memberships.destroy', $package) }}" method="POST"
                  onsubmit="return confirm('Hapus paket ini?')">
                @csrf @method('DELETE')
                <button class="btn-delete">
                    Hapus
                </button>
            </form>
        </div>
    </div>
    @endforeach
</div>
@endsection