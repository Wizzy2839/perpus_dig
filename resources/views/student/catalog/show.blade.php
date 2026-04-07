@extends('layouts.app')

@section('title', $book->title)
@section('page-title', 'Detail Buku')

@push('styles')
<style>
    /* Styling E-commerce Detail Layout */
    .ecommerce-detail-layout { display: flex; gap: 40px; align-items: flex-start; }
    .ecommerce-gallery { width: 320px; flex-shrink: 0; background: #fff; border: 1px solid var(--color-border); border-radius: var(--radius); padding: 32px 24px; position: sticky; top: 96px; display: flex; flex-direction: column; align-items: center; box-shadow: var(--shadow-sm); }
    .ecommerce-info { flex: 1; min-width: 0; }
    .ecommerce-action-box { width: 320px; flex-shrink: 0; background: #fff; border: 1px solid var(--color-border); border-radius: var(--radius); padding: 24px; box-shadow: var(--shadow-sm); position: sticky; top: 96px; }

    @media (max-width: 1100px) {
        .ecommerce-action-box { display: none; } /* We will show mobile action box inside info */
        .ecommerce-info-action-mobile { display: block !important; margin-top: 32px; border-top: 1px dashed var(--color-border); padding-top: 24px; }
    }
    @media (min-width: 1101px) {
        .ecommerce-info-action-mobile { display: none !important; }
    }

    @media (max-width: 768px) {
        .ecommerce-detail-layout { flex-direction: column; gap: 24px; }
        .ecommerce-gallery { width: 100%; position: static; }
    }

    .book-cover-large { width: 100%; max-width: 240px; height: auto; object-fit: contain; box-shadow: 4px 8px 24px rgba(0,0,0,0.15); border-radius: 4px 12px 12px 4px; border-left: 3px solid #e2e8f0; margin-bottom: 24px; }
    
    .detail-badge { display: inline-block; padding: 6px 16px; border-radius: 20px; font-size: 11.5px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; }

    .spec-table { width: 100%; border-collapse: collapse; margin-bottom: 32px; }
    .spec-table td { padding: 14px 0; border-bottom: 1px solid var(--color-border); font-size: 14.5px; }
    .spec-table td:first-child { width: 160px; color: var(--color-muted); font-weight: 600; }
    .spec-table td:last-child { color: var(--color-text); font-weight: 500; }
    
    /* Product card from index for related items */
    .product-card { background: #fff; border: 1px solid var(--color-border); border-radius: var(--radius); overflow: hidden; display: flex; flex-direction: column; transition: transform 0.2s, box-shadow 0.2s; height: 100%; text-decoration: none !important; }
    .product-card:hover { transform: translateY(-6px); box-shadow: 0 12px 24px rgba(0,0,0,0.08); z-index: 2; border-color: var(--color-primary-light); }
    .product-img-wrap { background: #f0f4f8; padding: 24px 20px; display: flex; align-items: center; justify-content: center; position: relative; border-bottom: 1px solid var(--color-border); }
    .product-img { height: 180px; width: auto; max-width: 100%; object-fit: contain; box-shadow: 2px 4px 12px rgba(0,0,0,0.15); border-radius: 2px 8px 8px 2px; border-left: 3px solid #e2e8f0; } 
    .product-info-card { padding: 18px; display: flex; flex-direction: column; flex: 1; border-top: 1px solid #fff; }
    .product-title { font-size: 15px; font-weight: 700; color: var(--color-text); margin-bottom: 4px; line-height: 1.4; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
    .product-author { font-size: 13px; color: var(--color-muted); margin-bottom: 0; }
    .product-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 24px; }
</style>
@endpush

@section('content')

<!-- Breadcrumbs (E-commerce style) -->
<nav style="margin-bottom: 32px; font-size: 13.5px; color: var(--color-muted); display: flex; align-items: center; gap: 8px;">
    <a href="{{ route('student.dashboard') }}" style="color: var(--color-primary); text-decoration: none;">Beranda</a>
    <i data-feather="chevron-right" style="width: 14px; height: 14px;"></i>
    <a href="{{ route('student.catalog.index') }}" style="color: var(--color-primary); text-decoration: none;">Katalog</a>
    <i data-feather="chevron-right" style="width: 14px; height: 14px;"></i>
    <span style="color: var(--color-text); font-weight: 500;">{{ $book->category->name }}</span>
</nav>

<div class="ecommerce-detail-layout">
    <!-- Left: Image Gallery -->
    <div class="ecommerce-gallery">
        @if($book->cover)
            <img src="{{ Storage::url($book->cover) }}" alt="Cover {{ $book->title }}" class="book-cover-large" loading="lazy">
        @else
            <div style="width: 100%; max-width: 240px; aspect-ratio: 3/4; background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%); display: flex; align-items: center; justify-content: center; box-shadow: 4px 8px 24px rgba(0,0,0,0.1); border-radius: 4px 12px 12px 4px; border-left: 3px solid #cbd5e1; margin-bottom: 24px;">
                <i data-feather="book-open" style="width: 64px; height: 64px; color: #94a3b8;"></i>
            </div>
        @endif
        
        <div style="width: 100%; display: flex; justify-content: center; border-top: 1px dashed var(--color-border); padding-top: 20px;">
            <div style="text-align: center; font-size: 11.5px; font-weight: 600; color: var(--color-muted); display: flex; flex-direction: column; align-items: center; gap: 8px;">
                <i data-feather="check-circle" style="width: 24px; height: 24px;"></i>
                <span style="line-height: 1.4;">Jaminan Kemudahan Layanan.<br>Peminjaman 100% Gratis.</span>
            </div>
        </div>
    </div>

    <!-- Center: Product Info -->
    <div class="ecommerce-info">
        <div style="background: #fff; padding: 40px; border-radius: var(--radius); border: 1px solid var(--color-border); box-shadow: var(--shadow-sm); margin-bottom: 32px;">
            <div class="detail-badge" style="background: rgba(37, 99, 168, 0.1); color: var(--color-primary); margin-bottom: 16px; display: inline-flex; align-items: center; gap: 6px;">
                <i data-feather="book" style="width: 14px; height: 14px;"></i>
                {{ $book->category->name }}
            </div>
            
            <h1 style="font-size: 34px; font-weight: 800; line-height: 1.3; margin-bottom: 12px; color: var(--color-text);">{{ $book->title }}</h1>
            <div style="font-size: 16px; color: var(--color-primary); font-weight: 600; margin-bottom: 32px; display: flex; align-items: center; gap: 8px;">
                <i data-feather="pen-tool" style="width: 18px; height: 18px;"></i>
                Oleh: <span style="text-decoration: underline; text-decoration-color: rgba(37, 99, 168, 0.3);">{{ $book->author }}</span>
            </div>
            
            <h3 style="font-size: 18px; font-weight: 700; margin-bottom: 16px; border-bottom: 2px solid var(--color-bg); padding-bottom: 12px;">Detail Buku</h3>
            <table class="spec-table">
                <tr>
                    <td>Penerbit</td>
                    <td>{{ $book->publisher ?: 'Tidak ada informasi' }}</td>
                </tr>
                <tr>
                    <td>Tahun Terbit</td>
                    <td>{{ $book->year ?: 'Tidak ada informasi' }}</td>
                </tr>
                <tr>
                    <td>ISBN</td>
                    <td><span style="font-family: monospace; background: var(--color-bg); padding: 2px 6px; border-radius: 4px;">{{ $book->isbn ?: '-' }}</span></td>
                </tr>
                <tr>
                    <td>Stok Total</td>
                    <td>{{ $book->stock }} Eksemplar</td>
                </tr>
            </table>

            <h3 style="font-size: 18px; font-weight: 700; margin-bottom: 16px;">Sinopsis Deskripsi</h3>
            <p style="font-size: 15.5px; line-height: 1.8; color: var(--color-text); white-space: pre-line; opacity: 0.9;">{{ $book->description ?: 'Buku ini belum memiliki sinopsis lengkap.' }}</p>

            <!-- Mobile Action Box (If screen is too small for right sidebar) -->
            <div class="ecommerce-info-action-mobile">
                @php
                    $existingLoan = auth()->user()->loans()->where('book_id', $book->id)->whereIn('status', ['pending', 'approved', 'overdue'])->first();
                @endphp
                
                <h3 style="font-size: 18px; font-weight: 700; margin-bottom: 16px;">Atur Peminjaman</h3>
                @include('student.catalog.partials.action-content')
            </div>
        </div>
    </div>

    <!-- Right: Desktop Action Box (Add To Cart style) -->
    <div class="ecommerce-action-box">
        @php
            $existingLoan = auth()->user()->loans()->where('book_id', $book->id)->whereIn('status', ['pending', 'approved', 'overdue'])->first();
        @endphp
        
        <h3 style="font-size: 16px; font-weight: 700; margin-bottom: 24px; padding-bottom: 16px; border-bottom: 1px solid var(--color-border); text-align: center; color: var(--color-primary-dark);">Konfirmasi Peminjaman</h3>
        @include('student.catalog.partials.action-content')
    </div>
</div>

@if($relatedBooks->count() > 0)
    <div style="margin-top: 48px; border-top: 1px solid var(--color-border); padding-top: 48px;">
        <h2 style="font-size: 24px; font-weight: 800; margin-bottom: 32px; text-align: center;">Buku Relevan di {{ $book->category->name }} Terkait</h2>
        <div class="product-grid">
            @foreach($relatedBooks as $related)
            <a href="{{ route('student.catalog.show', $related) }}" class="product-card">
                <div class="product-img-wrap">
                    @if($related->cover)
                        <img src="{{ Storage::url($related->cover) }}" alt="Cover" class="product-img" loading="lazy">
                    @else
                        <div class="book-cover-placeholder" style="width: 100px; height: 140px; box-shadow: 2px 4px 12px rgba(0,0,0,0.1); border-radius: 4px;">
                            <i data-feather="book-open" style="width: 24px; height: 24px;"></i>
                        </div>
                    @endif
                </div>
                <div class="product-info-card">
                    <h3 class="product-title">{{ $related->title }}</h3>
                    <div class="product-author">{{ $related->author }}</div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
@endif

@endsection
