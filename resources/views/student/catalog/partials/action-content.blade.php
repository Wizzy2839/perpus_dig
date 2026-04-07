<!-- partials/action-content.blade.php -->
<div style="margin-bottom: 24px;">
    <div style="font-size: 13px; color: var(--color-muted); margin-bottom: 6px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">Ketersediaan Stok</div>
    @if($book->isAvailable())
        <div style="font-size: 22px; font-weight: 800; color: var(--color-success); display: flex; align-items: center; gap: 8px;">
            <i data-feather="check" style="width: 24px; height: 24px;"></i>
            Tersedia
        </div>
        <div style="font-size: 13.5px; color: var(--color-text); margin-top: 6px;">Tersisa <strong style="font-size: 15px;">{{ $book->availableStock() }}</strong> buku di rak</div>
        @if($book->availableStock() <= 2)
            <div style="margin-top: 12px; padding: 10px 14px; background: #fffbeb; border: 1px solid #fde68a; border-radius: 6px; color: #b45309; font-size: 13px; font-weight: 600; display: flex; align-items: flex-start; gap: 8px;">
                <i data-feather="alert-triangle" style="width: 16px; height: 16px; flex-shrink: 0; margin-top: 2px;"></i>
                <div>Stok hampir habis. Ayo pinjam sekarang sebelum kehabisan!</div>
            </div>
        @endif
    @else
        <div style="font-size: 20px; font-weight: 800; color: var(--color-danger); display: flex; align-items: center; gap: 8px;">
            <i data-feather="x" style="width: 22px; height: 22px;"></i>
            Dipinjam Habis
        </div>
        <div style="font-size: 13px; color: var(--color-muted); margin-top: 6px;">Menunggu pengguna lain mengembalikan</div>
        <div style="margin-top: 12px; padding: 10px 14px; background: #fef2f2; border: 1px solid #fecaca; border-radius: 6px; color: #dc2626; font-size: 13px; font-weight: 600; display: flex; align-items: flex-start; gap: 8px;">
            <i data-feather="alert-octagon" style="width: 16px; height: 16px; flex-shrink: 0; margin-top: 2px;"></i>
            <div>Peringatan: Stok buku saat ini kosong (0)! Anda tidak bisa meminjam buku ini sampai ada yang mengembalikannya.</div>
        </div>
    @endif
</div>

@if($existingLoan)
    <div style="background: #fffbeb; border: 1px solid #fde68a; border-radius: var(--radius); padding: 16px; margin-top: 24px;">
        <div style="display: flex; gap: 12px; align-items: flex-start; color: #92400e;">
            <i data-feather="alert-triangle" style="width: 20px; height: 20px; flex-shrink: 0; margin-top: 2px;"></i>
            <div style="font-size: 13.5px; font-weight: 500; line-height: 1.5;">
                Kamu sudah mengajukan peminjaman buku ini. <br>
                <div style="margin-top: 10px; padding: 6px 10px; background: rgba(255,255,255,0.7); border-radius: 6px; display: inline-block;">
                    Status: <strong>{{ \App\Models\Loan::statusLabel($existingLoan->status) }}</strong>
                </div>
            </div>
        </div>
    </div>
@else
    @if($book->isAvailable())
        <div style="margin-top: 24px;">
            <form action="{{ route('student.loans.store') }}" method="POST">
                @csrf
                <input type="hidden" name="book_id" value="{{ $book->id }}">
                <button type="submit" class="btn btn-primary" style="width: 100%; padding: 14px; justify-content: center; font-size: 15px; font-weight: 700; gap: 8px; box-shadow: 0 4px 12px rgba(37,99,168,0.25);" onclick="return appConfirm(this, event, 'Ajukan pinjaman untuk buku ini? Pastikan Anda mengambil buku di perpustakaan jika telah disetujui.');">
                    <i data-feather="shopping-bag" style="width: 20px; height: 20px;"></i>
                    Ajukan Peminjaman
                </button>
            </form>
            <div style="text-align: center; margin-top: 16px; font-size: 11px; color: var(--color-muted);">
                <span style="display:inline-flex; align-items:center; justify-content:center; gap:4px; padding: 4px 12px; background: var(--color-bg); border-radius: 20px;">
                    <i data-feather="shield" style="width: 12px; height: 12px;"></i>
                    Aman & diawasi sistem
                </span>
            </div>
        </div>
    @else
        <div style="margin-top: 24px;">
            <button class="btn" disabled style="width: 100%; padding: 14px; justify-content: center; font-size: 15px; font-weight: 600; background: var(--color-bg); color: var(--color-muted); border: 2px dashed var(--color-border); cursor: not-allowed;">
                Buku Sedang Kosong
            </button>
        </div>
    @endif
@endif
