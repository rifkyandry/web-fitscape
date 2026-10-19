<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fitscape Studio — Premium Membership</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Barlow:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,700;1,800&family=Barlow+Condensed:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <style>
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

        :root {
            /* Warna disesuaikan dengan referensi gambar */
            --red: #DE4331; 
            --red2: #B93626;
            --orange: #E65A4B;
            --dark: #EBE9E1;   /* Warna background utama (Krem Terang) */
            --dark2: #F7F6F1;  /* Warna background section/card (Lebih terang) */
            --dark3: #FFFFFF;  /* Putih murni */
            --border: #D4D2C7; /* Warna garis batas (Abu-abu terang) */
            
            /* Teks dipergelap agar sangat jelas dan kontras */
            --dim: #333333;    /* Warna teks sekunder / deskripsi (Abu-abu sangat gelap) */
            --dim2: #666666;   /* Warna teks info tambahan */
            --white: #111111;  /* Teks utama (Hitam) */
            
            --num-color: #B3B0A5; /* Warna statis angka 01, 02 agar jelas sebelum di-hover */
        }

        /* overflow-x: clip pada html = jaring pengaman agar halaman tidak bisa digeser ke samping di HP */
        html { scroll-behavior: smooth; overflow-x: clip; -webkit-text-size-adjust: 100%; }

        body {
            background: var(--dark);
            color: var(--white);
            font-family: 'Barlow', sans-serif;
            overflow-x: hidden;
            max-width: 100%;
        }

        body::after {
            content: '';
            position: fixed;
            inset: 0;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)' opacity='0.04'/%3E%3C/svg%3E");
            pointer-events: none;
            z-index: 9999;
            opacity: 0.04;
        }

        /* ═══════════ NAVBAR ═══════════ */
        nav {
            position: fixed;
            top: 0; left: 0; right: 0;
            z-index: 500;
            padding: 0 48px;
            height: 64px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            background: rgba(235, 233, 225, 0.9);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--border);
        }

        .nav-brand {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
            min-width: 0;
        }

        .nav-brand img {
            width: 34px; height: 34px;
            border-radius: 6px;
            object-fit: contain;
            flex-shrink: 0;
        }

        .nav-brand-text {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 18px; font-weight: 800; letter-spacing: 3px;
            color: var(--white);
            white-space: nowrap;
        }

        .nav-brand-text span { color: var(--red); }

        .nav-right {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-shrink: 0;
        }

        .nav-menu {
            display: flex;
            align-items: center;
            gap: 4px;
            margin-right: 20px;
        }

        .nav-menu a {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 13px; font-weight: 600; letter-spacing: 2px;
            color: var(--dim);
            text-decoration: none;
            padding: 8px 14px;
            text-transform: uppercase;
            position: relative; /* Ditambahkan agar garis mengikuti teks */
            transition: color 0.2s;
        }

        .nav-menu a:hover { color: var(--white); }

        /* --- TAMBAHAN UNTUK ANIMASI GARIS BAWAH HITAM --- */
        .nav-menu a::after {
            content: '';
            position: absolute;
            bottom: 4px; /* Mengatur jarak garis dengan teks */
            left: 14px;  /* Menyesuaikan padding kiri menu */
            right: 14px; /* Menyesuaikan padding kanan menu */
            height: 2px; /* Ketebalan garis */
            background: var(--white); /* Menggunakan warna hitam pekat dari root */
            transform: scaleX(0); /* Menyembunyikan garis secara default */
            transform-origin: center;
            transition: transform 0.3s ease; /* Animasi memanjang saat dihover */
        }

        .nav-menu a:hover::after {
            transform: scaleX(1); /* Memunculkan garis */
        }

        .btn-nav-login {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 12px; font-weight: 700; letter-spacing: 2px;
            color: var(--dim);
            text-decoration: none;
            padding: 8px 18px;
            border: 1px solid var(--border);
            text-transform: uppercase;
            transition: all 0.2s;
        }

        .btn-nav-login:hover { border-color: var(--dim); color: var(--white); }

        .btn-nav-register {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 12px; font-weight: 700; letter-spacing: 2px;
            color: #fff;
            text-decoration: none;
            padding: 8px 22px;
            background: var(--red);
            text-transform: uppercase;
            white-space: nowrap;
            transition: background 0.2s;
        }

        .btn-nav-register:hover { background: var(--red2); }

        /* ═══════════ HAMBURGER ═══════════ */
        .hamburger {
            display: none;
            flex-direction: column;
            gap: 5px;
            cursor: pointer;
            padding: 6px;
            background: none;
            border: none;
        }

        .hamburger span {
            display: block;
            width: 22px; height: 2px;
            background: var(--white);
            transition: all 0.3s;
        }

        .hamburger.open span:nth-child(1) { transform: translateY(7px) rotate(45deg); }
        .hamburger.open span:nth-child(2) { opacity: 0; }
        .hamburger.open span:nth-child(3) { transform: translateY(-7px) rotate(-45deg); }

        /* ═══════════ MOBILE MENU ═══════════ */
        .mobile-menu {
            display: none;
            position: fixed;
            top: 64px; left: 0; right: 0;
            background: rgba(235, 233, 225, 0.98);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--border);
            z-index: 499;
            flex-direction: column;
            padding: 16px 24px 24px;
            gap: 0;
            max-height: calc(100vh - 64px);
            overflow-y: auto;
        }

        .mobile-menu.open { display: flex; }

        .mobile-menu a {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 15px; font-weight: 700; letter-spacing: 2px;
            color: var(--dim);
            text-decoration: none;
            padding: 14px 4px;
            text-transform: uppercase;
            border-bottom: 1px solid var(--border);
            transition: color 0.2s;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .mobile-menu a:hover { color: var(--white); }

        .mobile-menu a:last-child { border-bottom: none; }

        .mobile-menu .menu-icon {
            width: 20px;
            text-align: center;
            font-size: 14px;
            opacity: 0.6;
        }

        /* ═══════════ HERO ═══════════ */
        .hero {
            position: relative;
            min-height: 100vh;
            min-height: 100svh;
            display: flex;
            align-items: flex-end;
            overflow: hidden;
        }

        .hero-bg {
            position: absolute; inset: 0;
            background-image:
                linear-gradient(to right, rgba(17,17,17,0.97) 35%, rgba(17,17,17,0.5) 65%, rgba(17,17,17,0.2) 100%),
                url('{{ asset("images/gym-bg.jpg") }}');
            background-size: cover;
            background-position: center 30%;
        }

        .hero-bg-fallback {
            position: absolute; inset: 0;
            background: linear-gradient(135deg, #111111 0%, #222222 40%, #111111 100%);
        }

        .hero-accent {
            position: absolute;
            top: 0; right: 0;
            width: 40%; height: 100%;
            background: linear-gradient(135deg, transparent 40%, rgba(222,67,49,0.15) 100%);
            pointer-events: none;
        }

        .hero-content {
            position: relative;
            z-index: 10;
            padding: 140px 48px 80px;
            max-width: 720px;
            width: 100%;
        }

        .hero-eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 28px;
        }

        .hero-eyebrow-line { width: 32px; height: 2px; background: var(--red); flex-shrink: 0; }

        .hero-eyebrow span {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 12px; font-weight: 700; letter-spacing: 4px;
            color: var(--red);
            text-transform: uppercase;
        }

        .hero-h1 {
            font-family: 'Bebas Neue', sans-serif;
            font-size: clamp(72px, 10vw, 130px);
            line-height: 0.92; letter-spacing: 2px;
            color: #ffffff; /* Tetap putih karena background hero gelap */
            margin-bottom: 8px;
        }

        .hero-h1 .red { color: var(--red); }

        .hero-sub {
            font-family: 'Barlow', sans-serif;
            font-size: 16px; font-weight: 400;
            color: #ffffff;
            max-width: 440px;
            line-height: 1.7;
            margin: 20px 0 36px;
        }

        .hero-btns {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-bottom: 56px;
        }

        .btn-hero-red {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 14px; font-weight: 700; letter-spacing: 2px;
            color: #fff;
            text-decoration: none;
            padding: 14px 36px;
            background: var(--red);
            text-transform: uppercase;
            display: inline-flex; align-items: center;
            gap: 10px;
            transition: all 0.2s;
        }

        .btn-hero-red:hover { background: var(--red2); transform: translateY(-2px); }
        .btn-hero-red svg { transition: transform 0.2s; }
        .btn-hero-red:hover svg { transform: translateX(4px); }

        .btn-hero-ghost {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 14px; font-weight: 700; letter-spacing: 2px;
            color: #fff;
            text-decoration: none;
            padding: 14px 36px;
            border: 1px solid rgba(255,255,255,0.3);
            text-transform: uppercase;
            transition: all 0.2s;
        }

        .btn-hero-ghost:hover { border-color: #fff; color: #fff; }

        /* ═══════════ HERO STATS ═══════════ */
        .hero-stats {
            display: flex; gap: 0;
            border-top: 1px solid rgba(255,255,255,0.1);
            border-left: 1px solid rgba(255,255,255,0.1);
        }

        .stat-item {
            padding: 20px 32px;
            border-right: 1px solid rgba(255,255,255,0.1);
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .stat-num {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 32px; color: #ffffff;
            line-height: 1; letter-spacing: 1px;
        }

        .stat-num span { color: var(--red); }

        .stat-label {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 10px; font-weight: 600; letter-spacing: 3px;
            color: #ffffff;
            text-transform: uppercase;
            margin-top: 4px;
        }

        /* ═══════════ TAGLINE ═══════════ */
        .tagline-section {
            padding: 100px 48px;
            border-top: 1px solid var(--border);
            display: grid;
            grid-template-columns: minmax(0, 1fr) minmax(0, 1fr);
            gap: 80px;
            align-items: center;
        }

        .tagline-left h2 {
            font-family: 'Bebas Neue', sans-serif;
            font-size: clamp(48px, 6vw, 80px);
            line-height: 0.95; letter-spacing: 2px;
            color: var(--white);
        }

        .tagline-left h2 .red { color: var(--red); }

        .tagline-right {
            border-left: 2px solid var(--border);
            padding-left: 40px;
        }

        .tagline-label {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 10px; font-weight: 700; letter-spacing: 4px;
            color: var(--red);
            text-transform: uppercase;
            margin-bottom: 16px;
        }

        .tagline-right p { font-size: 15px; color: var(--dim); line-height: 1.8; margin-bottom: 24px; }

        .tagline-link {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 13px; font-weight: 700; letter-spacing: 2px;
            color: var(--white);
            text-decoration: none; text-transform: uppercase;
            display: inline-flex; align-items: center;
            gap: 8px;
            border-bottom: 1px solid var(--white);
            padding-bottom: 2px;
            transition: all 0.2s;
        }

        .tagline-link:hover { gap: 14px; color: var(--red); border-bottom-color: var(--red); }

        /* ═══════════ MEMBERSHIP ═══════════ */
        .membership-section { padding: 0 48px 100px; }

        .section-header {
            padding: 60px 0 50px;
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
        }

        .section-label {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 10px; font-weight: 700; letter-spacing: 4px;
            color: var(--red);
            text-transform: uppercase;
            margin-bottom: 12px;
        }

        .section-title {
            font-family: 'Bebas Neue', sans-serif;
            font-size: clamp(40px, 5vw, 64px);
            letter-spacing: 2px; line-height: 1;
            color: var(--white);
        }

        .pkg-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(min(280px, 100%), 1fr));
            gap: 1px;
            background: var(--border);
            border: 1px solid var(--border);
        }

        .pkg-card {
            background: var(--dark);
            padding: 48px 36px;
            position: relative;
            overflow: hidden;
            transition: background 0.25s, transform 0.3s cubic-bezier(.4,0,.2,1), box-shadow 0.3s;
            z-index: 1;
        }

        .pkg-card:hover {
            background: var(--dark2);
            transform: translateY(-8px);
            box-shadow: 0 24px 48px rgba(0,0,0,0.08);
            z-index: 10;
        }

        .pkg-card.featured { background: var(--dark3); border-top: 2px solid var(--red); }
        .pkg-card.featured:hover { transform: translateY(-8px); box-shadow: 0 24px 48px rgba(222,67,49,0.15); }

        .pkg-card::after {
            content: '';
            position: absolute;
            bottom: 0; left: 0; right: 0;
            height: 2px;
            background: var(--red);
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.35s ease;
        }

        .pkg-card:hover::after { transform: scaleX(1); }
        .pkg-card.featured::after { transform: scaleX(1); }
        .pkg-card:not(.featured) .pkg-name { transition: color 0.2s; }
        .pkg-card:not(.featured):hover .pkg-name { color: var(--red); }
        .pkg-card:not(.featured) .pkg-price { transition: color 0.2s; }
        .pkg-card:not(.featured):hover .pkg-price { color: var(--red); }
        .pkg-card:not(.featured) .pkg-cta { transition: all 0.2s; }
        .pkg-card:not(.featured):hover .pkg-cta { border-color: var(--red); color: var(--red); }

        .pkg-tier-label {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 10px; font-weight: 700; letter-spacing: 4px;
            color: var(--dim);
            text-transform: uppercase;
            margin-bottom: 16px;
        }

        .pkg-name {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 42px; letter-spacing: 2px; line-height: 1;
            color: var(--white);
            margin-bottom: 16px;
        }

        .pkg-desc { font-size: 13px; color: var(--dim); line-height: 1.7; margin-bottom: 32px; }

        .pkg-divider { height: 1px; background: var(--border); margin-bottom: 28px; }

        .pkg-price {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 52px; letter-spacing: 1px; line-height: 1;
            color: var(--white);
        }

        .pkg-price-unit { font-family: 'Barlow', sans-serif; font-size: 13px; font-weight: 400; color: var(--dim); }

        .pkg-duration {
            display: inline-block;
            margin-top: 14px;
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 10px; font-weight: 700; letter-spacing: 3px;
            color: var(--dim);
            text-transform: uppercase;
            border: 1px solid var(--border);
            padding: 4px 12px;
        }

        .pkg-features { margin-top: 28px; display: flex; flex-direction: column; gap: 10px; }

        .pkg-feat { display: flex; align-items: center; gap: 10px; font-size: 13px; color: var(--dim); }
        .pkg-feat::before { content: ''; width: 16px; height: 1px; background: var(--dim2); flex-shrink: 0; }

        .pkg-cta {
            display: block;
            margin-top: 36px;
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 13px; font-weight: 700; letter-spacing: 2px;
            color: var(--white);
            text-decoration: none; text-transform: uppercase;
            padding: 13px 24px;
            border: 1px solid var(--border);
            text-align: center;
            transition: all 0.2s;
        }

        .pkg-cta:hover { border-color: var(--red); color: var(--red); }

        /* ═══════════ HOW IT WORKS ═══════════ */
        .steps-section { padding: 0 48px 100px; }

        .steps-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 1px;
            background: var(--border);
            border: 1px solid var(--border);
        }

        .step-card {
            background: var(--dark);
            padding: 40px 28px;
            position: relative;
            overflow: hidden;
            transition: background 0.25s ease, transform 0.25s ease, box-shadow 0.25s ease;
        }

        .step-card:hover {
            background: var(--dark2);
            transform: translateY(-4px);
            box-shadow: 0 12px 30px rgba(0,0,0,0.08);
        }

        /* PERBAIKAN WARNA ANGKA 01, 02 DST */
        .step-num {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 64px; 
            color: var(--num-color); /* Menggunakan warna abu pekat agar jelas */
            line-height: 1;
            margin-bottom: 20px;
            transition: color 0.3s ease, transform 0.3s ease;
        }

        .step-card:hover .step-num { color: var(--orange); transform: translateX(5px); }

        .step-title {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 20px; font-weight: 700; letter-spacing: 1px;
            color: var(--white);
            text-transform: uppercase;
            margin-bottom: 12px;
        }

        .step-desc { font-size: 13px; color: var(--dim); line-height: 1.7; }

        /* ═══════════ CTA BANNER ═══════════ */
        .cta-section {
            margin: 0 48px 100px;
            position: relative;
            overflow: hidden;
            background: var(--red);
            padding: 72px 60px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 40px;
        }

        .cta-section::before {
            content: 'FITSCAPE';
            position: absolute;
            right: -20px; top: 50%;
            transform: translateY(-50%);
            font-family: 'Bebas Neue', sans-serif;
            font-size: 180px;
            color: rgba(255,255,255,0.1);
            pointer-events: none;
            white-space: nowrap; line-height: 1;
        }

        .cta-text h2 {
            font-family: 'Bebas Neue', sans-serif;
            font-size: clamp(36px, 4vw, 56px);
            letter-spacing: 2px; color: #fff;
            line-height: 1; margin-bottom: 8px;
        }

        .cta-text p { font-size: 14px; color: #fff; }

        .btn-cta-white {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 14px; font-weight: 700; letter-spacing: 2px;
            color: var(--red);
            text-decoration: none; text-transform: uppercase;
            padding: 16px 40px;
            background: #fff;
            white-space: nowrap;
            transition: all 0.2s;
            flex-shrink: 0;
            display: inline-flex; align-items: center; gap: 10px;
        }

        .btn-cta-white:hover { background: var(--dark); color: var(--white); }

        /* ═══════════ INFO GYM ═══════════ */
        #kontak {
            padding: 80px 48px;
            border-top: 1px solid var(--border);
            display: grid;
            grid-template-columns: minmax(0, 1fr) minmax(0, 1fr);
            gap: 60px;
            align-items: start;
        }

        /* Anak grid boleh menyusut, teks panjang (mis. nama Instagram) dipatahkan */
        #kontak > div { min-width: 0; }

        .contact-card > div { min-width: 0; }
        .contact-card > div > div { overflow-wrap: anywhere; }
        
        /* ═══════════ FOOTER ═══════════ */
        footer {
            border-top: 1px solid var(--border);
            padding: 28px 48px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 12px;
        }

        .footer-brand { display: flex; align-items: center; gap: 10px; text-decoration: none; }
        .footer-brand img { width: 28px; height: 28px; border-radius: 4px; object-fit: contain; }

        .footer-brand-text {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 16px; font-weight: 800; letter-spacing: 3px;
            color: var(--white);
        }

        .footer-brand-text span { color: var(--red); }

        footer p {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 11px; letter-spacing: 2px;
            color: var(--dim);
            text-transform: uppercase;
        }

        /* ═══════════ ANIMATIONS ═══════════ */
        .fade-up {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.7s ease, transform 0.7s ease;
        }
        .fade-up.visible { opacity: 1; transform: translateY(0); }

        /* ═══════════ RESPONSIVE ═══════════ */
        @media (max-width: 1024px) {
            .nav-menu { display: none; }
            .btn-nav-login { display: none; }
            .hamburger { display: flex; }
            .tagline-section { grid-template-columns: minmax(0, 1fr); gap: 40px; }
            .tagline-right { border-left: none; border-top: 1px solid var(--border); padding: 32px 0 0; }
            .steps-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); }
        }

        @media (max-width: 768px) {
            nav { padding: 0 20px; }
            .hero-bg { background-position: 68% 30%; }
            .hero-content { padding: 120px 20px 60px; }
            .hero-stats { flex-wrap: wrap; }
            .stat-item { flex: 1; min-width: 120px; padding: 16px 20px; }
            .tagline-section { padding: 60px 20px; }
            .membership-section { padding: 0 20px 60px; }
            .pkg-grid { grid-template-columns: minmax(0, 1fr); }
            .steps-section { padding: 0 20px 60px; }
            .steps-grid { grid-template-columns: minmax(0, 1fr); }
            .cta-section { margin: 0 20px 60px; padding: 48px 28px; flex-direction: column; align-items: flex-start; }
            .cta-section::before { font-size: 100px; }
            .section-header { flex-direction: column; align-items: flex-start; gap: 0; }

            /* Kontak & info gym: satu kolom di HP */
            #kontak {
                grid-template-columns: minmax(0, 1fr);
                padding: 48px 20px;
                gap: 40px;
            }

            footer { padding: 20px; flex-direction: column; text-align: center; }
            footer p { letter-spacing: 1px; }
        }

        @media (max-width: 480px) {
            .hero-h1 { font-size: clamp(46px, 16.5vw, 72px); }
            .hero-sub { font-size: 15px; }
            .hero-btns { flex-direction: column; }
            .btn-hero-red, .btn-hero-ghost { text-align: center; justify-content: center; }

            /* Navbar: kecilkan supaya logo + JOIN NOW + hamburger muat */
            .nav-brand { gap: 8px; }
            .nav-brand img { width: 30px; height: 30px; }
            .nav-brand-text { font-size: 14px; letter-spacing: 2px; }
            .btn-nav-register { font-size: 11px; letter-spacing: 1.5px; padding: 8px 14px; }
            .hamburger { padding: 4px; }

            .section-header { padding: 40px 0 32px; }
            .pkg-card { padding: 36px 24px; }
            .pkg-name { font-size: 36px; }
            .pkg-price { font-size: 44px; }
            .step-card { padding: 32px 24px; }
            .step-num { font-size: 52px; }
            .cta-section { padding: 40px 24px; }
            .btn-cta-white { width: 100%; justify-content: center; padding: 16px 24px; }
        }

        @media (max-width: 360px) {
            nav { padding: 0 14px; }
            .nav-brand img { width: 28px; height: 28px; }
            .nav-brand-text { font-size: 12px; letter-spacing: 1.5px; }
            .btn-nav-register { font-size: 10px; padding: 7px 10px; }
        }
    </style>
