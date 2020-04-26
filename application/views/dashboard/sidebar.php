<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" style="color: #fff">
        <div class="sidebar-brand-icon">
            <i class="fas fa-fw fa-tachometer-alt"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Dashboard</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="<?= base_url(); ?>dashboard" aria-disabled="true">
            <i class="fas fa-user"></i>
            <span><?= $user['nama_gs']; ?></span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Menu
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" id="menu-side" href="<?= base_url(); ?>dashboard/request/<?= $user['id_gs']; ?>">
            <i class="fas fa-envelope-open-text"></i>
            <span>Tawaran</span>
        </a>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" id="menu-side" href="<?= base_url(); ?>dashboard/profile">
            <i class="fas fa-fw fa-cog"></i>
            <span>Profil</span>
        </a>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" id="menu-side" href="<?= base_url(); ?>dashboard/akun">
            <i class="fas fa-key"></i>
            <span>Akun</span>
        </a>
    </li>


    <!-- Divider -->
    <hr class="sidebar-divider mb-0">

    <li class="nav-item">
        <a class="nav-link" href="<?= base_url(); ?>Auth/logoutdashboard">
            <i class="fas fa-sign-out-alt"></i>
            <span>Keluar</span></a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

</ul>
<!-- End of Sidebar -->