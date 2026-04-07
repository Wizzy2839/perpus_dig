@extends('layouts.app')

@section('title', 'Manajemen Peminjaman')
@section('page-title', 'Manajemen Peminjaman')

@section('topbar-actions')
<a href="{{ route('admin.loans.create') }}" class="btn btn-primary">
    <i data-feather="plus"></i>
    Input Peminjaman
</a>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <form action="{{ route('admin.loans.index') }}" method="GET" class="search-bar" style="margin: 0; width: 100%;">
            <div class="search-input-wrap">
                <i data-feather="search" style="width: 20px; height: 20px;"></i>
                <input type="text" name="search" class="form-control" placeholder="Cari nama anggota atau judul buku..." value="{{ request('search') }}">
            </div>
            <select name="status" class="form-control" style="width: auto; min-width: 150px;" onchange="this.form.submit()">
                <option value="">Semua Status</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Menunggu</option>
                <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Dipinjam</option>
                <option value="overdue" {{ request('status') == 'overdue' ? 'selected' : '' }}>Terlambat</option>
                <option value="returned" {{ request('status') == 'returned' ? 'selected' : '' }}>Dikembalikan</option>
                <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Ditolak</option>
            </select>
            @if(request('search') || request('status'))
                <a href="{{ route('admin.loans.index') }}" class="btn btn-ghost" title="Reset Filter">
                    <i data-feather="x"></i>
                </a>
            @endif
        </form>
    </div>
    
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th style="width: 50px;">ID</th>
                    <th>Peminjam</th>
                    <th style="width: 35%;">Buku</th>
                    <th>Tgl Pinjam</th>
                    <th>Jatuh Tempo</th>
                    <th style="text-align: center;">Status</th>
                    <th style="text-align: right; min-width: 140px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($loans as $loan)
                <tr>
                    <td>#{{ str_pad($loan->id, 4, '0', STR_PAD_LEFT) }}</td>
                    <td>
                        <div class="fw-600">{{ $loan->user->name }}</div>
                        <div style="font-size: 11.5px; color: var(--color-muted);">{{ $loan->user->nis }} / {{ $loan->user->kelas }}</div>
                    </td>
                    <td>
                        <div class="fw-600" title="{{ $loan->book->title }}">{{ Str::limit($loan->book->title, 40) }}</div>
                        <div style="font-size: 11.5px; color: var(--color-muted);">Sisa Stok: <span class="{{ $loan->book->availableStock() > 0 ? 'text-success' : 'text-danger' }}">{{ $loan->book->availableStock() }}</span></div>
                    </td>
                    <td>{{ $loan->loan_date->format('d/m/Y') }}</td>
                    <td>
                        @if(in_array($loan->status, ['approved', 'overdue']))
                            <div class="{{ $loan->isOverdue() ? 'text-danger fw-600' : '' }}">{{ $loan->due_date->format('d/m/Y') }}</div>
                            @if($loan->isOverdue())
                                <div style="font-size: 11px; color: var(--color-danger);">Telat {{ $loan->daysOverdue() }} hari</div>
                            @endif
                        @else
                            -
                        @endif
                    </td>
                    <td style="text-align: center;">
                        <span class="badge {{ \App\Models\Loan::statusBadgeClass($loan->status) }}">
                            {{ \App\Models\Loan::statusLabel($loan->status) }}
                        </span>
                    </td>
                    <td style="text-align: right;">
                        <div style="display: flex; gap: 4px; justify-content: flex-end;">
                            @if($loan->status === 'pending')
                                <form action="{{ route('admin.loans.approve', $loan) }}" method="POST">
                                    @csrf @method('PATCH')
                                    <button type="submit" class="btn btn-outline btn-sm text-success" title="Setujui" style="border-color: var(--color-success);">
                                        <i data-feather="check"></i>
                                    </button>
                                </form>
                                <form action="{{ route('admin.loans.reject', $loan) }}" method="POST" onsubmit="return appConfirm(this, event, 'Tolak permohonan peminjaman ini?');">
                                    @csrf @method('PATCH')
                                    <button type="submit" class="btn btn-outline btn-sm text-danger" title="Tolak" style="border-color: var(--color-danger);">
                                        <i data-feather="x"></i>
                                    </button>
                                </form>
                            @elseif(in_array($loan->status, ['approved', 'overdue']))
                                <form action="{{ route('admin.loans.return', $loan) }}" method="POST" onsubmit="return appConfirm(this, event, 'Tandai buku telah dikembalikan?{{ $loan->isOverdue() ? ' PERINGATAN: Siswa ini memiliki denda keterlambatan sebesar Rp ' . number_format($loan->calculateFine(), 0, ',', '.') : ''}}');">
                                    @csrf @method('PATCH')
                                    <button type="submit" class="btn btn-primary btn-sm" title="Kembalikan">Kembalikan</button>
                                </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="empty-state">
                        <p>Tidak ada transaksi peminjaman ditemukan.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($loans->hasPages())
    <div class="card-footer" style="padding: 16px 24px; border-top: 1px solid var(--color-border);">
        {{ $loans->links('pagination::default') }}
    </div>
    @endif
</div>
@endsection
