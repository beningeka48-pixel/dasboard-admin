<!DOCTYPE html>

<html lang="id">

<head>

```
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>
    @yield('title', 'KracakNu Super Admin')
</title>

{{-- Bootstrap --}}
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet">

{{-- Bootstrap Icons --}}
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
      rel="stylesheet">

<style>

    * {
        box-sizing: border-box;
    }

    body {
        background-color: #f5f7f9;
        font-family: Arial, sans-serif;
        margin: 0;
    }


    /* =====================================================
       SIDEBAR
    ====================================================== */

    .sidebar {

        width: 250px;
        height: 100vh;

        background: #172b1f;

        position: fixed;
        left: 0;
        top: 0;

        padding: 25px 15px;

        z-index: 1000;

        display: flex;
        flex-direction: column;

        overflow: hidden;
    }


    /* =====================================================
       BRAND
    ====================================================== */

    .brand {

        color: white;

        font-size: 23px;
        font-weight: bold;

        text-decoration: none;

        display: block;

        padding: 0 15px;

        margin-bottom: 25px;

        flex-shrink: 0;
    }

    .brand span {
        color: #9bd3b1;
    }


    /* =====================================================
       ROLE BADGE
    ====================================================== */

    .admin-badge {

        margin: 0 15px 20px;

        padding: 8px 12px;

        background: rgba(255, 255, 255, 0.08);

        border-radius: 8px;

        color: #9bd3b1;

        font-size: 13px;
        font-weight: bold;

        flex-shrink: 0;
    }


    /* =====================================================
       SIDEBAR MENU
    ====================================================== */

    .sidebar-menu {

        list-style: none;

        padding: 0;
        margin: 0;

        /*
         * Bagian menu mengambil ruang yang tersedia.
         * Jika menu terlalu panjang, hanya bagian ini
         * yang akan melakukan scroll.
         */
        flex: 1 1 auto;

        min-height: 0;

        overflow-y: auto;
        overflow-x: hidden;

        padding-right: 3px;
    }


    /* Scrollbar */

    .sidebar-menu::-webkit-scrollbar {
        width: 5px;
    }

    .sidebar-menu::-webkit-scrollbar-track {
        background: transparent;
    }

    .sidebar-menu::-webkit-scrollbar-thumb {
        background: #315c42;
        border-radius: 10px;
    }

    .sidebar-menu::-webkit-scrollbar-thumb:hover {
        background: #4b765b;
    }


    /* Firefox */

    .sidebar-menu {
        scrollbar-width: thin;
        scrollbar-color: #315c42 transparent;
    }


    /* =====================================================
       MENU ITEM
    ====================================================== */

    .sidebar-menu li {

        margin-bottom: 6px;

        width: 100%;
    }


    .sidebar-menu a {

        display: flex;
        align-items: center;

        width: 100%;

        color: #dce9e1;

        text-decoration: none;

        padding: 12px 15px;

        border-radius: 10px;

        transition: all 0.2s ease;

        white-space: nowrap;
    }


    .sidebar-menu a:hover,
    .sidebar-menu a.active {

        background-color: #315c42;

        color: white;

        transform: translateX(2px);
    }


    /* =====================================================
       SIDEBAR BOTTOM
    ====================================================== */

    .sidebar-bottom {

        /*
         * Penting:
         * Bagian ini TIDAK ikut scroll bersama menu.
         * Settings dan Logout selalu berada di bawah.
         */

        flex-shrink: 0;

        margin-top: 10px;

        padding-top: 12px;

        border-top: 1px solid rgba(255, 255, 255, 0.12);

        background: #172b1f;
    }


    .sidebar-bottom a,
    .sidebar-bottom button {

        display: flex;
        align-items: center;

        width: 100%;

        border-radius: 10px;

        transition: all 0.2s ease;
    }


    .sidebar-bottom a:hover {

        background-color: rgba(255, 255, 255, 0.08);
    }


    .sidebar-bottom button:hover {

        background-color: rgba(220, 53, 69, 0.12);
    }


    /* =====================================================
       MAIN CONTENT
    ====================================================== */

    .main-content {

        margin-left: 250px;

        padding: 30px;

        min-height: 100vh;

        width: calc(100% - 250px);
    }


    /* =====================================================
       TOPBAR
    ====================================================== */

    .topbar {

        background: white;

        border-radius: 15px;

        padding: 18px 25px;

        margin-bottom: 25px;

        box-shadow:
            0 3px 15px rgba(0, 0, 0, 0.05);
    }


    /* =====================================================
       DARK MODE
    ====================================================== */

    html[data-theme="dark"] body {

        background-color: #121212;

        color: #e9ecef;
    }


    html[data-theme="dark"] .topbar,
    html[data-theme="dark"] .card {

        background-color: #1e1e1e !important;

        color: #e9ecef;
    }


    html[data-theme="dark"] .text-muted {

        color: #adb5bd !important;
    }


    html[data-theme="dark"] .form-control,
    html[data-theme="dark"] .form-select,
    html[data-theme="dark"] textarea {

        background-color: #2b2b2b;

        color: #fff;

        border-color: #495057;
    }


    /* =====================================================
       RESPONSIVE
    ====================================================== */

    @media (max-width: 768px) {

        .sidebar {

            width: 100%;

            height: auto;

            min-height: auto;

            position: relative;

            overflow: visible;
        }


        .sidebar-menu {

            max-height: none;

            overflow-y: visible;
        }


        .sidebar-bottom {

            margin-top: 15px;
        }


        .main-content {

            margin-left: 0;

            width: 100%;

            padding: 20px;
        }

    }


    /* =====================================================
       MOBILE SMALL
    ====================================================== */

    @media (max-width: 576px) {

        .topbar {

            padding: 15px;

            flex-direction: column;

            align-items: flex-start !important;

            gap: 10px;
        }

    }

</style>


@stack('styles')


{{-- =====================================================
     THEME
====================================================== --}}

<script>

    const savedTheme =
        localStorage.getItem('kracaknu-theme') || 'light';

    document.documentElement.setAttribute(
        'data-theme',
        savedTheme
    );

</script>
```

