@extends('layouts.app')

@section('title', $book->title)
@section('page-title', 'Detail Buku')

@push('styles')
<style>
    .show-page { max-width: 1100px; margin: 0 auto; padding: 22px 24px 56px; }

    /* Breadcrumb */
    .breadcrumb {
        display: flex; align-items: center; gap: 7px;
        font-size: 13px; color: var(--color-muted);
        margin-bottom: 24px; flex-wrap: wrap;
    }
    .breadcrumb a { color: var(--color-primary); text-decoration: none; font-weight: 600; }
    .breadcrumb a:hover { text-decoration: underline; }
    .breadcrumb i { width: 13px; height: 13px; opacity: .5; }

    /* Layout */
    .show-layout { display: grid; grid-template-columns: 280px 1fr 280px; gap: 22px; align-items: start; }

    /* Cover panel */
    .cover-panel {
        background: #fff;
        border: 1px solid var(--color-border);
        border-radius: 14px;
        padding: 28px 20px 20px;
        display: flex; flex-direction: column; align-items: center;
        box-shadow: var(--shadow-sm);
        position: sticky; top: 88px;
    }
    .cover-img {
        width: 100%; max-width: 200px;
        height: auto; aspect-ratio: 3/4;
        object-fit: contain;
        border-radius: 3px 10px 10px 3px;
        border-left: 3px solid var(--color-primary-light);
        box-shadow: 4px 8px 24px rgba(0,0,0,0.14);
        margin-bottom: 20px;
    }
    .cover-ph {
        width: 100%; max-width: 200px; aspect-ratio: 3/4;
        background: linear-gradient(135deg, #f1f5f9, #e2e8f0);
        border-radius: 3px 10px 10px 3px;
        border-left: 3px solid var(--color-border);
        display: flex; align-items: center; justify-content: center;
        margin-bottom: 20px;
    }
    .cover-ph i { width: 48px; height: 48px; color: #94a3b8; }
    .cover-trust {
        display: flex; flex-direction: column; align-items: center; gap: 6px;
        padding-top: 16px;
        border-top: 1px dashed var(--color-border);
        width: 100%;
        text-align: center;
        font-size: 12px; color: var(--color-muted); font-weight: 600;
    }
    .cover-trust i { width: 20px; height: 20px; color: var(--color-success); }

    /* Info panel */
    .info-panel {
        background: #fff;
        border: 1px solid var(--color-border);
        border-radius: 14px;
        padding: 32px;
        box-shadow: var(--shadow-sm);
    }
    .book-cat-badge {
        display: inline-flex; align-items: center; gap: 7px;
        background: #EFF6FF;
        color: var(--color-primary);
        border: 1px solid #DBEAFE;
        border-radius: 100px;
        padding: 5px 14px;
        font-size: 11.5px; font-weight: 700;
        text-transform: uppercase; letter-spacing: .04em;
        margin-bottom: 14px;
    }
    .book-cat-badge i { width: 12px; height: 12px; }
    .book-title-main {
        font-size: 28px; font-weight: 800;
        line-height: 1.25; color: var(--color-text);
        margin-bottom: 8px; letter-spacing: -0.4px;
    }
    .book-author-main {
        display: flex; align-items: center; gap: 7px;
        font-size: 14.5px; color: var(--color-primary);
        font-weight: 600; margin-bottom: 28px;
    }
    .book-author-main i { width: 16px; height: 16px; }

    /* Spec table */
    .spec-section-title {
        font-size: 12px; font-weight: 800;
        text-transform: uppercase; letter-spacing: .06em;
        color: var(--color-muted);
        margin-bottom: 12px;
        padding-bottom: 8px;
        border-bottom: 1px solid var(--color-border);
    }
    .spec-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 10px;
        margin-bottom: 28px;
    }
    .spec-item {
        background: var(--color-bg);
        border: 1px solid var(--color-border);
        border-radius: 9px;
        padding: 11px 14px;
    }
    .spec-label { font-size: 11px; color: var(--color-muted); font-weight: 700; text-transform: uppercase; letter-spacing: .04em; margin-bottom: 3px; }
    .spec-value { font-size: 14px; color: var(--color-text); font-weight: 700; }
    .spec-mono { font-family: monospace; letter-spacing: .5px; }

    /* Synopsis */
    .synopsis-text {
        font-size: 14.5px; line-height: 1.8;
        color: var(--color-text); opacity: .88;
        white-space: pre-line;
    }

    /* Action panel */
    .action-panel {
        background: #fff;
        border: 1px solid var(--color-border);
        border-radius: 14px;
        overflow: hidden;
        box-shadow: var(--shadow-sm);
        position: sticky; top: 88px;
    }
    .action-panel-head {
        background: var(--color-primary);
        padding: 16px 20px;
        color: #fff;
        font-size: 13px; font-weight: 800;
        text-align: center;
        letter-spacing: .02em;
    }
    .action-panel-body { padding: 20px; }

    /* Stock indicator */
    .stock-wrap { margin-bottom: 20px; }
    .stock-label { font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: .05em; color: var(--color-muted); margin-bottom: 8px; }
    .stock-avail {
        display: flex; align-items: center; gap: 8px;
        background: #F0FDF4; border: 1px solid #BBF7D0;
        border-radius: 10px; padding: 12px 14px;
        color: var(--color-success); font-size: 15px; font-weight: 800;
    }
    .stock-avail i { width: 19px; height: 19px; }
    .stock-avail-sub { font-size: 12.5px; color: var(--color-muted); margin-top: 5px; padding-left: 2px; font-weight: 500; }
    .stock-empty {
        display: flex; align-items: center; gap: 8px;
        background: #FEF2F2; border: 1px solid #FECACA;
        border-radius: 10px; padding: 12px 14px;
        color: var(--color-danger); font-size: 15px; font-weight: 800;
    }
    .stock-empty i { width: 19px; height: 19px; }
    .stock-warning {
        display: flex; align-items: flex-start; gap: 8px;
        background: #FFFBEB; border: 1px solid #FDE68A;
        border-radius: 8px; padding: 10px 12px;
        color: #92400e; font-size: 12.5px; font-weight: 600;
        margin-top: 8px;
    }
    .stock-warning i { width: 14px; height: 14px; flex-shrink: 0; margin-top: 2px; }

    /* Existing loan notice */
    .existing-notice {
        background: #FFFBEB; border: 1px solid #FDE68A;
        border-radius: 10px; padding: 14px;
        display: flex; align-items: flex-start; gap: 10px;
        color: #78350f; font-size: 13px;
    }
    .existing-notice i { width: 17px; height: 17px; flex-shrink: 0; margin-top: 2px; }
    .existing-status-chip {
        display: inline-block;
        margin-top: 8px;
        padding: 3px 10px;
        background: rgba(255,255,255,0.7);
        border-radius: 6px;
        font-size: 12px; font-weight: 700;
        color: var(--color-primary);
    }

    /* Loan button */
    .loan-btn {
        display: flex; align-items: center; justify-content: center; gap: 9px;
        width: 100%; padding: 13px;
        background: var(--color-primary); color: #fff;
        border: none; border-radius: 10px;
        font-size: 14.5px; font-weight: 700;
        cursor: pointer; transition: all .25s;
        box-shadow: 0 4px 14px rgba(26,60,94,0.22);
        text-decoration: none;
        margin-top: 16px;
    }
    .loan-btn:hover { background: var(--color-primary-dark); transform: translateY(-1px); box-shadow: 0 6px 20px rgba(26,60,94,0.3); }
    .loan-btn i { width: 18px; height: 18px; }
    .loan-btn-disabled {
        display: flex; align-items: center; justify-content: center; gap: 9px;
        width: 100%; padding: 13px;
        background: var(--color-bg); color: var(--color-muted);
        border: 2px dashed var(--color-border);
        border-radius: 10px;
        font-size: 14px; font-weight: 600;
        cursor: not-allowed; margin-top: 16px;
    }
    .loan-btn-disabled i { width: 18px; height: 18px; }
    .loan-trust {
        display: flex; align-items: center; justify-content: center; gap: 5px;
        font-size: 11px; color: var(--color-muted);
        margin-top: 12px;
        padding: 5px 12px; background: var(--color-bg);
        border-radius: 100px;
    }
    .loan-trust i { width: 12px; height: 12px; }

    /* Related books */
    .related-section { margin-top: 40px; }
    .related-title {
        font-size: 16px; font-weight: 800;
        margin-bottom: 16px; color: var(--color-text);
        display: flex; align-items: center; gap: 8px;
    }
    .related-title i { width: 18px; height: 18px; color: var(--color-primary); }
    .related-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(165px, 1fr)); gap: 14px; }
    .related-card {
        background: #fff; border: 1px solid var(--color-border);
        border-radius: 10px; overflow: hidden;
        display: flex; flex-direction: column;
        text-decoration: none;
        transition: transform .2s, box-shadow .2s, border-color .2s;
        box-shadow: var(--shadow-sm);
    }
    .related-card:hover { transform: translateY(-4px); box-shadow: var(--shadow-md); border-color: var(--color-primary-light); }
    .related-cover-wrap { background: var(--color-bg); padding: 16px 12px; display: flex; align-items: center; justify-content: center; border-bottom: 1px solid var(--color-border); min-height: 140px; }
    .related-cover { height: 120px; width: auto; max-width: 100%; object-fit: contain; border-radius: 2px 6px 6px 2px; border-left: 2px solid var(--color-primary-light); box-shadow: 2px 3px 8px rgba(0,0,0,0.1); }
    .related-cover-ph { width: 80px; height: 120px; background: var(--color-bg); border-radius: 4px; border: 1px solid var(--color-border); display: flex; align-items: center; justify-content: center; }
    .related-cover-ph i { width: 22px; height: 22px; color: var(--color-muted); opacity: .5; }
    .related-body { padding: 12px; }
    .related-book-title { font-size: 12.5px; font-weight: 700; color: var(--color-text); line-height: 1.3; margin-bottom: 3px; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
    .related-book-author { font-size: 11.5px; color: var(--color-muted); }

    /* Responsive */
    @media (max-width: 1100px) {
        .show-layout { grid-template-columns: 260px 1fr; }
        .action-panel { position: static; grid-column: 1 / -1; }
    }
    @media (max-width: 768px) {
        .show-layout { grid-template-columns: 1fr; }
        .cover-panel { position: static; }
        .show-page { padding: 12px 12px 40px; }
        .book-title-main { font-size: 22px; }
        .spec-grid { grid-template-columns: 1fr; }
    }
</style>
@endpush

@section('content')
<div class="show-page">

    {{-- Breadcrumb --}}
    <nav class="breadcrumb">
        <a href="{{ route('student.dashboard') }}">Beranda</a>
        <i data-feather="chevron-right"></i>
        <a href="{{ route('student.catalog.index') }}">Katalog</a>
        <i data-feather="chevron-right"></i>
        <a href="{{ route('student.catalog.index') }}?category={{ $book->category->id }}">{{ $book->category->name }}</a>
        <i data-feather="chevron-right"></i>
        <span style="color:var(--color-text);font-weight:600;">{{ Str::limit($book->title, 40) }}</span>
    </nav>

    <div class="show-layout">

        {{-- ── COVER PANEL ── --}}
        <div class="cover-panel">
            @if($book->cover)
                <img src="{{ Storage::url($book->cover) }}" alt="{{ $book->title }}" class="cover-img" loading="lazy">
            @else
                <div class="cover-ph"><i data-feather="book-open"></i></div>
            @endif
            <div class="cover-trust">
                <i data-feather="check-circle"></i>
                Layanan 100% Gratis<br>Tanpa Biaya Peminjaman
            </div>
        </div>

        {{-- ── INFO PANEL ── --}}
        <div class="info-panel">
            <div class="book-cat-badge">
                <i data-feather="tag"></i>
                {{ $book->category->name }}
            </div>
            <h1 class="book-title-main">{{ $book->title }}</h1>
            <div class="book-author-main">
                <i data-feather="pen-tool"></i>
                {{ $book->author }}
            </div>

            <div class="spec-section-title">Informasi Buku</div>
            <div class="spec-grid">
                <div class="spec-item">
                    <div class="spec-label">Penerbit</div>
                    <div class="spec-value">{{ $book->publisher ?: '—' }}</div>
                </div>
                <div class="spec-item">
                    <div class="spec-label">Tahun Terbit</div>
                    <div class="spec-value">{{ $book->year ?: '—' }}</div>
                </div>
                <div class="spec-item">
                    <div class="spec-label">ISBN</div>
                    <div class="spec-value spec-mono">{{ $book->isbn ?: '—' }}</div>
                </div>
                <div class="spec-item">
                    <div class="spec-label">Stok Total</div>
                    <div class="spec-value">{{ $book->stock }} Eksemplar</div>
                </div>
            </div>

            <div class="spec-section-title">Sinopsis</div>
            <p class="synopsis-text">{{ $book->description ?: 'Buku ini belum memiliki sinopsis lengkap.' }}</p>
        </div>

        {{-- ── ACTION PANEL ── --}}
        <div class="action-panel">
            <div class="action-panel-head">
                <i data-feather="bookmark" style="width:14px;height:14px;display:inline;margin-right:5px;"></i>
                Ajukan Peminjaman
            </div>
            <div class="action-panel-body">
                @php
                    $existingLoan = auth()->user()->loans()->where('book_id', $book->id)->whereIn('status', ['pending', 'approved', 'overdue'])->first();
                @endphp

                {{-- Stock Status --}}
                <div class="stock-wrap">
                    <div class="stock-label">Ketersediaan Stok</div>
                    @if($book->isAvailable())
                        <div class="stock-avail">
                            <i data-feather="check-circle"></i>
                            Tersedia
                        </div>
                        <div class="stock-avail-sub">Tersisa <strong>{{ $book->availableStock() }}</strong> dari {{ $book->stock }} eksemplar</div>
                        @if($book->availableStock() <= 2)
                            <div class="stock-warning">
                                <i data-feather="alert-triangle"></i>
                                Stok hampir habis! Pinjam sebelum kehabisan.
                            </div>
                        @endif
                    @else
                        <div class="stock-empty">
                            <i data-feather="x-circle"></i>
                            Dipinjam Habis
                        </div>
                        <div class="stock-avail-sub" style="margin-top:5px;">Sedang menunggu pengembalian</div>
                        <div class="stock-warning" style="background:#FEF2F2;border-color:#FECACA;color:#dc2626;margin-top:8px;">
                            <i data-feather="alert-octagon"></i>
                            Stok kosong (0). Tidak dapat dipinjam saat ini.
                        </div>
                    @endif
                </div>

                @if($existingLoan)
                    <div class="existing-notice" style="{{ $existingLoan->isOverdue() ? 'background: #FEF2F2; border-color: #FECACA; color: #991B1B;' : '' }}">
                        <i data-feather="{{ $existingLoan->isOverdue() ? 'alert-octagon' : 'info' }}"></i>
                        <div>
                            Kamu sudah memiliki peminjaman aktif untuk buku ini.
                            <div>
                                <span class="existing-status-chip" style="{{ $existingLoan->isOverdue() ? 'color: #dc2626;' : '' }}">
                                    Status: {{ \App\Models\Loan::statusLabel($existingLoan->status) }}
                                </span>
                            </div>
                            @if($existingLoan->isOverdue())
                                <div style="margin-top: 8px; font-size: 12.5px; font-weight: 700; display: flex; align-items: center; gap: 4px;">
                                    <i data-feather="dollar-sign" style="width: 14px; height: 14px;"></i>
                                    Denda: Rp {{ number_format($existingLoan->calculateFine(), 0, ',', '.') }}
                                </div>
                            @endif
                        </div>
                    </div>
                @else
                    @if($book->isAvailable())
                        <form action="{{ route('student.loans.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="book_id" value="{{ $book->id }}">
                            <button type="submit" class="loan-btn" onclick="return appConfirm(this, event, 'Ajukan pinjaman untuk buku ini? Pastikan Anda mengambil buku di perpustakaan jika telah disetujui.');">
                                <i data-feather="book-open"></i>
                                Ajukan Peminjaman
                            </button>
                        </form>
                        <div style="display:flex;justify-content:center;margin-top:10px;">
                            <div class="loan-trust">
                                <i data-feather="shield"></i>
                                Aman & diawasi sistem
                            </div>
                        </div>
                    @else
                        <div class="loan-btn-disabled">
                            <i data-feather="lock"></i>
                            Stok Sedang Habis
                        </div>
                    @endif
                @endif
            </div>
        </div>

    </div>{{-- end layout --}}

    {{-- ── RELATED BOOKS ── --}}
    @if($relatedBooks->count() > 0)
    <div class="related-section">
        <div class="related-title">
            <i data-feather="layers"></i>
            Buku Lain di Kategori {{ $book->category->name }}
        </div>
        <div class="related-grid">
            @foreach($relatedBooks as $related)
            <a href="{{ route('student.catalog.show', $related) }}" class="related-card">
                <div class="related-cover-wrap">
                    @if($related->cover)
                        <img src="{{ Storage::url($related->cover) }}" alt="{{ $related->title }}" class="related-cover" loading="lazy">
                    @else
                        <div class="related-cover-ph"><i data-feather="book"></i></div>
                    @endif
                </div>
                <div class="related-body">
                    <div class="related-book-title">{{ $related->title }}</div>
                    <div class="related-book-author">{{ $related->author }}</div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
    @endif

</div>
@endsection
