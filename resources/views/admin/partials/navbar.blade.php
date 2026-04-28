<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="false">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Admin</a></li>
                <li class="breadcrumb-item text-sm text-dark active" aria-current="page">@yield('title', 'Dashboard')</li>
            </ol>
            <h6 class="font-weight-bolder mb-0">@yield('title', 'Dashboard')</h6>
        </nav>

        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
            <div class="ms-md-auto pe-md-3 d-flex align-items-center"></div>

            <ul class="navbar-nav justify-content-end align-items-center">
                <li class="nav-item d-flex align-items-center me-3 text-sm text-dark">
                    <i class="fa fa-user me-2"></i>
                    {{ auth()->user()->name ?? 'Admin' }}
                </li>
                <li class="nav-item">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="btn btn-sm bg-gradient-dark mb-0" type="submit">Logout</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>