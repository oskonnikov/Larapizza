@if (Auth::User())
<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
        <div class="sidebar-brand-text mx-2">Larapizza Admin</div>
    </a>
    <hr class="sidebar-divider my-0">
    <li class="nav-item {{ Request::url() == url('/admin') ? 'active' : '' }}">
        <a class="nav-link" href="/admin">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Главная</span></a>
    </li>
    <li class="nav-item {{ Request::url() == url('/admin/personal') ? 'active' : '' }}">
        <a class="nav-link" href="/admin/personal">
            <i class="fas fa-fw fa-user"></i>
            <span>Мои данные</span></a>
    </li>
    @if (Auth::User()->isSuperAdmin())
    @endif
    <hr class="sidebar-divider">
    <div class="sidebar-heading">
        Сайт
    </div>
    <li class="nav-item">
        <a class="nav-link" href="/admin/users"> <i class="fas fa-fw fa-file-alt"></i> <span> Пользователи</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/admin/orders"> <i class="fas fa-fw fa-file-alt"></i> <span> Заказы</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/admin/products"> <i class="fas fa-fw fa-file-alt"></i> <span> Продукты</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/admin/settings"> <i class="fas fa-fw fa-file-alt"></i> <span> Настройки</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/">
            <i class="fas fa-fw fa-backward"></i>
            <span>Вернуться на сайт</span></a>
    </li>
    <hr class="sidebar-divider d-none d-md-block">
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->
@endif