<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{route('admin.')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Bảng điều khiển
            </span></a>
        <hr class="sidebar-divider">

        <a class="nav-link" href="{{route('admin.categories.index')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span> Danh mục
            </span></a>
        <hr class="sidebar-divider">

        <a class="nav-link" href="{{route('admin.products.index')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span> Sản phẩm
            </span></a>
        <hr class="sidebar-divider">

        <a class="nav-link" href="index.html">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span> Tài khoản
            </span></a>
        <hr class="sidebar-divider">

        <a class="nav-link" href="{{route('admin.banners.index')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span> Banners
            </span></a>
        <hr class="sidebar-divider">

        <a class="nav-link" href="{{route('admin.vouchers.index')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span> vouchers
            </span></a>
    </li>
  
    <!-- Divider -->
   
   
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

    <!-- Sidebar Message -->
    <div class="sidebar-card d-none d-lg-flex">
        <img class="sidebar-card-illustration mb-2" src="{{asset('theme/admin/img/undraw_rocket.svg')}}" alt="...">
        <p class="text-center mb-2"><strong>SB Admin Pro</strong> is packed with premium features, components, and more!</p>
        <a class="btn btn-success btn-sm" href="https://startbootstrap.com/theme/sb-admin-pro">Upgrade to Pro!</a>
    </div>

</ul>
