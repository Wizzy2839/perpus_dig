@extends('layouts.app')

@section('title', 'Kategori Buku')
@section('page-title', 'Kategori Buku')

@section('topbar-actions')
<button type="button" class="btn btn-primary" onclick="openModal('createModal')">
    <i data-feather="plus"></i>
    Tambah Kategori
</button>
@endsection

@section('content')
<div class="card">
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th style="width: 50px;">#</th>
                    <th>Nama Kategori</th>
                    <th>Slug</th>
                    <th>Deskripsi</th>
                    <th style="text-align: center;">Jumlah Buku</th>
                    <th style="text-align: right; min-width: 120px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $index => $category)
                <tr>
                    <td>{{ $categories->firstItem() + $index }}</td>
                    <td class="fw-600">{{ $category->name }}</td>
                    <td style="font-family: monospace; font-size: 12.5px; color: var(--color-muted);">{{ $category->slug }}</td>
                    <td>{{ Str::limit($category->description, 50) ?: '-' }}</td>
                    <td style="text-align: center;">
                        <span class="badge badge-secondary">{{ $category->books_count }}</span>
                    </td>
                    <td style="text-align: right;">
                        <div style="display: flex; gap: 4px; justify-content: flex-end;">
                            <button type="button" class="btn btn-ghost btn-sm" onclick="editCategory({{ $category }})" title="Edit">
                                <i data-feather="edit-2"></i>
                            </button>
                            <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" onsubmit="return appConfirm(this, event, 'Hapus kategori ini? Pastikan tidak ada buku yang terhubung.');">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-ghost btn-sm text-danger" title="Hapus">
                                    <i data-feather="trash-2"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="empty-state">
                        <p>Belum ada kategori buku.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($categories->hasPages())
    <div class="card-footer" style="padding: 16px 24px; border-top: 1px solid var(--color-border);">
        {{ $categories->links('pagination::default') }}
    </div>
    @endif
</div>

<!-- Modal Tambah/Edit Kategori -->
<div class="modal-overlay" id="formModalOverlay">
    <div class="modal">
        <form id="categoryForm" action="{{ route('admin.categories.store') }}" method="POST">
            @csrf
            <!-- Untuk update, js akan tambah _method PUT -->
            <div id="method-field"></div>
            
            <div class="modal-header">
                <h3 id="modalTitle">Tambah Kategori</h3>
                <button type="button" class="btn-close" onclick="closeModal('formModalOverlay')">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="form-label" for="name">Nama Kategori <span class="text-danger">*</span></label>
                    <input type="text" name="name" id="cat_name" class="form-control" required autofocus>
                </div>
                <div class="form-group mb-0">
                    <label class="form-label" for="description">Deskripsi (Opsional)</label>
                    <textarea name="description" id="cat_desc" class="form-control" rows="3"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-ghost" onclick="closeModal('formModalOverlay')">Batal</button>
                <button type="submit" class="btn btn-primary" id="btnSubmit">Simpan Kategori</button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    function openModal(id) {
        document.getElementById('formModalOverlay').classList.add('open');
        document.getElementById('cat_name').focus();
    }
    
    function closeModal(id) {
        document.getElementById(id).classList.remove('open');
        // Reset form to create mode
        setTimeout(() => {
            document.getElementById('categoryForm').reset();
            document.getElementById('categoryForm').action = "{{ route('admin.categories.store') }}";
            document.getElementById('method-field').innerHTML = '';
            document.getElementById('modalTitle').textContent = 'Tambah Kategori';
            document.getElementById('btnSubmit').textContent = 'Simpan Kategori';
        }, 300);
    }
    
    function editCategory(cat) {
        document.getElementById('categoryForm').action = `/admin/categories/${cat.id}`;
        document.getElementById('method-field').innerHTML = '@method("PUT")';
        document.getElementById('modalTitle').textContent = 'Edit Kategori';
        document.getElementById('btnSubmit').textContent = 'Update Kategori';
        
        document.getElementById('cat_name').value = cat.name;
        document.getElementById('cat_desc').value = cat.description || '';
        
        openModal('formModalOverlay');
    }
</script>
@endpush
@endsection
