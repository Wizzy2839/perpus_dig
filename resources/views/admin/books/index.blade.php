@extends('layouts.app')

@section('title', 'Manajemen Buku')
@section('page-title', 'Manajemen Buku')

@section('topbar-actions')
<a href="{{ route('admin.books.create') }}" class="btn btn-primary">
    <i data-feather="plus"></i>
    Tambah Buku
</a>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <form action="{{ route('admin.books.index') }}" method="GET" class="search-bar" style="margin: 0; width: 100%;">
            <div class="search-input-wrap">
                <i data-feather="search" style="width: 20px; height: 20px;"></i>
                <input type="text" name="search" class="form-control" placeholder="Cari judul, penulis, atau ISBN..." value="{{ request('search') }}">
            </div>
            <select name="category" class="form-control" style="width: auto; min-width: 180px;" onchange="this.form.submit()">
                <option value="">Semua Kategori</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>
            @if(request('search') || request('category'))
                <a href="{{ route('admin.books.index') }}" class="btn btn-ghost" title="Reset Filter">
                    <i data-feather="x"></i>
                </a>
            @endif
        </form>
    </div>
    
    <div class="card-body">
        <div class="books-grid">
            @forelse($books as $book)
            <div class="book-card">
                <div class="book-card-img">
                    @if($book->cover)
                        <img src="{{ Storage::url($book->cover) }}" alt="Cover {{ $book->title }}" class="book-cover" loading="lazy">
                    @else
                        <div class="book-cover-placeholder">
                            <i data-feather="book-open"></i>
                        </div>
                    @endif
                </div>
                <div class="book-card-body">
                    <div style="font-size: 11px; color: var(--color-primary); font-weight: 600; margin-bottom: 4px; text-transform: uppercase;">{{ $book->category->name }}</div>
                    <h3 class="book-card-title" title="{{ $book->title }}">{{ $book->title }}</h3>
                    <div class="book-card-author">{{ $book->author }} &bull; {{ $book->year }}</div>
                    
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 12px; padding-top: 12px; border-top: 1px dashed var(--color-border);">
                        <div>
                            <div style="font-size: 11px; color: var(--color-muted);">Tersedia</div>
                            <div style="display: flex; align-items: center; gap: 6px;">
                                <div style="font-weight: 700; font-size: 14px; {{ $book->isAvailable() ? 'color: var(--color-success);' : 'color: var(--color-danger);' }}">
                                    {{ $book->availableStock() }} / {{ $book->stock }}
                                </div>
                                @if($book->availableStock() == 0)
                                    <span style="font-size: 10px; padding: 2px 6px; border-radius: 4px; background: #fee2e2; color: #dc2626; font-weight: 700;">HABIS</span>
                                @elseif($book->availableStock() <= 2)
                                    <span style="font-size: 10px; padding: 2px 6px; border-radius: 4px; background: #fef3c7; color: #d97706; font-weight: 700; display: inline-flex; align-items: center; gap: 3px;"><i data-feather="alert-triangle" style="width: 10px; height: 10px;"></i> MENIPIS</span>
                                @endif
                            </div>
                        </div>
                        <div style="display: flex; gap: 4px;">
                            <a href="{{ route('admin.books.edit', $book) }}" class="btn btn-ghost btn-sm" title="Edit Buku">
                                <i data-feather="edit-2"></i>
                            </a>
                            <form action="{{ route('admin.books.destroy', $book) }}" method="POST" onsubmit="return appConfirm(this, event, 'Apakah Anda yakin ingin menghapus buku ini dari sistem?');">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-ghost btn-sm text-danger" title="Hapus Buku">
                                    <i data-feather="trash-2"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div style="grid-column: 1 / -1;" class="empty-state">
                <i data-feather="book-open" style="width: 48px; height: 48px; color: var(--color-muted); opacity: 0.5; margin-bottom: 16px;"></i>
                <h3>Tidak ada buku ditemukan</h3>
                <p>Belum ada buku dalam katalog atau pencarian tidak cocok.</p>
                @if(!request('search') && !request('category'))
                    <a href="{{ route('admin.books.create') }}" class="btn btn-primary mt-4" style="margin: 0 auto;">Tambah Buku Pertama</a>
                @endif
            </div>
            @endforelse
        </div>
        
        <div style="margin-top: 24px;">
            {{ $books->links('pagination::default') }}
        </div>
    </div>
</div>
@endsection
