<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/admin">
        <div class="sidebar-brand-icon">
            <i class="fas fa-store"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Manager Jewelry</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="/admin">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Product
    </div>

    <!-- Nav Item - List product -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.product.index') }}">
            <i class="fas fa-fw fa-list-ul"></i>
            <span>List</span></a>
    </li>

    <!-- Nav Item - Form create product -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.product.create') }}">
            <i class="fas fa-fw fa-boxes"></i>
            <span>Create</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Product Cateogry
    </div>

    <!-- Nav Item - List category -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.product_category.index') }}">
            <i class="fas fa-fw fa-layer-group"></i>
            <span>List</span></a>
    </li>

    <!-- Nav Item - Form create category -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.product_category.create') }}">
            <i class="fas fa-fw fa-boxes"></i>
            <span>Create</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Blog
    </div>

    <!-- Nav Item - List blog -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.blog.index') }}">
            <i class="fas fa-fw fa-table"></i>
            <span>List</span></a>
    </li>

    <!-- Nav Item - Form create blog -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.blog.create') }}">
            <i class="fas fa-fw fa-blog"></i>
            <span>Create</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Blog Category
    </div>

    <!-- Nav Item - List blog -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.blogCategories.index') }}">
            <i class="fas fa-fw fa-table"></i>
            <span>List</span></a>
    </li>

    <!-- Nav Item - Form create blog -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.blogCategories.create') }}">
            <i class="fas fa-fw fa-blog"></i>
            <span>Create</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Order
    </div>

    <!-- Nav Item - List order -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.order.index') }}">
            <i class="fas fa-fw fa-truck-loading"></i>
            <span>List</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Customer
    </div>

    <!-- Nav Item - List customer -->
    <li class="nav-item">
        <a class="nav-link" href="/admin">
            <i class="fa-solid fa-user-group"></i>
            <span>List</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
