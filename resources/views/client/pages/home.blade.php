@extends('client.layouts.master')

@section('title')
    Jewelery Store
@endsection
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/client/css/home/Home.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/client/css/home/headerHome.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/client/css/home/SliderBar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/client/css/home/WWD.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/client/css/home/Category.css') }}">
@endsection
@section('content')
    <div class="bg_home">
        <!-- Header start -->
        @include('client.components.headerhome')
        <!-- Header end -->

        <!-- Banner start-->
        @include('client.components.sliderbar')
        <!-- Banner end-->

        <div class="container">
            <!-- WHAT WE DO START -->
            @include('client.components.whatwedo')
            <!-- WHAT WE DO END -->

            <!-- Service Start -->
            @include('client.components.category')
            <!-- Service End -->

            <div class="row_home">
                <!-- OUR BESTSELLING START -->
                <div class="heading">
                    <x-client.heading heading="OUR BESTSELLING" title="Our Jewelry Selection"></x-client.heading>

                    <section class="variable slider">
                        @foreach ($datas as $data)
                            <x-client.card :name="$data->name" :price="number_format($data->price, 2, '.', ',')" :productid="['product' => $data->id]" :category="$data->ProductCategory->name"
                                :imageurl="$data->image_url" :imageurlsecond="$data->image_url_second" :sale="$data->sale" :quantity="$data->quantity" :promotion="number_format($data->promotion, 2, '.', ',')" />
                        @endforeach
                    </section>
                </div> <!-- OUR BESTSELLING END -->
            </div>

            <div class="row_home">
                <!-- NEWS & INSPIRED START -->
                <div class="heading">
                    <x-client.heading heading="NEWS & INSPIRED" title="Jewellery Style Files"></x-client.heading>

                    <section class="cardNews slider">
                        @foreach ($blog as $item)
                            <x-client.card-news :image="$item->image_url" :title="$item->title" :date="$item->created_at" :description="$item->content"
                                :blogId="['blog' => $item->id]" />
                        @endforeach
                    </section>
                </div>
                <!-- NEWS & INSPIRED END -->
            </div>
        </div>
    </div>
@endsection

@section('myscript')
    <script type="text/javascript" src="{{ asset('assets/client/js/siderbar.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#btnAddToCart').on('click', function(event) {
                event.preventDefault();
                var productId = $(this).data('product-id');

                $.ajax({
                    url: "{{ route('home.cart.addProduct') }}", //action of form
                    type: 'POST', //method of form
                    data: {
                        _token: '{{ csrf_token() }}',
                        productId: productId
                    },
                    success: function(response) {
                        $('#countItemsCart').html(response.totalProducts);
                        Swal.fire({
                            title: response.message,
                            text: "Add product to cart is successful",
                            icon: "success"
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
@endsection
