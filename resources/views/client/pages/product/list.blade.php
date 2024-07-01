@extends('client.layouts.master')

@section('title')
    Shop - Jewelry
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/client/css/ListProduct/ListProduct.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/client/css/banner.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/client/css/ListProduct/sort.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/client/css/pagination.css') }}">
@endsection

@section('content')
    <div class="ListProduct">
        <x-client.banner imageBanner="list_product.jpg">
            <div class="title">SHOP</div>
            <x-client.breadcrumb firstlink="{{ route('home') }}" from="Home Page" secondlink="{{ route('home.shop') }}"
                to="Shop" />
        </x-client.banner>
        <div class="box_product">
            <div class="container">
                <div class="row">
                    <!-- Filter Start -->
                    <div class="col-lg-3">
                        <div class="FBN">
                            <p class="filterbyname">Filter by name</p>
                            <input type="text" id="search-input" value="" placeholder="Search name product..." />
                        </div>
                        <div class="Product_Categories">Product Categories</div>
                        <div class="Categories">
                            @foreach ($productCategories as $productCategory)
                                <div class="diamonds">
                                    <a href="{{ route('home.shop', ['category' => $productCategory['id']]) }}"
                                        class="name">{{ $productCategory['name'] }}</a>
                                    <div class="count">{{ $categoryProductCounts[$productCategory['id']] ?? 0 }}</div>
                                </div>
                            @endforeach
                        </div>
                        <div class="FBP">
                            <p class="filterbyprice">Price</p>
                            <input type="number" id="price-from-input" value="" placeholder="$ 0.00" />
                            <p class="TO">TO</p>
                            <input type="number" id="price-to-input" value="" placeholder="$ 100,000.00" />
                        </div>
                    </div>
                    <!-- Filter End -->

                    <!-- List Product Start -->
                    <div class="col-lg-9">
                        <div class="row">
                            <div class="container">
                                <div class="sorting">
                                    <div class="Count_AP">
                                        Show {{ ($currentPage - 1) * $itemPerPage + 1 }} -
                                        {{ min($currentPage * $itemPerPage, $totalProducts) }} of {{ $totalProducts }}
                                        results
                                    </div>
                                    <div class="sort">
                                        <p>Default sort</p>
                                        <i class="fa-solid fa-angle-down"></i>
                                        <div class="sorts">
                                            <x-client.sort nameSort="Sort by A - Z" href="{{ route('home.shop') }}" />
                                            <x-client.sort nameSort="Sort by Z - A" href="{{ route('home.shop') }}" />
                                            <x-client.sort nameSort="Sort Price Low To High"
                                                href="{{ route('home.shop') }}" />
                                            <x-client.sort nameSort="Sort Price High To Low"
                                                href="{{ route('home.shop') }}" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Show list of products start -->
                        <div class="row">
                            @include('client.components.product_list', ['datas' => $datas])
                        </div>
                        <!-- Show list of products end -->

                        <!-- Per page start -->
                        <div class="per-page">
                            @include('client.components.paginationProduct')
                        </div>
                        <!-- Per page end -->

                    </div>
                    <!-- List Product Start -->
                </div>
            </div>
        </div>
    </div>
@endsection

@section('myscript')
    <script type="text/javascript" src="{{ asset('assets/client/js/list-product.js') }}"></script>
@endsection