</head>

<body>

{{-- ═══════════ NAVBAR ═══════════ --}}
<nav>
    <a href="#beranda" class="nav-brand">
        <img src="{{ asset('images/logo.jpeg') }}" alt="Fitscape">
        <div class="nav-brand-text">FITSCAPE <span>STUDIO</span></div>
    </a>

    {{-- Menu Desktop --}}
    <div class="nav-menu">
        <a href="#beranda">Beranda</a>
        <a href="#membership">Membership</a>
        <a href="#cara-kerja">Cara Kerja</a>
        <a href="#kontak">Kontak</a>
    </div>

    <div class="nav-right">
        <a href="{{ route('login') }}" class="btn-nav-login">Login</a>
        <a href="{{ route('register') }}" class="btn-nav-register">JOIN NOW</a>
        <button class="hamburger" id="hamburger" onclick="toggleMenu()" aria-label="Buka Menu">
            <span></span>
            <span></span>
            <span></span>
        </button>
    </div>
</nav>

{{-- ═══════════ MOBILE MENU ═══════════ --}}
<div class="mobile-menu" id="mobileMenu">
    <a href="#beranda" onclick="closeMenu()"><span class="menu-icon">🏠</span> Beranda</a>
    <a href="#membership" onclick="closeMenu()"><span class="menu-icon">🏋️️</span> Membership</a>
    <a href="#cara-kerja" onclick="closeMenu()"><span class="menu-icon">📋</span> Cara Kerja</a>
    <a href="#kontak" onclick="closeMenu()"><span class="menu-icon">📞</span> Kontak</a>
    <a href="{{ route('login') }}" onclick="closeMenu()"><span class="menu-icon">🔐</span> Masuk</a>
