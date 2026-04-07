@extends('layouts.app')

@section('title', 'Katalog Buku')
@section('page-title', 'Temukan Koleksi Kami')

@push('styles')
<style>
    .catalog-wrapper { display: flex; align-items: flex-start; gap: 32px; }
    .catalog-sidebar { width: 260px; flex-shrink: 0; position: sticky; top: 96px; }
    .catalog-main { flex: 1; min-width: 0; }
    
    @media (max-width: 992px) {
        .catalog-wrapper { flex-direction: column; }
        .catalog-sidebar { width: 100%; position: static; }
    }

    .filter-card { background: #fff; border: 1px solid var(--color-border); border-radius: var(--radius); padding: 24px; box-shadow: var(--shadow-sm); }
    
    .product-card { background: #fff; border: 1px solid var(--color-border); border-radius: var(--radius); overflow: hidden; display: flex; flex-direction: column; transition: transform 0.2s, box-shadow 0.2s; height: 100%; text-decoration: none !important; }
    .product-card:hover { transform: translateY(-6px); box-shadow: 0 12px 24px rgba(0,0,0,0.08); z-index: 2; border-color: var(--color-primary-light); }
    
    .product-img-wrap { background: #f0f4f8; padding: 24px 20px; display: flex; align-items: center; justify-content: center; position: relative; border-bottom: 1px solid var(--color-border); }
    .product-img { height: 180px; width: auto; max-width: 100%; object-fit: contain; box-shadow: 2px 4px 12px rgba(0,0,0,0.15); border-radius: 2px 8px 8px 2px; border-left: 3px solid #e2e8f0; } 
    
    .product-info { padding: 18px; display: flex; flex-direction: column; flex: 1; border-top: 1px solid #fff; }
    .product-category { font-size: 10px; font-weight: 700; color: var(--color-primary-light); text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 6px; }
    .product-title { font-size: 15px; font-weight: 700; color: var(--color-text); margin-bottom: 4px; line-height: 1.4; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
    .product-author { font-size: 13px; color: var(--color-muted); margin-bottom: 16px; }
    
    .product-actions { margin-top: auto; }
    .product-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 24px; }
    
    /* Badges Overlay */
    .status-badge { position: absolute; top: 12px; right: 12px; padding: 4px 10px; border-radius: 20px; font-size: 11px; font-weight: 600; box-shadow: var(--shadow-sm); z-index: 5; }
    .status-badge.available { background: var(--color-success); color: #fff; }
    .status-badge.unavailable { background: var(--color-danger); color: #fff; }
    
    /* Custom Radio Buttons */
    .custom-radio { display: flex; align-items: center; gap: 10px; cursor: pointer; padding: 6px 0; }
    .custom-radio input[type="radio"] { appearance: none; width: 18px; height: 18px; border: 2px solid var(--color-border); border-radius: 50%; margin: 0; outline: none; transition: border-color 0.2s; position: relative; }
    .custom-radio input[type="radio"]:checked { border-color: var(--color-primary); }
    .custom-radio input[type="radio"]:checked::after { content: ''; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 8px; height: 8px; background: var(--color-primary); border-radius: 50%; }
    .custom-radio .label-text { font-size: 14.5px; color: var(--color-text); }
</style>
@endpush

@section('content')

<!-- Hero Banner (Promo Style) -->
<div style="background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-light) 100%); border-radius: var(--radius); padding: 40px; margin-bottom: 32px; color: #fff; display: flex; align-items: center; justify-content: space-between; overflow: hidden; position: relative; box-shadow: var(--shadow-md);">
    <div style="position: relative; z-index: 2; max-width: 600px;">
        <span style="background: rgba(255,255,255,0.2); backdrop-filter: blur(4px); padding: 4px 12px; border-radius: 20px; font-size: 11px; font-weight: 700; letter-spacing: 1px; margin-bottom: 16px; display: inline-block;">KOLEKSI DIGITAL</span>
        <h2 style="font-size: 30px; font-weight: 800; margin-bottom: 12px; line-height: 1.2;">Jelajahi Dunia Melalui Buku</h2>
        <p style="font-size: 15px; opacity: 0.9; line-height: 1.6; margin: 0;">Temukan ribuan karya menarik dari berbagai genre. Pinjam langsung tanpa ribet, cepat dan praktis!</p>
    </div>
    <!-- Dekorasi Lingkaran -->
    <div style="position: absolute; right: -50px; top: -100px; width: 300px; height: 300px; border-radius: 50%; background: linear-gradient(135deg, rgba(255,255,255,0.1), rgba(255,255,255,0)); z-index: 1;"></div>
    <div style="position: absolute; right: 150px; bottom: -80px; width: 200px; height: 200px; border-radius: 50%; background: linear-gradient(135deg, rgba(255,255,255,0.1), rgba(255,255,255,0)); z-index: 1;"></div>
</div>

<div class="catalog-wrapper">
    <!-- E-Commerce Left Sidebar (Filters) -->
    <aside class="catalog-sidebar">
        <form action="{{ route('student.catalog.index') }}" method="GET" id="filterForm">
            <div class="filter-card">
                
                <!-- Search Box -->
                <div style="margin-bottom: 24px;">
                    <h3 style="font-size: 12px; text-transform: uppercase; color: var(--color-muted); font-weight: 700; letter-spacing: 0.5px; margin-bottom: 12px;">Cari Judul</h3>
                    <div style="position: relative;">
                        <i data-feather="search" style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); width: 16px; height: 16px; color: var(--color-muted);"></i>
                        <input type="text" name="search" class="form-control" placeholder="Ketik kata kunci..." value="{{ request('search') }}" style="padding-left: 36px; padding-right: 12px;" onkeydown="if(event.key === 'Enter') this.form.submit()">
                    </div>
                </div>

                <hr style="border: 0; border-top: 1px solid var(--color-border); margin: 0 0 24px;">

                <!-- Category Filters -->
                <div style="margin-bottom: 24px;">
                    <h3 style="font-size: 12px; text-transform: uppercase; color: var(--color-muted); font-weight: 700; letter-spacing: 0.5px; margin-bottom: 12px;">Kategori</h3>
                    <div style="display: flex; flex-direction: column; gap: 4px;">
                        <label class="custom-radio">
                            <input type="radio" name="category" value="" {{ request('category') == '' ? 'checked' : '' }} onchange="document.getElementById('filterForm').submit()">
                            <span class="label-text">Semua Kategori</span>
                        </label>
                        @foreach($categories as $cat)
                        <label class="custom-radio">
                            <input type="radio" name="category" value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'checked' : '' }} onchange="document.getElementById('filterForm').submit()">
                            <span class="label-text">{{ $cat->name }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>

                @if(request('search') || request('category'))
                    <a href="{{ route('student.catalog.index') }}" class="btn btn-outline" style="width: 100%; justify-content: center; font-weight: 600;">Reset Filter</a>
                @endif
            </div>
        </form>
    </aside>

    <!-- E-Commerce Main Product Grid -->
    <main class="catalog-main">
        <!-- Results count -->
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; background: #fff; padding: 12px 20px; border-radius: var(--radius); border: 1px solid var(--color-border); box-shadow: var(--shadow-sm);">
            <div style="font-size: 14.5px; color: var(--color-text);">
                Menampilkan <strong>{{ $books->total() }}</strong> hasil buku.
            </div>
            <!-- Optionally Add Sorting Dropdown Here in the future -->
        </div>

        @if($books->isEmpty())
            <div class="empty-state" style="background: #fff; border: 1px solid var(--color-border); border-radius: var(--radius); padding: 48px;">
                <i data-feather="search" style="width: 64px; height: 64px; color: var(--color-muted); opacity: 0.5; margin-bottom: 16px;"></i>
                <h3>Yah, buku tidak ditemukan</h3>
                <p>Coba gunakan kata kunci lain atau pilih kategori yang berbeda.</p>
                <a href="{{ route('student.catalog.index') }}" class="btn btn-primary mt-4">Lihat Semua Buku</a>
            </div>
        @else
            <div class="product-grid">
                @foreach($books as $book)
                    <a href="{{ route('student.catalog.show', $book) }}" class="product-card">
                        <div class="product-img-wrap">
                            @if($book->isAvailable())
                                <div class="status-badge available">Tersedia</div>
                            @else
                                <div class="status-badge unavailable">Dipinjam</div>
                            @endif

                            @if($book->cover)
                                <img src="{{ Storage::url($book->cover) }}" alt="Cover {{ $book->title }}" class="product-img" loading="lazy">
                            @else
                                <div class="book-cover-placeholder" style="width: 130px; height: 180px; box-shadow: 2px 4px 12px rgba(0,0,0,0.1); border-radius: 4px;">
                                    <i data-feather="book-open" style="width: 32px; height: 32px;"></i>
                                </div>
                            @endif
                        </div>
                        <div class="product-info">
                            <div class="product-category">{{ $book->category->name }}</div>
                            <h3 class="product-title">{{ $book->title }}</h3>
                            <div class="product-author">{{ $book->author }}</div>
                            
                            <div class="product-actions">
                                <div class="btn btn-outline" style="width: 100%; justify-content: center; font-size: 13px; font-weight: 600; padding: 10px;">
                                    Detail & Pinjam
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>

            <div style="margin-top: 32px;">
                {{ $books->links('pagination::default') }}
            </div>
        @endif
    </main>
</div>

@endsection
