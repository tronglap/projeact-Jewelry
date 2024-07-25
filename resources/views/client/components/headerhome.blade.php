<div class="nav">
    <div class="left">
        <div class="bar" id="toggleNavBar">
            Menu
            <div class="line1"></div>
            <div class="line2"></div>
            <div class="line3"></div>
        </div>
        <div class="search">
            <i class="fa-solid fa-magnifying-glass"></i>
            <p>Search...</p>
        </div>
    </div>
    <div class="mid">
        <div class="logo">
            <a href="{{ route('home') }}">
                <img src="{{ asset('assets/client/images/logo/logo.png') }}" alt="Logo" />
            </a>
        </div>
    </div>
    <div class="right">
        @auth
            <a href="{{ url('/profile') }}" class="register">
                {{ Auth::user()->name }}
            </a>
        @else
            <a class="register" href="{{ route('home.register') }}">Login/Register</a>
        @endauth
        <a href="{{ route('home.cart') }}" class="cart">
            <svg fill="#000000" width="30px" height="30px" viewBox="0 0 256.00 256.00" id="Flat"
                xmlns="http://www.w3.org/2000/svg" stroke="#000000" stroke-width="0.00256">
                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                <g id="SVGRepo_iconCarrier">
                    <path
                        d="M216,44H40A12.01312,12.01312,0,0,0,28,56V200a12.01312,12.01312,0,0,0,12,12H216a12.01312,12.01312,0,0,0,12-12V56A12.01312,12.01312,0,0,0,216,44ZM40,52H216a4.00427,4.00427,0,0,1,4,4V76H36V56A4.00427,4.00427,0,0,1,40,52ZM216,204H40a4.00427,4.00427,0,0,1-4-4V84H220V200A4.00427,4.00427,0,0,1,216,204Zm-44-92a44,44,0,0,1-88,0,4,4,0,0,1,8,0,36,36,0,0,0,72,0,4,4,0,0,1,8,0Z">
                    </path>
                </g>
            </svg>
            @php
                $totalProductInCart = count(session()->get('cart', []));
            @endphp
            <span class="count"> {{ $totalProductInCart }}</span>
        </a>
    </div>
    @include('client.components.siderbar')
</div>