</div>

{{-- ═══════════ HERO ═══════════ --}}
<section class="hero" id="beranda">
    <div class="hero-bg-fallback"></div>
    <div class="hero-bg"></div>
    <div class="hero-accent"></div>

    <div class="hero-content">
        <div class="hero-eyebrow fade-up">
            <div class="hero-eyebrow-line"></div>
            <span>Premium Gym Membership</span>
        </div>

        <h1 class="hero-h1 fade-up" style="transition-delay:0.1s">
            TRAIN HARD.<br><span class="red">STAY STRONG.</span>
        </h1>

        <p class="hero-sub fade-up" style="transition-delay:0.2s">
            Bergabunglah dengan Fitscape Studio dan capai performa terbaik Anda.
            Fasilitas premium, trainer berpengalaman, dan sistem absensi digital modern.
        </p>

        <div class="hero-btns fade-up" style="transition-delay:0.3s">
            <a href="{{ route('register') }}" class="btn-hero-red">
                Daftar Sekarang
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
                    <path d="M3 8h10M9 4l4 4-4 4" stroke="#fff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </a>
            <a href="{{ route('login') }}" class="btn-hero-ghost">Sudah Member?</a>
        </div>
    </div>
</section>

{{-- ═══════════ TAGLINE ═══════════ --}}
<section class="tagline-section fade-up">
    <div class="tagline-left">
        <h2>STRONGER<br><span class="red">EVERY</span><br>DAY</h2>
    </div>
    <div class="tagline-right">
        <div class="tagline-label">Train Your Way</div>
        <p>Program latihan yang disesuaikan dengan target Anda. Dari pemula hingga atlet profesional, Fitscape Studio hadir untuk semua level.</p>
        <p>Dengan sistem QR Code dinamis, absensi Anda tercatat otomatis setiap kunjungan. Aman, cepat, dan anti-manipulasi.</p>
        <a href="#membership" class="tagline-link">Explore Programs →</a>
    </div>
