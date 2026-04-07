@extends('layouts.app')

@section('title', 'Buat Peminjaman Baru')
@section('page-title', 'Buat Peminjaman')

@section('topbar-actions')
<a href="{{ route('student.catalog.index') }}" class="btn btn-ghost">
    <i data-feather="arrow-left"></i>
    Batal
</a>
@endsection

@section('content')
<div class="card" style="max-width: 600px; margin: 0 auto;">
    <form action="{{ route('student.loans.store') }}" method="POST">
        @csrf
        <div class="card-header">
            <h2>Pilih Buku untuk Dipinjam</h2>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label class="form-label" for="book_id">Pilih Judul Buku <span class="text-danger">*</span></label>
                <select name="book_id" id="book_id" class="form-control" required autofocus>
                    <option value="">-- Silakan Pilih Buku --</option>
                    @foreach($books as $b)
                        <option value="{{ $b->id }}" {{ ($book && $book->id == $b->id) || old('book_id') == $b->id ? 'selected' : '' }} {{ !$b->isAvailable() ? 'disabled' : '' }}>
                            {{ $b->title }} - {{ $b->author }} @if(!$b->isAvailable()) (Dipinjam Habis) @endif
                        </option>
                    @endforeach
                </select>
                <div class="form-hint" style="margin-top: 8px;">Buku yang sedang habis dipinjam tidak dapat dipilih. Permintaan peminjaman kamu akan dikirimkan untuk disetujui Admin/Petugas.</div>
            </div>

            <div class="form-group mb-0">
                <label class="form-label" for="notes">Catatan (Bila ada)</label>
                <textarea name="notes" id="notes" class="form-control" rows="3" placeholder="Misal: Saya meminjam buku ini untuk tugas kelompok">{{ old('notes') }}</textarea>
            </div>
        </div>
        <div class="card-footer" style="padding: 16px 24px; border-top: 1px solid var(--color-border); background: #f8fafc; text-align: right;">
            <button class="btn btn-primary">
                Ajukan Peminjaman
            </button>
        </div>
    </form>
</div>
@endsection
