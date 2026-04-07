@extends('layouts.app')

@section('title', 'Beranda')

@push('styles')
<style>
    /* Storefront Hero */
    .storefront-hero { background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%); border-radius: var(--radius); padding: 48px 40px; color: #fff; position: relative; overflow: hidden; margin-bottom: 32px; box-shadow: var(--shadow-md); display: flex; align-items: center; justify-content: space-between; }
    .hero-content { position: relative; z-index: 2; max-width: 600px; }
    .hero-title { font-size: 36px; font-weight: 800; line-height: 1.2; margin-bottom: 16px; letter-spacing: -0.5px; }
    .hero-desc { font-size: 16px; opacity: 0.9; line-height: 1.6; margin-bottom: 32px; }
    
    .hero-bg-shapes .shape1 { position: absolute; right: -50px; top: -100px; width: 400px; height: 400px; border-radius: 50%; background: radial-gradient(circle, rgba(56, 189, 248, 0.15) 0%, rgba(255,255,255,0) 70%); z-index: 1; }
    .hero-bg-shapes .shape2 { position: absolute; right: 200px; bottom: -150px; width: 300px; height: 300px; border-radius: 50%; background: radial-gradient(circle, rgba(16, 185, 129, 0.1) 0%, rgba(255,255,255,0) 70%); z-index: 1; }

    /* E-Commerce Stats */
    .stats-container { display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 24px; margin-bottom: 32px; }
    .store-stat-card { background: #fff; border: 1px solid var(--color-border); border-radius: var(--radius); padding: 24px; display: flex; align-items: center; gap: 20px; box-shadow: var(--shadow-sm); transition: transform 0.2s; }
    .store-stat-card:hover { transform: translateY(-4px); box-shadow: var(--shadow-md); border-color: var(--color-primary-light); }
    .store-stat-icon { width: 56px; height: 56px; border-radius: 16px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
    .store-stat-info { flex: 1; min-width: 0; }
    .store-stat-label { font-size: 13px; color: var(--color-muted); font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 4px; }
    .store-stat-value { font-size: 28px; font-weight: 800; color: var(--color-text); line-height: 1; }

    /* Layout Grid */
    .dashboard-grid { display: grid; grid-template-columns: minmax(0, 1.5fr) minmax(0, 1fr); gap: 32px; align-items: start; }
    @media (max-width: 992px) { .dashboard-grid { grid-template-columns: 1fr; } }
    
    /* List Item Row for Active Loans */
    .cart-item { display: flex; gap: 16px; padding: 20px; border-bottom: 1px solid var(--color-border); align-items: center; transition: background 0.2s; }
    .cart-item:hover { background: #f8fafc; }
    .cart-item:last-child { border-bottom: none; }
    .cart-img { width: 64px; height: 90px; object-fit: contain; border-radius: 4px; box-shadow: 2px 4px 8px rgba(0,0,0,0.1); border-left: 2px solid #e2e8f0; flex-shrink: 0; }
    .cart-img-placeholder { width: 64px; height: 90px; background: #f1f5f9; display: flex; align-items: center; justify-content: center; border-radius: 4px; border: 1px solid var(--color-border); flex-shrink: 0; }
    
    /* Digital Card ID */
    .member-id-card { background: linear-gradient(135deg, var(--color-primary) 0%, rgba(30, 58, 138, 1) 100%); border-radius: var(--radius); padding: 32px; color: #fff; box-shadow: 0 12px 24px rgba(30, 58, 138, 0.2); position: relative; overflow: hidden; }
    .member-id-card::after { content: ''; position: absolute; right: -20px; top: -20px; width: 150px; height: 150px; border: 20px solid rgba(255,255,255,0.05); border-radius: 50%; }
</style>
@endpush

@section('content')

<!-- E-Commerce Hero Banner -->
<div class="storefront-hero">
    <div class="hero-bg-shapes">
        <div class="shape1"></div>
        <div class="shape2"></div>
    </div>
    <div class="hero-content">
        <div style="display: inline-block; padding: 4px 12px; background: rgba(56, 189, 248, 0.2); color: #7dd3fc; border-radius: 20px; font-size: 11px; font-weight: 700; letter-spacing: 1px; margin-bottom: 16px; text-transform: uppercase;">Portal Pustaka Digital Sekolah</div>
        <h1 class="hero-title">Selamat Datang,<br>{{ explode(' ', auth()->user()->name)[0] }}!</h1>
        <p class="hero-desc">Ribuan bahan bacaan premium kini ada di genggamanmu. Temukan judul idaman Anda dengan mudah dan pinjam langsung secara gratis.</p>
        <div style="display: flex; gap: 16px;">
            <a href="{{ route('student.catalog.index') }}" class="btn btn-primary" style="padding: 14px 28px; font-size: 15px; font-weight: 700; box-shadow: 0 4px 12px rgba(56, 189, 248, 0.3);">
                <i data-feather="book-open" style="width: 20px; height: 20px;"></i>
                Jelajahi Katalog Buku
            </a>
            <a href="{{ route('student.loans.index') }}" class="btn btn-outline" style="padding: 14px 28px; font-size: 15px; font-weight: 600; color: #fff; border-color: rgba(255,255,255,0.3);">Lihat Transaksi</a>
        </div>
    </div>
    
    <!-- Illustration / Graphic right side -->
    <div style="position: relative; z-index: 2; display: none; @media(min-width: 768px) { display: block; } opacity: 0.9;">
        <i data-feather="folder" style="width: 200px; height: 200px; color: rgba(255,255,255,0.8); stroke-width: 1.5px;"></i>
    </div>
</div>

<!-- Performance Metrics -->
<div class="stats-container">
    <div class="store-stat-card">
        <div class="store-stat-icon" style="background: rgba(14, 165, 233, 0.1); color: #0ea5e9;">
            <i data-feather="book-open" style="width: 28px; height: 28px;"></i>
        </div>
        <div class="store-stat-info">
            <div class="store-stat-label">Sedang Dibaca</div>
            <div class="store-stat-value">{{ $stats['active_loans'] }}</div>
        </div>
    </div>
    
    <div class="store-stat-card">
        <div class="store-stat-icon" style="background: rgba(245, 158, 11, 0.1); color: #f59e0b;">
            <i data-feather="clock" style="width: 28px; height: 28px;"></i>
        </div>
        <div class="store-stat-info">
            <div class="store-stat-label">Menunggu Persetujuan</div>
            <div class="store-stat-value">{{ $stats['pending'] }}</div>
        </div>
    </div>
    
    <div class="store-stat-card">
        <div class="store-stat-icon" style="background: rgba(34, 197, 94, 0.1); color: #22c55e;">
            <i data-feather="check-circle" style="width: 28px; height: 28px;"></i>
        </div>
        <div class="store-stat-info">
            <div class="store-stat-label">Transaksi Selesai</div>
            <div class="store-stat-value">{{ $stats['returned'] }}</div>
        </div>
    </div>
</div>

<div class="dashboard-grid">
    <!-- Left Column: Active Orders list -->
    <div>
        <div style="background: #fff; border: 1px solid var(--color-border); border-radius: var(--radius); box-shadow: var(--shadow-sm); overflow: hidden;">
            <div style="padding: 20px 24px; border-bottom: 1px solid var(--color-border); display: flex; justify-content: space-between; align-items: center; background: #f8fafc;">
                <h2 style="font-size: 18px; font-weight: 800; margin: 0;">Barang Sedang Diproses / Dipinjam</h2>
                <a href="{{ route('student.loans.index') }}" class="btn btn-ghost btn-sm" style="font-weight: 600;">Lihat Semua</a>
            </div>
            
            <div style="padding: 0;">
                @forelse($activeLoans as $loan)
                    <div class="cart-item">
                        <a href="{{ route('student.catalog.show', $loan->book) }}" style="display: block;">
                            @if($loan->book->cover)
                                <img src="{{ Storage::url($loan->book->cover) }}" alt="Cover" class="cart-img" loading="lazy">
                            @else
                                <div class="cart-img-placeholder">
                                    <i data-feather="book-open" style="width: 24px; height: 24px; color: var(--color-muted);"></i>
                                </div>
                            @endif
                        </a>
                        <div style="flex: 1; min-width: 0;">
                            <div style="font-size: 11px; color: var(--color-primary-light); font-weight: 700; text-transform: uppercase; margin-bottom: 4px; letter-spacing: 0.5px;">{{ $loan->book->category->name }}</div>
                            <a href="{{ route('student.catalog.show', $loan->book) }}" style="text-decoration: none; color: var(--color-text);">
                                <h3 style="font-weight: 700; font-size: 16px; margin-bottom: 6px; line-height: 1.3;" title="{{ $loan->book->title }}">
                                    {{ $loan->book->title }}
                                </h3>
                            </a>
                            <div style="font-size: 13px; color: var(--color-muted); margin-bottom: 8px;">Order ID: T-{{ $loan->id }}{{ $loan->book->id }}{{ date('y') }} &bull; Pinjam: {{ $loan->loan_date->format('d/m/y') }}</div>
                            
                            @if($loan->isOverdue())
                                <div style="display: inline-flex; align-items: center; gap: 6px; font-size: 12px; font-weight: 700; color: #b91c1c; background: #fee2e2; padding: 4px 8px; border-radius: 4px;">
                                    <i data-feather="alert-triangle" style="width: 14px; height: 14px;"></i>
                                    Terlambat {{ $loan->daysOverdue() }} hari
                                </div>
                            @else
                                <div style="display: inline-flex; align-items: center; gap: 6px; font-size: 12px; font-weight: 600; color: var(--color-primary-dark); background: rgba(37,99,168,0.1); padding: 4px 8px; border-radius: 4px;">
                                    <i data-feather="clock" style="width: 14px; height: 14px;"></i>
                                    Jatuh Tempo: {{ $loan->due_date->format('d M Y') }}
                                </div>
                            @endif
                        </div>
                        <div style="flex-shrink: 0; display: flex; flex-direction: column; align-items: flex-end; gap: 8px;">
                            <span class="badge {{ \App\Models\Loan::statusBadgeClass($loan->status) }}" style="padding: 6px 12px;">{{ \App\Models\Loan::statusLabel($loan->status) }}</span>
                        </div>
                    </div>
                @empty
                    <div style="padding: 64px 24px; text-align: center;">
                        <i data-feather="package" style="width: 48px; height: 48px; color: var(--color-muted); opacity: 0.5; margin-bottom: 16px;"></i>
                        <h3 style="font-size: 16px; font-weight: 700; margin-bottom: 8px;">Daftar Peminjaman Kosong</h3>
                        <p style="font-size: 14px; color: var(--color-muted); margin-bottom: 16px;">Belum ada pinjaman buku yang sedang aktif saat ini.</p>
                        <a href="{{ route('student.catalog.index') }}" class="btn btn-outline btn-sm">Mulai Pinjam Buku</a>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
    
    <!-- Right Column: Member ID & Policies -->
    <div style="display: flex; flex-direction: column; gap: 24px;">
        <!-- Digital Loyalty Card -->
        <div class="member-id-card">
            <img src="/logo.svg" alt="Logo" style="height: 24px; margin-bottom: 24px; filter: brightness(0) invert(1); opacity: 0.9;" onerror="this.style.display='none'">
            <h3 style="font-size: 14px; font-weight: 700; margin-bottom: 4px; letter-spacing: 1px; opacity: 0.8; text-transform: uppercase;">Membership Identitas</h3>
            
            <div style="background: rgba(255,255,255,0.1); border-radius: 8px; padding: 20px; border: 1px solid rgba(255,255,255,0.2); backdrop-filter: blur(8px); margin-top: 16px;">
                <div style="font-size: 10px; text-transform: uppercase; letter-spacing: 1px; color: rgba(255,255,255,0.7); margin-bottom: 4px;">Nama Lengkap Pelanggan</div>
                <div style="font-size: 18px; font-weight: 800; margin-bottom: 16px; letter-spacing: 0.5px;">{{ auth()->user()->name }}</div>
                
                <div style="display: flex; justify-content: space-between;">
                    <div>
                        <div style="font-size: 10px; text-transform: uppercase; letter-spacing: 1px; color: rgba(255,255,255,0.7); margin-bottom: 4px;">No. Induk (NIS)</div>
                        <div style="font-size: 15px; font-weight: 600; font-family: monospace; letter-spacing: 1.5px;">{{ auth()->user()->nis }}</div>
                    </div>
                    <div>
                        <div style="font-size: 10px; text-transform: uppercase; letter-spacing: 1px; color: rgba(255,255,255,0.7); margin-bottom: 4px;">Kelas</div>
                        <div style="font-size: 15px; font-weight: 600; text-align: right;">{{ auth()->user()->kelas }}</div>
                    </div>
                </div>
            </div>
            <div style="font-size: 11px; text-align: center; margin-top: 16px; opacity: 0.7;">Tunjukkan kartu digital ini saat layanan offline.</div>
        </div>
        
        <!-- Store Policies -->
        <div style="background: #fff; border: 1px solid var(--color-border); border-radius: var(--radius); box-shadow: var(--shadow-sm);">
            <div style="padding: 16px 20px; border-bottom: 1px solid var(--color-border); background: #f8fafc;">
                <h2 style="font-size: 16px; font-weight: 700; margin: 0; display: flex; align-items: center; gap: 8px;">
                    <i data-feather="info" style="width: 18px; height: 18px;"></i>
                    Kebijakan Peminjaman
                </h2>
            </div>
            <div style="padding: 20px;">
                <ul style="padding-left: 20px; display: flex; flex-direction: column; gap: 12px; color: var(--color-text); font-size: 13.5px; margin: 0;">
                    <li>Batas maksimum peminjaman: <strong>{{ \App\Models\Setting::get('max_loan_per_user', 3) }} Item</strong> / akun.</li>
                    <li>Durasi pinjam: <strong>{{ \App\Models\Setting::get('loan_duration_days', 7) }} Hari Kalender</strong> sejak pengajuan disetujui.</li>
                    <li>Biaya denda keterlambatan: <strong>Rp {{ number_format((int)\App\Models\Setting::get('fine_per_day', 1000), 0, ',', '.') }} / hari</strong> penundaan.</li>
                    <li>Siswa diwajibkan menjaga fisik buku seperti perlindungan segel baru.</li>
                </ul>
            </div>
        </div>
    </div>
</div>

@endsection
