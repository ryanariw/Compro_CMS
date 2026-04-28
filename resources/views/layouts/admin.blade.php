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
        body { font-family: 'Open Sans', sans-serif; }
        .sidenav .navbar-nav .nav-link.active {
            background: linear-gradient(310deg,#5e72e4,#825ee4);
            color: #fff !important;
            box-shadow: 0 4px 20px 0 rgba(94,114,228,.14),0 7px 10px -5px rgba(94,114,228,.4);
        }
        .table td, .table th { vertical-align: middle; }
        .page-header-mini {
            border-radius: 1rem;
            background: linear-gradient(310deg,#172b4d,#1a174d);
            color: #fff;
        }
    </style>

    @stack('styles')
</head>
<body class="g-sidenav-show bg-gray-100">
    @include('admin.partials.sidebar')

    <main class="main-content position-relative border-radius-lg">
        @include('admin.partials.navbar')

        <div class="container-fluid py-4">
            @yield('content')
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/argon-dashboard/2.0.4/js/argon-dashboard.min.js"></script>
    @stack('scripts')
</body>
</html>