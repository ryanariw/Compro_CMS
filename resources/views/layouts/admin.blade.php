<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin CMS')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/argon-dashboard/2.0.4/css/nucleo-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/argon-dashboard/2.0.4/css/nucleo-svg.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/argon-dashboard/2.0.4/css/argon-dashboard.min.css">

    <style>
        body {
            font-family: 'Open Sans', sans-serif;
            overflow-x: hidden;
        }

        .sidenav .navbar-nav .nav-link.active {
            background: linear-gradient(310deg, #5e72e4, #825ee4);
            color: #fff !important;
            box-shadow: 0 4px 20px 0 rgba(94, 114, 228, .14), 0 7px 10px -5px rgba(94, 114, 228, .4);
        }

        .table td,
        .table th {
            vertical-align: middle;
        }

        .page-header-mini {
            border-radius: 1rem;
            background: linear-gradient(310deg, #172b4d, #1a174d);
            color: #fff;
        }

        .admin-mobile-toggle {
            display: none;
        }

        .admin-sidebar-overlay {
            display: none;
        }

        .main-content {
            min-height: 100vh;
        }

        .container-fluid {
            max-width: 100%;
        }

        .card {
            max-width: 100%;
        }

        .table-responsive {
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .btn {
            white-space: nowrap;
        }

        img {
            max-width: 100%;
            height: auto;
        }

        @media (max-width: 1199.98px) {
            body.g-sidenav-show {
                overflow-x: hidden;
            }

            .admin-mobile-toggle {
                display: inline-flex;
                position: fixed;
                top: 16px;
                left: 16px;
                z-index: 1052;
                width: 44px;
                height: 44px;
                border: 0;
                border-radius: 12px;
                background: #ffffff;
                color: #344767;
                align-items: center;
                justify-content: center;
                box-shadow: 0 8px 24px rgba(0, 0, 0, .15);
            }

            .admin-mobile-toggle i {
                font-size: 18px;
            }

            #sidenav-main {
                position: fixed !important;
                top: 0;
                left: 0;
                z-index: 1051;
                width: 270px;
                max-width: 82vw;
                height: 100vh;
                margin: 0 !important;
                border-radius: 0 1rem 1rem 0 !important;
                transform: translateX(-110%);
                transition: transform .25s ease;
            }

            body.admin-sidebar-open #sidenav-main {
                transform: translateX(0);
            }

            .admin-sidebar-overlay {
                display: none;
                position: fixed;
                inset: 0;
                z-index: 1050;
                background: rgba(0, 0, 0, .45);
            }

            body.admin-sidebar-open .admin-sidebar-overlay {
                display: block;
            }

            body.admin-sidebar-open {
                overflow: hidden;
            }

            .main-content {
                margin-left: 0 !important;
                width: 100% !important;
                max-width: 100% !important;
                padding-top: 72px;
            }

            .container-fluid {
                width: 100% !important;
                max-width: 100% !important;
                padding-left: 16px !important;
                padding-right: 16px !important;
                overflow-x: hidden;
            }

            .navbar-main,
            nav.navbar {
                margin-left: 0 !important;
                margin-right: 0 !important;
            }

            .row {
                margin-left: -8px !important;
                margin-right: -8px !important;
            }

            .row > [class*="col-"] {
                padding-left: 8px !important;
                padding-right: 8px !important;
            }

            .card {
                overflow: hidden;
                border-radius: 1rem;
            }

            .card-body {
                padding: 1rem !important;
            }

            .card-header {
                padding: 1rem !important;
            }

            .table-responsive table {
                min-width: 720px;
            }

            .dropdown-menu {
                max-width: calc(100vw - 32px);
            }
        }

        @media (max-width: 575.98px) {
            .container-fluid {
                padding-left: 12px !important;
                padding-right: 12px !important;
            }

            .card-header .d-flex,
            .card-body .d-flex {
                flex-direction: column;
                align-items: stretch !important;
                gap: 12px;
            }

            .card-header .btn,
            .card-body .btn {
                width: 100%;
                justify-content: center;
            }

            .page-header-mini {
                padding: 1.5rem !important;
            }

            h1, .h1 {
                font-size: 1.75rem !important;
            }

            h2, .h2 {
                font-size: 1.5rem !important;
            }

            h3, .h3 {
                font-size: 1.25rem !important;
            }

            h4, .h4 {
                font-size: 1.1rem !important;
            }

            .breadcrumb {
                flex-wrap: wrap;
            }

            .form-control,
            .form-select {
                font-size: 14px;
            }

            .btn-group {
                display: flex;
                flex-direction: column;
                width: 100%;
                gap: 8px;
            }

            .btn-group .btn {
                border-radius: .5rem !important;
            }
        }

        @media (min-width: 1200px) {
            #sidenav-main {
                transform: none !important;
            }

            .admin-sidebar-overlay,
            .admin-mobile-toggle {
                display: none !important;
            }
        }
    </style>

    @stack('styles')
</head>
<body class="g-sidenav-show bg-gray-100">

    <button type="button" class="admin-mobile-toggle" id="sidenavToggle" aria-label="Toggle sidebar">
        <i class="fas fa-bars" id="sidenavToggleIcon"></i>
    </button>

    <div class="admin-sidebar-overlay" id="sidenavOverlay"></div>

    @include('admin.partials.sidebar')

    <main class="main-content position-relative border-radius-lg">
        @include('admin.partials.navbar')

        <div class="container-fluid py-4">
            @yield('content')
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/argon-dashboard/2.0.4/js/argon-dashboard.min.js"></script>

    <script>
        (function () {
            const body = document.body;
            const toggleBtn = document.getElementById('sidenavToggle');
            const toggleIcon = document.getElementById('sidenavToggleIcon');
            const overlay = document.getElementById('sidenavOverlay');
            const closeBtn = document.getElementById('iconSidenav');
            const sidebarLinks = document.querySelectorAll('#sidenav-main .nav-link');

            function openSidebar() {
                body.classList.add('admin-sidebar-open');

                if (toggleIcon) {
                    toggleIcon.classList.remove('fa-bars');
                    toggleIcon.classList.add('fa-times');
                }
            }

            function closeSidebar() {
                body.classList.remove('admin-sidebar-open');

                if (toggleIcon) {
                    toggleIcon.classList.remove('fa-times');
                    toggleIcon.classList.add('fa-bars');
                }
            }

            function toggleSidebar() {
                if (body.classList.contains('admin-sidebar-open')) {
                    closeSidebar();
                } else {
                    openSidebar();
                }
            }

            if (toggleBtn) {
                toggleBtn.addEventListener('click', toggleSidebar);
            }

            if (overlay) {
                overlay.addEventListener('click', closeSidebar);
            }

            if (closeBtn) {
                closeBtn.addEventListener('click', closeSidebar);
            }

            sidebarLinks.forEach(function (link) {
                link.addEventListener('click', function () {
                    if (window.innerWidth < 1200) {
                        closeSidebar();
                    }
                });
            });

            window.addEventListener('resize', function () {
                if (window.innerWidth >= 1200) {
                    closeSidebar();
                }
            });
        })();
    </script>

    @stack('scripts')
</body>
</html>