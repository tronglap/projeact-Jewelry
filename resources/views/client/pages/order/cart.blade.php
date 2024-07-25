@extends('client.layouts.master')

@section('title')
    Cart - Jewelry
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/client/css/order/Cart.css') }}">
@endsection

@section('content')
    <div class="Cart">
        <div class="container">
            <x-client.breadcrumb firstlink="{{ route('home') }}" from="Home Page" secondlink="{{ route('home.cart') }}"
                to="Cart"></x-client.breadcrumb>
        </div>
        <div class="container">
            <!-- Notifications Empty Cart Start -->
            <div id="noti" class="noti {{ count($cart) === 0 ? 'active' : '' }}">
                <h1>Oops! Your cart is currently empty.</h1>
                <a href="{{ route('home.shop') }}" class="btn-proceed">
                    <x-client.button title="Return shop" type="submit" class="btn-submit"></x-client.button>
                </a>
            </div>
            <!-- Notifications Empty Cart End -->
            <!-- Cart start -->
            <div id="table-cart" class="cart-product {{ count($cart) > 0 ? 'active' : '' }}">
                <div class="row">
                    <div class="col-lg-2">
                        <x-client.button title="Clear Cart" class="btn-delete-cart mb-3 mt-0"></x-client.button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8">
                        <div class="row">
                            <div
                                class="row title d-flex align-items-center justify-content-center p-3 border-top border-bottom">
                                <div class="col"> # </div>
                                <div class="col">Image</div>
                                <div class="col">Product</div>
                                <div class="col">Price</div>
                                <div class="col">Quantity</div>
                            </div>
                            @foreach ($cart as $productId => $item)
                                <div id="tr-{{ $productId }}"
                                    class="row cart-item d-flex align-items-center justify-content-center p-3 border-bottom">
                                    <div class="col">
                                        <div data-url-delete="{{ route('home.cart.delete.item', ['productId' => $productId]) }}"
                                            data-product-id="{{ $productId }}" class="delete-product">
                                            <i class="fa-solid fa-xmark"></i>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="thumb">
                                            <img src={{ asset('assets/images/' . $item['image_url']) }} alt="" />
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="name">
                                            <p>{{ $item['name'] }}</p>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="price d-flex align-items-center justify-content-center">
                                            @if (is_null($item['promotion']) || $item['promotion'] == '0')
                                                <span class="cost">
                                                    ${{ number_format($item['price'], 2, '.', ',') }}
                                                </span>
                                            @else
                                                <span class="discount active">
                                                    ${{ number_format($item['promotion'], 2, '.', ',') }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="quantity">
                                            <button class="minus" data-product-id="{{ $productId }}"
                                                data-url-add-product="{{ route('home.cart.add.product.item', ['productId' => $productId]) }}">
                                                <i class="fa-solid fa-minus"></i>
                                            </button>
                                            <input class="input-number" type="number" value="{{ $item['quantity'] }}"
                                                min="1" max="99999" readOnly />
                                            <button class="plus" data-product-id="{{ $productId }}"
                                                data-url-add-product="{{ route('home.cart.add.product.item', ['productId' => $productId]) }}">
                                                <i class="fa-solid fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="bill">
                            <div class="cart-total border-bottom">
                                <h2>Cart totals</h2>
                            </div>
                            <div class="total-product border-bottom">
                                <p>Product</p>
                                <div class="number">{{ count($cart) }}</div>
                            </div>
                            <div class="total border-bottom">
                                <p>Total</p>
                                <div id="totalPrice" class="price d-flex align-items-center">
                                    <span>$</span>
                                    {{ number_format(array_sum(array_map(function ($item) {return ($item['promotion'] ?? $item['price']) * $item['quantity'];}, $cart)),2,'.',',') }}
                                </div>
                            </div>
                            <div class="proceed-to-checkout">
                                <a href="{{ route('home.cart.checkout') }}" class="btn-proceed">
                                    <x-client.button title="Proceed To Checkout" type="submit"
                                        class="btn-submit"></x-client.button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Cart End -->
    </div>
    </div>
@endsection

@section('myscript')
    <script type="text/javascript">
        $(document).ready(function() {
            // Xóa toàn bộ sản phẩm trong giỏ hàng
            $(".btn-delete-cart").on("click", function(e) {
                e.preventDefault();
                $.ajax({
                    url: "{{ route('home.cart.destroy') }}", // action of form
                    type: "GET",
                    success: function(response) {
                        $("#table-cart").empty();
                        updateTotalPrice();
                        updateTotalProducts(response
                            .totalProducts);
                        if (response.totalProducts > 0) {
                            $("#table-cart").addClass('active');
                            $("#noti").removeClass('active');
                        } else {
                            $("#table-cart").removeClass('active');
                            $("#noti").addClass('active');
                        }
                    },
                });
            });

            // Xóa từng sản phẩm trong giỏ hàng
            $('.delete-product').on("click", function(e) {
                e.preventDefault();
                var productId = $(this).data("product-id");
                var url = $(this).data("url-delete");
                $.ajax({
                    url: url, // action of form
                    type: "GET",
                    success: function(response) {
                        $('#tr-' + productId).empty();
                        updateTotalPrice();
                        updateTotalProducts(response
                            .totalProducts);

                        if (response.totalProducts > 0) {
                            $("#table-cart").addClass('active');
                            $("#noti").removeClass('active');
                        } else {
                            $("#table-cart").removeClass('active');
                            $("#noti").addClass('active');
                        }
                        Toast.fire({
                            title: response.message,
                            toast: true,
                            timer: 3000
                        });
                    },
                });
            });

            // Hàm để cập nhật tổng giá tiền
            function updateTotalPrice() {
                $.ajax({
                    url: "{{ route('get.cart.total') }}",
                    type: 'GET',
                    success: function(response) {
                        $('#totalPrice').html('<span>$</span>' + response.totalPriceFormatted);
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            }

            // Hàm để cập nhật tổng số sản phẩm
            function updateTotalProducts(totalProducts) {
                $('.total-product .number').html(totalProducts);
            }

            // Cập nhật số lượng sản phẩm trong giỏ hàng
            $('.minus, .plus').click(function(e) {
                e.preventDefault();

                var btn = $(this);
                var qtyInput = btn.siblings('input');
                var currentQty = parseInt(qtyInput.val());
                var productId = btn.parent().data("product-id");
                var url = btn.data("url-add-product") + "/" + currentQty;

                if (btn.hasClass('plus')) {
                    currentQty += 1;
                } else if (btn.hasClass('minus')) {
                    if (currentQty > 1) {
                        currentQty -= 1;
                    } else {
                        return;
                    }
                }

                if (currentQty > 5) {
                    Toast.fire({
                        title: 'Sản phẩm chỉ được mua tối đa 5 món.',
                        toast: true,
                        timer: 3000
                    });
                    return;
                }

                qtyInput.val(currentQty);

                $.ajax({
                    url: url,
                    type: "POST",
                    data: {
                        _token: '{{ csrf_token() }}',
                        qty: currentQty
                    },
                    success: function(response) {
                        updateTotalPrice
                            ();
                        updateTotalProducts(response
                            .totalProducts);
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });

            $(document).ready(function() {
                updateTotalPrice();
            });
        });
    </script>

    <script src="{{ asset('assets/client/js/sweetnotification2.js') }}"></script>
@endsection