</section>

{{-- ═══════════ MEMBERSHIP ═══════════ --}}
<section class="membership-section" id="membership">
    <div class="section-header fade-up">
        <div>
            <div class="section-label">Membership Architecture</div>
            <div class="section-title">PILIH PAKET<br>ANDA</div>
        </div>
    </div>

    <div class="pkg-grid">
        @php
            $packages = \App\Models\MembershipPackage::where('is_active', true)->orderBy('price')->get();
            $tiers = ['Entry Level', 'Most Adopted', 'Full Protocol'];
        @endphp

        @forelse($packages as $index => $pkg)
        <div class="pkg-card fade-up" style="transition-delay: {{ $index * 0.15 }}s">
            <div class="pkg-tier-label">{{ $tiers[$index] ?? 'Premium' }}</div>
            <div class="pkg-name">{{ strtoupper($pkg->name) }}</div>
            <div class="pkg-desc">{{ $pkg->description }}</div>
            <div class="pkg-divider"></div>
            <div class="pkg-price">{{ number_format($pkg->price / 1000, 0) }}K</div>
            <div class="pkg-duration">
                {{ $pkg->duration_days }} HARI
                <span style="color: var(--dim); margin: 0 6px;">/</span>
                {{ round($pkg->duration_days / 30) }} BULAN
            </div>
            <a href="{{ route('register') }}" class="pkg-cta">Pilih {{ $pkg->name }}</a>
        </div>
        @empty
        <div style="padding: 60px; text-align: center; color: var(--dim); grid-column: 1 / -1;">
            Belum ada paket tersedia.
        </div>
        @endforelse
    </div>
