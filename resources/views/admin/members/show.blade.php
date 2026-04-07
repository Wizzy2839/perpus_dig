@extends('layouts.app')

@section('title', 'Detail Anggota ' . $member->name)
@section('page-title', 'Detail Anggota')

@section('topbar-actions')
<a href="{{ route('admin.members.index') }}" class="btn btn-ghost">
    <i data-feather="arrow-left"></i>
    Kembali
</a>
@endsection

@section('content')
<div style="display: grid; grid-template-columns: 1fr 2fr; gap: 24px; align-items: start;">
    
    <!-- Info Anggota & Form Edit -->
    <div class="card">
        <form action="{{ route('admin.members.update', $member) }}" method="POST">
            @csrf @method('PUT')
            
            <div class="card-body" style="text-align: center; border-bottom: 1px solid var(--color-border); padding-bottom: 32px;">
                <div style="width: 80px; height: 80px; border-radius: 50%; background: var(--color-primary-light); color: white; display: inline-flex; align-items: center; justify-content: center; font-size: 32px; font-weight: 700; margin-bottom: 16px;">
                    {{ substr($member->name, 0, 1) }}
                </div>
                <h3 style="font-size: 18px; margin-bottom: 4px;">{{ $member->name }}</h3>
                <div style="color: var(--color-muted); margin-bottom: 16px;">NIS: {{ $member->nis }} &bull; Kelas: {{ $member->kelas }}</div>
                
                <span class="avail-chip {{ $member->is_active ? 'available' : 'unavailable' }}">
                    Status Akun: {{ $member->is_active ? 'Aktif' : 'Non-aktif' }}
                </span>
            </div>
            
            <div class="card-body">
                <h4 style="font-size: 14px; margin-bottom: 16px; color: var(--color-text);">Update Informasi</h4>
                
                <div class="form-group">
                    <label class="form-label" for="name">Nama Lengkap <span class="text-danger">*</span></label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $member->name) }}" required>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="nis">NIS <span class="text-danger">*</span></label>
                        <input type="text" name="nis" id="nis" class="form-control" value="{{ old('nis', $member->nis) }}" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="kelas">Kelas <span class="text-danger">*</span></label>
                        <input type="text" name="kelas" id="kelas" class="form-control" value="{{ old('kelas', $member->kelas) }}" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="form-label" for="email">Email Login <span class="text-danger">*</span></label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $member->email) }}" required>
                </div>
                
                <div class="form-group">
                    <label class="form-label" for="phone">No. Handphone</label>
                    <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone', $member->phone) }}">
                </div>
                
                <div class="form-group">
                    <label class="form-label" for="password">Reset Password</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Isi untuk mereset password baru">
                    <div class="form-hint">Kosongkan jika tidak ingin merubah password.</div>
                </div>

                <div class="form-group" style="display: flex; align-items: center; gap: 8px;">
                    <input type="hidden" name="is_active" value="0">
                    <input type="checkbox" name="is_active" id="is_active" value="1" {{ $member->is_active ? 'checked' : '' }} style="width: 16px; height: 16px; accent-color: var(--color-primary);">
                    <label for="is_active" style="cursor: pointer;">Akun Aktif (Dapat Login)</label>
                </div>
                
            </div>
            <div class="card-footer" style="padding: 16px 24px; border-top: 1px solid var(--color-border); text-align: right; background: #f8fafc;">
                <button class="btn btn-primary">Simpan Perubahan</button>
            </div>
        </form>
    </div>

    <!-- Riwayat Peminjaman -->
    <div class="card">
        <div class="card-header">
            <h2>Riwayat Peminjaman</h2>
        </div>
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th style="width: 40%">Buku</th>
                        <th>Tgl Pinjam</th>
                        <th>Jatuh Tempo</th>
                        <th style="text-align: center;">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($loans as $loan)
                    <tr>
                        <td>
                            <div class="fw-600" title="{{ $loan->book->title }}">{{ Str::limit($loan->book->title, 40) }}</div>
                        </td>
                        <td>{{ $loan->loan_date->format('d/m/Y') }}</td>
                        <td>
                            @if(in_array($loan->status, ['approved', 'overdue']))
                                <div class="{{ $loan->isOverdue() ? 'text-danger fw-600' : '' }}">{{ $loan->due_date->format('d/m/Y') }}</div>
                            @elseif($loan->status == 'returned')
                                <div class="text-success" style="font-size:12px;">Kembali {{ $loan->return_date ? $loan->return_date->format('d/m') : '' }}</div>
                            @else
                                -
                            @endif
                        </td>
                        <td style="text-align: center;">
                            <span class="badge {{ \App\Models\Loan::statusBadgeClass($loan->status) }}">
                                {{ \App\Models\Loan::statusLabel($loan->status) }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="empty-state" style="padding: 32px 16px;">
                            <p>Siswa belum memiliki riwayat peminjaman.</p>
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

</div>
@endsection
