@extends('layouts.app')

@section('title', 'Tambah Buku Baru')
@section('page-title', 'Tambah Buku Baru')

@section('topbar-actions')
<a href="{{ route('admin.books.index') }}" class="btn btn-ghost">
    <i data-feather="arrow-left"></i>
    Kembali
</a>
@endsection

@section('content')
<div class="card" style="max-width: 800px; margin: 0 auto;">
    <form action="{{ route('admin.books.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="card-header">
            <h2>Informasi Buku</h2>
        </div>
        
        <div class="card-body">
            <div class="form-group">
                <label class="form-label" for="title">Judul Buku <span class="text-danger">*</span></label>
                <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" required>
                @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label" for="author">Penulis / Pengarang <span class="text-danger">*</span></label>
                    <input type="text" name="author" id="author" class="form-control @error('author') is-invalid @enderror" value="{{ old('author') }}" required>
                    @error('author') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                
                <div class="form-group">
                    <label class="form-label" for="category_id">Kategori <span class="text-danger">*</span></label>
                    <select name="category_id" id="category_id" class="form-control @error('category_id') is-invalid @enderror" required>
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label" for="publisher">Penerbit</label>
                    <input type="text" name="publisher" id="publisher" class="form-control @error('publisher') is-invalid @enderror" value="{{ old('publisher') }}">
                    @error('publisher') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                
                <div class="form-group">
                    <label class="form-label" for="year">Tahun Terbit</label>
                    <input type="number" name="year" id="year" min="1900" max="{{ date('Y') }}" class="form-control @error('year') is-invalid @enderror" value="{{ old('year') }}">
                    @error('year') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label" for="isbn">ISBN</label>
                    <input type="text" name="isbn" id="isbn" class="form-control @error('isbn') is-invalid @enderror" value="{{ old('isbn') }}">
                    @error('isbn') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                
                <div class="form-group">
                    <label class="form-label" for="stock">Jumlah Stok <span class="text-danger">*</span></label>
                    <input type="number" name="stock" id="stock" min="1" class="form-control @error('stock') is-invalid @enderror" value="{{ old('stock', 1) }}" required>
                    @error('stock') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>
            
            <div class="form-group">
                <label class="form-label" for="description">Deskripsi / Sinopsis</label>
                <textarea name="description" id="description" rows="4" class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            
            <div class="form-group">
                <label class="form-label" for="cover">Sampul Buku (Opsional)</label>
                <div style="display: flex; gap: 16px; align-items: flex-start;">
                    <div style="width: 120px; height: 160px; background: var(--color-bg); border-radius: var(--radius); border: 2px dashed var(--color-border); display: flex; align-items: center; justify-content: center; overflow: hidden;" id="coverPreviewContainer">
                        <i data-feather="image" style="color: var(--color-muted);"></i>
                        <img id="coverPreview" style="display: none; width: 100%; height: 100%; object-fit: cover;">
                    </div>
                    <div style="flex: 1;">
                        <input type="file" name="cover" id="cover" class="form-control @error('cover') is-invalid @enderror" accept="image/*" onchange="previewImage(this)">
                        <div class="form-hint">Format yang diizinkan: JPG, JPEG, PNG. Maksimal 2MB. Rasio ideal 3:4.</div>
                        @error('cover') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
            </div>
        </div>
        
        <div class="card-footer" style="padding: 16px 24px; border-top: 1px solid var(--color-border); background: #f8fafc; text-align: right;">
            <button type="submit" class="btn btn-primary">
                <i data-feather="save"></i>
                Simpan Buku
            </button>
        </div>
    </form>
</div>

@push('scripts')
<script>
    function previewImage(input) {
        var preview = document.getElementById('coverPreview');
        var container = document.getElementById('coverPreviewContainer');
        var icon = container.querySelector('i');
        
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
                if(icon) icon.style.display = 'none';
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endpush
@endsection
