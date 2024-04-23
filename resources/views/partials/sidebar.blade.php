<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-text mx-3">ArseneLIB</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ Request::is('dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="/dashboard">
            <i class="fas fa-fw fa-h-square"></i>
            <span>Dashboard</span></a>
    </li>

    @if (auth()->user()->role == 'admin')
        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Administrator
        </div>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item {{ Request::is('buku') ? 'active' : '' }}">
            <a class="nav-link" href="/buku">
                <i class="fas fa-fw fa-book"></i>
                <span>Buku</span></a>
        </li>
        <li class="nav-item {{ Request::is('kategori') ? 'active' : '' }}">
            <a class="nav-link" href="/kategori">
                <i class="fas fa-fw fa-bars"></i>
                <span>Kategori</span></a>
        </li>
        <li class="nav-item {{ Request::is('user') ? 'active' : '' }}">
            <a class="nav-link" href="/user">
                <i class="fas fa-fw fa-user"></i>
                <span>Manajemen User</span></a>
        </li>
    @endif

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Info
    </div>

    @if (auth()->user()->role == 'admin')
        <!-- Nav Item - Charts -->
        <li class="nav-item {{ Request::is('peminjaman') || Request::is('peminjaman-user') ? 'active' : '' }}">
            <a class="nav-link" href="/peminjaman">
                <i class="fas fa-fw fa-clone"></i>
                <span>Status Peminjaman</span></a>
        </li>
    @endif

    @if (auth()->user()->role == 'pustakawan')
        <!-- Nav Item - Charts -->
        <li class="nav-item {{ Request::is('peminjaman') || Request::is('peminjaman-user') ? 'active' : '' }}">
            <a class="nav-link" href="/peminjaman">
                <i class="fas fa-fw fa-clone"></i>
                <span>Status Peminjaman</span></a>
        </li>
    @endif

    <!-- Nav Item - Tables -->
    <li class="nav-item {{ Request::is('history') ? 'active' : '' }}">
        <a class="nav-link" href="/history">
            <i class="fas fa-fw fa-bookmark"></i>
            <span>{{ auth()->user()->role == 'user' ? 'History' : 'Laporan' }} Peminjaman</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>


</ul>
<!-- End of Sidebar -->
