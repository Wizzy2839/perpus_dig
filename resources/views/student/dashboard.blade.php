@extends('layouts.app')

@section('title', 'Beranda')

@push('styles')
<style>
    /* ── PAGE LAYOUT ── */
    .sd-page { display: flex; flex-direction: column; gap: 28px; max-width: 1200px; margin: 0 auto; padding: 28px 24px 48px; }

    /* ── HERO ── */
    .sd-hero {
        background: linear-gradient(135deg, var(--color-primary-dark) 0%, var(--color-primary) 60%, var(--color-primary-light) 100%);
        border-radius: 16px;
        padding: 40px 44px;
        color: #fff;
        position: relative;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 24px;
        box-shadow: 0 12px 32px rgba(26,60,94,0.22);
    }
    .sd-hero::before {
        content: '';
        position: absolute;
        right: -80px; top: -80px;
        width: 300px; height: 300px;
        border-radius: 50%;
        border: 40px solid rgba(255,255,255,0.05);
    }
    .sd-hero::after {
        content: '';
        position: absolute;
        left: 40%; bottom: -60px;
        width: 220px; height: 220px;
        border-radius: 50%;
        background: rgba(255,255,255,0.04);
    }
    .sd-hero-content { position: relative; z-index: 2; flex: 1; }
    .sd-hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(255,255,255,0.12);
        border: 1px solid rgba(255,255,255,0.2);
        border-radius: 100px;
        padding: 5px 14px;
        font-size: 11px;
        font-weight: 700;
        color: rgba(255,255,255,0.9);
        letter-spacing: .06em;
        text-transform: uppercase;
        margin-bottom: 16px;
    }
    .sd-hero-badge span {
        width: 6px; height: 6px;
        border-radius: 50%;
        background: #4ade80;
        animation: dot-pulse 2s infinite;
    }
    @keyframes dot-pulse { 0%,100%{opacity:1;transform:scale(1)} 50%{opacity:.5;transform:scale(1.4)} }
    .sd-hero h1 {
        font-size: 30px;
        font-weight: 800;
        line-height: 1.2;
        margin-bottom: 12px;
        letter-spacing: -0.5px;
    }
    .sd-hero p {
        font-size: 14.5px;
        color: rgba(255,255,255,0.77);
        line-height: 1.65;
        max-width: 480px;
        margin-bottom: 24px;
    }
    .sd-hero-btns { display: flex; gap: 12px; flex-wrap: wrap; }
    .sd-btn-primary {
        display: inline-flex; align-items: center; gap: 8px;
        padding: 11px 22px;
        background: #fff;
        color: var(--color-primary);
        font-size: 13.5px; font-weight: 700;
        border-radius: 8px;
        text-decoration: none;
        border: none; cursor: pointer;
        transition: all .2s;
        box-shadow: 0 4px 12px rgba(0,0,0,0.12);
    }
    .sd-btn-primary:hover { transform: translateY(-2px); box-shadow: 0 6px 16px rgba(0,0,0,0.16); }
    .sd-btn-primary i { width: 16px; height: 16px; }
    .sd-btn-ghost {
        display: inline-flex; align-items: center; gap: 8px;
        padding: 11px 22px;
        background: rgba(255,255,255,0.12);
        color: #fff;
        font-size: 13.5px; font-weight: 700;
        border-radius: 8px;
        text-decoration: none;
        border: 1px solid rgba(255,255,255,0.25);
        transition: all .2s;
    }
    .sd-btn-ghost:hover { background: rgba(255,255,255,0.2); }
    .sd-btn-ghost i { width: 16px; height: 16px; }

    /* Hero illustration */
    .sd-hero-art {
        position: relative; z-index: 2;
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0;
        opacity: 0.92;
    }
    .sd-hero-art-inner {
        width: 120px; height: 120px;
        border-radius: 24px;
        background: rgba(255,255,255,0.1);
        border: 1px solid rgba(255,255,255,0.15);
        display: flex; align-items: center; justify-content: center;
        backdrop-filter: blur(8px);
    }
    .sd-hero-art-inner i { width: 56px; height: 56px; color: rgba(255,255,255,0.9); }

    /* ── STATS ── */
    .sd-stats {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 16px;
    }
    .sd-stat {
        background: #fff;
        border: 1px solid var(--color-border);
        border-radius: 12px;
        padding: 20px 22px;
        display: flex;
        align-items: center;
        gap: 16px;
        box-shadow: var(--shadow-sm);
        transition: all .25s;
        text-decoration: none;
        color: inherit;
    }
    .sd-stat:hover { transform: translateY(-3px); box-shadow: var(--shadow-md); border-color: var(--color-primary-light); }
    .sd-stat-icon {
        width: 48px; height: 48px;
        border-radius: 12px;
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0;
    }
    .sd-stat-icon i { width: 24px; height: 24px; }
    .sd-stat-label { font-size: 12px; color: var(--color-muted); font-weight: 600; text-transform: uppercase; letter-spacing: .04em; margin-bottom: 4px; }
    .sd-stat-value { font-size: 28px; font-weight: 800; color: var(--color-text); line-height: 1; }

    /* ── MAIN GRID ── */
    .sd-grid {
        display: grid;
        grid-template-columns: minmax(0, 1.4fr) minmax(0, 1fr);
        gap: 20px;
        align-items: start;
    }

    /* ── CARD ── */
    .sd-card {
        background: #fff;
        border: 1px solid var(--color-border);
        border-radius: 14px;
        overflow: hidden;
        box-shadow: var(--shadow-sm);
    }
    .sd-card-head {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 16px 20px;
        border-bottom: 1px solid var(--color-border);
    }
    .sd-card-title {
        font-size: 15px;
        font-weight: 700;
        color: var(--color-text);
        display: flex; align-items: center; gap: 8px;
    }
    .sd-card-title i { width: 17px; height: 17px; color: var(--color-primary); }
    .sd-link-sm {
        font-size: 12.5px;
        font-weight: 700;
        color: var(--color-primary);
        text-decoration: none;
        display: flex; align-items: center; gap: 4px;
    }
    .sd-link-sm:hover { text-decoration: underline; }
    .sd-link-sm i { width: 14px; height: 14px; }

    /* Loan list items */
    .sd-loan-item {
        display: flex;
        gap: 14px;
        padding: 16px 20px;
        border-bottom: 1px solid var(--color-border);
        align-items: center;
        transition: background .15s;
    }
    .sd-loan-item:last-child { border-bottom: none; }
    .sd-loan-item:hover { background: #f8fafc; }
    .sd-loan-cover {
        width: 52px; height: 72px;
        border-radius: 5px;
        object-fit: contain;
        box-shadow: 2px 2px 8px rgba(0,0,0,0.10);
        flex-shrink: 0;
        border-left: 3px solid var(--color-primary-light);
    }
    .sd-loan-cover-ph {
        width: 52px; height: 72px;
        border-radius: 5px;
        background: var(--color-bg);
        border: 1px solid var(--color-border);
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0;
    }
    .sd-loan-cover-ph i { width: 20px; height: 20px; color: var(--color-muted); }
    .sd-loan-info { flex: 1; min-width: 0; }
    .sd-loan-cat { font-size: 10.5px; color: var(--color-primary-light); font-weight: 700; text-transform: uppercase; letter-spacing: .04em; margin-bottom: 3px; }
    .sd-loan-title {
        font-size: 14px;
        font-weight: 700;
        color: var(--color-text);
        margin-bottom: 5px;
        line-height: 1.3;
        overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
    }
    .sd-loan-meta { font-size: 12px; color: var(--color-muted); margin-bottom: 6px; }
    .sd-tag {
        display: inline-flex; align-items: center; gap: 5px;
        font-size: 11.5px; font-weight: 700;
        padding: 3px 9px;
        border-radius: 6px;
    }
    .sd-tag i { width: 12px; height: 12px; }
    .sd-tag-overdue { color: #b91c1c; background: #fee2e2; }
    .sd-tag-due { color: var(--color-primary-dark); background: rgba(37,99,168,0.1); }

    /* Empty state */
    .sd-empty {
        padding: 56px 24px;
        text-align: center;
    }
    .sd-empty i { width: 44px; height: 44px; color: var(--color-muted); opacity: .4; margin-bottom: 12px; }
    .sd-empty h3 { font-size: 15px; font-weight: 700; margin-bottom: 6px; }
    .sd-empty p { font-size: 13.5px; color: var(--color-muted); margin-bottom: 16px; }

    /* ── RIGHT COLUMN ── */
    /* Member Card */
    .sd-member-card {
        background: linear-gradient(135deg, var(--color-primary-dark) 0%, var(--color-primary) 100%);
        border-radius: 14px;
        padding: 24px;
        color: #fff;
        position: relative;
        overflow: hidden;
        box-shadow: 0 8px 24px rgba(26,60,94,0.2);
        margin-bottom: 16px;
    }
    .sd-member-card::before {
        content: '';
        position: absolute;
        right: -30px; top: -30px;
        width: 140px; height: 140px;
        border-radius: 50%;
        border: 24px solid rgba(255,255,255,0.05);
    }
    .sd-mc-top {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 20px;
    }
    .sd-mc-avatar {
        width: 48px; height: 48px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid rgba(255,255,255,0.3);
        flex-shrink: 0;
    }
    .sd-mc-avatar-ph {
        width: 48px; height: 48px;
        border-radius: 50%;
        background: rgba(255,255,255,0.15);
        border: 2px solid rgba(255,255,255,0.25);
        display: flex; align-items: center; justify-content: center;
        font-size: 20px; font-weight: 700;
        flex-shrink: 0;
    }
    .sd-mc-name { font-size: 15px; font-weight: 800; line-height: 1.2; }
    .sd-mc-label { font-size: 11px; opacity: .65; font-weight: 500; text-transform: uppercase; letter-spacing: .04em; }

    .sd-mc-body {
        background: rgba(255,255,255,0.08);
        border: 1px solid rgba(255,255,255,0.12);
        border-radius: 10px;
        padding: 16px;
    }
    .sd-mc-row { display: flex; justify-content: space-between; }
    .sd-mc-field-label { font-size: 10.5px; opacity: .65; text-transform: uppercase; letter-spacing: .05em; margin-bottom: 3px; }
    .sd-mc-field-value { font-size: 14px; font-weight: 700; font-family: monospace; letter-spacing: 1px; }
    .sd-mc-caption { font-size: 10.5px; text-align: center; margin-top: 14px; opacity: .55; }

    /* Policy card */
    .sd-policy-item {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        padding: 13px 0;
        border-bottom: 1px solid var(--color-border);
    }
    .sd-policy-item:last-child { border-bottom: none; }
    .sd-policy-icon {
        width: 34px; height: 34px;
        border-radius: 9px;
        background: #EFF6FF;
        color: var(--color-primary);
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0;
    }
    .sd-policy-icon i { width: 16px; height: 16px; }
    .sd-policy-label { font-size: 11px; color: var(--color-muted); font-weight: 600; margin-bottom: 2px; }
    .sd-policy-value { font-size: 13px; color: var(--color-text); font-weight: 700; }

    /* Responsive */
    @media (max-width: 992px) {
        .sd-stats { grid-template-columns: 1fr 1fr; }
        .sd-grid { grid-template-columns: 1fr; }
    }
    @media (max-width: 600px) {
        .sd-page { padding: 16px 12px 40px; gap: 16px; }
        .sd-hero { padding: 28px 22px; flex-direction: column; }
        .sd-hero-art { display: none; }
        .sd-hero h1 { font-size: 22px; }
        .sd-stats { grid-template-columns: 1fr; }
    }
</style>
@endpush

@section('content')
<div class="sd-page">

    {{-- ---- HERO ---- --}}
    <div class="sd-hero">
        <div class="sd-hero-content">
            <div class="sd-hero-badge">
                <span></span>
                Portal Pustaka Digital
            </div>
            <h1>Selamat Datang,<br>{{ explode(' ', auth()->user()->name)[0] }}! 👋</h1>
            <p>Akses ribuan koleksi buku, kelola peminjaman, dan pantau riwayat bacaan Anda dengan mudah.</p>
            <div class="sd-hero-btns">
                <a href="{{ route('student.catalog.index') }}" class="sd-btn-primary">
                    <i data-feather="book-open"></i>
                    Jelajahi Katalog
                </a>
                <a href="{{ route('student.loans.index') }}" class="sd-btn-ghost">
                    <i data-feather="clock"></i>
                    Lihat Transaksi
                </a>
            </div>
        </div>
        <div class="sd-hero-art">
            <div class="sd-hero-art-inner">
                <i data-feather="book-open"></i>
            </div>
        </div>
    </div>

    {{-- ---- STATS ---- --}}
    <div class="sd-stats">
        <div class="sd-stat">
            <div class="sd-stat-icon" style="background: rgba(14,165,233,0.1); color: #0ea5e9;">
                <i data-feather="book-open"></i>
            </div>
            <div>
                <div class="sd-stat-label">Sedang Dibaca</div>
                <div class="sd-stat-value">{{ $stats['active_loans'] }}</div>
            </div>
        </div>
        <div class="sd-stat">
            <div class="sd-stat-icon" style="background: rgba(245,158,11,0.1); color: #f59e0b;">
                <i data-feather="clock"></i>
            </div>
            <div>
                <div class="sd-stat-label">Menunggu Persetujuan</div>
                <div class="sd-stat-value">{{ $stats['pending'] }}</div>
            </div>
        </div>
        <div class="sd-stat">
            <div class="sd-stat-icon" style="background: rgba(34,197,94,0.1); color: #22c55e;">
                <i data-feather="check-circle"></i>
            </div>
            <div>
                <div class="sd-stat-label">Transaksi Selesai</div>
                <div class="sd-stat-value">{{ $stats['returned'] }}</div>
            </div>
        </div>
    </div>

    {{-- ---- MAIN GRID ---- --}}
    <div class="sd-grid">

        {{-- Active Loans --}}
        <div class="sd-card">
            <div class="sd-card-head">
                <div class="sd-card-title">
                    <i data-feather="layers"></i>
                    Buku Aktif & Menunggu
                </div>
                <a href="{{ route('student.loans.index') }}" class="sd-link-sm">
                    Lihat Semua <i data-feather="arrow-right"></i>
                </a>
            </div>
            @forelse($activeLoans as $loan)
                <div class="sd-loan-item">
                    <a href="{{ route('student.catalog.show', $loan->book) }}">
                        @if($loan->book->cover)
                            <img src="{{ Storage::url($loan->book->cover) }}" alt="Cover" class="sd-loan-cover">
                        @else
                            <div class="sd-loan-cover-ph">
                                <i data-feather="book"></i>
                            </div>
                        @endif
                    </a>
                    <div class="sd-loan-info">
                        <div class="sd-loan-cat">{{ $loan->book->category->name }}</div>
                        <a href="{{ route('student.catalog.show', $loan->book) }}" style="text-decoration:none;color:inherit;">
                            <div class="sd-loan-title">{{ $loan->book->title }}</div>
                        </a>
                        <div class="sd-loan-meta">{{ $loan->book->author }} &bull; Dipinjam: {{ $loan->loan_date->format('d M Y') }}</div>
                        @if($loan->isOverdue())
                            <div style="display:flex; flex-direction:column; gap:4px; margin-top:6px; align-items:flex-start;">
                                <span class="sd-tag sd-tag-overdue">
                                    <i data-feather="alert-triangle"></i>
                                    Terlambat {{ $loan->daysOverdue() }} hari
                                </span>
                                <span style="font-size:11.5px; font-weight:700; color:#b91c1c; display:flex; align-items:center; gap:4px; margin-left:2px;">
                                    <i data-feather="dollar-sign" style="width:12px; height:12px;"></i>
                                    Denda: Rp {{ number_format($loan->calculateFine(), 0, ',', '.') }}
                                </span>
                            </div>
                        @else
                            <span class="sd-tag sd-tag-due">
                                <i data-feather="calendar"></i>
                                Jatuh Tempo: {{ $loan->due_date->format('d M Y') }}
                            </span>
                        @endif
                    </div>
                    <div style="flex-shrink:0;">
                        <span class="badge {{ \App\Models\Loan::statusBadgeClass($loan->status) }}">
                            {{ \App\Models\Loan::statusLabel($loan->status) }}
                        </span>
                    </div>
                </div>
            @empty
                <div class="sd-empty">
                    <i data-feather="inbox"></i>
                    <h3>Daftar Peminjaman Kosong</h3>
                    <p>Belum ada pinjaman buku aktif saat ini.</p>
                    <a href="{{ route('student.catalog.index') }}" class="btn btn-outline btn-sm">Mulai Pinjam Buku</a>
                </div>
            @endforelse
        </div>

        {{-- Right Column --}}
        <div>

            {{-- Member Card --}}
            <div class="sd-member-card">
                <div class="sd-mc-top">
                    @if(auth()->user()->photo)
                        <img src="{{ Storage::url(auth()->user()->photo) }}" class="sd-mc-avatar" alt="Avatar">
                    @else
                        <div class="sd-mc-avatar-ph">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
                    @endif
                    <div>
                        <div class="sd-mc-label">Kartu Anggota Digital</div>
                        <div class="sd-mc-name">{{ auth()->user()->name }}</div>
                    </div>
                </div>
                <div class="sd-mc-body">
                    <div class="sd-mc-row">
                        <div>
                            <div class="sd-mc-field-label">NIS</div>
                            <div class="sd-mc-field-value">{{ auth()->user()->nis }}</div>
                        </div>
                        <div style="text-align:right;">
                            <div class="sd-mc-field-label">Kelas</div>
                            <div class="sd-mc-field-value">{{ auth()->user()->kelas }}</div>
                        </div>
                    </div>
                </div>
                <div class="sd-mc-caption">Tunjukkan kartu ini saat transaksi offline di perpustakaan</div>
            </div>

            {{-- Borrow Policy --}}
            <div class="sd-card">
                <div class="sd-card-head">
                    <div class="sd-card-title">
                        <i data-feather="shield"></i>
                        Kebijakan Peminjaman
                    </div>
                </div>
                <div style="padding: 8px 20px 16px;">
                    <div class="sd-policy-item">
                        <div class="sd-policy-icon"><i data-feather="package"></i></div>
                        <div>
                            <div class="sd-policy-label">Maks. Peminjaman</div>
                            <div class="sd-policy-value">{{ \App\Models\Setting::get('max_loan_per_user', 3) }} buku per akun</div>
                        </div>
                    </div>
                    <div class="sd-policy-item">
                        <div class="sd-policy-icon"><i data-feather="calendar"></i></div>
                        <div>
                            <div class="sd-policy-label">Durasi Peminjaman</div>
                            <div class="sd-policy-value">{{ \App\Models\Setting::get('loan_duration_days', 7) }} hari kalender</div>
                        </div>
                    </div>
                    <div class="sd-policy-item">
                        <div class="sd-policy-icon"><i data-feather="alert-circle"></i></div>
                        <div>
                            <div class="sd-policy-label">Denda Keterlambatan</div>
                            <div class="sd-policy-value">Rp {{ number_format((int)\App\Models\Setting::get('fine_per_day', 1000), 0, ',', '.') }} / hari</div>
                        </div>
                    </div>
                </div>
            </div>

        </div>{{-- end right col --}}
    </div>{{-- end grid --}}

</div>{{-- end page --}}
@endsection