</section>

{{-- ═══════════ HOW IT WORKS ═══════════ --}}
<section class="steps-section" id="cara-kerja">
    <div class="section-header fade-up">
        <div>
            <div class="section-label">Cara Kerja</div>
            <div class="section-title">MULAI DALAM<br>4 LANGKAH</div>
        </div>
    </div>

    <div class="steps-grid">
        <div class="step-card fade-up">
            <div class="step-num">01</div>
            <div class="step-title">Daftar Akun</div>
            <div class="step-desc">Buat akun member dan dapatkan Member ID unik Anda secara otomatis. Proses cepat dan mudah.</div>
        </div>
        <div class="step-card fade-up" style="transition-delay:0.1s">
            <div class="step-num">02</div>
            <div class="step-title">Pilih Paket</div>
            <div class="step-desc">Pilih paket Bronze, Silver, atau Gold sesuai kebutuhan. Konfirmasi oleh admin setelah pembayaran.</div>
        </div>
        <div class="step-card fade-up" style="transition-delay:0.2s">
            <div class="step-num">03</div>
            <div class="step-title">Generate QR</div>
            <div class="step-desc">Buka dashboard dan generate QR Code dinamis TOTP yang berubah otomatis setiap 30 detik.</div>
        </div>
        <div class="step-card fade-up" style="transition-delay:0.3s">
            <div class="step-num">04</div>
            <div class="step-title">Scan & Masuk</div>
            <div class="step-desc">Tunjukkan QR ke petugas untuk di-scan. Absensi tercatat otomatis dan riwayat tersimpan di dashboard.</div>
        </div>
    </div>
