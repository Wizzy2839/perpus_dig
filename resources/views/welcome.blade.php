<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ \App\Models\Setting::get('library_name', 'Simbok') }} — Sistem Informasi Membaca Buku</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/image/logo.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,600;0,700;1,400;1,600&family=Nunito+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
    <script src="{{ asset('assets/feather.min.js') }}"></script>
    <style>
        *,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
        :root{
            /* LIGHT MODE PRESET */
            --navy: #FFFFFF;           /* Main Background */
            --navy2: #F8FAFC;          /* Card Background */
            --navy3: #F1F5F9;          /* Secondary Card / CTA Background */
            
            --gold: #2563EB;           /* Primary Blue Accent (replaces gold) */
            --gold2: #1E40AF;          /* Darker Blue Accent */
            
            --cream: #1E293B;          /* Main Title Text (dark grey) */
            --text: #334155;           /* Main Body Text */
            --muted: #64748B;          /* Secondary/Muted Text */
            
            --border: #E2E8F0;         /* Subtle Light Borders */
        }
        
        html{scroll-behavior:smooth}
        body{font-family:'Nunito Sans',sans-serif;background:var(--navy);color:var(--text);overflow-x:hidden;line-height:1.65}
        ::-webkit-scrollbar{width:6px}::-webkit-scrollbar-track{background:var(--navy)}::-webkit-scrollbar-thumb{background:var(--muted);border-radius:3px}
        /* icon helpers */
        .ico{display:inline-flex;align-items:center;justify-content:center;flex-shrink:0}
        .ico svg{stroke:currentColor;fill:none;stroke-width:2;stroke-linecap:round;stroke-linejoin:round;display:block}
        .ico-sm svg{width:14px;height:14px} .ico-md svg{width:18px;height:18px} .ico-lg svg{width:24px;height:24px} .ico-xl svg{width:32px;height:32px}
        /* nav (Floating Pill Redesign) */
        nav{position:fixed;top:20px;left:50%;transform:translateX(-50%);width:calc(100% - 40px);max-width:1100px;z-index:100;padding:0.4rem 0.4rem 0.4rem 1.2rem;height:70px;display:flex;align-items:center;justify-content:space-between;background:rgba(255,255,255,0.7);backdrop-filter:blur(24px);-webkit-backdrop-filter:blur(24px);border:1px solid rgba(255,255,255,0.6);border-radius:100px;box-shadow:0 10px 40px -10px rgba(15,23,42,0.1), 0 0 0 1px rgba(226,232,240,0.5);transition:all .4s cubic-bezier(0.16,1,0.3,1)}
        nav:hover{background:rgba(255,255,255,0.9);box-shadow:0 15px 40px -10px rgba(15,23,42,0.12), 0 0 0 1px rgba(226,232,240,0.8);transform:translateX(-50%) translateY(-2px)}
        .nav-logo{display:flex;align-items:center;gap:12px;font-family:'Cormorant Garamond',serif;font-size:1.6rem;font-weight:800;color:var(--cream);text-decoration:none;letter-spacing:-.01em}
        .nav-logo img{box-shadow:0 4px 12px rgba(37,99,235,0.15);background:#fff;padding:2px}
        .nav-logo span{color:var(--gold)}
        .nav-links{display:flex;align-items:center;gap:.3rem;background:rgba(255,255,255,0.5);padding:.35rem;border-radius:100px;border:1px solid rgba(226,232,240,0.6)}
        .nav-links a{padding:.5rem 1.2rem;font-size:.875rem;font-weight:700;text-decoration:none;border-radius:100px;transition:all .3s cubic-bezier(0.16,1,0.3,1);letter-spacing:.02em;display:inline-flex;align-items:center;gap:8px}
        .btn-ghost{color:var(--muted);border:1px solid transparent}
        .btn-ghost:hover{color:var(--gold);background:#ffffff;box-shadow:0 4px 12px rgba(0,0,0,0.05);transform:translateY(-1px)}
        .btn-primary{color:#fff;background:linear-gradient(135deg,var(--gold),var(--gold2));border:none;font-weight:700;box-shadow:0 4px 12px rgba(37,99,235,0.25)}
        .btn-primary:hover{background:linear-gradient(135deg,var(--gold2),#1e3a8a);transform:translateY(-2px);box-shadow:0 8px 16px rgba(37,99,235,0.35)}
        /* hero */
        .hero{min-height:100vh;display:flex;align-items:center;justify-content:center;padding:8rem 2rem 5rem;position:relative;overflow:hidden;background:radial-gradient(ellipse at top right, #f8fafc 0%, #ffffff 100%)}
        .hero-bg{position:absolute;inset:0;pointer-events:none;background:radial-gradient(circle at 80% 20%, rgba(37,99,235,0.04) 0%, transparent 40%), radial-gradient(circle at 10% 80%, rgba(37,99,235,0.03) 0%, transparent 40%)}
        .hero-grid{position:absolute;inset:0;pointer-events:none;background-image:linear-gradient(var(--border) 1px,transparent 1px),linear-gradient(90deg,var(--border) 1px,transparent 1px);background-size:60px 60px;mask-image:radial-gradient(ellipse 90% 70% at 50% 50%,black 30%,transparent 80%);opacity:0.6}
        .hero-inner{max-width:1100px;width:100%;display:grid;grid-template-columns:1fr 1fr;gap:4rem;align-items:center;position:relative}
        .hero-badge{display:inline-flex;align-items:center;gap:8px;padding:6px 16px;background:#EFF6FF;border:1px solid #DBEAFE;border-radius:100px;font-size:.78rem;font-weight:800;color:var(--gold);letter-spacing:.06em;text-transform:uppercase;margin-bottom:1.4rem;animation:fadeUp .6s ease both}
        .badge-dot{width:6px;height:6px;border-radius:50%;background:var(--gold);animation:pulse 2s infinite;flex-shrink:0}
        @keyframes pulse{0%,100%{opacity:1;transform:scale(1)}50%{opacity:.5;transform:scale(1.3)}}
        .hero-title{font-family:'Cormorant Garamond',serif;font-size:clamp(2.6rem,4.5vw,3.8rem);font-weight:800;line-height:1.15;color:var(--cream);margin-bottom:1.2rem;animation:fadeUp .6s .1s ease both}
        .hero-title em{font-style:italic;color:var(--gold)}
        .hero-desc{font-size:1.1rem;font-weight:400;color:var(--muted);line-height:1.75;margin-bottom:2.4rem;max-width:480px;animation:fadeUp .6s .2s ease both}
        .hero-cta{display:flex;flex-wrap:wrap;gap:.9rem;animation:fadeUp .6s .3s ease both}
        .cta-main{display:inline-flex;align-items:center;gap:8px;padding:.85rem 2rem;background:linear-gradient(135deg,var(--gold),var(--gold2));color:#fff;font-weight:700;font-size:.95rem;border-radius:8px;text-decoration:none;transition:all .25s;border:none;cursor:pointer;letter-spacing:.02em;box-shadow:0 8px 24px rgba(37,99,235,0.25)}
        .cta-main:hover{transform:translateY(-2px);box-shadow:0 12px 28px rgba(37,99,235,0.35)}
        .cta-secondary{display:inline-flex;align-items:center;gap:8px;padding:.85rem 2rem;background:#fff;color:var(--text);font-weight:700;font-size:.95rem;border-radius:8px;text-decoration:none;border:1px solid #CBD5E1;transition:all .25s;cursor:pointer;box-shadow:0 2px 8px rgba(0,0,0,0.04)}
        .cta-secondary:hover{background:var(--navy2);border-color:var(--muted);transform:translateY(-1px)}
        
        /* hero visual */
        .hero-visual{position:relative;height:520px;animation:fadeUp .8s .2s ease both}
        .book-stack{position:absolute;left:50%;top:50%;transform:translate(-50%,-50%)}
        .floating-card{position:absolute;background:#fff;border:1px solid var(--border);border-radius:14px;padding:1.2rem 1.4rem;box-shadow:0 12px 32px rgba(0,0,0,0.06);z-index:10}
        .fc-stats{top:10px;right:-30px;min-width:160px;animation:float 4s ease-in-out infinite}
        .fc-genre{bottom:30px;left:-70px;min-width:180px;animation:float 4s 1.5s ease-in-out infinite}
        .fc-members{top:200px;right:-50px;min-width:150px;animation:float 5s .8s ease-in-out infinite}
        @keyframes float{0%,100%{transform:translateY(0)}50%{transform:translateY(-12px)}}
        .card-label{font-size:.75rem;font-weight:800;color:var(--muted);text-transform:uppercase;letter-spacing:.06em;margin-bottom:6px;display:flex;align-items:center;gap:6px}
        .card-value{font-family:'Cormorant Garamond',serif;font-size:1.8rem;font-weight:700;color:var(--cream);line-height:1}
        .card-sub{font-size:.8rem;color:var(--gold);font-weight:600;margin-top:4px}
        .genre-list{display:flex;flex-wrap:wrap;gap:6px;margin-top:8px}
        .genre-tag{padding:4px 12px;background:#EFF6FF;border:1px solid #BFDBFE;border-radius:20px;font-size:.75rem;font-weight:700;color:var(--gold2)}
        
        /* Book Center Mockup */
        .book-center{width:220px;height:300px;background:#ffffff;border:1px solid var(--border);border-radius:6px 18px 18px 6px;box-shadow:-10px 0 0 #f1f5f9, -20px 0 0 #e2e8f0, 20px 30px 60px rgba(15, 23, 42, 0.12);display:flex;flex-direction:column;align-items:center;justify-content:center;gap:14px;position:relative;animation:float 5s .4s ease-in-out infinite;z-index:5}
        .book-center::before{content:'';position:absolute;left:0;top:-1px;bottom:-1px;width:18px;background:linear-gradient(135deg,var(--gold),var(--gold2));border-radius:6px 0 0 6px;border-right:1px solid rgba(0,0,0,0.1)}
        .book-center::after{content:'';position:absolute;left:18px;top:0;bottom:0;width:3px;background:rgba(0,0,0,0.04)}
        .book-center-icon{color:var(--gold);margin-bottom:8px}
        .book-title-label{font-family:'Cormorant Garamond',serif;font-size:1.3rem;font-weight:700;color:var(--cream);text-align:center;padding:0 1.5rem;line-height:1.3}
        .book-author{font-size:.8rem;color:var(--muted);font-weight:600;text-transform:uppercase;letter-spacing:0.05em}

        /* stats bar */
        .stats-bar{background:#ffffff;border-top:1px solid var(--border);border-bottom:1px solid var(--border);padding:3rem 2rem;position:relative;z-index:2;box-shadow:0 4px 6px -1px rgba(0,0,0,0.02)}
        .stats-inner{max-width:1100px;margin:0 auto;display:grid;grid-template-columns:repeat(4,1fr);gap:2rem;text-align:center}
        .stat-item{position:relative}
        .stat-item+.stat-item::before{content:'';position:absolute;left:-1rem;top:20%;bottom:20%;width:1px;background:var(--border)}
        .stat-icon{display:flex;justify-content:center;margin-bottom:12px;color:var(--gold)}
        .stat-num{font-family:'Cormorant Garamond',serif;font-size:3rem;font-weight:700;color:var(--cream);display:block;line-height:1;margin-bottom:4px}
        .stat-label{font-size:.85rem;color:var(--muted);font-weight:700;text-transform:uppercase;letter-spacing:0.05em}
        
        /* section */
        .section{padding:6rem 2rem;background:var(--navy)}
        .section#fitur{background:linear-gradient(180deg, #f8fafc 0%, #ffffff 100%)}
        .section-inner{max-width:1100px;margin:0 auto}
        .section-tag{display:inline-block;padding:6px 16px;background:#EEF2FF;border:1px solid #C7D2FE;border-radius:100px;font-size:.78rem;font-weight:800;color:#4338CA;letter-spacing:.08em;text-transform:uppercase;margin-bottom:1rem}
        .section-title{font-family:'Cormorant Garamond',serif;font-size:clamp(2rem,3.5vw,2.8rem);font-weight:800;color:var(--cream);margin-bottom:1rem;line-height:1.2}
        .section-desc{font-size:1.05rem;color:var(--muted);max-width:560px;font-weight:400;line-height:1.7}
        
        /* features */
        .features-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:2rem;margin-top:4rem}
        .feature-card{background:#ffffff;border:1px solid var(--border);border-radius:16px;padding:2rem;transition:all .3s;cursor:default;position:relative;overflow:hidden;box-shadow:0 4px 6px -1px rgba(0,0,0,0.03), 0 2px 4px -1px rgba(0,0,0,0.02)}
        .feature-card::before{content:'';position:absolute;top:0;left:0;right:0;height:3px;background:linear-gradient(90deg,var(--gold),var(--gold2));opacity:0;transition:opacity .3s}
        .feature-card:hover{border-color:#cbd5e1;transform:translateY(-6px);box-shadow:0 20px 25px -5px rgba(0,0,0,0.05), 0 10px 10px -5px rgba(0,0,0,0.02)}
        .feature-card:hover::before{opacity:1}
        .feature-icon{width:56px;height:56px;border-radius:14px;background:#F0F9FF;border:1px solid #BAE6FD;display:flex;align-items:center;justify-content:center;color:#0284C7;margin-bottom:1.5rem}
        .feature-title{font-family:'Cormorant Garamond',serif;font-size:1.35rem;font-weight:700;color:var(--cream);margin-bottom:.6rem}
        .feature-desc{font-size:.95rem;color:var(--text);line-height:1.6}
        
        /* catalog */
        .catalog-section{background:#ffffff;border-top:1px solid var(--border)}
        .catalog-header{display:flex;justify-content:space-between;align-items:flex-end;margin-bottom:3rem;flex-wrap:wrap;gap:1.5rem}
        .view-all{display:inline-flex;align-items:center;gap:8px;color:var(--gold);font-size:.9rem;font-weight:700;text-decoration:none;border-bottom:2px solid transparent;transition:all .2s;padding-bottom:2px}
        .view-all:hover{border-color:var(--gold);transform:translateX(4px)}
        .books-grid{display:grid;grid-template-columns:repeat(5,1fr);gap:1.8rem}
        .book-card{background:#ffffff;border:1px solid var(--border);border-radius:12px;overflow:hidden;transition:all .3s;cursor:pointer;box-shadow:0 4px 6px rgba(0,0,0,0.02)}
        .book-card:hover{transform:translateY(-8px);border-color:#cbd5e1;box-shadow:0 20px 25px -5px rgba(0,0,0,0.08), 0 10px 10px -5px rgba(0,0,0,0.04)}
        .book-cover{width:100%;aspect-ratio:2/3;display:flex;align-items:center;justify-content:center;position:relative}
        .book-cover-icon{color:rgba(255,255,255,.9)}
        /* Lighter, friendlier gradient colors for light mode covers */
        .bc1{background:linear-gradient(135deg,#3B82F6,#1D4ED8)}
        .bc2{background:linear-gradient(135deg,#F59E0B,#D97706)}
        .bc3{background:linear-gradient(135deg,#10B981,#047857)}
        .bc4{background:linear-gradient(135deg,#8B5CF6,#6D28D9)}
        .bc5{background:linear-gradient(135deg,#EC4899,#BE185D)}
        .book-badge{position:absolute;top:10px;right:10px;padding:4px 10px;background:#ffffff;color:var(--cream);font-size:.7rem;font-weight:800;border-radius:6px;text-transform:uppercase;letter-spacing:.05em;box-shadow:0 2px 4px rgba(0,0,0,0.1)}
        .book-info{padding:1.2rem}
        .book-category{font-size:.7rem;font-weight:800;color:var(--gold);text-transform:uppercase;letter-spacing:.06em;margin-bottom:6px}
        .book-name{font-family:'Cormorant Garamond',serif;font-size:1.1rem;font-weight:700;color:var(--cream);line-height:1.2;margin-bottom:4px}
        .book-writer{font-size:.8rem;color:var(--muted);font-weight:600}
        .book-avail{display:flex;align-items:center;gap:6px;margin-top:12px;font-size:.75rem;font-weight:700}
        .dot-avail{width:8px;height:8px;border-radius:50%;flex-shrink:0}
        .avail{color:#16A34A}.avail .dot-avail{background:#22C55E;box-shadow:0 0 0 2px #DCFCE7}
        .unavail{color:#DC2626}.unavail .dot-avail{background:#EF4444;box-shadow:0 0 0 2px #FEE2E2}
        
        /* cta band */
        .cta-band{background:linear-gradient(135deg, #1E293B, #0F172A);border-top:1px solid var(--border);border-bottom:1px solid var(--border);padding:6rem 2rem;text-align:center;position:relative;overflow:hidden}
        .cta-band::before{content:'';position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);width:600px;height:400px;background:radial-gradient(ellipse,rgba(37,99,235,.15) 0%,transparent 70%);pointer-events:none}
        .cta-band-title{font-family:'Cormorant Garamond',serif;font-size:clamp(2rem,3.5vw,3.2rem);font-weight:700;color:#ffffff;margin-bottom:1rem}
        .cta-band-desc{font-size:1.1rem;color:#94a3b8;margin-bottom:2.5rem;max-width:540px;margin-left:auto;margin-right:auto;line-height:1.7}
        .cta-band-btns{display:flex;justify-content:center;gap:1.2rem;flex-wrap:wrap}
        
        /* Modifying the secondary button specifically for dark section */
        .cta-band .cta-secondary { background:rgba(255,255,255,0.1); border-color:rgba(255,255,255,0.2); color:#fff; }
        .cta-band .cta-secondary:hover { background:rgba(255,255,255,0.15); border-color:rgba(255,255,255,0.3); }

        /* footer */
        footer{background:#F8FAFC;border-top:1px solid var(--border);padding:4rem 2rem 2rem}
        .footer-inner{max-width:1100px;margin:0 auto}
        .footer-top{display:grid;grid-template-columns:2.5fr 1fr 1fr 1fr;gap:3rem;margin-bottom:3.5rem}
        .footer-logo{display:flex;align-items:center;gap:12px;margin-bottom:1.2rem}
        .footer-logo-icon{width:36px;height:36px;border-radius:8px;background:linear-gradient(135deg,var(--gold),var(--gold2));display:flex;align-items:center;justify-content:center;color:#ffffff}
        .footer-brand-name{font-family:'Cormorant Garamond',serif;font-size:1.35rem;font-weight:700;color:var(--cream)}
        .footer-brand-desc{font-size:.95rem;color:var(--muted);line-height:1.7;max-width:320px}
        .footer-col-title{font-size:.85rem;font-weight:800;color:var(--cream);text-transform:uppercase;letter-spacing:.08em;margin-bottom:1.2rem}
        .footer-links{list-style:none}
        .footer-links li{margin-bottom:.8rem}
        .footer-links a{text-decoration:none;color:var(--muted);font-size:.9rem;font-weight:600;transition:color .2s;display:inline-flex;align-items:center;gap:8px}
        .footer-links a:hover{color:var(--gold)}
        .footer-bottom{border-top:1px solid var(--border);padding-top:2rem;display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:1rem}
        .footer-copy{font-size:.85rem;color:var(--muted);font-weight:600}
        .footer-made{font-size:.85rem;color:var(--muted);font-weight:600;display:inline-flex;align-items:center;gap:6px}
        .heart-icon{color:#EF4444}
        
        /* animations */
        @keyframes fadeUp{from{opacity:0;transform:translateY(24px)}to{opacity:1;transform:translateY(0)}}
        .reveal{opacity:0;transform:translateY(28px);transition:opacity .65s ease,transform .65s ease}
        .reveal.visible{opacity:1;transform:translateY(0)}
        
        /* responsive */
        @media(max-width:960px){
            .hero-inner{grid-template-columns:1fr;gap:3rem;text-align:center}
            .hero-desc{margin-left:auto;margin-right:auto}
            .hero-cta{justify-content:center}
            .hero-visual{height:400px;order:-1}
            .book-center{width:180px;height:250px}
            .fc-stats{right:10%} .fc-genre{left:10%} .fc-members{right:20%}
            .features-grid{grid-template-columns:repeat(2,1fr)}
            .books-grid{grid-template-columns:repeat(3,1fr)}
            .footer-top{grid-template-columns:1fr 1fr;gap:2.5rem}
            .stats-inner{grid-template-columns:repeat(2,1fr);gap:2.5rem}
            .stat-item+.stat-item::before{display:none}
        }
        @media(max-width:600px){
            nav{top:12px;width:calc(100% - 24px);height:60px;padding:0.3rem 0.3rem 0.3rem 1rem}
            .nav-logo{font-size:1.3rem;gap:8px}
            .nav-logo img{width:28px !important;height:28px !important}
            .nav-links{gap:0.2rem;padding:0.25rem}
            .nav-links a{padding:0.4rem 0.8rem;font-size:0.8rem}
            .hero{padding:7rem 1.2rem 4rem}
            .section{padding:5rem 1.2rem}
            .features-grid{grid-template-columns:1fr}
            .books-grid{grid-template-columns:repeat(2,1fr)}
            .footer-top{grid-template-columns:1fr;gap:2.5rem}
            .stats-inner{grid-template-columns:1fr 1fr;gap:2rem}
            .hero-visual{display:none}
        }
    </style>
</head>
<body>

<!-- NAV -->
<nav id="navbar">
    <a href="/" class="nav-logo">
        <img src="{{ asset('assets/image/logo.png') }}" alt="Logo Simbok" style="width:36px;height:36px;object-fit:contain;border-radius:8px;flex-shrink:0;">
        <div>{{ \App\Models\Setting::get('library_name', 'Simbok') }} <span>{{ \App\Models\Setting::get('school_name', 'PGRI') }}</span></div>
    </a>
    <div class="nav-links">
        @if (Route::has('login'))
            @auth
                <a href="{{ url('/dashboard') }}" class="btn-ghost">
                    <i data-feather="grid" style="width:14px;height:14px;stroke:currentColor;fill:none;stroke-width:2"></i> Dashboard
                </a>
            @else
                <a href="{{ route('login') }}" class="btn-ghost">
                    <i data-feather="log-in" style="width:14px;height:14px;stroke:currentColor;fill:none;stroke-width:2"></i> Masuk
                </a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="btn-primary">
                        <i data-feather="user-plus" style="width:14px;height:14px;stroke:currentColor;fill:none;stroke-width:2"></i> Daftar Sekarang
                    </a>
                @endif
            @endauth
        @endif
    </div>
</nav>

<!-- HERO -->
<section class="hero">
    <div class="hero-bg"></div>
    <div class="hero-grid"></div>
    <div class="hero-inner">
        <div>
            <div class="hero-badge">
                <span class="badge-dot"></span>
                Sistem Informasi Membaca Buku
            </div>
            <h1 class="hero-title">Temukan Ilmu,<br><em>Tanpa Batas</em><br>Ruang &amp; Waktu</h1>
            <p class="hero-desc">Akses ribuan koleksi buku, jurnal, dan referensi akademik sekolah secara digital. Mudah, cepat, dan tersedia 24 jam untuk seluruh sivitas sekolah.</p>
            <div class="hero-cta">
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="cta-main">
                        <i data-feather="book" style="width:14px;height:14px;stroke:currentColor;fill:none;stroke-width:2"></i> Mulai Membaca
                    </a>
                @endif
                <a href="#katalog" class="cta-secondary">
                    Lihat Katalog <i data-feather="arrow-right" style="width:14px;height:14px;stroke:currentColor;fill:none;stroke-width:2"></i>
                </a>
            </div>
        </div>
        <div class="hero-visual">
            <div class="book-stack">
                <div class="floating-card fc-stats">
                    <div class="card-label"><i data-feather="layers" style="width:12px;height:12px;stroke:currentColor;fill:none;stroke-width:2"></i> Total Koleksi</div>
                    <div class="card-value">4.200+</div>
                    <div class="card-sub">Judul buku tersedia</div>
                </div>
                <div class="book-center" style="position:relative;left:-50px;top:40px;">
                    <i data-feather="book-open" class="book-center-icon" style="width:32px;height:32px;stroke:currentColor;fill:none;stroke-width:1.5"></i>
                    <div class="book-title-label">Koleksi Digital Sekolah</div>
                    <div class="book-author">Perpustakaan Terpadu</div>
                </div>
                <div class="floating-card fc-genre">
                    <div class="card-label"><i data-feather="tag" style="width:12px;height:12px;stroke:currentColor;fill:none;stroke-width:2"></i> Kategori Populer</div>
                    <div class="genre-list">
                        <span class="genre-tag">IPA</span>
                        <span class="genre-tag">IPS</span>
                        <span class="genre-tag">Sastra</span>
                        <span class="genre-tag">Sains</span>
                    </div>
                </div>
                <div class="floating-card fc-members">
                    <div class="card-label"><i data-feather="users" style="width:12px;height:12px;stroke:currentColor;fill:none;stroke-width:2"></i> Peminjam Aktif</div>
                    <div class="card-value" style="font-size:1.3rem">320</div>
                    <div class="card-sub">Siswa bulan ini</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- STATS -->
<div class="stats-bar reveal">
    <div class="stats-inner">
        <div class="stat-item">
            <div class="stat-icon"><i data-feather="book" style="width:18px;height:18px;stroke:currentColor;fill:none;stroke-width:2"></i></div>
            <span class="stat-num" data-target="4200">0</span>
            <div class="stat-label">Koleksi Buku &amp; Jurnal</div>
        </div>
        <div class="stat-item">
            <div class="stat-icon"><i data-feather="users" style="width:18px;height:18px;stroke:currentColor;fill:none;stroke-width:2"></i></div>
            <span class="stat-num" data-target="1850">0</span>
            <div class="stat-label">Anggota Terdaftar</div>
        </div>
        <div class="stat-item">
            <div class="stat-icon"><i data-feather="trending-up" style="width:18px;height:18px;stroke:currentColor;fill:none;stroke-width:2"></i></div>
            <span class="stat-num" data-target="320">0</span>
            <div class="stat-label">Peminjam Aktif Bulan Ini</div>
        </div>
        <div class="stat-item">
            <div class="stat-icon"><i data-feather="award" style="width:18px;height:18px;stroke:currentColor;fill:none;stroke-width:2"></i></div>
            <span class="stat-num" data-target="98">0</span>
            <div class="stat-label">% Tingkat Kepuasan</div>
        </div>
    </div>
</div>

<!-- FEATURES -->
<section class="section" id="fitur">
    <div class="section-inner">
        <div class="reveal">
            <span class="section-tag">Fitur Utama</span>
            <h2 class="section-title">Semua yang Kamu Butuhkan<br>dalam Satu Platform</h2>
            <p class="section-desc">Dirancang khusus untuk mendukung kegiatan belajar-mengajar di lingkungan sekolah secara efisien.</p>
        </div>
        <div class="features-grid">
            <div class="feature-card reveal">
                <div class="feature-icon"><i data-feather="search" style="width:24px;height:24px;stroke:currentColor;fill:none;stroke-width:1.75"></i></div>
                <div class="feature-title">Pencarian Cerdas</div>
                <p class="feature-desc">Temukan buku berdasarkan judul, pengarang, kategori, atau ISBN dengan hasil instan dan akurat.</p>
            </div>
            <div class="feature-card reveal">
                <div class="feature-icon"><i data-feather="smartphone" style="width:24px;height:24px;stroke:currentColor;fill:none;stroke-width:1.75"></i></div>
                <div class="feature-title">Akses Multi-Perangkat</div>
                <p class="feature-desc">Baca dan pinjam buku kapan saja dari smartphone, tablet, maupun komputer sekolah.</p>
            </div>
            <div class="feature-card reveal">
                <div class="feature-icon"><i data-feather="bell" style="width:24px;height:24px;stroke:currentColor;fill:none;stroke-width:1.75"></i></div>
                <div class="feature-title">Notifikasi Otomatis</div>
                <p class="feature-desc">Pengingat jatuh tempo peminjaman dikirim otomatis agar tidak ada denda yang terlupakan.</p>
            </div>
            <div class="feature-card reveal">
                <div class="feature-icon"><i data-feather="bar-chart-2" style="width:24px;height:24px;stroke:currentColor;fill:none;stroke-width:1.75"></i></div>
                <div class="feature-title">Riwayat &amp; Statistik</div>
                <p class="feature-desc">Pantau histori bacaan dan rekap peminjaman siswa secara real-time oleh guru maupun pustakawan.</p>
            </div>
            <div class="feature-card reveal">
                <div class="feature-icon"><i data-feather="shield" style="width:24px;height:24px;stroke:currentColor;fill:none;stroke-width:1.75"></i></div>
                <div class="feature-title">Akses Aman &amp; Terkelola</div>
                <p class="feature-desc">Sistem login berbasis akun sekolah dengan manajemen peran: siswa, guru, dan admin perpustakaan.</p>
            </div>
            <div class="feature-card reveal">
                <div class="feature-icon"><i data-feather="refresh-cw" style="width:24px;height:24px;stroke:currentColor;fill:none;stroke-width:1.75"></i></div>
                <div class="feature-title">Peminjaman Digital</div>
                <p class="feature-desc">Proses peminjaman dan pengembalian buku langsung dari aplikasi tanpa perlu antre di perpustakaan.</p>
            </div>
        </div>
    </div>
</section>

<!-- CATALOG -->
<section class="section catalog-section" id="katalog">
    <div class="section-inner">
        <div class="catalog-header reveal">
            <div>
                <span class="section-tag">Katalog</span>
                <h2 class="section-title">Koleksi Unggulan</h2>
            </div>
            <a href="{{ Route::has('login') ? route('login') : '#' }}" class="view-all">
                Lihat Semua Buku <i data-feather="arrow-right" style="width:14px;height:14px;stroke:currentColor;fill:none;stroke-width:2"></i>
            </a>
        </div>

        @php $coverColors = ['bc1','bc2','bc3','bc4','bc5']; @endphp

        @if($featuredBooks->count() > 0)
        <div class="books-grid reveal">
            @foreach($featuredBooks as $i => $book)
            <div class="book-card">
                <div class="book-cover {{ $coverColors[$i % 5] }}">
                    @if($book->cover)
                        <img src="{{ Storage::url($book->cover) }}"
                             alt="{{ $book->title }}"
                             style="width:100%;height:100%;object-fit:cover;display:block;">
                    @else
                        <i data-feather="book" class="book-cover-icon" style="width:40px;height:40px;stroke:currentColor;fill:none;stroke-width:1.5"></i>
                    @endif
                    @if($loop->first)
                        <span class="book-badge">Terbaru</span>
                    @elseif($book->availableStock() == 0)
                        <span class="book-badge" style="background:#FEE2E2;color:#DC2626;">Habis</span>
                    @endif
                </div>
                <div class="book-info">
                    <div class="book-category">{{ $book->category->name ?? 'Umum' }}</div>
                    <div class="book-name" title="{{ $book->title }}">{{ Str::limit($book->title, 40) }}</div>
                    <div class="book-writer">{{ $book->author }}</div>
                    @if($book->isAvailable())
                        <div class="book-avail avail"><span class="dot-avail"></span> Tersedia ({{ $book->availableStock() }})</div>
                    @else
                        <div class="book-avail unavail"><span class="dot-avail"></span> Dipinjam Habis</div>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        @else
        {{-- Fallback: tampilkan dummy jika database masih kosong --}}
        <div class="books-grid reveal">
            <div class="book-card">
                <div class="book-cover bc1">
                    <i data-feather="book" class="book-cover-icon" style="width:36px;height:36px;stroke:currentColor;fill:none;stroke-width:1.5"></i>
                    <span class="book-badge">Contoh</span>
                </div>
                <div class="book-info">
                    <div class="book-category">Matematika</div>
                    <div class="book-name">Kalkulus Lanjutan XII</div>
                    <div class="book-writer">Dr. Budi Santoso</div>
                    <div class="book-avail avail"><span class="dot-avail"></span> Tersedia</div>
                </div>
            </div>
            <div class="book-card">
                <div class="book-cover bc2">
                    <i data-feather="book" class="book-cover-icon" style="width:36px;height:36px;stroke:currentColor;fill:none;stroke-width:1.5"></i>
                </div>
                <div class="book-info">
                    <div class="book-category">Sastra</div>
                    <div class="book-name">Laskar Pelangi</div>
                    <div class="book-writer">Andrea Hirata</div>
                    <div class="book-avail unavail"><span class="dot-avail"></span> Dipinjam</div>
                </div>
            </div>
            <div class="book-card">
                <div class="book-cover bc3">
                    <i data-feather="book" class="book-cover-icon" style="width:36px;height:36px;stroke:currentColor;fill:none;stroke-width:1.5"></i>
                </div>
                <div class="book-info">
                    <div class="book-category">Biologi</div>
                    <div class="book-name">Biologi Sel &amp; Genetika</div>
                    <div class="book-writer">Prof. Siti Rahayu</div>
                    <div class="book-avail avail"><span class="dot-avail"></span> Tersedia</div>
                </div>
            </div>
            <div class="book-card">
                <div class="book-cover bc4">
                    <i data-feather="book" class="book-cover-icon" style="width:36px;height:36px;stroke:currentColor;fill:none;stroke-width:1.5"></i>
                </div>
                <div class="book-info">
                    <div class="book-category">Sejarah</div>
                    <div class="book-name">Sejarah Indonesia Modern</div>
                    <div class="book-writer">M. Hatta Rajasa</div>
                    <div class="book-avail avail"><span class="dot-avail"></span> Tersedia</div>
                </div>
            </div>
            <div class="book-card">
                <div class="book-cover bc5">
                    <i data-feather="book" class="book-cover-icon" style="width:36px;height:36px;stroke:currentColor;fill:none;stroke-width:1.5"></i>
                </div>
                <div class="book-info">
                    <div class="book-category">Fisika</div>
                    <div class="book-name">Mekanika Kuantum Dasar</div>
                    <div class="book-writer">Dr. Andi Wijaya</div>
                    <div class="book-avail avail"><span class="dot-avail"></span> Tersedia</div>
                </div>
            </div>
        </div>
        @endif
    </div>
</section>

<!-- CTA BAND -->
<section class="cta-band">
    <div style="position:relative;z-index:1">
        <h2 class="cta-band-title">Siap Mulai Membaca?</h2>
        <p class="cta-band-desc">Bergabung bersama ribuan siswa yang sudah memanfaatkan perpustakaan digital sekolah untuk belajar lebih efektif.</p>
        <div class="cta-band-btns">
            @if (Route::has('register'))
                <a href="{{ route('register') }}" class="cta-main">
                    <i data-feather="user-plus" style="width:14px;height:14px;stroke:currentColor;fill:none;stroke-width:2"></i> Daftar Gratis Sekarang
                </a>
            @endif
            @if (Route::has('login'))
                <a href="{{ route('login') }}" class="cta-secondary">
                    Sudah punya akun? Masuk <i data-feather="arrow-right" style="width:14px;height:14px;stroke:currentColor;fill:none;stroke-width:2"></i>
                </a>
            @endif
        </div>
    </div>
</section>

<!-- FOOTER -->
<footer>
    <div class="footer-inner">
        <div class="footer-top">
            <div>
                <div class="footer-logo">
                    <img src="{{ asset('assets/image/logo.png') }}" alt="Logo Simbok" style="width:36px;height:36px;object-fit:contain;">
                    <div class="footer-brand-name">{{ \App\Models\Setting::get('library_name', 'Simbok') }}</div>
                </div>
                <p class="footer-brand-desc">{{ \App\Models\Setting::get('school_name', 'SMK PGRI 2 Ponorogo') }} - Platform perpustakaan digital terpadu untuk mendukung ekosistem belajar yang modern.</p>
            </div>
            <div>
                <div class="footer-col-title">Layanan</div>
                <ul class="footer-links">
                    <li><a href="#"><i data-feather="book" style="width:13px;height:13px;stroke:currentColor;fill:none;stroke-width:2"></i> Katalog Buku</a></li>
                    <li><a href="#"><i data-feather="refresh-cw" style="width:13px;height:13px;stroke:currentColor;fill:none;stroke-width:2"></i> Peminjaman</a></li>
                    <li><a href="#"><i data-feather="file-text" style="width:13px;height:13px;stroke:currentColor;fill:none;stroke-width:2"></i> E-Referensi</a></li>
                    <li><a href="#"><i data-feather="clipboard" style="width:13px;height:13px;stroke:currentColor;fill:none;stroke-width:2"></i> Jurnal Ilmiah</a></li>
                </ul>
            </div>
            <div>
                <div class="footer-col-title">Pengguna</div>
                <ul class="footer-links">
                    <li><a href="#"><i data-feather="user" style="width:13px;height:13px;stroke:currentColor;fill:none;stroke-width:2"></i> Siswa</a></li>
                    <li><a href="#"><i data-feather="users" style="width:13px;height:13px;stroke:currentColor;fill:none;stroke-width:2"></i> Guru &amp; Staf</a></li>
                    <li><a href="#"><i data-feather="settings" style="width:13px;height:13px;stroke:currentColor;fill:none;stroke-width:2"></i> Administrator</a></li>
                    <li><a href="#"><i data-feather="archive" style="width:13px;height:13px;stroke:currentColor;fill:none;stroke-width:2"></i> Pustakawan</a></li>
                </ul>
            </div>
            <div>
                <div class="footer-col-title">Info</div>
                <ul class="footer-links">
                    <li><a href="#"><i data-feather="info" style="width:13px;height:13px;stroke:currentColor;fill:none;stroke-width:2"></i> Tentang Kami</a></li>
                    <li><a href="#"><i data-feather="help-circle" style="width:13px;height:13px;stroke:currentColor;fill:none;stroke-width:2"></i> Panduan Pakai</a></li>
                    <li><a href="#"><i data-feather="list" style="width:13px;height:13px;stroke:currentColor;fill:none;stroke-width:2"></i> Tata Tertib</a></li>
                    <li><a href="#"><i data-feather="mail" style="width:13px;height:13px;stroke:currentColor;fill:none;stroke-width:2"></i> Kontak</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <span class="footer-copy">&copy; {{ date('Y') }} {{ \App\Models\Setting::get('library_name', 'Simbok') }}. Hak cipta dilindungi.</span>
            <span class="footer-made">
                Dibangun dengan
                <i data-feather="heart" class="heart-icon" style="width:13px;height:13px;stroke:currentColor;fill:currentColor;stroke-width:2"></i>
                untuk dunia pendidikan
            </span>
        </div>
    </div>
</footer>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        if (typeof feather !== 'undefined') feather.replace();
    });

    const navbar = document.getElementById('navbar');
    window.addEventListener('scroll', () => {
        if (window.scrollY > 40) {
            navbar.style.background = 'rgba(255, 255, 255, 0.9)';
            navbar.style.boxShadow = '0 15px 40px -10px rgba(15,23,42,0.15)';
        } else {
            navbar.style.background = 'rgba(255, 255, 255, 0.7)';
            navbar.style.boxShadow = '0 10px 40px -10px rgba(15,23,42,0.1)';
        }
    });

    const revealObs = new IntersectionObserver((entries) => {
        entries.forEach((e, i) => {
            if (e.isIntersecting) {
                setTimeout(() => e.target.classList.add('visible'), i * 80);
                revealObs.unobserve(e.target);
            }
        });
    }, { threshold: 0.12 });
    document.querySelectorAll('.reveal').forEach(el => revealObs.observe(el));

    function animateCounter(el) {
        const target = parseInt(el.dataset.target);
        const step = target / (1800 / 16);
        let cur = 0;
        const t = setInterval(() => {
            cur = Math.min(cur + step, target);
            el.textContent = Math.floor(cur).toLocaleString('id-ID') + (target >= 98 && target <= 100 ? '%' : '+');
            if (cur >= target) clearInterval(t);
        }, 16);
    }
    const cntObs = new IntersectionObserver((entries) => {
        entries.forEach(e => { if (e.isIntersecting) { animateCounter(e.target); cntObs.unobserve(e.target); } });
    }, { threshold: 0.5 });
    document.querySelectorAll('.stat-num[data-target]').forEach(el => cntObs.observe(el));
</script>
</body>
</html>