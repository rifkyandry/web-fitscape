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

    .settings-header {
        margin-bottom: 28px;
    }
    
    .settings-title {
        font-size: 24px; 
        font-weight: 800; 
        margin: 0 0 4px; 
        color: var(--white);
    }
    
    .settings-subtitle {
        font-size: 13px; 
        color: var(--dim2); 
        margin: 0; 
        font-weight: 500;
    }

    .alert-success {
        background: rgba(46, 204, 113, 0.1); 
        border: 1px solid rgba(46, 204, 113, 0.3); 
        border-radius: 12px; 
        padding: 12px 16px; 
        font-size: 13px; 
        font-weight: 600;
        color: #27AE60; 
        margin-bottom: 20px;
    }

    .settings-card {
        background: var(--dark3); 
        border: 1px solid var(--border); 
        border-radius: 16px; 
        padding: 24px 28px; 
        margin-bottom: 20px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.02);
    }

    .card-title {
        font-size: 14px; 
        font-weight: 800; 
        margin: 0 0 20px; 
        color: var(--white);
        border-bottom: 1px solid var(--border);
        padding-bottom: 12px;
    }

    .form-group-wrapper {
        display: flex; 
        flex-direction: column; 
        gap: 16px;
    }

    .form-label {
        display: block; 
        font-size: 11px; 
        color: var(--dim); 
        text-transform: uppercase; 
        letter-spacing: 1px; 
        margin-bottom: 8px; 
        font-weight: 700;
    }

    .form-input {
        width: 100%; 
        background: var(--dark2); 
        border: 1px solid var(--border); 
        border-radius: 8px; 
        padding: 12px 16px; 
        color: var(--white); 
        font-size: 13px; 
        outline: none; 
        transition: all 0.2s;
        font-family: inherit;
    }
    
    .form-input:focus {
        border-color: var(--red);
        background: #FFFFFF;
        box-shadow: 0 0 0 3px rgba(222,67,49,0.1);
    }
    
    textarea.form-input {
        resize: vertical;
        min-height: 80px;
    }

    .btn-submit {
        background: var(--red); 
        color: #fff; 
        border: none;
        padding: 14px 40px; 
        border-radius: 10px; 
        font-size: 13px;
        font-weight: 800; 
        cursor: pointer; 
        letter-spacing: 1px;
        text-transform: uppercase; 
        transition: all 0.2s;
        box-shadow: 0 4px 12px rgba(222,67,49,0.15);
        display: inline-block;
        margin-bottom: 20px;
    }
    
    .btn-submit:hover {
        background: var(--red2);
        transform: translateY(-2px);
    }
</style>

<div class="settings-header">
    <h1 class="settings-title">⚙️ Pengaturan Website</h1>
    <p class="settings-subtitle">Edit konten yang tampil di landing page dan footer</p>
</div>

@if(session('success'))
<div class="alert-success">
    ✅ {{ session('success') }}
</div>
@endif

<form method="POST" action="{{ route('admin.settings.update') }}">
    @csrf

    @php
        $groupLabels = [
            'general' => '🏢 Informasi Gym',
            'contact' => '📞 Kontak & Sosial Media',
            'hours'   => '🕐 Jam Operasional',
            'footer'  => '🔽 Footer',
        ];
    @endphp

    @foreach($settings as $group => $items)
    <div class="settings-card">
        <h3 class="card-title">
            {{ $groupLabels[$group] ?? ucfirst($group) }}
        </h3>
        <div class="form-group-wrapper">
            @foreach($items as $setting)
            <div>
                <label class="form-label">
                    {{ $setting->label }}
                </label>
                @if(strlen($setting->value) > 80)
                <textarea
                    name="settings[{{ $setting->key }}]"
                    rows="3"
                    class="form-input"
                >{{ $setting->value }}</textarea>
                @else
                <input
                    type="text"
                    name="settings[{{ $setting->key }}]"
                    value="{{ $setting->value }}"
                    class="form-input"
                >
                @endif
            </div>
            @endforeach
        </div>
    </div>
    @endforeach

    <button type="submit" class="btn-submit">
        Simpan Pengaturan
    </button>
</form>
@endsection