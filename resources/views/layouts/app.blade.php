<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Sistem Perpustakaan Digital Sekolah">
    <title>@yield('title', 'Dashboard') — Perpustakaan Digital</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="{{ asset('assets/feather.min.js') }}"></script>
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --color-primary:      #1a3c5e;
            --color-primary-dark: #122840;
            --color-primary-light:#2563a8;
            --color-accent:       #2e7d32;
            --color-accent-light: #43a047;
            --color-bg:           #f0f4f8;
            --color-surface:      #ffffff;
            --color-sidebar:      #1a2332;
            --color-sidebar-text: #c5cfe4;
            --color-sidebar-hover:#253347;
            --color-sidebar-active:#2563a8;
            --color-text:         #1e293b;
            --color-muted:        #64748b;
            --color-border:       #e2e8f0;
            --color-danger:       #dc2626;
            --color-warning:      #d97706;
            --color-success:      #16a34a;
            --color-info:         #0284c7;
            --radius:             8px;
            --sidebar-w:          260px;
            --nav-h:              56px;
            --shadow-sm:          0 1px 3px rgba(0,0,0,.08);
            --shadow-md:          0 4px 12px rgba(0,0,0,.10);
            --shadow-lg:          0 8px 24px rgba(0,0,0,.12);
            --transition:         .2s ease;
        }

        html, body { height: 100%; font-family: 'Inter', system-ui, sans-serif; font-size: 14px; background: var(--color-bg); color: var(--color-text); }

        /* ── SIDEBAR ── */
        .sidebar {
            position: fixed; top: 0; left: 0; width: var(--sidebar-w); height: 100vh;
            background: var(--color-sidebar); display: flex; flex-direction: column;
            transition: transform var(--transition); z-index: 100; overflow-y: auto;
        }
        .sidebar-brand {
            padding: 20px 20px 16px; border-bottom: 1px solid rgba(255,255,255,.08);
            display: flex; align-items: center; gap: 12px;
        }
        .sidebar-brand-icon {
            width: 40px; height: 40px; background: var(--color-primary-light);
            border-radius: var(--radius); display: flex; align-items: center; justify-content: center; flex-shrink: 0;
        }
        .sidebar-brand-icon svg { color: #fff; width: 20px; height: 20px; }
        .sidebar-brand-text h1 { font-size: 13px; font-weight: 700; color: #fff; line-height: 1.2; }
        .sidebar-brand-text p  { font-size: 11px; color: var(--color-sidebar-text); }

        .sidebar-nav { padding: 16px 0; flex: 1; }
        .nav-section-label {
            font-size: 10px; font-weight: 600; letter-spacing: .08em;
            color: #4e6080; text-transform: uppercase; padding: 8px 20px 4px;
        }
        .nav-item { display: flex; align-items: center; gap: 12px; padding: 10px 20px;
            color: var(--color-sidebar-text); text-decoration: none; font-size: 13px; font-weight: 500;
            border-radius: 0; transition: background var(--transition), color var(--transition);
            position: relative; border-left: 3px solid transparent;
        }
        .nav-item:hover { background: var(--color-sidebar-hover); color: #fff; }
        .nav-item.active { background: rgba(37,99,168,.2); color: #fff; border-left-color: var(--color-primary-light); }
        .nav-item svg { width: 17px; height: 17px; flex-shrink: 0; }
        .nav-item .badge-nav {
            margin-left: auto; background: var(--color-danger); color: #fff;
            font-size: 10px; padding: 2px 6px; border-radius: 10px; font-weight: 600;
        }

        .sidebar-footer { padding: 16px 20px; border-top: 1px solid rgba(255,255,255,.08); }
        .sidebar-user { display: flex; align-items: center; gap: 10px; }
        .sidebar-user-avatar {
            width: 36px; height: 36px; background: var(--color-primary-light);
            border-radius: var(--radius); display: flex; align-items: center; justify-content: center; flex-shrink: 0;
        }
        .sidebar-user-avatar svg { width: 18px; height: 18px; color: #fff; }
        .sidebar-user-info { flex: 1; min-width: 0; }
        .sidebar-user-info .name { font-size: 12.5px; font-weight: 600; color: #fff; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .sidebar-user-info .role { font-size: 11px; color: var(--color-sidebar-text); }

        /* ── MAIN ── */
        .main-wrap { margin-left: var(--sidebar-w); min-height: 100vh; display: flex; flex-direction: column; }

        .topbar {
            height: var(--nav-h); background: var(--color-surface); border-bottom: 1px solid var(--color-border);
            display: flex; align-items: center; padding: 0 28px; gap: 16px;
            position: sticky; top: 0; z-index: 50; box-shadow: var(--shadow-sm);
        }
        .topbar-title { font-size: 16px; font-weight: 600; color: var(--color-text); flex: 1; }
        .topbar-actions { display: flex; align-items: center; gap: 8px; }

        .page-content { flex: 1; padding: 28px; }

        /* ── COMPONENTS ── */
        .card {
            background: var(--color-surface); border: 1px solid var(--color-border);
            border-radius: var(--radius); box-shadow: var(--shadow-sm); overflow: hidden;
        }
        .card-header {
            padding: 18px 24px; border-bottom: 1px solid var(--color-border);
            display: flex; align-items: center; justify-content: space-between; gap: 12px;
        }
        .card-header h2 { font-size: 15px; font-weight: 600; }
        .card-body { padding: 24px; }

        .stat-card {
            background: var(--color-surface); border: 1px solid var(--color-border);
            border-radius: var(--radius); padding: 20px 24px; box-shadow: var(--shadow-sm);
            display: flex; align-items: flex-start; gap: 16px;
        }
        .stat-icon {
            width: 48px; height: 48px; border-radius: var(--radius); display: flex;
            align-items: center; justify-content: center; flex-shrink: 0;
        }
        .stat-icon svg { width: 22px; height: 22px; }
        .stat-icon.blue   { background: #dbeafe; color: #1d4ed8; }
        .stat-icon.green  { background: #dcfce7; color: #16a34a; }
        .stat-icon.amber  { background: #fef3c7; color: #d97706; }
        .stat-icon.red    { background: #fee2e2; color: #dc2626; }
        .stat-icon.purple { background: #f3e8ff; color: #7c3aed; }
        .stat-icon.teal   { background: #ccfbf1; color: #0d9488; }
        .stat-info .label { font-size: 12px; color: var(--color-muted); margin-bottom: 4px; font-weight: 500; }
        .stat-info .value { font-size: 26px; font-weight: 700; color: var(--color-text); line-height: 1; }

        .stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 16px; margin-bottom: 24px; }

        /* Buttons */
        .btn {
            display: inline-flex; align-items: center; gap: 7px; padding: 8px 16px;
            font-size: 13.5px; font-weight: 500; border-radius: var(--radius);
            border: none; cursor: pointer; text-decoration: none; transition: all var(--transition);
            line-height: 1;
        }
        .btn svg { width: 15px; height: 15px; }
        .btn-primary   { background: var(--color-primary); color: #fff; }
        .btn-primary:hover { background: var(--color-primary-dark); }
        .btn-accent    { background: var(--color-accent); color: #fff; }
        .btn-accent:hover  { background: var(--color-accent-light); }
        .btn-danger    { background: var(--color-danger); color: #fff; }
        .btn-danger:hover  { background: #b91c1c; }
        .btn-outline   { background: transparent; color: var(--color-primary); border: 1.5px solid var(--color-primary); }
        .btn-outline:hover { background: var(--color-primary); color: #fff; }
        .btn-ghost     { background: transparent; color: var(--color-muted); border: 1.5px solid var(--color-border); }
        .btn-ghost:hover   { background: var(--color-bg); }
        .btn-sm { padding: 5px 10px; font-size: 12.5px; }
        .btn-sm svg { width: 13px; height: 13px; }

        /* Tables */
        .table-wrap { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; }
        thead th { background: var(--color-bg); font-size: 11.5px; font-weight: 600; color: var(--color-muted); text-transform: uppercase; letter-spacing: .05em; padding: 10px 16px; text-align: left; border-bottom: 1px solid var(--color-border); }
        tbody td { padding: 13px 16px; border-bottom: 1px solid var(--color-border); font-size: 13.5px; vertical-align: middle; }
        tbody tr:last-child td { border-bottom: none; }
        tbody tr:hover { background: #f8fafc; }

        /* Badges */
        .badge { display: inline-flex; align-items: center; gap: 4px; padding: 3px 10px; border-radius: 20px; font-size: 11.5px; font-weight: 600; }
        .badge-primary { background: #dbeafe; color: #1d4ed8; }
        .badge-success { background: #dcfce7; color: #16a34a; }
        .badge-warning { background: #fef3c7; color: #b45309; }
        .badge-danger  { background: #fee2e2; color: #dc2626; }
        .badge-secondary { background: #f1f5f9; color: #64748b; }

        /* Forms */
        .form-group { margin-bottom: 18px; }
        .form-label { display: block; font-size: 13px; font-weight: 500; margin-bottom: 6px; color: var(--color-text); }
        .form-control {
            width: 100%; padding: 9px 13px; font-size: 13.5px; font-family: inherit;
            border: 1.5px solid var(--color-border); border-radius: var(--radius);
            background: #fff; color: var(--color-text); transition: border-color var(--transition);
            outline: none;
        }
        .form-control:focus { border-color: var(--color-primary-light); box-shadow: 0 0 0 3px rgba(37,99,168,.1); }
        .form-control.is-invalid { border-color: var(--color-danger); }
        .invalid-feedback { font-size: 12px; color: var(--color-danger); margin-top: 4px; }
        select.form-control { appearance: none; background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%2364748b' stroke-width='2'%3E%3Cpolyline points='6 9 12 15 18 9'/%3E%3C/svg%3E"); background-repeat: no-repeat; background-position: right 12px center; padding-right: 36px; }
        textarea.form-control { resize: vertical; min-height: 90px; }
        .form-row { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 16px; }
        .form-hint { font-size: 11.5px; color: var(--color-muted); margin-top: 4px; }

        /* Alerts / Flash */
        .alert { padding: 12px 16px; border-radius: var(--radius); font-size: 13.5px; display: flex; align-items: flex-start; gap: 10px; margin-bottom: 20px; }
        .alert svg { width: 17px; height: 17px; flex-shrink: 0; margin-top: 1px; }
        .alert-success { background: #dcfce7; color: #166534; border: 1px solid #bbf7d0; }
        .alert-error   { background: #fee2e2; color: #991b1b; border: 1px solid #fecaca; }
        .alert-warning { background: #fef9c3; color: #854d0e; border: 1px solid #fef08a; }

        /* Pagination */
        .pagination { display: flex; align-items: center; gap: 4px; padding: 0; list-style: none; flex-wrap: wrap; }
        .pagination .page-link { display: flex; align-items: center; justify-content: center; min-width: 32px; height: 32px; padding: 0 8px; border: 1.5px solid var(--color-border); border-radius: var(--radius); font-size: 13px; color: var(--color-muted); text-decoration: none; transition: all var(--transition); }
        .pagination .page-link:hover { border-color: var(--color-primary); color: var(--color-primary); }
        .pagination .page-item.active .page-link { background: var(--color-primary); border-color: var(--color-primary); color: #fff; }
        .pagination .page-item.disabled .page-link { opacity: .45; pointer-events: none; }

        /* Empty state */
        .empty-state { text-align: center; padding: 48px 24px; }
        .empty-state svg { width: 48px; height: 48px; color: var(--color-muted); margin: 0 auto 16px; display: block; opacity: .5; }
        .empty-state h3 { font-size: 16px; font-weight: 600; margin-bottom: 6px; }
        .empty-state p  { font-size: 13.5px; color: var(--color-muted); }

        /* Book cover */
        .book-cover { width: 100%; aspect-ratio: 3/4; object-fit: cover; border-radius: calc(var(--radius) - 2px); background: var(--color-bg); }
        .book-cover-placeholder { width: 100%; aspect-ratio: 3/4; background: linear-gradient(135deg, #dbeafe 0%, #e0e7ff 100%); border-radius: calc(var(--radius) - 2px); display: flex; align-items: center; justify-content: center; }
        .book-cover-placeholder svg { width: 40px; height: 40px; color: #93c5fd; }

        .book-card { border: 1px solid var(--color-border); border-radius: var(--radius); overflow: hidden; background: #fff; box-shadow: var(--shadow-sm); transition: transform var(--transition), box-shadow var(--transition); }
        .book-card:hover { transform: translateY(-2px); box-shadow: var(--shadow-md); }
        .book-card-img { padding: 16px 16px 0; }
        .book-card-body { padding: 12px 16px 16px; }
        .book-card-title { font-size: 13.5px; font-weight: 600; margin-bottom: 4px; line-height: 1.4; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
        .book-card-author { font-size: 12px; color: var(--color-muted); margin-bottom: 10px; }

        .books-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(160px, 1fr)); gap: 16px; }

        /* Misc */
        .page-header { display: flex; align-items: flex-start; justify-content: space-between; margin-bottom: 24px; gap: 12px; flex-wrap: wrap; }
        .page-header h1 { font-size: 20px; font-weight: 700; }
        .page-header p  { font-size: 13.5px; color: var(--color-muted); margin-top: 2px; }
        .gap-2 { gap: 8px; }
        .d-flex { display: flex; }
        .align-center { align-items: center; }
        .flex-wrap { flex-wrap: wrap; }
        .ml-auto { margin-left: auto; }
        .mt-4 { margin-top: 16px; }
        .mb-4 { margin-bottom: 16px; }
        .text-muted { color: var(--color-muted); }
        .text-danger { color: var(--color-danger); }
        .fw-600 { font-weight: 600; }

        /* Search bar */
        .search-bar { display: flex; gap: 8px; margin-bottom: 20px; flex-wrap: wrap; }
        .search-input-wrap { position: relative; flex: 1; min-width: 200px; }
        .search-input-wrap svg { position: absolute; left: 11px; top: 50%; transform: translateY(-50%); color: var(--color-muted); width: 16px; height: 16px; pointer-events: none; }
        .search-input-wrap .form-control { padding-left: 36px; }

        /* Modal Overlay */
        .modal-overlay { position: fixed; inset: 0; background: rgba(0,0,0,.4); z-index: 200; display: flex; align-items: center; justify-content: center; opacity: 0; pointer-events: none; transition: opacity var(--transition); }
        .modal-overlay.open { opacity: 1; pointer-events: all; }
        .modal { background: #fff; border-radius: var(--radius); box-shadow: var(--shadow-lg); width: 100%; max-width: 520px; max-height: 90vh; overflow-y: auto; margin: 16px; transform: translateY(10px); transition: transform var(--transition); }
        .modal-overlay.open .modal { transform: translateY(0); }
        .modal-header { padding: 20px 24px 16px; border-bottom: 1px solid var(--color-border); display: flex; align-items: center; justify-content: space-between; }
        .modal-header h3 { font-size: 16px; font-weight: 600; }
        .modal-body { padding: 20px 24px; }
        .modal-footer { padding: 16px 24px; border-top: 1px solid var(--color-border); display: flex; justify-content: flex-end; gap: 8px; }

        .btn-close { background: none; border: none; cursor: pointer; color: var(--color-muted); display: flex; align-items: center; padding: 4px; border-radius: 4px; transition: color var(--transition); }
        .btn-close:hover { color: var(--color-text); }
        .btn-close svg { width: 18px; height: 18px; }

        /* Availability chip */
        .avail-chip { font-size: 11.5px; font-weight: 600; padding: 2px 8px; border-radius: 4px; }
        .avail-chip.available   { background: #dcfce7; color: #16a34a; }
        .avail-chip.unavailable { background: #fee2e2; color: #dc2626; }

        /* Toasts */
        .toast-container { position: fixed; bottom: 24px; right: 24px; z-index: 9999; display: flex; flex-direction: column; gap: 12px; pointer-events: none; }
        .toast { width: 340px; background: #fff; border-radius: var(--radius); padding: 16px; box-shadow: 0 4px 16px rgba(0,0,0,.12); display: flex; align-items: flex-start; gap: 12px; border: 1px solid var(--color-border); border-left: 4px solid var(--color-primary); transform: translateX(120%); opacity: 0; transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275); pointer-events: auto; }
        .toast.show { transform: translateX(0); opacity: 1; }
        .toast.toast-success { border-left-color: var(--color-success); }
        .toast.toast-error { border-left-color: var(--color-danger); }
        .toast-icon { padding-top: 2px; }
        .toast.toast-success .toast-icon { color: var(--color-success); }
        .toast.toast-error .toast-icon { color: var(--color-danger); }
        .toast-content { flex: 1; }
        .toast-title { font-size: 14px; font-weight: 600; margin-bottom: 4px; color: var(--color-text); }
        .toast-msg { font-size: 13px; color: var(--color-muted); line-height: 1.4; }
        .toast-close { background: none; border: none; cursor: pointer; color: var(--color-muted); padding: 2px; transition: color .2s; }
        .toast-close:hover { color: var(--color-text); }

        /* Student Navbar E-Commerce Style */
        .student-navbar { background: #fff; border-bottom: 1px solid var(--color-border); position: sticky; top: 0; z-index: 100; box-shadow: 0 2px 10px rgba(0,0,0,0.04); height: 64px; }
        .student-brand { display: flex; align-items: center; gap: 10px; font-size: 16px; font-weight: 800; color: var(--color-text); text-decoration: none; letter-spacing: -0.5px; }
        .student-brand .icon { width: 34px; height: 34px; background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-light) 100%); color: #fff; border-radius: 10px; display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 10px rgba(37,99,168,0.25); }
        .student-brand .icon svg { width: 18px; height: 18px; }
        .student-nav { display: flex; align-items: center; gap: 28px; height: 100%; margin-left: 36px; }
        .student-nav-link { display: flex; align-items: center; gap: 8px; color: var(--color-muted); font-size: 14px; font-weight: 600; text-decoration: none; height: 100%; border-bottom: 3px solid transparent; transition: all 0.2s; }
        .student-nav-link:hover { color: var(--color-primary); }
        .student-nav-link.active { color: var(--color-primary); border-bottom-color: var(--color-primary); }
        
        .container { width: 100%; padding-left: 24px; padding-right: 24px; margin-right: auto; margin-left: auto; }
        @media (min-width: 992px) { .container { max-width: 960px; } }
        @media (min-width: 1200px) { .container { max-width: 1140px; } }

        .layout-student .main-wrap { margin-left: 0; display: flex; flex-direction: column; min-height: calc(100vh - 72px); }
        .layout-student .page-content { padding: 8px 0 40px; flex: 1; }
        .layout-student-header { padding: 24px 0 12px; }
        .layout-student-header h1 { font-size: 24px; font-weight: 700; color: var(--color-text); letter-spacing: -0.5px; }

        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.open { transform: translateX(0); }
            .main-wrap { margin-left: 0; }
            .layout-student-header { padding: 24px 0 8px; }
            .layout-student-header h1 { font-size: 20px; }
            .layout-student .page-content { padding: 16px 0 32px; }
            .toast-container { bottom: 16px; right: 16px; left: 16px; align-items: center; }
            .toast { width: 100%; max-width: 400px; transform: translateY(100px); }
            .toast.show { transform: translateY(0); }
            .student-nav { display: none; } /* On very small screens we might hide or make a hamburger, simple hide for now */
        }
        
        /* Global App Preloader CSS */
        #global-preloader { position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; background: #ffffff; z-index: 999999; display: flex; flex-direction: column; align-items: center; justify-content: center; transition: opacity 0.6s ease, visibility 0.6s ease; }
        #global-preloader.loaded { opacity: 0; visibility: hidden; }
        .book-preloader { position: relative; width: 64px; height: 64px; perspective: 200px; margin-bottom: 24px; }
        .book-preloader .page { width: 32px; height: 48px; background: var(--color-primary); position: absolute; top: 8px; border-radius: 2px 4px 4px 2px; box-shadow: inset 0 0 10px rgba(0,0,0,0.1); transform-origin: left center; animation: pageTurn 1.2s infinite linear; }
        .book-preloader .page:nth-child(1) { right: 50%; transform-origin: right center; animation: pageTurnLeft 1.2s infinite linear; background: var(--color-primary-light); }
        .book-preloader .page:nth-child(2) { left: 50%; }
        .book-preloader .page:nth-child(3) { left: 50%; animation-delay: 0.4s; }
        .book-preloader .page:nth-child(4) { left: 50%; animation-delay: 0.8s; }
        @keyframes pageTurn { 0% { transform: rotateY(0deg); opacity: 1; } 49% { opacity: 1; } 50% { transform: rotateY(-180deg); opacity: 0; } 100% { transform: rotateY(-180deg); opacity: 0; } }
        @keyframes pageTurnLeft { 0% { transform: rotateY(0deg); opacity: 0; } 49% { opacity: 0; } 50% { transform: rotateY(180deg); opacity: 1; } 100% { transform: rotateY(180deg); opacity: 1; } }
        .preloader-text { font-size: 13px; font-weight: 700; color: var(--color-primary-dark); text-transform: uppercase; letter-spacing: 2px; animation: pulse 1.5s infinite ease-in-out; }
        @keyframes pulse { 0%, 100% { opacity: 0.5; } 50% { opacity: 1; } }
    </style>
    @stack('styles')
</head>
<body class="{{ auth()->check() && !auth()->user()->isAdmin() ? 'layout-student' : 'layout-admin' }}">
    <!-- Global Preloader UI -->
    <div id="global-preloader">
        <div class="book-preloader">
            <div class="page"></div>
            <div class="page"></div>
            <div class="page"></div>
            <div class="page"></div>
        </div>
        <div class="preloader-text">Memuat Sistem...</div>
    </div>
    @if(auth()->check() && !auth()->user()->isAdmin())
        <!-- STUDENT NAVBAR (TOP) -->
        @include('components.navbar-student')
    @else
        <!-- ADMIN SIDEBAR (LEFT) -->
        <aside class="sidebar" id="sidebar">
        <div class="sidebar-brand">
            <div class="sidebar-brand-icon">
                <i data-feather="book-open"></i>
            </div>
            <div class="sidebar-brand-text">
                <h1>Perpustakaan<br>Digital</h1>
                <p>{{ \App\Models\Setting::get('school_name', 'Sekolah') }}</p>
            </div>
        </div>

        <nav class="sidebar-nav">
            @if(auth()->user()->isAdmin())
                @include('components.sidebar-admin')
            @endif
        </nav>

        <div class="sidebar-footer">
            <div class="sidebar-user">
                <div class="sidebar-user-avatar">
                    <i data-feather="user" style="color: #fff;"></i>
                </div>
                <div class="sidebar-user-info">
                    <div class="name">{{ auth()->user()->name }}</div>
                    <div class="role">Administrator</div>
                </div>
            </div>
            <form action="{{ route('logout') }}" method="POST" style="margin-top:12px;">
                @csrf
                <button type="submit" class="btn btn-ghost btn-sm" style="width:100%;justify-content:center;">
                    <i data-feather="log-out"></i>
                    Keluar
                </button>
            </form>
        </div>
    </aside>
    @endif

    <div class="main-wrap">
        @if(auth()->check() && auth()->user()->isAdmin())
            <header class="topbar">
                <div class="topbar-title">@yield('page-title', 'Dashboard')</div>
                <div class="topbar-actions">
                    @yield('topbar-actions')
                </div>
            </header>
            
            <main class="page-content">
                @yield('content')
            </main>
        @else
            <!-- STUDENT CONTENT WRAPPER -->
            <div class="layout-student-header">
                <div class="container" style="display: flex; justify-content: space-between; align-items: flex-end; flex-wrap: wrap; gap: 16px;">
                    <div>
                        <h1>@yield('page-title', 'Katalog Buku')</h1>
                    </div>
                    <div style="display: flex; align-items: center; gap: 12px;">
                        @yield('topbar-actions')
                    </div>
                </div>
            </div>
            
            <main class="page-content">
                <div class="container">
                    @yield('content')
                </div>
            </main>
            
            @include('components.footer-student')
        @endif
    </div>

    <!-- UI TOAST -->
    <div class="toast-container" id="uiToastContainer">
        @if(session('success'))
            <div class="toast toast-success" id="toastSuccess">
                <div class="toast-icon">
                    <i data-feather="check-circle" style="width: 20px; height: 20px;"></i>
                </div>
                <div class="toast-content">
                    <div class="toast-title">Berhasil</div>
                    <div class="toast-msg">{{ session('success') }}</div>
                </div>
                <button class="toast-close" onclick="this.closest('.toast').classList.remove('show')">
                    <i data-feather="x" style="width: 16px; height: 16px;"></i>
                </button>
            </div>
        @endif

        @if(session('error'))
            <div class="toast toast-error" id="toastError">
                <div class="toast-icon">
                    <i data-feather="alert-circle" style="width: 20px; height: 20px;"></i>
                </div>
                <div class="toast-content">
                    <div class="toast-title">Perhatian</div>
                    <div class="toast-msg">{{ session('error') }}</div>
                </div>
                <button class="toast-close" onclick="this.closest('.toast').classList.remove('show')">
                    <i data-feather="x" style="width: 16px; height: 16px;"></i>
                </button>
            </div>
        @endif
    </div>

    <!-- UI CONFIRM MODAL -->
    <div id="uiConfirmModal" class="modal-overlay">
        <div class="modal" style="max-width: 400px;">
            <div class="modal-header">
                <h3>Konfirmasi Tindakan</h3>
                <button class="btn-close" onclick="document.getElementById('uiConfirmModal').classList.remove('open')">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">
                <p id="uiConfirmMsg" style="font-size: 14px; line-height: 1.5;"></p>
            </div>
            <div class="modal-footer" style="background: #f8fafc;">
                <button class="btn btn-ghost" onclick="document.getElementById('uiConfirmModal').classList.remove('open')">Batal</button>
                <button class="btn btn-primary" id="uiConfirmYesBtn">Ya, Lanjutkan</button>
            </div>
        </div>
    </div>

    <script>
        // Inisiasi Feather Icons saat halaman siap
        document.addEventListener("DOMContentLoaded", function() {
            feather.replace();
        });
        document.addEventListener('DOMContentLoaded', function () {
            feather.replace();

            // Auto-show toasts for server flash messages
            const autoToasts = document.querySelectorAll('#uiToastContainer .toast');
            autoToasts.forEach((toast, index) => {
                setTimeout(() => {
                    toast.classList.add('show');
                    // Auto hide after 4 seconds
                    setTimeout(() => {
                        toast.classList.remove('show');
                    }, 4000);
                }, 100 + (index * 150));
            });
        });

        // Custom Confirm Logic
        window.appConfirm = function(el, event, message) {
            // Jika sudah dikonfirmasi, ijinkan submit natural (lewati prompt)
            if (el.dataset.confirmed === 'true') {
                el.dataset.confirmed = 'false';
                return true; 
            }
            
            event.preventDefault();
            document.getElementById('uiConfirmMsg').innerHTML = message;
            const modal = document.getElementById('uiConfirmModal');
            modal.classList.add('open');

            const confirmBtn = document.getElementById('uiConfirmYesBtn');
            const newConfirmBtn = confirmBtn.cloneNode(true);
            confirmBtn.parentNode.replaceChild(newConfirmBtn, confirmBtn);

            newConfirmBtn.addEventListener('click', function() {
                modal.classList.remove('open');
                el.dataset.confirmed = 'true';
                
                // Cari form jika elemen bukan form
                const formToSubmit = el.tagName === 'FORM' ? el : el.closest('form');
                if (formToSubmit) {
                    formToSubmit.submit();
                } else if (el.tagName === 'A') {
                    window.location.href = el.href;
                }
            });
            
            return false;
        };

        // Window Load Preloader Fade-out Event
        window.addEventListener('load', function() {
            const preloader = document.getElementById('global-preloader');
            if (preloader) {
                // Minimum visualization time to show the cool animation
                setTimeout(() => { preloader.classList.add('loaded'); }, 300);
            }
        });
        
        // Fallback in case window load stalls on heavy network images
        document.addEventListener("DOMContentLoaded", function() {
            setTimeout(() => {
                const preloader = document.getElementById('global-preloader');
                if (preloader && !preloader.classList.contains('loaded')) {
                    preloader.classList.add('loaded');
                }
            }, 6000); // Auto remove after 6 seconds
        });
    </script>
    @stack('scripts')
</body>
</html>