</section>

{{-- ═══════════ INFO GYM ═══════════ --}}
<section id="kontak">
    {{-- Kiri: Info Gym --}}
    <div>
        <div style="font-family:'Barlow Condensed',sans-serif; font-size:10px; font-weight:700; letter-spacing:4px; color:var(--red); text-transform:uppercase; margin-bottom:20px;">
            Tentang Kami
        </div>
        <div style="display:flex; align-items:center; gap:14px; margin-bottom:24px;">
            <img src="{{ asset('images/logo.jpeg') }}" alt="Logo" style="width:56px; height:56px; border-radius:10px; object-fit:contain; flex-shrink:0;">
            <div>
                <div style="font-family:'Bebas Neue',sans-serif; font-size:28px; letter-spacing:2px; line-height:1; color:var(--white);">FITSCAPE STUDIO</div>
                <div style="font-size:12px; color:var(--dim); margin-top:2px;">Premium Gym Membership</div>
            </div>
        </div>
        <p style="font-size:13px; color:var(--dim); line-height:1.8; margin-bottom:28px; max-width:380px;">
            Fitscape Studio adalah pusat kebugaran premium yang menghadirkan pengalaman latihan modern dengan sistem absensi digital berbasis QR Code dinamis.
        </p>

        {{-- Jam Operasional --}}
        <div style="background:var(--dark3); border:1px solid var(--border); border-radius:12px; padding:20px; margin-bottom:24px;">
            <div style="font-family:'Barlow Condensed',sans-serif; font-size:10px; font-weight:700; letter-spacing:3px; color:var(--red); text-transform:uppercase; margin-bottom:14px;">
                🕐 Jam Operasional
            </div>
            <div style="display:flex; flex-direction:column; gap:8px;">
                <div style="display:flex; justify-content:space-between; gap:12px; font-size:13px;">
                    <span style="color:var(--dim);">Senin — Jumat</span>
                    <span style="color:var(--white); font-weight:600;">{{ \App\Models\SiteSetting::get('hours_weekday', '05:00 — 23:00') }}</span>
                </div>
                <div style="display:flex; justify-content:space-between; gap:12px; font-size:13px;">
                    <span style="color:var(--dim);">Sabtu</span>
                    <span style="color:var(--white); font-weight:600;">{{ \App\Models\SiteSetting::get('hours_saturday', '06:00 — 22:00') }}</span>
                </div>
                <div style="display:flex; justify-content:space-between; gap:12px; font-size:13px;">
                    <span style="color:var(--dim);">Minggu & Libur</span>
                    <span style="color:var(--white); font-weight:600;">{{ \App\Models\SiteSetting::get('hours_sunday', '06:00 — 21:00') }}</span>
                </div>
            </div>
        </div>

        {{-- Lokasi --}}
        <div style="display:flex; align-items:flex-start; gap:10px; font-size:13px; color:var(--dim); line-height:1.6;">
            <span style="font-size:16px; flex-shrink:0;">📍</span>
            <span>{{ \App\Models\SiteSetting::get('gym_address', 'Jl. Nama Jalan No. XX') }}</span>
        </div>
    </div>

    {{-- Kanan: Kontak & Sosmed --}}
    <div>
        <div style="font-family:'Barlow Condensed',sans-serif; font-size:10px; font-weight:700; letter-spacing:4px; color:var(--red); text-transform:uppercase; margin-bottom:20px;">
            Hubungi Kami
        </div>

        <div style="display:flex; flex-direction:column; gap:12px; margin-bottom:32px;">
           
        {{-- WhatsApp --}}
