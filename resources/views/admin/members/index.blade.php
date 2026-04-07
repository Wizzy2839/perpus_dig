@extends('layouts.app')

@section('title', 'Anggota Perpustakaan')
@section('page-title', 'Anggota Perpustakaan')

@section('topbar-actions')
<button type="button" class="btn btn-primary" onclick="openModal('createModal')">
    <i data-feather="user-plus"></i>
    Tambah Anggota
</button>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <form action="{{ route('admin.members.index') }}" method="GET" class="search-bar" style="margin: 0; width: 100%;">
            <div class="search-input-wrap">
                <i data-feather="search" style="width: 20px; height: 20px;"></i>
                <input type="text" name="search" class="form-control" placeholder="Cari nama, NIS, atau kelas..." value="{{ request('search') }}">
            </div>
            @if(request('search'))
                <a href="{{ route('admin.members.index') }}" class="btn btn-ghost" title="Reset Filter">
                    <i data-feather="x"></i>
                </a>
            @endif
        </form>
    </div>
    
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th style="width: 50px;">#</th>
                    <th>Nama Lengkap</th>
                    <th>NIS</th>
                    <th>Kelas</th>
                    <th style="text-align: center;">Pinjaman Aktif</th>
                    <th style="text-align: center;">Status</th>
                    <th style="text-align: right; min-width: 140px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($members as $index => $member)
                <tr>
                    <td>{{ $members->firstItem() + $index }}</td>
                    <td>
                        <div class="fw-600">{{ $member->name }}</div>
                        <div style="font-size: 11.5px; color: var(--color-muted);">{{ $member->email }}</div>
                    </td>
                    <td><span style="font-family: monospace; font-size: 13px;">{{ $member->nis }}</span></td>
                    <td>{{ $member->kelas }}</td>
                    <td style="text-align: center;">
                        <span class="badge {{ $member->active_loans_count > 0 ? 'badge-primary' : 'badge-secondary' }}">{{ $member->active_loans_count }}</span>
                    </td>
                    <td style="text-align: center;">
                        <span class="avail-chip {{ $member->is_active ? 'available' : 'unavailable' }}">
                            {{ $member->is_active ? 'Aktif' : 'Non-aktif' }}
                        </span>
                    </td>
                    <td style="text-align: right;">
                        <div style="display: flex; gap: 4px; justify-content: flex-end;">
                            <a href="{{ route('admin.members.show', $member) }}" class="btn btn-ghost btn-sm" title="Lihat Profil">
                                <i data-feather="user"></i>
                            </a>
                            <form action="{{ route('admin.members.toggle-active', $member) }}" method="POST">
                                @csrf @method('PATCH')
                                <button type="submit" class="btn btn-ghost btn-sm {{ $member->is_active ? 'text-danger' : 'text-success' }}" title="{{ $member->is_active ? 'Non-aktifkan' : 'Aktifkan' }}">
                                    @if($member->is_active)
                                        <i data-feather="lock"></i>
                                    @else
                                        <i data-feather="unlock"></i>
                                    @endif
                                </button>
                            </form>
                            @if($member->active_loans_count == 0)
                            <form action="{{ route('admin.members.destroy', $member) }}" method="POST" onsubmit="return appConfirm(this, event, 'Anda yakin ingin menghapus data anggota ini? Tindakan ini tidak dapat dibatalkan.');">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-ghost btn-sm text-danger" title="Hapus">
                                    <i data-feather="trash-2"></i>
                                </button>
                            </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="empty-state">
                        <p>Tidak ada anggota ditemukan.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($members->hasPages())
    <div class="card-footer" style="padding: 16px 24px; border-top: 1px solid var(--color-border);">
        {{ $members->links('pagination::default') }}
    </div>
    @endif
</div>

<!-- Modal Tambah Anggota -->
<div class="modal-overlay" id="createModal">
    <div class="modal">
        <form action="{{ route('admin.members.store') }}" method="POST">
            @csrf
            <div class="modal-header">
                <h3>Tambah Anggota Baru</h3>
                <button type="button" class="btn-close" onclick="closeModal('createModal')">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="form-label" for="name">Nama Lengkap <span class="text-danger">*</span></label>
                    <input type="text" name="name" id="name" class="form-control" required autofocus>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="nis">NIS <span class="text-danger">*</span></label>
                        <input type="text" name="nis" id="nis" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="kelas">Kelas <span class="text-danger">*</span></label>
                        <input type="text" name="kelas" id="kelas" class="form-control" placeholder="Contoh: X IPA 1" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="email">Email <span class="text-danger">*</span></label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="Siswa akan login dengan email ini" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="phone">No. Handphone</label>
                        <input type="text" name="phone" id="phone" class="form-control">
                    </div>
                </div>
                <div class="form-group mb-0">
                    <label class="form-label" for="password">Password Default <span class="text-danger">*</span></label>
                    <input type="password" name="password" id="password" class="form-control" value="murid123" required>
                    <div class="form-hint">Siswa disarankan untuk mengubah password setelah login.</div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-ghost" onclick="closeModal('createModal')">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    function openModal(id) { document.getElementById(id).classList.add('open'); }
    function closeModal(id) { document.getElementById(id).classList.remove('open'); }
</script>
@endpush
@endsection
