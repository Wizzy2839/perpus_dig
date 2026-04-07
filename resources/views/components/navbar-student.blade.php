@php $route = request()->route()->getName(); @endphp

<header class="student-navbar">
    <div class="container" style="display: flex; align-items: center; justify-content: space-between; height: 100%;">
        
        <!-- Left Side: Brand & Links -->
        <div style="display: flex; align-items: center; height: 100%;">
            <!-- Brand -->
            <a href="{{ route('student.dashboard') }}" class="student-brand">
                <div class="icon">
                    <i data-feather="book-open"></i>
                </div>
                <span>E-Pustaka</span>
            </a>

            <!-- Navigation Links -->
            <nav class="student-nav">
                <a href="{{ route('student.dashboard') }}" class="student-nav-link {{ str_starts_with($route, 'student.dashboard') ? 'active' : '' }}">
                    Beranda
                </a>
                <a href="{{ route('student.catalog.index') }}" class="student-nav-link {{ str_starts_with($route, 'student.catalog') ? 'active' : '' }}">
                    Katalog Buku
                </a>
                <a href="{{ route('student.loans.index') }}" class="student-nav-link {{ str_starts_with($route, 'student.loans') ? 'active' : '' }}">
                    Riwayat Transaksi
                </a>
            </nav>
        </div>

        <!-- Right Side: User Menu & Search/Cart equivalent -->
        <div style="display: flex; align-items: center; gap: 24px; height: 100%;">
            
            <a href="{{ route('student.catalog.index') }}" style="color: var(--color-muted); display: flex; align-items: center; justify-content: center; width: 40px; height: 40px; border-radius: 50%; background: var(--color-bg); cursor: pointer; transition: background 0.2s, color 0.2s;" onmouseover="this.style.background='#e2e8f0'; this.style.color='var(--color-primary)';" onmouseout="this.style.background='var(--color-bg)'; this.style.color='var(--color-muted)';">
                <i data-feather="search" style="width: 18px; height: 18px;"></i>
            </a>

            <div style="width: 1px; height: 32px; background: var(--color-border);"></div>

            <!-- Profile Dropdown Equivalent -->
            <a href="{{ route('student.profile.index') }}" class="student-nav-link {{ str_starts_with($route, 'student.profile') ? 'active' : '' }}" style="border-bottom: none; gap: 12px; padding: 6px 12px; border-radius: 8px; transition: background 0.2s;" onmouseover="this.style.background='var(--color-bg)';" onmouseout="this.style.background='transparent';">
                <div style="display: flex; flex-direction: column; align-items: flex-end;">
                    <span style="font-size: 13.5px; font-weight: 700; color: var(--color-text); line-height: 1.2;">{{ auth()->user()->name }}</span>
                    <span style="font-size: 11px; color: var(--color-muted); font-weight: 500;">Profil Akun</span>
                </div>
                @if(auth()->user()->photo)
                    <img src="{{ Storage::url(auth()->user()->photo) }}" style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover; border: 2px solid var(--color-bg); box-shadow: var(--shadow-sm);">
                @else
                    <div style="width: 40px; height: 40px; border-radius: 50%; background: linear-gradient(135deg, var(--color-primary-light) 0%, var(--color-primary-dark) 100%); color: #fff; display: flex; align-items: center; justify-content: center; font-weight: 700; box-shadow: var(--shadow-sm);">
                        {{ substr(auth()->user()->name, 0, 1) }}
                    </div>
                @endif
            </a>
            
            <form action="{{ route('logout') }}" method="POST" style="margin: 0; display: flex; align-items: center;">
                @csrf
                <button type="submit" class="btn btn-outline" style="padding: 10px; border-color: rgba(220, 38, 38, 0.3); color: var(--color-danger); border-radius: 8px;" title="Keluar">
                    <i data-feather="log-out" style="width: 18px; height: 18px;"></i>
                </button>
            </form>
        </div>

    </div>
</header>
