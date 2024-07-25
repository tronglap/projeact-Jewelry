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
                        <form action="{{ route('home.shop') }}" method="GET" id="searchForm" role="form">
                            <div class="FBN">
                                <label for="key" class="filterbyname">Filter by name</label>
                                <input type="text" id="searchKey" value="{{ request()->key ?? '' }}" name="key"
                                    placeholder="Search name product..." />
                            </div>
                            <div class="Product_Categories">Product Categories</div>
                            <div class="Categories">
                                @foreach ($productCategories as $productCategory)
                                    <div class="diamonds">
                                        <div class="name" data-id="{{ $productCategory['id'] }}">
                                            {{ $productCategory['name'] }}</div>
                                        <div class="count">{{ $categoryProductCounts[$productCategory['id']] ?? 0 }}</div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="FBP">
                                <p class="filterbyprice">Price</p>
                                <input type="number" id="price-from-input" name="price_from"
                                    value="{{ request()->price_from ?? '' }}" placeholder="$ 0.00" />
                                <p class="TO">TO</p>
                                <input type="number" id="price-to-input" name="price_to"
                                    value="{{ request()->price_to ?? '' }}" placeholder="$ 100,000.00" />
                            </div>
                            <button type="submit" style="display: none;"></button>
                        </form>
                    </div>
                    <!-- Filter End -->

                    <!-- List Product Start -->
                    <div class="col-lg-9">
                        <div class="row">
                            <div class="container">
                                <form action="{{ route('home.shop') }}" id="searchForm" role="form">
                                    <div class="sorting">
                                        {{-- <div class="Count_AP">
                                            Show {{ ($currentPage - 1) * $itemPerPage + 1 }} -
                                            {{ min($currentPage * $itemPerPage, $totalProducts) }} of {{ $totalProducts }}
                                            results
                                        </div> --}}

                                        <div class="Count_AP">
                                            Show
                                            <span id="product-count-start">
                                                {{ ($currentPage - 1) * $itemPerPage + 1 }}
                                            </span>
                                            -
                                            <span id="product-count-end">
                                                {{ min($currentPage * $itemPerPage, $totalProducts) }}
                                            </span>
                                            of
                                            <span id="total-product-count">
                                                {{ $totalProducts }}
                                            </span>
                                            results
                                        </div>
                                        <div name="sortByOption" id="sortByOption" class="sort">
                                            <div class="sort-option" data-value="">Default sort</div>
                                            <i class="fa-solid fa-angle-down"></i>
                                            <div class="sorts">
                                                <div class="sort-option" data-value="1"
                                                    {{ request()->sortByOption == '1' ? 'selected' : '' }}>Sort by A - Z
                                                </div>
                                                <div class="sort-option" data-value="2"
                                                    {{ request()->sortByOption == '2' ? 'selected' : '' }}>Sort by Z - A
                                                </div>
                                                <div class="sort-option" data-value="3"
                                                    {{ request()->sortByOption == '3' ? 'selected' : '' }}>Sort Price Low
                                                    To High</div>
                                                <div class="sort-option" data-value="4"
                                                    {{ request()->sortByOption == '4' ? 'selected' : '' }}>Sort Price High
                                                    To Low</div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- Show list of products start -->
                        <div id="listProduct" class="row">
                            @include('client.components.product_list', ['datas' => $datas])
                        </div>
                        <!-- Show list of products end -->

                        <!-- Per page start -->
                        {{-- <div class="per-page">
                            @include('client.components.paginationProduct')
                        </div> --}}


                        <div class="per-page">
                            <ul class="pagination">
                                @if ($currentPage > 1)
                                    <li class="page-item">
                                        <a class="page-number"
                                            href="{{ route('home.shop', ['page' => $currentPage - 1, 'category' => $selectedCategory]) }}">
                                            <i class="fa-solid fa-angle-left"></i>
                                        </a>
                                    </li>
                                @endif

                                @for ($i = 1; $i <= ceil($totalProducts / $itemPerPage); $i++)
                                    <li class="page-item {{ $currentPage == $i ? 'active' : '' }}">
                                        <a class="page-number"
                                            href="{{ route('home.shop', ['page' => $i, 'category' => $selectedCategory]) }}">{{ $i }}</a>
                                    </li>
                                @endfor

                                @if ($currentPage < ceil($totalProducts / $itemPerPage))
                                    <li class="page-item">
                                        <a class="page-number"
                                            href="{{ route('home.shop', ['page' => $currentPage + 1, 'category' => $selectedCategory]) }}">
                                            <i class="fa-solid fa-angle-right"></i>
                                        </a>
                                    </li>
                                @endif
                            </ul>
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
    <script>
        $(document).ready(function() {
            $('#searchKey, #sortByOption, #price-from-input, #price-to-input').on('input change', function() {
                let query = $('#searchKey').val();
                let sortByOption = $('#sortByOption').attr('data-selected-value');
                let priceFrom = $('#price-from-input').val();
                let priceTo = $('#price-to-input').val();

                $.ajax({
                    url: '{{ route('home.shop') }}',
                    type: 'GET',
                    data: {
                        key: query,
                        sortByOption: sortByOption,
                        price_from: priceFrom,
                        price_to: priceTo,
                    },
                    success: function(data) {
                        // $('#listProduct').html(data);
                        $('#listProduct').html(data.html);
                        $('#total-product-count').text(data.totalProducts);
                        $('#product-count-start').text(data.productCountStart);
                        $('#product-count-end').text(data.productCountEnd);
                    }
                });
            });

            $(document).on('click', '.sort-option', function() {
                let value = $(this).attr('data-value');
                $('#sortByOption').attr('data-selected-value', value).trigger('change');
            });
        });
    </script>
@endsection
