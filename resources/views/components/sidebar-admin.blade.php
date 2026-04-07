@php $route = request()->route()->getName(); @endphp

<div class="nav-section-label">Utama</div>

<a href="{{ route('admin.dashboard') }}"
   class="nav-item {{ str_starts_with($route, 'admin.dashboard') ? 'active' : '' }}">
    <i data-feather="grid"></i>
    Dashboard
</a>

<div class="nav-section-label" style="margin-top:8px;">Koleksi</div>

<a href="{{ route('admin.books.index') }}"
   class="nav-item {{ str_starts_with($route, 'admin.books') ? 'active' : '' }}">
    <i data-feather="book"></i>
    Manajemen Buku
</a>

<a href="{{ route('admin.categories.index') }}"
   class="nav-item {{ str_starts_with($route, 'admin.categories') ? 'active' : '' }}">
    <i data-feather="list"></i>
    Kategori
</a>

<div class="nav-section-label" style="margin-top:8px;">Sirkulasi</div>

<a href="{{ route('admin.loans.index') }}"
   class="nav-item {{ str_starts_with($route, 'admin.loans') ? 'active' : '' }}">
    <i data-feather="check-circle"></i>
    Peminjaman
    @php $pending = \App\Models\Loan::where('status','pending')->count(); @endphp
    @if($pending > 0)
        <span class="badge-nav">{{ $pending }}</span>
    @endif
</a>

<a href="{{ route('admin.members.index') }}"
   class="nav-item {{ str_starts_with($route, 'admin.members') ? 'active' : '' }}">
    <i data-feather="users"></i>
    Anggota
</a>

<a href="{{ route('admin.reports.index') }}"
   class="nav-item {{ str_starts_with($route, 'admin.reports') ? 'active' : '' }}">
    <i data-feather="bar-chart-2"></i>
    Laporan
</a>
