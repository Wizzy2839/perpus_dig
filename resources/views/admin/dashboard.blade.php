@extends('layouts.app')

@section('title', 'Dashboard Admin')
@section('page-title', 'Dashboard Admin')

@section('content')
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon blue">
            <i data-feather="book"></i>
        </div>
        <div class="stat-info">
            <div class="label">Total Buku</div>
            <div class="value">{{ number_format($stats['total_books']) }}</div>
        </div>
    </div>
    
    <div class="stat-card">
        <div class="stat-icon purple">
            <i data-feather="users"></i>
        </div>
        <div class="stat-info">
            <div class="label">Total Anggota</div>
            <div class="value">{{ number_format($stats['total_members']) }}</div>
        </div>
    </div>
    
    <div class="stat-card">
        <div class="stat-icon green">
            <i data-feather="check-circle"></i>
        </div>
        <div class="stat-info">
            <div class="label">Pinjaman Aktif</div>
            <div class="value">{{ number_format($stats['active_loans']) }}</div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon red">
            <i data-feather="clock"></i>
        </div>
        <div class="stat-info">
            <div class="label">Terlambat</div>
            <div class="value">{{ number_format($stats['overdue_loans']) }}</div>
        </div>
    </div>
</div>

<div style="display: grid; grid-template-columns: 2fr 1fr; gap: 24px;">
    <!-- Recent Loans -->
    <div class="card">
        <div class="card-header">
            <h2>Peminjaman Terbaru</h2>
            <a href="{{ route('admin.loans.index') }}" class="btn btn-ghost btn-sm">Lihat Semua</a>
        </div>
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Peminjam</th>
                        <th>Buku</th>
                        <th>Tgl Pinjam</th>
                        <th>Jatuh Tempo</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentLoans as $loan)
                    <tr>
                        <td>
                            <div style="font-weight: 500; color: var(--color-text);">{{ $loan->user->name }}</div>
                            <div style="font-size: 11.5px; color: var(--color-muted);">{{ $loan->user->nis }} / {{ $loan->user->kelas }}</div>
                        </td>
                        <td>
                            <div style="font-weight: 500; color: var(--color-text);">{{ Str::limit($loan->book->title, 30) }}</div>
                        </td>
                        <td>{{ $loan->loan_date->format('d M Y') }}</td>
                        <td>{{ $loan->due_date->format('d M Y') }}</td>
                        <td>
                            <span class="badge {{ \App\Models\Loan::statusBadgeClass($loan->status) }}">
                                {{ \App\Models\Loan::statusLabel($loan->status) }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" style="text-align: center; padding: 32px; color: var(--color-muted);">Belum ada data peminjaman.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pending Requests / Quick Actions -->
    <div style="display: flex; flex-direction: column; gap: 24px;">
        <div class="card">
            <div class="card-header">
                <h2>Menunggu Persetujuan</h2>
                @if($stats['pending_loans'] > 0)
                    <span class="badge badge-warning">{{ $stats['pending_loans'] }}</span>
                @endif
            </div>
            <div class="card-body" style="padding: 0;">
                @forelse($pendingLoans as $loan)
                    <div style="padding: 16px 20px; border-bottom: 1px solid var(--color-border); display: flex; flex-direction: column; gap: 8px;">
                        <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                            <div>
                                <div style="font-weight: 600; font-size: 13.5px; color: var(--color-text);">{{ $loan->user->name }}</div>
                                <div style="font-size: 12px; color: var(--color-primary); font-weight: 500;">{{ Str::limit($loan->book->title, 40) }}</div>
                            </div>
                        </div>
                        <div style="display: flex; gap: 8px; margin-top: 4px;">
                            <form action="{{ route('admin.loans.approve', $loan) }}" method="POST" style="flex:1;">
                                @csrf @method('PATCH')
                                <button type="submit" class="btn btn-primary btn-sm" style="width: 100%; justify-content: center;">Stujui</button>
                            </form>
                            <form action="{{ route('admin.loans.reject', $loan) }}" method="POST" style="flex:1;">
                                @csrf @method('PATCH')
                                <button type="submit" class="btn btn-outline btn-sm" style="width: 100%; justify-content: center; color: var(--color-danger); border-color: var(--color-danger);">Tolak</button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div style="padding: 32px 20px; text-align: center; color: var(--color-muted); font-size: 13.5px;">
                        Tidak ada permohonan peminjaman baru.
                    </div>
                @endforelse
                @if($stats['pending_loans'] > 5)
                    <div style="padding: 12px; text-align: center; border-top: 1px solid var(--color-border); background: var(--color-bg);">
                        <a href="{{ route('admin.loans.index', ['status' => 'pending']) }}" style="font-size: 12.5px; font-weight: 500; color: var(--color-primary); text-decoration: none;">Lihat semua ({{ $stats['pending_loans'] }})</a>
                    </div>
                @endif
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h2>Aksi Cepat</h2>
            </div>
            <div class="card-body" style="display: grid; gap: 12px;">
                <a href="{{ route('admin.loans.create') }}" class="btn btn-outline" style="justify-content: center; padding: 12px;">
                    <i data-feather="plus-circle" style="width: 20px; height: 20px;"></i>
                    Input Peminjaman Baru
                </a>
                <a href="{{ route('admin.books.create') }}" class="btn btn-outline" style="justify-content: center; padding: 12px;">
                    <i data-feather="plus" style="width: 20px; height: 20px;"></i>
                    Tambah Buku Baru
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
