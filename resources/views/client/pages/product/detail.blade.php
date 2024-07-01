@extends('client.layouts.master')

@section('title')
    {{ $product['name'] }}
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/client/css/ListProduct/Detail.css') }}">
@endsection

@section('content')
    <!-- Information Product Start -->
    <div class="DetailProduct">
        <x-client.breadcrumb firstlink="{{ route('home') }}" from="Home Page"
            secondlink="{{ route('home.shop.detail', $product['name']) }}" to="{{ $product['name'] }}"></x-client.breadcrumb>
        <div class="box_detail">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="thumb">
                            <img src="{{ asset('assets/images/' . $product['image_url']) }}"alt="" />
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="infor">
                            <div class="name">
                                <h1>{{ $product['name'] }}</h1>
                            </div>
                            <div class="material">{{ $product->ProductCategory->name }}</div>
                            <div class="price">
                                @if ($product['promotion'])
                                    <span class="discount active">
                                        ${{ number_format($product['promotion'], 2) }}
                                    </span>
                                    <span class="cost active">
                                        ${{ number_format($product['price'], 2) }}
                                    </span>
                                @else
                                    <span class="cost">
                                        ${{ number_format($product['price'], 2) }}
                                    </span>
                                @endif
                            </div>
                            @if ($product['quantity'] > 0)
                                <div class="instock">
                                    <p>In Stock</p>
                                </div>
                            @else
                                <div class="outstock">
                                    <p>Out Stock</p>
                                </div>
                            @endif
                            <div class="shortdesc">
                                <p>{!! $product['shortDescription'] !!}</p>
                            </div>
                            <div class="icon">
                                <div class="d-flex align-items-center gap-2 text-color">
                                    <i class="fa-regular fa-message"></i>
                                    <p class="m-0">Free returns</p>
                                </div>
                                <div class="d-flex align-items-center gap-2 text-color">
                                    <i class="fa-solid fa-truck-fast"></i>
                                    <p class="m-0">
                                        Free shipping via DHL, fully insured All
                                    </p>
                                </div>
                                <div class="d-flex align-items-center gap-2 text-color ">
                                    <i class="fa-regular fa-square-check"></i>
                                    <p class="m-0">taxes and customs duties included</p>
                                </div>
                            </div>
                        </div>
                        <div class="addtocart row">
                            @if ($product['quantity'] > 0)
                                {{-- <div class="count col-lg-4">
                                    <button class="minus click">
                                        <i class="fa-solid fa-minus"></i>
                                    </button>
                                    <input type="number" value="1" min="1" inputmode="numeric" readOnly
                                        class="input">
                                    <button class="plus click">
                                        <i class="fa-solid fa-plus"></i>
                                    </button>
                                </div> --}}
                                <div class="col-lg-4">
                                    <x-client.button :data-product-id="$product['id']" id="btnAddToCart"
                                        title="ADD TO CART"></x-client.button>
                                </div>
                            @else
                                <div class="col-lg-4">
                                    <p class="text-center text-danger">Out of Stock</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row product-infor">
                    <div class="col-lg-12">
                        <div class="tab">
                            <ul class="detail-tab" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="title-tab active" id="description-tab" data-bs-toggle="tab"
                                        data-bs-target="#description" type="button" role="tab"
                                        aria-controls="description" aria-selected="true">DESCRIPTION</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="title-tab " id="information-tab" data-bs-toggle="tab"
                                        data-bs-target="#information" type="button" role="tab"
                                        aria-controls="information" aria-selected="false">ADDITIONAL INFORMATION
                                    </button>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="description" role="tabpanel"
                                    aria-labelledby="description-tab">
                                    <p>{!! $product['description'] !!}</p>
                                </div>

                                <div class="tab-pane fade " id="information" role="tabpanel"
                                    aria-labelledby="information-tab">
                                    <!-- Nội dung của tab Additional Information -->
                                    <table class="information">
                                        <tr>
                                            <th>Weight</th>
                                            <td>148 kg</td>
                                        </tr>
                                        <tr>
                                            <th>Dimensions</th>
                                            <td>6 × 120 × 195 cm</td>
                                        </tr>
                                        <tr>
                                            <th>Stand Up</th>
                                            <td>35″L x 24″W x 37-45″H (front to back wheel)</td>
                                        </tr>
                                        <tr>
                                            <th>Folded (W/O Wheels)</th>
                                            <td>32.5″L x 18.5″W x 16.5″H</td>
                                        </tr>
                                        <tr>
                                            <th>Folded (W/ Wheels)</th>
                                            <td>32.5″L x 24″W x 18.5″H</td>
                                        </tr>
                                        <tr>
                                            <th>Door Pass Through</th>
                                            <td>24</td>
                                        </tr>
                                        <tr>
                                            <th>Frame</th>
                                            <td>Aluminum</td>
                                        </tr>
                                        <tr>
                                            <th>Weight (W/O Wheels)</th>
                                            <td>20 LBS</td>
                                        </tr>
                                        <tr>
                                            <th>Weight Capacity</th>
                                            <td>60 LBS</td>
                                        </tr>
                                        <tr>
                                            <th>Width</th>
                                            <td>24″</td>
                                        </tr>
                                        <tr>
                                            <th>Handle Height (Ground To Handle)</th>
                                            <td>37-45″</td>
                                        </tr>
                                        <tr>
                                            <th>Wheels</th>
                                            <td>12″ air / wide track slick tread</td>
                                        </tr>
                                        <tr>
                                            <th>Seat Back Height</th>
                                            <td>21.5″</td>
                                        </tr>
                                        <tr>
                                            <th>Head Room (Inside Canopy)</th>
                                            <td>25″</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Related Product Start -->
                <div class="row related">
                    <div class="heading">
                        <x-client.heading heading="Parity Product" title="Related products"></x-client.heading>

                        <section class="variable slider">
                            @foreach ($datas as $data)
                                <x-client.card :name="$data->name" :price="number_format($data->price, 2, '.', ',')" :quantity="$data->quantity" :productid="['product' => $data->id]"
                                    :category="$data->ProductCategory->name" :imageurl="$data->image_url" :imageurlsecond="$data->image_url_second" :sale="$data->sale"
                                    :promotion="number_format($data->promotion, 2, '.', ',')" />
                            @endforeach
                        </section>
                    </div>
                </div>
                <!-- Related Product End -->

            </div>
        </div>
    </div>
    <!-- Information Product End -->
@endsection
@section('myscript')
    {{-- <script type="text/javascript" src="{{ asset('assets/client/js/minusPlus.js') }}"></script> --}}
    <script type="text/javascript">
        $(document).ready(function() {
            $('#btnAddToCart').on('click', function(event) {
                event.preventDefault();
                var productId = $(this).data('product-id');

                $.ajax({
                    url: "{{ route('home.cart.addProduct') }}",
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        productId: productId
                    },
                    success: function(response) {
                        $('#countItemsCart').html(response.totalProducts);
                        // Lấy thông tin sản phẩm
                        var productName = "{{ $product['name'] }}";
                        var productImage =
                            "{{ asset('assets/images/' . $product['image_url']) }}";

                        // Hiển thị thông báo Toast
                        Toast.fire({
                            icon: 'success',
                            html: '<div class="toast-content"><img src="' +
                                productImage + '" alt="' + productName + '" /><span>' +
                                'Add product success' +
                                '</span></div>'
                        });
                    },
                    statusCode: {
                        401: function() {
                            window.location.href = "{{ route('home.register') }}";
                        }
                    }
                });
            });
        });
    </script>

    <script src="{{ asset('assets/client/js/sweetnotification2.js') }}"></script>
@endsection
