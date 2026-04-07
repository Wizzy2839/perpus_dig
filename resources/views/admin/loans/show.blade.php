@extends('layouts.app')

@section('title', 'Detail Peminjaman')
@section('page-title', 'Detail Peminjaman')

@section('topbar-actions')
<a href="{{ route('admin.loans.index') }}" class="btn btn-ghost">
    <i data-feather="arrow-left"></i>
    Kembali
</a>
@endsection

@section('content')
<div style="display: grid; grid-template-columns: 2fr 1fr; gap: 24px;">
    <!-- Detail Peminjaman & Buku -->
    <div style="display: flex; flex-direction: column; gap: 24px;">
        <div class="card">
            <div class="card-header">
                <h2>Informasi Transaksi #{{ str_pad($loan->id, 4, '0', STR_PAD_LEFT) }}</h2>
                <span class="badge {{ \App\Models\Loan::statusBadgeClass($loan->status) }}">
                    {{ \App\Models\Loan::statusLabel($loan->status) }}
                </span>
            </div>
            <div class="card-body">
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px; margin-bottom: 24px;">
                    <div>
                        <h4 style="font-size: 12px; color: var(--color-muted); text-transform: uppercase;">Tanggal Pinjam</h4>
                        <div style="font-weight: 600; font-size: 15px;">{{ $loan->loan_date->format('d M Y') }}</div>
                    </div>
                    <div>
                        <h4 style="font-size: 12px; color: var(--color-muted); text-transform: uppercase;">Jatuh Tempo</h4>
                        <div style="font-weight: 600; font-size: 15px;">{{ $loan->due_date->format('d M Y') }}</div>
                    </div>
                    <div>
                        <h4 style="font-size: 12px; color: var(--color-muted); text-transform: uppercase;">Tanggal Kembali</h4>
                        <div style="font-weight: 600; font-size: 15px;">{{ $loan->return_date ? $loan->return_date->format('d M Y') : '-' }}</div>
                    </div>
                    <div>
                        <h4 style="font-size: 12px; color: var(--color-muted); text-transform: uppercase;">Total Denda</h4>
                        <div style="font-weight: 700; font-size: 15px; color: var(--color-danger);">
                            Rp {{ number_format($loan->fine_amount, 0, ',', '.') }}
                        </div>
                    </div>
                </div>
                
                @if($loan->notes)
                <div>
                    <h4 style="font-size: 12px; color: var(--color-muted); text-transform: uppercase; margin-bottom: 8px;">Catatan</h4>
                    <div style="background: var(--color-bg); padding: 12px; border-radius: var(--radius); font-size: 13.5px;">
                        {{ $loan->notes }}
                    </div>
                </div>
                @endif
                
                @if($loan->isOverdue())
                    <div class="alert alert-error" style="margin-top: 24px; margin-bottom: 0;">
                        <i data-feather="alert-triangle"></i>
                        Peminjam terlambat mengembalikan buku selama {{ $loan->daysOverdue() }} hari. Denda saat ini tercatat Rp {{ number_format($loan->calculateFine(), 0, ',', '.') }}
                    </div>
                @endif
            </div>

            <!-- Panel Aksi -->
            <div class="card-footer" style="padding: 16px 24px; border-top: 1px solid var(--color-border); background: #f8fafc; display: flex; gap: 8px; justify-content: flex-end;">
                @if($loan->status === 'pending')
                    <form action="{{ route('admin.loans.reject', $loan) }}" method="POST">
                        @csrf @method('PATCH')
                        <button type="submit" class="btn btn-outline" style="color: var(--color-danger); border-color: var(--color-danger);" onclick="return appConfirm(this, event, 'Anda yakin ingin menolak permohonan peminjaman ini?');">Tolak Peminjaman</button>
                    </form>
                    <form action="{{ route('admin.loans.approve', $loan) }}" method="POST">
                        @csrf @method('PATCH')
                        <button type="submit" class="btn btn-success" style="background: var(--color-success); color: #fff;">Setujui Peminjaman</button>
                    </form>
                @elseif(in_array($loan->status, ['approved', 'overdue']))
                    <form action="{{ route('admin.loans.return', $loan) }}" method="POST">
                        @csrf @method('PATCH')
                        <button type="submit" class="btn btn-primary" onclick="return appConfirm(this, event, 'Tandai buku ini sebagai telah dikembalikan?');" style="background: var(--color-primary); color: #fff;">Kembalikan Buku</button>
                    </form>
                @endif
            </div>
        </div>
        
        <div class="card">
            <div class="card-header">
                <h2>Buku yang Dipinjam</h2>
            </div>
            <div class="card-body">
                <div style="display: flex; gap: 16px;">
                    <div style="width: 80px;">
                        @if($loan->book->cover)
                            <img src="{{ Storage::url($loan->book->cover) }}" class="book-cover" style="box-shadow: var(--shadow-sm);" loading="lazy">
                        @else
                            <div class="book-cover-placeholder">
                                <i data-feather="book-open" style="color: var(--color-muted);"></i>
                            </div>
                        @endif
                    </div>
                    <div>
                        <div style="font-size: 11.5px; color: var(--color-primary); font-weight: 600; text-transform: uppercase;">{{ $loan->book->category->name }}</div>
                        <h3 style="font-size: 16px; margin: 4px 0;">{{ $loan->book->title }}</h3>
                        <div style="color: var(--color-muted); font-size: 13.5px; margin-bottom: 8px;">Penulis: {{ $loan->book->author }}</div>
                        <div style="color: var(--color-text); font-size: 13.5px;">ISBN: {{ $loan->book->isbn ?: '-' }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Detail Anggota -->
    <div class="card" style="align-self: flex-start;">
        <div class="card-header">
            <h2>Peminjam</h2>
        </div>
        <div class="card-body">
            <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 20px;">
                <div style="width: 50px; height: 50px; border-radius: 50%; background: var(--color-primary-light); color: white; display: flex; align-items: center; justify-content: center; font-size: 20px; font-weight: 700;">
                    {{ substr($loan->user->name, 0, 1) }}
                </div>
                <div>
                    <div style="font-weight: 600; font-size: 15px;">{{ $loan->user->name }}</div>
                    <div style="font-size: 12px; color: var(--color-muted);">{{ $loan->user->email }}</div>
                </div>
            </div>
            
            <div style="display: grid; gap: 12px;">
                <div>
                    <div style="font-size: 12px; color: var(--color-muted);">NIS</div>
                    <div style="font-weight: 500;">{{ $loan->user->nis }}</div>
                </div>
                <div>
                    <div style="font-size: 12px; color: var(--color-muted);">Kelas</div>
                    <div style="font-weight: 500;">{{ $loan->user->kelas }}</div>
                </div>
                <div>
                    <div style="font-size: 12px; color: var(--color-muted);">Telepon</div>
                    <div style="font-weight: 500;">{{ $loan->user->phone ?: '-' }}</div>
                </div>
            </div>
            
            <div style="margin-top: 24px; text-align: center;">
                <a href="{{ route('admin.members.show', $loan->user) }}" class="btn btn-outline" style="width: 100%; justify-content: center;">Lihat Profil Lengkap</a>
            </div>
        </div>
    </div>
</div>
@endsection
