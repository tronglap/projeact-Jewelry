    <div class="Banner">
        <div class="thumb">
            <img src="{{ asset('assets/client/images/banner/list_product.jpg') }}" alt="" />
        </div>
        <div class="content">
            <div class="title">SHOP</div>
            <x-client.breadcrumb firstlink="{{ route('home') }}" from="Home Page" secondlink="{{ route('home.shop') }}"
                to="Shop"></x-client.breadcrumb>
        </div>
    </div>
