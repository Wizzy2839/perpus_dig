@extends('layouts.app')

@section('title', 'Riwayat Pinjaman Saya')
@section('page-title', 'Peminjaman Saya')

@push('styles')
<style>
    /* Premium E-Commerce History Card Layout */
    .history-card { background: #fff; border: 1px solid var(--color-border); border-radius: 12px; margin-bottom: 24px; box-shadow: 0 4px 12px rgba(0,0,0,0.02); transition: transform 0.2s, box-shadow 0.2s; overflow: hidden; }
    .history-card:hover { box-shadow: 0 8px 24px rgba(0,0,0,0.06); transform: translateY(-2px); border-color: rgba(37,99,168,0.3); }

    .hc-header { border-bottom: 1px solid var(--color-border); padding: 16px 24px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px; }
    .hc-date { display: flex; align-items: center; gap: 8px; font-size: 14px; color: var(--color-text); font-weight: 600; }
    .hc-date svg { color: var(--color-muted); }

    .hc-body { padding: 24px; display: flex; gap: 24px; align-items: stretch; }
    
    .hc-img-wrap { width: 96px; flex-shrink: 0; }
    .hc-img { width: 100%; height: auto; aspect-ratio: 3/4; object-fit: cover; border-radius: 6px; box-shadow: 2px 4px 10px rgba(0,0,0,0.1); border: 1px solid var(--color-border); }
    .hc-img-placeholder { width: 100%; aspect-ratio: 3/4; background: #f1f5f9; display: flex; align-items: center; justify-content: center; border-radius: 6px; border: 1px dashed #cbd5e1; color: #94a3b8; }

    .hc-info { flex: 1; display: flex; flex-direction: column; justify-content: center; min-width: 0; }
    .hc-category { font-size: 11px; font-weight: 700; color: var(--color-primary); text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 6px; }
    .hc-title { font-size: 18px; font-weight: 800; color: var(--color-text); line-height: 1.3; margin-bottom: 6px; display: block; text-decoration: none; }
    .hc-title:hover { text-decoration: underline; text-decoration-color: var(--color-primary-light); }
    .hc-author { font-size: 14px; color: var(--color-muted); margin-bottom: 12px; }

    .hc-status-wrapper { display: flex; align-items: center; gap: 8px; background: var(--color-bg); padding: 8px 12px; border-radius: 8px; font-size: 13.5px; border: 1px solid var(--color-border); width: fit-content; }
    .hc-status-wrapper.alert { background: #fef2f2; border-color: #fca5a5; color: #991b1b; }
    
    /* The actions column on the right */
    .hc-actions { width: 200px; flex-shrink: 0; border-left: 1px dashed var(--color-border); padding-left: 24px; display: flex; flex-direction: column; justify-content: center; align-items: stretch; gap: 12px; }

    .hc-footer { background: #f8fafc; border-top: 1px solid var(--color-border); padding: 16px 24px; font-size: 13.5px; display: flex; justify-content: space-between; align-items: center; }

    @media(max-width: 768px) {
        .hc-body { flex-direction: column; padding: 20px; }
        .hc-img-wrap { width: 80px; }
        .hc-actions { width: 100%; border-left: none; border-top: 1px dashed var(--color-border); padding-left: 0; padding-top: 20px; flex-direction: row; flex-wrap: wrap; }
        .hc-actions .btn { flex: 1; }
    }
</style>
@endpush

@section('content')

<!-- Page Header -->
<div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 16px; margin-bottom: 32px;">
    <div style="display: flex; gap: 12px; align-items: center;">
        <div style="width: 48px; height: 48px; background: rgba(37, 99, 168, 0.1); border-radius: 12px; display: flex; align-items: center; justify-content: center; color: var(--color-primary);">
            <i data-feather="file-text" style="width: 24px; height: 24px;"></i>
        </div>
        <div>
            <h2 style="font-size: 24px; font-weight: 800; color: var(--color-text); margin: 0; letter-spacing: -0.5px;">Daftar Riwayat Peminjaman</h2>
            <div style="font-size: 14px; color: var(--color-muted); margin-top: 4px;">Pantau status buku yang sedang atau pernah Anda pinjam.</div>
        </div>
    </div>
</div>

<div class="loans-container">
    @forelse($loans as $loan)
    <div class="history-card">
        
        <!-- Header: Date and Badge -->
        <div class="hc-header">
            <div class="hc-date">
                <i data-feather="calendar" style="width: 18px; height: 18px;"></i>
                Diajukan pada {{ $loan->loan_date->format('d M Y') }}
            </div>
            <div>
                <span class="badge {{ \App\Models\Loan::statusBadgeClass($loan->status) }}" style="padding: 6px 16px; font-size: 12px; border-radius: 6px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px;">
                    {{ \App\Models\Loan::statusLabel($loan->status) }}
                </span>
            </div>
        </div>
        
        <!-- Body: 3-Column Layout -->
        <div class="hc-body">
            
            <!-- COl 1: Image -->
            <div class="hc-img-wrap">
                @if($loan->book->cover)
                    <img src="{{ Storage::url($loan->book->cover) }}" alt="Cover" class="hc-img" loading="lazy">
                @else
                    <div class="hc-img-placeholder">
                        <i data-feather="book-open" style="width: 28px; height: 28px;"></i>
                    </div>
                @endif
            </div>
            
            <!-- Col 2: Info (Centered vertically) -->
            <div class="hc-info">
                <div class="hc-category">{{ $loan->book->category->name }}</div>
                <a href="{{ route('student.catalog.show', $loan->book) }}" class="hc-title">{{ $loan->book->title }}</a>
                <div class="hc-author">Karya: {{ $loan->book->author }}</div>
                
                @if($loan->status == 'returned' && $loan->return_date)
                    <div class="hc-status-wrapper">
                        <i data-feather="check" style="width: 16px; height: 16px; color: var(--color-success);"></i>
                        <span>Selesai dibaca & dikembalikan tgl <strong>{{ $loan->return_date->format('d M Y') }}</strong></span>
                    </div>
                @elseif(in_array($loan->status, ['approved', 'overdue']))
                    <div class="hc-status-wrapper {{ $loan->isOverdue() ? 'alert' : '' }}">
                        <i data-feather="clock" style="width: 16px; height: 16px; color: {{ $loan->isOverdue() ? '#dc2626' : 'var(--color-primary)' }};"></i>
                        <span>Jatuh Tempo: <strong>{{ $loan->due_date->format('d M Y') }}</strong></span>
                    </div>
                    @if($loan->isOverdue())
                        <div style="color: #dc2626; font-size: 13px; font-weight: 700; display: flex; align-items: center; gap: 6px; margin-top: 8px;">
                            <i data-feather="alert-circle" style="width: 14px; height: 14px;"></i>
                            Peringatan: Terlambat {{ $loan->daysOverdue() }} hari
                        </div>
                    @endif
                @elseif($loan->status == 'pending')
                    <div class="hc-status-wrapper">
                        <i data-feather="alert-circle" style="width: 16px; height: 16px; color: var(--color-warning);"></i>
                        <span>Harap tunggu persetujuan Admin Perpustakaan.</span>
                    </div>
                @endif
            </div>

            <!-- Col 3: Actions -->
            <div class="hc-actions">
                <a href="{{ route('student.catalog.show', $loan->book) }}" class="btn btn-outline" style="justify-content: center; padding: 12px; font-size: 14px; font-weight: 600;">Lihat Detail Buku</a>
                @if(in_array($loan->status, ['returned']))
                    <a href="{{ route('student.catalog.show', $loan->book) }}" class="btn btn-primary" style="justify-content: center; padding: 12px; font-size: 14px; font-weight: 600;">Pinjam Ulang</a>
                @endif
            </div>

        </div>
        
        <!-- Footer: Remarks / Fines (Only show if exists) -->
        @if($loan->fine_amount > 0 || $loan->notes)
        <div class="hc-footer">
            <div style="display: flex; flex-direction: column; gap: 4px;">
                @if($loan->notes)
                    <div style="font-size: 12px; color: var(--color-muted); font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px;">Pesan Admin :</div>
                    <div style="color: var(--color-text); font-style: italic;">"{{ $loan->notes }}"</div>
                @endif
            </div>
            
            @if($loan->fine_amount > 0)
                <div style="background: rgba(220, 38, 38, 0.05); border: 1px solid rgba(220, 38, 38, 0.2); padding: 8px 16px; border-radius: 6px; display: flex; align-items: center; gap: 12px; flex-shrink: 0;">
                    <div style="font-weight: 500; font-size: 13px; color: var(--color-danger);">Tagihan Denda:</div>
                    <div style="font-weight: 800; font-size: 16px; color: var(--color-danger);">Rp {{ number_format($loan->fine_amount, 0, ',', '.') }}</div>
                </div>
            @endif
        </div>
        @endif

    </div>
    @empty
    <!-- Empty State Premium -->
    <div style="background: #fff; border: 1px solid #e2e8f0; border-radius: 16px; padding: 64px 24px; text-align: center; box-shadow: 0 4px 12px rgba(0,0,0,0.02);">
        <div style="margin: 0 auto 24px; width: 80px; height: 80px; background: #f1f5f9; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
            <i data-feather="book-open" style="width: 40px; height: 40px; color: #94a3b8;"></i>
        </div>
        <h3 style="font-size: 20px; font-weight: 800; color: var(--color-text); margin-bottom: 8px;">Belum Ada Riwayat Peminjaman</h3>
        <p style="font-size: 15px; color: var(--color-muted); max-width: 400px; margin: 0 auto 24px; line-height: 1.6;">Anda belum mulai meminjam koleksi digital kami. Mari jelajahi ribuan materi bacaan premium secara gratis sekarang!</p>
        <a href="{{ route('student.catalog.index') }}" class="btn btn-primary" style="padding: 14px 28px; font-size: 15px; font-weight: 700; border-radius: 8px;">Eksplorasi Katalog</a>
    </div>
    @endforelse

    @if($loans->hasPages())
    <div style="margin-top: 32px;">
        {{ $loans->links('pagination::default') }}
    </div>
    @endif
</div>

@endsection