@php
    // wa.me hanya menerima angka: buang spasi, strip, tanda +, dll.
    $waNumber = preg_replace('/\D/', '', \App\Models\SiteSetting::get('gym_phone', '628XXXXXXXXXX'));
    // Kalau diawali 0 (mis. 0853...), ubah ke kode negara 62
    if (str_starts_with($waNumber, '0')) {
        $waNumber = '62' . substr($waNumber, 1);
    }
@endphp
<a class="contact-card" href="https://wa.me/{{ $waNumber }}" target="_blank" rel="noopener"
   style="display:flex; align-items:center; gap:14px; background:var(--dark3); border:1px solid var(--border); border-radius:12px; padding:14px 18px; text-decoration:none; transition:border-color 0.2s;"
   onmouseover="this.style.borderColor='#25D366'" onmouseout="this.style.borderColor='var(--border)'">
    <span style="font-size:22px; width:28px; text-align:center; color:#25D366; flex-shrink:0;"><i class="fa-brands fa-whatsapp"></i></span>
    <div>
        <div style="font-family:'Barlow Condensed',sans-serif; font-size:10px; font-weight:700; letter-spacing:2px; color:var(--dim); text-transform:uppercase; margin-bottom:2px;">WhatsApp</div>
        <div style="font-size:13px; color:var(--white); font-weight:600;">+{{ \App\Models\SiteSetting::get('gym_phone', '628XXXXXXXXXX') }}</div>
    </div>
