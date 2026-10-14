<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Fitscape Studio') }}</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
       <style>
            body { 
                background: #F4F3EF; /* Background krem terang (Warm Off-White) */
                color: #141414;      /* Teks utama hitam */
                font-family: 'Barlow', sans-serif;
            }

            .fitscape-nav {
                background: rgba(244, 243, 239, 0.95); /* Semi transparan krem terang */
                border-bottom: 1px solid #E5E3DB;     /* Garis lembut */
                padding: 12px 30px;
                display: flex;
                justify-content: space-between;
                align-items: center;
                position: sticky;
                top: 0;
                z-index: 100;
                backdrop-filter: blur(20px);
            }

            .fitscape-nav .logo {
                font-family: 'Bebas Neue', sans-serif;
                font-size: 22px;
                font-weight: 700;
                color: #141414;
                letter-spacing: 2px;
                text-decoration: none;
            }

            .fitscape-nav .logo span { 
                color: #E63946; /* Merah Coral menyala */
            }

            .nav-avatar {
                width: 38px;
                height: 38px;
                border-radius: 50%;
                background: #141414; /* Hitam pekat */
                display: flex;
                align-items: center;
                justify-content: center;
                font-weight: 700;
                color: #fff;
                font-size: 14px;
                cursor: pointer;
                text-decoration: none;
                transition: 0.2s;
                border: 2px solid transparent;
            }

            .nav-avatar:hover { 
                border-color: #E63946; 
                transform: scale(1.05); 
            }

            @media (max-width: 768px) {
                .fitscape-nav { padding: 12px 16px; }
                .fitscape-nav .logo { font-size: 18px; }
            }
        </style>
    </head>
    <body class="font-sans antialiased">

        <nav class="fitscape-nav">
           <a href="{{ route('dashboard') }}" class="logo">FITSCAPE <span>STUDIO</span></a>
            @auth
            <a href="{{ route('profile.edit') }}" class="nav-avatar">
                {{ substr(auth()->user()->name, 0, 1) }}
            </a>
            @endauth
        </nav>

        <main>{{ $slot }}</main>

    </body>
</html>