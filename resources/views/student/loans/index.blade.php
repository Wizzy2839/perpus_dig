@extends('layouts.app')

@section('title', 'Riwayat Peminjaman')
@section('page-title', 'Peminjaman Saya')

@push('styles')
<style>
    .loans-page { max-width: 900px; margin: 0 auto; padding: 24px 24px 56px; }

    /* ── PAGE HEADER ── */
    .lp-header {
        display: flex;
        align-items: center;
        gap: 16px;
        margin-bottom: 24px;
    }
    .lp-header-icon {
        width: 50px; height: 50px;
        border-radius: 14px;
        background: linear-gradient(135deg, var(--color-primary), var(--color-primary-light));
        display: flex; align-items: center; justify-content: center;
        box-shadow: 0 6px 14px rgba(26,60,94,0.2);
        flex-shrink: 0;
        color: #fff;
    }
    .lp-header-icon i { width: 24px; height: 24px; }
    .lp-header-text h1 { font-size: 22px; font-weight: 800; color: var(--color-text); letter-spacing: -0.4px; margin-bottom: 3px; }
    .lp-header-text p { font-size: 13.5px; color: var(--color-muted); }

    /* ── LOAN CARD ── */
    .loan-card {
        background: #fff;
        border: 1px solid var(--color-border);
        border-radius: 14px;
        margin-bottom: 16px;
        overflow: hidden;
        box-shadow: var(--shadow-sm);
        transition: transform .2s, box-shadow .2s, border-color .2s;
    }
    .loan-card:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
        border-color: rgba(37,99,168,0.25);
    }

    /* Card Head */
    .lc-head {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 13px 20px;
        background: var(--color-bg);
        border-bottom: 1px solid var(--color-border);
        gap: 12px;
        flex-wrap: wrap;
    }
    .lc-head-left { display: flex; align-items: center; gap: 10px; font-size: 13px; color: var(--color-muted); font-weight: 600; }
    .lc-head-left i { width: 15px; height: 15px; }
    .lc-head-id { font-size: 12px; font-family: monospace; color: var(--color-muted); background: var(--color-border); padding: 2px 8px; border-radius: 5px; }

    /* Card Body */
    .lc-body { display: flex; gap: 20px; padding: 20px; align-items: stretch; }

    /* Cover */
    .lc-cover {
        width: 80px; flex-shrink: 0;
    }
    .lc-cover img {
        width: 80px; height: auto; aspect-ratio: 3/4;
        object-fit: cover;
        border-radius: 6px;
        box-shadow: 2px 3px 10px rgba(0,0,0,0.1);
        border: 1px solid var(--color-border);
    }
    .lc-cover-ph {
        width: 80px; height: 106px;
        border-radius: 6px;
        background: var(--color-bg);
        border: 1px dashed var(--color-border);
        display: flex; align-items: center; justify-content: center;
        color: var(--color-muted);
    }
    .lc-cover-ph i { width: 24px; height: 24px; }

    /* Info */
    .lc-info { flex: 1; min-width: 0; display: flex; flex-direction: column; justify-content: center; }
    .lc-cat { font-size: 10.5px; font-weight: 700; color: var(--color-primary-light); text-transform: uppercase; letter-spacing: .04em; margin-bottom: 4px; }
    .lc-title {
        font-size: 16px; font-weight: 800;
        color: var(--color-text);
        margin-bottom: 3px; line-height: 1.3;
        text-decoration: none; display: block;
    }
    .lc-title:hover { color: var(--color-primary); text-decoration: underline; }
    .lc-author { font-size: 13px; color: var(--color-muted); margin-bottom: 12px; }

    /* Status pill */
    .lc-status-pill {
        display: inline-flex; align-items: center; gap: 7px;
        padding: 6px 13px;
        border-radius: 8px;
        font-size: 12.5px; font-weight: 600;
        width: fit-content;
        border: 1px solid;
    }
    .lc-status-pill i { width: 14px; height: 14px; }
    .lc-status-normal { background: #EFF6FF; color: var(--color-primary); border-color: #DBEAFE; }
    .lc-status-pending { background: #FFFBEB; color: var(--color-warning); border-color: #FDE68A; }
    .lc-status-overdue { background: #FEF2F2; color: var(--color-danger); border-color: #FECACA; }
    .lc-status-done { background: #F0FDF4; color: var(--color-success); border-color: #BBF7D0; }
    .lc-overdue-warn { display: flex; align-items: center; gap: 6px; font-size: 12px; font-weight: 700; color: var(--color-danger); margin-top: 6px; }
    .lc-overdue-warn i { width: 13px; height: 13px; }

    /* Actions */
    .lc-actions {
        flex-shrink: 0;
        display: flex;
        flex-direction: column;
        gap: 8px;
        justify-content: center;
        min-width: 150px;
        border-left: 1px dashed var(--color-border);
        padding-left: 20px;
    }
    .lc-btn {
        display: flex; align-items: center; justify-content: center; gap: 7px;
        padding: 9px 14px;
        border-radius: 9px;
        font-size: 13px; font-weight: 700;
        text-decoration: none;
        transition: all .2s;
        white-space: nowrap;
    }
    .lc-btn i { width: 14px; height: 14px; }
    .lc-btn-outline { border: 1.5px solid var(--color-border); color: var(--color-primary); background: #fff; }
    .lc-btn-outline:hover { border-color: var(--color-primary); background: #EFF6FF; }
    .lc-btn-solid { background: var(--color-primary); color: #fff; border: 1.5px solid var(--color-primary); }
    .lc-btn-solid:hover { background: var(--color-primary-dark); }

    /* Card Footer (fine/notes) */
    .lc-footer {
        padding: 13px 20px;
        background: var(--color-bg);
        border-top: 1px solid var(--color-border);
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 10px;
        font-size: 13px;
    }
    .lc-fine {
        display: flex; align-items: center; gap: 10px;
        background: #FEF2F2;
        border: 1px solid #FECACA;
        padding: 7px 14px;
        border-radius: 8px;
    }
    .lc-fine-label { font-weight: 600; color: var(--color-danger); }
    .lc-fine-amount { font-size: 16px; font-weight: 800; color: var(--color-danger); }

    /* Empty State */
    .lp-empty {
        background: #fff;
        border: 1px solid var(--color-border);
        border-radius: 16px;
        padding: 72px 24px;
        text-align: center;
        box-shadow: var(--shadow-sm);
    }
    .lp-empty-icon {
        width: 80px; height: 80px;
        border-radius: 50%;
        background: var(--color-bg);
        display: flex; align-items: center; justify-content: center;
        margin: 0 auto 20px;
    }
    .lp-empty-icon i { width: 36px; height: 36px; color: var(--color-muted); opacity: .4; }
    .lp-empty h3 { font-size: 18px; font-weight: 800; margin-bottom: 8px; }
    .lp-empty p { font-size: 14px; color: var(--color-muted); max-width: 380px; margin: 0 auto 20px; line-height: 1.6; }

    /* Responsive */
    @media (max-width: 640px) {
        .loans-page { padding: 12px 12px 40px; }
        .lc-body { flex-direction: column; gap: 14px; }
        .lc-actions { border-left: none; border-top: 1px dashed var(--color-border); padding-left: 0; padding-top: 14px; flex-direction: row; flex-wrap: wrap; min-width: unset; }
        .lc-btn { flex: 1; }
    }
</style>
@endpush

@section('content')
<div class="loans-page">

    {{-- ---- PAGE HEADER ---- --}}
    <div class="lp-header">
        <div class="lp-header-icon">
            <i data-feather="file-text"></i>
        </div>
        <div class="lp-header-text">
            <h1>Riwayat Peminjaman</h1>
            <p>Pantau status buku yang sedang atau pernah Anda pinjam.</p>
        </div>
    </div>

    {{-- ---- LOAN LIST ---- --}}
    @forelse($loans as $loan)
    <div class="loan-card">

        {{-- Head --}}
        <div class="lc-head">
            <div class="lc-head-left">
                <i data-feather="calendar"></i>
                Diajukan {{ $loan->loan_date->format('d M Y') }}
                <span class="lc-head-id">#T{{ $loan->id }}{{ date('y') }}</span>
            </div>
            <span class="badge {{ \App\Models\Loan::statusBadgeClass($loan->status) }}" style="padding: 5px 14px; font-size: 11.5px; font-weight: 700; text-transform: uppercase; letter-spacing: .04em;">
                {{ \App\Models\Loan::statusLabel($loan->status) }}
            </span>
        </div>

        {{-- Body --}}
        <div class="lc-body">

            {{-- Cover --}}
            <div class="lc-cover">
                @if($loan->book->cover)
                    <img src="{{ Storage::url($loan->book->cover) }}" alt="Cover" loading="lazy">
                @else
                    <div class="lc-cover-ph"><i data-feather="book-open"></i></div>
                @endif
            </div>

            {{-- Info --}}
            <div class="lc-info">
                <div class="lc-cat">{{ $loan->book->category->name }}</div>
                <a href="{{ route('student.catalog.show', $loan->book) }}" class="lc-title">{{ $loan->book->title }}</a>
                <div class="lc-author">{{ $loan->book->author }}</div>

                @if($loan->status == 'returned' && $loan->return_date)
                    <div class="lc-status-pill lc-status-done">
                        <i data-feather="check-circle"></i>
                        Dikembalikan tgl {{ $loan->return_date->format('d M Y') }}
                    </div>
                @elseif(in_array($loan->status, ['approved', 'overdue']))
                    <div class="lc-status-pill {{ $loan->isOverdue() ? 'lc-status-overdue' : 'lc-status-normal' }}">
                        <i data-feather="{{ $loan->isOverdue() ? 'alert-triangle' : 'clock' }}"></i>
                        Jatuh Tempo: {{ $loan->due_date->format('d M Y') }}
                    </div>
                    @if($loan->isOverdue())
                        <div class="lc-overdue-warn" style="flex-direction: column; align-items: flex-start; gap: 4px;">
                            <div style="display: flex; align-items: center; gap: 6px;">
                                <i data-feather="alert-circle"></i>
                                Terlambat {{ $loan->daysOverdue() }} hari
                            </div>
                            <div style="display: flex; align-items: center; gap: 6px; color: #b91c1c;">
                                <i data-feather="dollar-sign"></i>
                                Denda: Rp {{ number_format($loan->calculateFine(), 0, ',', '.') }}
                            </div>
                        </div>
                    @endif
                @elseif($loan->status == 'pending')
                    <div class="lc-status-pill lc-status-pending">
                        <i data-feather="loader"></i>
                        Menunggu persetujuan admin
                    </div>
                @endif
            </div>

            {{-- Actions --}}
            <div class="lc-actions">
                <a href="{{ route('student.catalog.show', $loan->book) }}" class="lc-btn lc-btn-outline">
                    <i data-feather="eye"></i>
                    Detail Buku
                </a>
                @if($loan->status == 'returned')
                    <a href="{{ route('student.catalog.show', $loan->book) }}" class="lc-btn lc-btn-solid">
                        <i data-feather="refresh-cw"></i>
                        Pinjam Lagi
                    </a>
                @endif
            </div>

        </div>{{-- end body --}}

        {{-- Footer (only if fine or notes) --}}
        @if($loan->fine_amount > 0 || $loan->notes)
        <div class="lc-footer">
            <div>
                @if($loan->notes)
                    <div style="font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.04em;color:var(--color-muted);margin-bottom:3px;">Pesan Admin</div>
                    <div style="color:var(--color-text);font-style:italic;">{{ $loan->notes }}</div>
                @endif
            </div>
            @if($loan->fine_amount > 0)
                <div class="lc-fine">
                    <i data-feather="alert-circle" style="width:16px;height:16px;color:var(--color-danger);"></i>
                    <span class="lc-fine-label">Denda:</span>
                    <span class="lc-fine-amount">Rp {{ number_format($loan->fine_amount, 0, ',', '.') }}</span>
                </div>
            @endif
        </div>
        @endif

    </div>
    @empty

    {{-- EMPTY STATE --}}
    <div class="lp-empty">
        <div class="lp-empty-icon">
            <i data-feather="book-open"></i>
        </div>
        <h3>Belum Ada Riwayat Peminjaman</h3>
        <p>Anda belum pernah meminjam koleksi kami. Mulai eksplorasi sekarang!</p>
        <a href="{{ route('student.catalog.index') }}" class="btn btn-primary" style="padding:12px 24px;font-size:14px;">
            <i data-feather="search" style="width:16px;height:16px;"></i>
            Eksplorasi Katalog
        </a>
    </div>

    @endforelse

    @if($loans->hasPages())
    <div style="margin-top: 28px;">
        {{ $loans->links('pagination::default') }}
    </div>
    @endif

</div>
@endsection
