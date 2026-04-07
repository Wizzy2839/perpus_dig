@extends('layouts.app')

@section('title', 'Laporan Peminjaman')
@section('page-title', 'Laporan Peminjaman')

@section('topbar-actions')
<button type="button" class="btn btn-outline" onclick="window.print()">
    <i data-feather="printer"></i>
    Cetak Laporan
</button>
@endsection

@push('styles')
<style>
    @media print {
        body { background: #fff !important; }
        .sidebar, .topbar-actions, .filter-section, .pagination { display: none !important; }
        .main-wrap { margin-left: 0 !important; }
        .topbar { background: transparent !important; box-shadow: none !important; border-bottom: 2px solid #000 !important; padding: 0 !important; margin-bottom: 24px; position: static !important;}
        .page-content { padding: 0 !important; }
        .card { box-shadow: none !important; border: none !important; }
        .card-header { padding: 0 !important; border: none !important; margin-bottom: 16px; }
        .stats-grid { gap: 8px !important; margin-bottom: 24px !important; }
        .stat-card { border: 1px solid #ccc !important; padding: 12px 16px !important; }
        .table-wrap { overflow: visible !important; }
        table { border: 1px solid #000 !important; }
        thead th { background: #eee !important; color: #000 !important; border-bottom: 2px solid #000 !important; }
        th, td { border: 1px solid #ccc !important; padding: 8px !important; color: #000 !important; }
        .badge { display: none !important; } /* Sembunyikan badge berwarna agar tinta rapi, tampilkan text asli saja jika perlu, tp di sini badge dipakai utama */
        .print-text-status { display: inline-block !important; font-weight: bold; }
    }
    .print-text-status { display: none; }
</style>
@endpush

@section('content')

<div class="card filter-section mb-4">
    <div class="card-body">
        <form action="{{ route('admin.reports.index') }}" method="GET" style="display: flex; gap: 16px; align-items: flex-end; flex-wrap: wrap;">
            <div style="flex: 1; min-width: 200px;">
                <label class="form-label" for="start_date">Periode Awal</label>
                <input type="date" name="start_date" id="start_date" class="form-control" value="{{ $startDate }}" required>
            </div>
            <div style="flex: 1; min-width: 200px;">
                <label class="form-label" for="end_date">Periode Akhir</label>
                <input type="date" name="end_date" id="end_date" class="form-control" value="{{ $endDate }}" required>
            </div>
            <button type="submit" class="btn btn-primary" style="padding: 10px 20px;">
                <i data-feather="filter"></i>
                Terapkan Filter
            </button>
        </form>
    </div>
</div>

<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon blue">
            <i data-feather="file-text"></i>
        </div>
        <div class="stat-info">
            <div class="label">Total Transaksi</div>
            <div class="value">{{ number_format($summary['total']) }}</div>
        </div>
    </div>
    
    <div class="stat-card">
        <div class="stat-icon green">
            <i data-feather="check-circle"></i>
        </div>
        <div class="stat-info">
            <div class="label">Buku Dikembalikan</div>
            <div class="value">{{ number_format($summary['returned']) }}</div>
        </div>
    </div>
    
    <div class="stat-card">
        <div class="stat-icon red">
            <i data-feather="alert-triangle"></i>
        </div>
        <div class="stat-info">
            <div class="label">Kasus Terlambat</div>
            <div class="value">{{ number_format($summary['overdue']) }}</div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon amber">
            <i data-feather="dollar-sign"></i>
        </div>
        <div class="stat-info">
            <div class="label">Total Denda</div>
            <div class="value" style="font-size: 20px;">Rp {{ number_format($summary['total_fine'], 0, ',', '.') }}</div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h2>Rincian Transaksi ({{ date('d/m/Y', strtotime($startDate)) }} - {{ date('d/m/Y', strtotime($endDate)) }})</h2>
    </div>
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Peminjam</th>
                    <th style="width: 30%;">Buku</th>
                    <th>Tgl Pinjam</th>
                    <th>Kembali / Due</th>
                    <th style="text-align: right;">Denda</th>
                    <th style="text-align: center;">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($loans as $loan)
                <tr>
                    <td>#{{ str_pad($loan->id, 4, '0', STR_PAD_LEFT) }}</td>
                    <td>
                        <div class="fw-600">{{ $loan->user->name }}</div>
                        <div class="text-muted" style="font-size: 11.5px;">{{ $loan->user->nis }} / {{ $loan->user->kelas }}</div>
                    </td>
                    <td>
                        <div class="fw-600">{{ Str::limit($loan->book->title, 40) }}</div>
                        <div class="text-muted" style="font-size: 11.5px;">Kategori: {{ $loan->book->category->name }}</div>
                    </td>
                    <td>{{ $loan->loan_date->format('d/m/Y') }}</td>
                    <td>
                        @if($loan->status == 'returned' && $loan->return_date)
                            {{ $loan->return_date->format('d/m/Y') }}
                            <div><small class="text-success">Dikembalikan</small></div>
                        @elseif(in_array($loan->status, ['approved', 'overdue']))
                            {{ $loan->due_date->format('d/m/Y') }}
                            <div><small class="text-danger">Batas Waktu</small></div>
                        @else
                            -
                        @endif
                    </td>
                    <td style="text-align: right; font-weight: 500;">
                        {{ $loan->fine_amount > 0 ? 'Rp ' . number_format($loan->fine_amount, 0, ',', '.') : '-' }}
                    </td>
                    <td style="text-align: center;">
                        <span class="badge {{ \App\Models\Loan::statusBadgeClass($loan->status) }}">
                            {{ \App\Models\Loan::statusLabel($loan->status) }}
                        </span>
                        <!-- Teks khusus untuk mode cetak -->
                        <span class="print-text-status">{{ strtoupper(\App\Models\Loan::statusLabel($loan->status)) }}</span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="empty-state">
                        <p>Tidak ada transaksi peminjaman pada periode yang dipilih.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($loans->hasPages())
    <div class="card-footer pagination-wrap" style="padding: 16px 24px; border-top: 1px solid var(--color-border);">
        {{ $loans->links('pagination::default') }}
    </div>
    @endif
</div>
@endsection