</a>

            {{-- Instagram --}}
            <a class="contact-card" href="https://www.instagram.com/fitscape_fitness_studio?utm_source=ig_web_button_share_sheet&exln=ZDNlZDc0MzIxNw==/{{ \App\Models\SiteSetting::get('gym_instagram', 'fitscapestudio') }}" target="_blank"
               style="display:flex; align-items:center; gap:14px; background:var(--dark3); border:1px solid var(--border); border-radius:12px; padding:14px 18px; text-decoration:none; transition:border-color 0.2s;"
               onmouseover="this.style.borderColor='#E1306C'" onmouseout="this.style.borderColor='var(--border)'">
                <span style="font-size:22px; width:28px; text-align:center; color:#E1306C; flex-shrink:0;"><i class="fa-brands fa-instagram"></i></span>
                <div>
                    <div style="font-family:'Barlow Condensed',sans-serif; font-size:10px; font-weight:700; letter-spacing:2px; color:var(--dim); text-transform:uppercase; margin-bottom:2px;">Instagram</div>
                    <div style="font-size:13px; color:var(--white); font-weight:600;">&#64;{{ \App\Models\SiteSetting::get('gym_instagram', 'fitscapestudio') }}</div>
                </div>
            </a>

            {{-- Facebook --}}
            <a class="contact-card" href="{{ \App\Models\SiteSetting::get('gym_facebook', 'https://www.facebook.com/140705662450630?ref=NONE_xav_ig_profile_page_web') }}" target="_blank"
               style="display:flex; align-items:center; gap:14px; background:var(--dark3); border:1px solid var(--border); border-radius:12px; padding:14px 18px; text-decoration:none; transition:border-color 0.2s;"
               onmouseover="this.style.borderColor='#1877F2'" onmouseout="this.style.borderColor='var(--border)'">
                <span style="font-size:22px; width:28px; text-align:center; color:#1877F2; flex-shrink:0;"><i class="fa-brands fa-facebook"></i></span>
                <div>
                    <div style="font-family:'Barlow Condensed',sans-serif; font-size:10px; font-weight:700; letter-spacing:2px; color:var(--dim); text-transform:uppercase; margin-bottom:2px;">Facebook</div>
                    <div style="font-size:13px; color:var(--white); font-weight:600;">Fitscape Studio</div>
                </div>
            </a>

            {{-- Google Maps --}}
            <a class="contact-card" href="{{ \App\Models\SiteSetting::get('gym_maps_url', 'https://maps.google.com') }}" target="_blank"
               style="display:flex; align-items:center; gap:14px; background:var(--dark3); border:1px solid var(--border); border-radius:12px; padding:14px 18px; text-decoration:none; transition:border-color 0.2s;"
               onmouseover="this.style.borderColor='#4285F4'" onmouseout="this.style.borderColor='var(--border)'">
                <span style="font-size:21px; width:28px; text-align:center; color:#4285F4; flex-shrink:0;"><i class="fa-solid fa-map-location-dot"></i></span>
                <div>
                    <div style="font-family:'Barlow Condensed',sans-serif; font-size:10px; font-weight:700; letter-spacing:2px; color:var(--dim); text-transform:uppercase; margin-bottom:2px;">Google Maps</div>
                    <div style="font-size:13px; color:var(--white); font-weight:600;">Lihat Lokasi →</div>
                </div>
            </a>
        </div>

        {{-- Layanan Pengaduan --}}
        <div style="background:rgba(222,67,49,0.05); border:1px solid rgba(222,67,49,0.15); border-radius:12px; padding:16px 18px;">
            <div style="font-family:'Barlow Condensed',sans-serif; font-size:10px; font-weight:700; letter-spacing:2px; color:var(--red); text-transform:uppercase; margin-bottom:8px;">
                ⚠️ Layanan Pengaduan
            </div>
            <p style="font-size:12px; color:var(--dim); line-height:1.6; margin-bottom:6px;">
                Jika ada keluhan atau pertanyaan, hubungi kami melalui WhatsApp di atas.
            </p>
            <p style="font-size:11px; color:var(--dim2);">Respon dalam 1×24 jam pada hari kerja.</p>
        </div>
    </div>
</section>

{{-- ═══════════ FOOTER ═══════════ --}}
<footer>
    <a href="#beranda" class="footer-brand">
        <img src="{{ asset('images/logo.jpeg') }}" alt="Fitscape">
        <div class="footer-brand-text">FITSCAPE <span>STUDIO</span></div>
    </a>
    <p>{{ \App\Models\SiteSetting::get('footer_copyright', '© 2026 Fitscape Studio. All rights reserved.') }}</p>
</footer>

<script>
    // ── Toggle menu ──
    function toggleMenu() {
        const menu = document.getElementById('mobileMenu');
        const btn  = document.getElementById('hamburger');
        const isOpen = menu.classList.contains('open');
        menu.classList.toggle('open');
        btn.classList.toggle('open');
        document.body.style.overflow = isOpen ? '' : 'hidden';
    }

    function closeMenu() {
        const menu = document.getElementById('mobileMenu');
        const btn  = document.getElementById('hamburger');
        menu.classList.remove('open');
        btn.classList.remove('open');
        document.body.style.overflow = '';
    }

    // Tutup saat klik di luar
    document.addEventListener('click', function(e) {
        const menu = document.getElementById('mobileMenu');
        const btn  = document.getElementById('hamburger');
        if (menu.classList.contains('open') && !menu.contains(e.target) && !btn.contains(e.target)) {
            closeMenu();
        }
    });

    // Tutup saat resize ke desktop
    window.addEventListener('resize', function() {
        if (window.innerWidth > 1024) closeMenu();
    });

    // ── Smooth scroll dengan offset navbar ──
    document.querySelectorAll('a[href^="#"]').forEach(function(anchor) {
        anchor.addEventListener('click', function(e) {
            const href = this.getAttribute('href');
            if (href === '#') return;
            const target = document.querySelector(href);
            if (target) {
                e.preventDefault();
                const top = target.getBoundingClientRect().top + window.scrollY - 64;
                window.scrollTo({ top: top, behavior: 'smooth' });
            }
        });
    });

    // ── Fade up observer ──
    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(function(e) {
            if (e.isIntersecting) {
                e.target.classList.add('visible');
                observer.unobserve(e.target);
            }
        });
    }, { threshold: 0.1 });
    document.querySelectorAll('.fade-up').forEach(function(el) { observer.observe(el); });
</script>

</body>
</html>