</head>

<body>

```
{{-- =====================================================
     SIDEBAR SUPER ADMIN
====================================================== --}}

<div class="sidebar">


    {{-- BRAND --}}

    <a href="{{ route('superadmin.dashboard') }}"
       class="brand">

        DINKAN
        <span>(Digitalisasi Nu Kracak)</span>

    </a>


    {{-- ROLE --}}

    <div class="admin-badge">

        <i class="bi bi-shield-check"></i>

        SUPER ADMIN

    </div>


    {{-- =================================================
         MENU UTAMA
    ================================================== --}}

    <ul class="sidebar-menu">


        {{-- Dashboard --}}

        <li>

            <a href="{{ route('superadmin.dashboard') }}"
               class="{{ request()->routeIs('superadmin.dashboard') ? 'active' : '' }}">

                <i class="bi bi-speedometer2 me-2"></i>

                Dashboard

            </a>

        </li>


        {{-- Citizens --}}

        <li>

            <a href="{{ route('citizens.index') }}"
               class="{{ request()->routeIs('citizens.*') ? 'active' : '' }}">

                <i class="bi bi-people me-2"></i>

                Citizens

            </a>

        </li>


        {{-- News --}}

        <li>

            <a href="{{ route('news.index') }}"
               class="{{ request()->routeIs('news.*') ? 'active' : '' }}">

                <i class="bi bi-newspaper me-2"></i>

                News

            </a>

        </li>


        {{-- NU Activities --}}

        <li>

            <a href="{{ route('nu_activities.index') }}"
               class="{{ request()->routeIs('nu_activities.*') ? 'active' : '' }}">

                <i class="bi bi-moon-stars me-2"></i>

                NU Activities

            </a>

        </li>


        {{-- NU Institutions --}}

        <li>

            <a href="{{ route('nu-institutions.index') }}"
               class="{{ request()->routeIs('nu-institutions.*') ? 'active' : '' }}">

                <i class="bi bi-building me-2"></i>

                NU Institutions

            </a>

        </li>


        {{-- Pengurus --}}

        <li>

            <a href="{{ route('pengurus.index') }}"
               class="{{ request()->routeIs('pengurus.*') ? 'active' : '' }}">

                <i class="bi bi-person-badge me-2"></i>

                Pengurus

            </a>

        </li>


        {{-- Kotak Saran --}}

        <li>

            <a href="{{ route('sarans.index') }}"
               class="{{ request()->routeIs('sarans.*') ? 'active' : '' }}">

                <i class="bi bi-chat-left-text me-2"></i>

                Kotak Saran

            </a>

        </li>


        {{-- Announcements --}}

        <li>

            <a href="{{ route('announcements.index') }}"
               class="{{ request()->routeIs('announcements.*') ? 'active' : '' }}">

                <i class="bi bi-megaphone me-2"></i>

                Announcements

            </a>

        </li>


        {{-- Reports --}}

        <li>

            <a href="{{ route('reports.index') }}"
               class="{{ request()->routeIs('reports.*') ? 'active' : '' }}">

                <i class="bi bi-bar-chart-line me-2"></i>

                Reports

            </a>

        </li>


        {{-- USER MANAGEMENT --}}

        <li>

            <a href="{{ route('users.index') }}"
               class="{{ request()->routeIs('users.*') ? 'active' : '' }}">

                <i class="bi bi-person-gear me-2"></i>

                User Management

            </a>

        </li>


    </ul>


    {{-- =================================================
         SIDEBAR BOTTOM
    ================================================== --}}

    <div class="sidebar-bottom">


        {{-- Settings --}}

        <a href="{{ route('settings') }}"
           class="text-decoration-none text-light p-2 mb-1">

            <i class="bi bi-gear me-2"></i>

            Settings

        </a>


        {{-- Logout --}}

        <form action="{{ route('logout') }}"
              method="POST"
              class="m-0">

            @csrf

            <button type="submit"
                    class="btn btn-link text-danger text-decoration-none p-2 w-100 text-start">

                <i class="bi bi-box-arrow-right me-2"></i>

                Logout

            </button>

        </form>


    </div>

</div>


{{-- =====================================================
     MAIN CONTENT
====================================================== --}}

<div class="main-content">


    {{-- =================================================
         TOPBAR
    ================================================== --}}

    <div class="topbar d-flex justify-content-between align-items-center">


        <div>

            <h4 class="fw-bold mb-1">

                @yield(
                    'page-title',
                    'Super Admin Dashboard'
                )

            </h4>


            <p class="text-muted mb-0">

                @yield(
                    'page-description',
                    'Welcome to KracakNu Super Admin'
                )

            </p>

        </div>


        <div class="text-end">

            <strong>

                {{ auth()->user()->name ?? 'Super Administrator' }}

            </strong>

            <br>

            <small class="text-muted">

                Super Administrator

            </small>

        </div>


    </div>


    {{-- =================================================
         PAGE CONTENT
    ================================================== --}}

    @yield('content')


</div>


{{-- Bootstrap JS --}}

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
</script>


@stack('scripts')
```

</body>

</html>
