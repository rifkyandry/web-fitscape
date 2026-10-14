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

    .admin-form-container {
        max-width: 500px;
    }
    
    .admin-form-title {
        font-size: 24px;
        font-weight: 800;
        margin-bottom: 24px;
        color: var(--white);
    }

    .admin-form-card {
        background: var(--dark3);
        border: 1px solid var(--border);
        border-radius: 16px;
        padding: 28px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.02);
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        font-size: 11px;
        font-weight: 700;
        color: var(--dim);
        margin-bottom: 8px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .form-control {
        width: 100%;
        background: var(--dark2);
        border: 1px solid var(--border);
        border-radius: 8px;
        padding: 14px 16px;
        color: var(--white);
        font-size: 14px;
        transition: all 0.2s;
    }

    .form-control:focus {
        outline: none;
        border-color: var(--red);
        background: #FFFFFF;
        box-shadow: 0 0 0 3px rgba(222,67,49,0.1);
    }

    .form-hint {
        font-size: 11px;
        color: var(--dim2);
        margin-top: 6px;
        font-weight: 500;
    }

    .btn-submit {
        width: 100%;
        background: var(--red);
        color: #fff;
        border: none;
        border-radius: 8px;
        padding: 14px;
        font-size: 14px;
        font-weight: 800;
        cursor: pointer;
        text-transform: uppercase;
        letter-spacing: 1px;
        transition: all 0.2s;
        margin-top: 8px;
    }

    .btn-submit:hover {
        background: var(--red2);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(222,67,49,0.2);
    }
</style>

<div class="admin-form-container">
    <h2 class="admin-form-title">Edit Paket: <span style="color: var(--red);">{{ $membership->name }}</span></h2>

    <div class="admin-form-card">
        <form action="{{ route('admin.memberships.update', $membership) }}" method="POST">
            @csrf 
            @method('PUT')
            
            <div class="form-group">
                <label>Nama Paket</label>
                <input type="text" name="name" value="{{ $membership->name }}" class="form-control" required>
            </div>
            
            <div class="form-group">
                <label>Deskripsi</label>
                <textarea name="description" rows="3" class="form-control">{{ $membership->description }}</textarea>
            </div>
            
            <div class="form-group">
                <label>Harga (Rp)</label>
                <input type="number" name="price" value="{{ $membership->price }}" class="form-control" required>
            </div>
            
            <div class="form-group">
                <label>Durasi (Bulan)</label>
                <div style="position: relative;">
                    <input type="number" name="duration_months" value="{{ round($membership->duration_days / 30) }}" min="1" max="24" class="form-control" required>
                    <span style="position: absolute; right: 16px; top: 50%; transform: translateY(-50%); font-size: 13px; color: var(--dim2); font-weight: 600;">bulan</span>
                </div>
                <p class="form-hint">Contoh: Bronze = 1, Silver = 3, Gold = 5, Platinum = 7</p>
            </div>
            
            <button type="submit" class="btn-submit">
                Update Paket
            </button>
        </form>
    </div>
</div>
@endsection