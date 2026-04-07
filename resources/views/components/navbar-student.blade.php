@php $route = request()->route()->getName(); @endphp

<header class="student-navbar" id="student-navbar">
    <div class="sn-inner">

        <!-- Brand -->
        <a href="{{ route('student.dashboard') }}" class="student-brand">
            <div class="student-brand-logo">
                <img src="{{ asset('assets/image/logo.png') }}" alt="Logo">
            </div>
            <div class="student-brand-text">
                <span class="sbt-name">{{ \App\Models\Setting::get('library_name', 'Simbok') }}</span>
                <span class="sbt-sub">{{ \App\Models\Setting::get('school_name', 'SMK PGRI 2 Ponorogo') }}</span>
            </div>
        </a>

        <!-- Center Nav -->
        <nav class="sn-links">
            <a href="{{ route('student.dashboard') }}" class="sn-link {{ str_starts_with($route, 'student.dashboard') ? 'active' : '' }}">
                <i data-feather="home"></i>
                <span>Beranda</span>
            </a>
            <a href="{{ route('student.catalog.index') }}" class="sn-link {{ str_starts_with($route, 'student.catalog') ? 'active' : '' }}">
                <i data-feather="book-open"></i>
                <span>Katalog</span>
            </a>
            <a href="{{ route('student.loans.index') }}" class="sn-link {{ str_starts_with($route, 'student.loans') ? 'active' : '' }}">
                <i data-feather="clock"></i>
                <span>Riwayat</span>
            </a>
        </nav>

        <!-- Right Actions -->
        <div class="sn-actions">
            <!-- Profile -->
            <a href="{{ route('student.profile.index') }}" class="sn-profile {{ str_starts_with($route, 'student.profile') ? 'active' : '' }}">
                @if(auth()->user()->photo)
                    <img src="{{ Storage::url(auth()->user()->photo) }}" class="sn-avatar" alt="Avatar">
                @else
                    <div class="sn-avatar sn-avatar-initials">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                @endif
                <div class="sn-profile-info">
                    <span class="sn-profile-name">{{ explode(' ', auth()->user()->name)[0] }}</span>
                    <span class="sn-profile-role">{{ auth()->user()->kelas }}</span>
                </div>
                <i data-feather="chevron-down" class="sn-chevron"></i>
            </a>

            <!-- Logout -->
            <form action="{{ route('logout') }}" method="POST" style="margin:0;">
                @csrf
                <button type="submit" class="sn-logout" title="Keluar">
                    <i data-feather="log-out"></i>
                </button>
            </form>
        </div>
    </div>
</header>

<style>
    .student-navbar {
        background: #fff;
        border-bottom: 1px solid var(--color-border);
        position: sticky;
        top: 0;
        z-index: 100;
        height: 68px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.06), 0 4px 16px rgba(0,0,0,0.04);
        transition: box-shadow .3s;
    }
    .student-navbar.scrolled {
        box-shadow: 0 2px 16px rgba(0,0,0,0.10);
    }
    .sn-inner {
        display: flex;
        align-items: center;
        justify-content: space-between;
        height: 100%;
        max-width: 1280px;
        margin: 0 auto;
        padding: 0 28px;
        gap: 24px;
    }

    /* Brand */
    .student-brand {
        display: flex;
        align-items: center;
        gap: 11px;
        text-decoration: none;
        flex-shrink: 0;
    }
    .student-brand-logo {
        width: 38px; height: 38px;
        border-radius: 10px;
        background: #EFF6FF;
        border: 1px solid #DBEAFE;
        display: flex; align-items: center; justify-content: center;
        overflow: hidden;
        flex-shrink: 0;
    }
    .student-brand-logo img {
        width: 28px; height: 28px;
        object-fit: contain;
    }
    .student-brand-text {
        display: flex;
        flex-direction: column;
        line-height: 1.2;
    }
    .sbt-name {
        font-size: 14.5px;
        font-weight: 800;
        color: var(--color-primary);
        letter-spacing: -0.2px;
    }
    .sbt-sub {
        font-size: 11px;
        color: var(--color-muted);
        font-weight: 500;
    }

    /* Center Nav */
    .sn-links {
        display: flex;
        align-items: center;
        gap: 4px;
        background: var(--color-bg);
        border: 1px solid var(--color-border);
        border-radius: 100px;
        padding: 4px;
    }
    .sn-link {
        display: flex;
        align-items: center;
        gap: 7px;
        padding: 7px 16px;
        border-radius: 100px;
        font-size: 13.5px;
        font-weight: 600;
        color: var(--color-muted);
        text-decoration: none;
        transition: all .2s;
        white-space: nowrap;
    }
    .sn-link i { width: 15px; height: 15px; flex-shrink: 0; }
    .sn-link:hover {
        color: var(--color-primary);
        background: #fff;
    }
    .sn-link.active {
        background: var(--color-primary);
        color: #fff;
        box-shadow: 0 2px 8px rgba(26,60,94,0.2);
    }

    /* Right Actions */
    .sn-actions {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-shrink: 0;
    }

    /* Profile */
    .sn-profile {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 5px 14px 5px 5px;
        border-radius: 100px;
        border: 1.5px solid var(--color-border);
        text-decoration: none;
        background: #fff;
        transition: all .2s;
        cursor: pointer;
    }
    .sn-profile:hover, .sn-profile.active {
        border-color: var(--color-primary);
        background: #EFF6FF;
    }
    .sn-avatar {
        width: 32px; height: 32px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid var(--color-border);
        flex-shrink: 0;
    }
    .sn-avatar-initials {
        width: 32px; height: 32px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--color-primary-light), var(--color-primary-dark));
        color: #fff;
        display: flex; align-items: center; justify-content: center;
        font-size: 13px;
        font-weight: 700;
    }
    .sn-profile-info {
        display: flex;
        flex-direction: column;
        line-height: 1.2;
    }
    .sn-profile-name {
        font-size: 13px;
        font-weight: 700;
        color: var(--color-text);
    }
    .sn-profile-role {
        font-size: 11px;
        color: var(--color-muted);
        font-weight: 500;
    }
    .sn-chevron {
        width: 14px; height: 14px;
        color: var(--color-muted);
    }

    /* Logout button */
    .sn-logout {
        width: 38px; height: 38px;
        border-radius: 10px;
        border: 1.5px solid rgba(220,38,38,0.2);
        background: rgba(220,38,38,0.05);
        color: var(--color-danger);
        display: flex; align-items: center; justify-content: center;
        cursor: pointer;
        transition: all .2s;
    }
    .sn-logout:hover {
        background: #FEF2F2;
        border-color: var(--color-danger);
    }
    .sn-logout i { width: 16px; height: 16px; }

    @media (max-width: 768px) {
        .sbt-sub { display: none; }
        .sn-link span { display: none; }
        .sn-link { padding: 8px 10px; }
        .sn-profile-info { display: none; }
        .sn-chevron { display: none; }
        .sn-inner { padding: 0 16px; gap: 12px; }
    }
</style>

<script>
    const snavbar = document.getElementById('student-navbar');
    window.addEventListener('scroll', () => {
        snavbar.classList.toggle('scrolled', window.scrollY > 10);
    });
</script>
