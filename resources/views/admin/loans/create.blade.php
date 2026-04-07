@extends('layouts.app')

@section('title', 'Input Peminjaman Baru')
@section('page-title', 'Input Peminjaman Baru')

@section('topbar-actions')
<a href="{{ route('admin.loans.index') }}" class="btn btn-ghost">
    <i data-feather="arrow-left"></i>
    Kembali
</a>
@endsection

@section('content')
<div class="card" style="max-width: 600px; margin: 0 auto;">
    <form action="{{ route('admin.loans.store') }}" method="POST">
        @csrf
        
        <div class="card-header">
            <h2>Pilih Anggota & Buku</h2>
        </div>
        
        <div class="card-body">
            <!-- Peringatan batas pinjaman bisa ditampilkan dengan JS/Livewire jika mau, tp sementara via controller -->
            
            <div class="form-group">
                <label class="form-label" for="user_id">Peminjam (Anggota) <span class="text-danger">*</span></label>
                <select name="user_id" id="user_id" class="form-control" required autofocus>
                    <option value="">-- Pilih Anggota --</option>
                    @foreach($members as $member)
                        <option value="{{ $member->id }}" {{ old('user_id') == $member->id ? 'selected' : '' }}>
                            {{ $member->nis }} - {{ $member->name }} ({{ $member->kelas }})
                        </option>
                    @endforeach
                </select>
            </div>
            
            <div class="form-group">
                <label class="form-label" for="book_id">Buku <span class="text-danger">*</span></label>
                <select name="book_id" id="book_id" class="form-control" required>
                    <option value="">-- Pilih Buku --</option>
                    @foreach($books as $book)
                        <!-- Jika stok kosong, disable opsi -->
                        <option value="{{ $book->id }}" {{ !$book->isAvailable() ? 'disabled' : '' }} {{ old('book_id') == $book->id ? 'selected' : '' }}>
                            {{ $book->title }} - {{ $book->author }} (Sisa Stok: {{ $book->availableStock() }})
                        </option>
                    @endforeach
                </select>
                <div class="form-hint" style="margin-top: 6px;">Durasi peminjaman default adalah {{ \App\Models\Setting::get('loan_duration_days', 7) }} hari dari hari ini.</div>
            </div>
            
            <div class="form-group mb-0">
                <label class="form-label" for="notes">Catatan (Opsional)</label>
                <textarea name="notes" id="notes" class="form-control" rows="3" placeholder="Kondisi buku, kesepakatan, dll.">{{ old('notes') }}</textarea>
            </div>
        </div>
        
        <div class="card-footer" style="padding: 16px 24px; border-top: 1px solid var(--color-border); background: #f8fafc; text-align: right;">
            <button type="submit" class="btn btn-primary">
                <i data-feather="save"></i>
                Catat Peminjaman
            </button>
        </div>
    </form>
</div>
@endsection
