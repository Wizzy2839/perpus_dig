@extends('layouts.app')

@section('title', 'Katalog Buku')
@section('page-title', 'Katalog Buku')

@push('styles')
<style>
    .cat-page { max-width: 1200px; margin: 0 auto; padding: 24px 24px 48px; }

    /* ── PAGE HEADER ── */
    .cat-header {
        background: linear-gradient(135deg, var(--color-primary-dark) 0%, var(--color-primary) 60%, var(--color-primary-light) 100%);
        border-radius: 14px;
        padding: 32px 36px;
        margin-bottom: 24px;
        color: #fff;
        position: relative;
        overflow: hidden;
        box-shadow: 0 10px 28px rgba(26,60,94,0.2);
    }
    .cat-header::before {
        content: '';
        position: absolute;
        right: -60px; top: -60px;
        width: 250px; height: 250px;
        border-radius: 50%;
        border: 35px solid rgba(255,255,255,0.05);
    }
    .cat-header-content { position: relative; z-index: 2; }
    .cat-header-badge {
        display: inline-flex; align-items: center; gap: 7px;
        background: rgba(255,255,255,0.13);
        border: 1px solid rgba(255,255,255,0.2);
        border-radius: 100px;
        padding: 4px 14px;
        font-size: 11px; font-weight: 700;
        color: rgba(255,255,255,0.88);
        letter-spacing: .06em; text-transform: uppercase;
        margin-bottom: 12px;
    }
    .cat-header h1 { font-size: 26px; font-weight: 800; letter-spacing: -0.4px; margin-bottom: 6px; }
    .cat-header p { font-size: 14px; opacity: .75; }

    /* ── LAYOUT ── */
    .cat-layout { display: flex; gap: 22px; align-items: flex-start; }
    .cat-sidebar {
        width: 250px;
        flex-shrink: 0;
        position: sticky;
        top: 88px;
        background: #fff;
        border: 1px solid var(--color-border);
        border-radius: 14px;
        overflow: hidden;
        box-shadow: var(--shadow-sm);
    }
    .cat-sidebar-head {
        padding: 16px 18px 14px;
        border-bottom: 1px solid var(--color-border);
        font-size: 11px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: .07em;
        color: var(--color-muted);
        display: flex; align-items: center; gap: 7px;
    }
    .cat-sidebar-head i { width: 14px; height: 14px; }

    /* Search inside sidebar */
    .cat-search-wrap { padding: 14px 16px; border-bottom: 1px solid var(--color-border); }
    .cat-search { position: relative; }
    .cat-search i {
        position: absolute; left: 10px; top: 50%;
        transform: translateY(-50%);
        width: 15px; height: 15px;
        color: var(--color-muted); pointer-events: none;
    }
    .cat-search input {
        width: 100%;
        padding: 9px 12px 9px 33px;
        font-size: 13px; font-family: inherit;
        border: 1.5px solid var(--color-border);
        border-radius: 9px;
        background: var(--color-bg);
        outline: none; color: var(--color-text);
        transition: border-color .2s;
    }
    .cat-search input:focus { border-color: var(--color-primary); background: #fff; }

    /* Category list */
    .cat-cat-list { padding: 10px 10px 14px; display: flex; flex-direction: column; gap: 2px; }
    .cat-cat-item {
        display: flex; align-items: center;
        padding: 8px 10px;
        border-radius: 8px;
        cursor: pointer;
        transition: background .15s;
        gap: 10px;
    }
    .cat-cat-item:hover { background: var(--color-bg); }
    .cat-cat-item input[type="radio"] {
        appearance: none;
        width: 16px; height: 16px;
        border: 2px solid var(--color-border);
        border-radius: 50%;
        flex-shrink: 0;
        outline: none;
        transition: border-color .2s;
        position: relative;
    }
    .cat-cat-item input[type="radio"]:checked {
        border-color: var(--color-primary);
    }
    .cat-cat-item input[type="radio"]:checked::after {
        content: '';
        position: absolute;
        top: 50%; left: 50%; transform: translate(-50%, -50%);
        width: 7px; height: 7px;
        background: var(--color-primary);
        border-radius: 50%;
    }
    .cat-cat-item-label { font-size: 13.5px; color: var(--color-text); font-weight: 500; }
    .cat-cat-item:has(input:checked) { background: #EFF6FF; }
    .cat-cat-item:has(input:checked) .cat-cat-item-label { color: var(--color-primary); font-weight: 700; }

    .cat-reset { display: block; margin: 0 16px 14px; text-align: center; padding: 9px 0; border-radius: 8px; border: 1.5px solid var(--color-border); font-size: 12.5px; font-weight: 700; color: var(--color-muted); text-decoration: none; transition: all .2s; }
    .cat-reset:hover { border-color: var(--color-primary); color: var(--color-primary); background: #EFF6FF; }

    /* ── MAIN AREA ── */
    .cat-main { flex: 1; min-width: 0; }

    /* Results bar */
    .cat-results-bar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 11px 16px;
        background: #fff;
        border: 1px solid var(--color-border);
        border-radius: 10px;
        margin-bottom: 18px;
        font-size: 13.5px;
        box-shadow: var(--shadow-sm);
    }

    /* Grid */
    .cat-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(185px, 1fr)); gap: 16px; }

    /* Book Card */
    .book-card {
        background: #fff;
        border: 1px solid var(--color-border);
        border-radius: 12px;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        text-decoration: none;
        transition: transform .25s, box-shadow .25s, border-color .25s;
        height: 100%;
        box-shadow: var(--shadow-sm);
    }
    .book-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 14px 28px rgba(0,0,0,0.09);
        border-color: var(--color-primary-light);
    }
    .book-cover-wrap {
        background: var(--color-bg);
        padding: 20px 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        border-bottom: 1px solid var(--color-border);
        min-height: 180px;
    }
    .book-cover-img {
        height: 160px;
        width: auto; max-width: 100%;
        object-fit: contain;
        box-shadow: 3px 4px 12px rgba(0,0,0,0.14);
        border-radius: 2px 6px 6px 2px;
        border-left: 3px solid var(--color-primary-light);
    }
    .book-cover-ph {
        width: 110px; height: 160px;
        background: linear-gradient(135deg, #e2e8f0, #f1f5f9);
        border-radius: 4px 8px 8px 4px;
        border-left: 3px solid var(--color-border);
        display: flex; align-items: center; justify-content: center;
    }
    .book-cover-ph i { width: 28px; height: 28px; color: var(--color-muted); opacity: .5; }
    .book-status {
        position: absolute;
        top: 10px; right: 10px;
        padding: 3px 9px;
        border-radius: 100px;
        font-size: 10.5px; font-weight: 700;
        box-shadow: 0 2px 6px rgba(0,0,0,0.12);
    }
    .book-status.avail { background: var(--color-success); color: #fff; }
    .book-status.unavail { background: var(--color-danger); color: #fff; }
    .book-body { padding: 14px; display: flex; flex-direction: column; flex: 1; }
    .book-cat { font-size: 10px; font-weight: 700; color: var(--color-primary-light); text-transform: uppercase; letter-spacing: .04em; margin-bottom: 4px; }
    .book-title { font-size: 13.5px; font-weight: 700; color: var(--color-text); margin-bottom: 3px; line-height: 1.35; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
    .book-author { font-size: 12px; color: var(--color-muted); margin-bottom: 12px; }
    .book-cta { margin-top: auto; display: block; text-align: center; padding: 9px; background: var(--color-bg); border: 1.5px solid var(--color-border); border-radius: 8px; font-size: 12.5px; font-weight: 700; color: var(--color-primary); transition: all .2s; }
    .book-card:hover .book-cta { background: var(--color-primary); border-color: var(--color-primary); color: #fff; }

    /* Empty */
    .cat-empty { background: #fff; border: 1px solid var(--color-border); border-radius: 14px; padding: 56px 24px; text-align: center; }
    .cat-empty i { width: 48px; height: 48px; color: var(--color-muted); opacity: .35; margin-bottom: 14px; }
    .cat-empty h3 { font-size: 16px; font-weight: 700; margin-bottom: 6px; }
    .cat-empty p { font-size: 13.5px; color: var(--color-muted); margin-bottom: 16px; }

    /* Responsive */
    @media (max-width: 992px) {
        .cat-layout { flex-direction: column; }
        .cat-sidebar { width: 100%; position: static; }
        .cat-cat-list { flex-direction: row; flex-wrap: wrap; }
    }
    @media (max-width: 600px) {
        .cat-page { padding: 12px 12px 40px; }
        .cat-header { padding: 24px 20px; }
        .cat-header h1 { font-size: 20px; }
        .cat-grid { grid-template-columns: repeat(2, 1fr); gap: 12px; }
    }
</style>
@endpush

@section('content')
<div class="cat-page">

    {{-- ---- HEADER ---- --}}
    <div class="cat-header">
        <div class="cat-header-content">
            <div class="cat-header-badge">
                <i data-feather="book-open" style="width:12px;height:12px;"></i>
                Koleksi Digital
            </div>
            <h1>Jelajahi Dunia Melalui Buku</h1>
            <p>Temukan ribuan karya menarik dari berbagai genre. Pinjam langsung, gratis dan mudah.</p>
        </div>
    </div>

    <div class="cat-layout">

        {{-- ---- SIDEBAR ---- --}}
        <aside class="cat-sidebar">
            <form action="{{ route('student.catalog.index') }}" method="GET" id="filterForm">
                <div class="cat-sidebar-head">
                    <i data-feather="filter"></i>
                    Filter Koleksi
                </div>

                <div class="cat-search-wrap">
                    <div class="cat-search">
                        <i data-feather="search"></i>
                        <input type="text" name="search"
                            placeholder="Cari judul buku..."
                            value="{{ request('search') }}"
                            onkeydown="if(event.key==='Enter')this.form.submit()">
                    </div>
                </div>

                <div class="cat-cat-list">
                    <label class="cat-cat-item">
                        <input type="radio" name="category" value="" {{ request('category') == '' ? 'checked' : '' }} onchange="document.getElementById('filterForm').submit()">
                        <span class="cat-cat-item-label">Semua Kategori</span>
                    </label>
                    @foreach($categories as $cat)
                    <label class="cat-cat-item">
                        <input type="radio" name="category" value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'checked' : '' }} onchange="document.getElementById('filterForm').submit()">
                        <span class="cat-cat-item-label">{{ $cat->name }}</span>
                    </label>
                    @endforeach
                </div>

                @if(request('search') || request('category'))
                    <a href="{{ route('student.catalog.index') }}" class="cat-reset">
                        <i data-feather="x" style="width:12px;height:12px;display:inline;margin-right:4px;"></i>
                        Reset Filter
                    </a>
                @endif
            </form>
        </aside>

        {{-- ---- MAIN ---- --}}
        <main class="cat-main">
            <div class="cat-results-bar">
                <span>Menampilkan <strong>{{ $books->total() }}</strong> koleksi buku</span>
                @if(request('search'))
                    <span style="font-size:12.5px;color:var(--color-muted);">Hasil untuk: "<em>{{ request('search') }}</em>"</span>
                @endif
            </div>

            @if($books->isEmpty())
                <div class="cat-empty">
                    <i data-feather="search"></i>
                    <h3>Buku tidak ditemukan</h3>
                    <p>Coba kata kunci lain atau reset filter kategori.</p>
                    <a href="{{ route('student.catalog.index') }}" class="btn btn-primary btn-sm">Tampilkan Semua</a>
                </div>
            @else
                <div class="cat-grid">
                    @foreach($books as $book)
                    <a href="{{ route('student.catalog.show', $book) }}" class="book-card">
                        <div class="book-cover-wrap">
                            @if($book->isAvailable())
                                <span class="book-status avail">Tersedia</span>
                            @else
                                <span class="book-status unavail">Penuh</span>
                            @endif

                            @if($book->cover)
                                <img src="{{ Storage::url($book->cover) }}" alt="{{ $book->title }}" class="book-cover-img" loading="lazy">
                            @else
                                <div class="book-cover-ph">
                                    <i data-feather="book"></i>
                                </div>
                            @endif
                        </div>
                        <div class="book-body">
                            <div class="book-cat">{{ $book->category->name }}</div>
                            <div class="book-title">{{ $book->title }}</div>
                            <div class="book-author">{{ $book->author }}</div>
                            <span class="book-cta">Detail &amp; Pinjam</span>
                        </div>
                    </a>
                    @endforeach
                </div>

                <div style="margin-top: 28px; display: flex; justify-content: center;">
                    {{ $books->links('components.pagination') }}
                </div>
            @endif
        </main>
    </div>
</div>
@endsection
