<!-- Sider Bar Start -->
<div class="NavBar" id="NavBar">
    <div class="List" id="List">
        <div class="icon_close" id="icon_close">
            <span class="Menu">Main Menu</span>
            <div class="icon">
                <div class="line1"></div>
                <div class="line2"></div>
            </div>
        </div>
        <a href="{{ route('home') }}" class="menu-item">
            <span>Home</span>
            {{-- <i class="fa-solid fa-angle-right"></i> --}}
        </a>
        <a href="{{ route('home.shop') }}" class="menu-item">
            <span>Shop</span>
            {{-- <i class="fa-solid fa-angle-right"></i> --}}
        </a>
        {{-- <div class="Categories" id="Categories">
            <div class="title">
                <span>Categories</span>
                <i class="fa-solid fa-angle-right"></i>
            </div>
            <div class="submenu-cate" id="submenu-cate"></div>
        </div> --}}
        <a href="{{ route('home.blog.index') }}" class="menu-item">
            <span>Blog</span>
            {{-- <i class="fa-solid fa-angle-right"></i> --}}
        </a>
        <div class="menu-item">
            <span>Contact</span>
            {{-- <i class="fa-solid fa-angle-right"></i> --}}
        </div>
    </div>
</div>
<!-- Sider Bar End -->
