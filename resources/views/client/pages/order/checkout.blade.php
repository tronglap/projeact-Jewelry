@extends('client.layouts.master')

@section('title')
    Check out - {{ Auth::user()->name }}
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/client/css/order/Checkout.css') }}">
@endsection

@section('content')
    <div class="CheckOut">
        <div class="container">
            <x-client.breadcrumb firstlink="{{ route('home') }}" from="Home Page"
                secondlink="{{ route('home.cart.checkout') }}" to="CheckOut"></x-client.breadcrumb>
        </div>
        <div class="container">
            <div class="noti {{ !$cart || $cart === [] ? 'active' : '' }}">
                <h1>Oops! Your cart is currently empty.</h1>
                <a href="{{ route('home.shop') }}" class="btn-proceed">
                    <x-client.button title="Return shop" type="submit" class="btn-submit"></x-client.button>
                </a>
            </div>
            <form class="box_checkout {{ !$cart || $cart === [] ? '' : 'active' }}"
                action="{{ route('home.cart.placeOrder') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-lg-7">
                        <div class="billing-fields">
                            <h2>Billing details</h2>
                            <div class="input-text">
                                <label for="name">Full name</label>
                                <input type="text" value="{{ $user->name }}" name="name" />
                                @error('name')
                                    <span class="text-danger">{{ $message }}<span>
                                        @enderror
                            </div>
                            <div class="input-text">
                                <label for="phone">Phone</label>
                                <input type="number" value="{{ old('phone') ?? $user->phone }}" name="phone" />
                                @error('phone')
                                    <span class="text-danger">{{ $message }}<span>
                                        @enderror
                            </div>
                            <div class="input-text">
                                <label for="address">Address</label>
                                <input type="text" value="{{ old('address') ?? $user->address }}" name="address" />
                                @error('address')
                                    <span class="text-danger">{{ $message }}<span>
                                        @enderror
                            </div>
                            <div class="input-text">
                                <label for="email">Email address</label>
                                <input type="email" value="{{ old('email') ?? $user->email }}" name="email"
                                    placeholder="Enter your mail" />
                                @error('email')
                                    <span class="text-danger">{{ $message }}<span>
                                        @enderror
                            </div>
                            <div class="input-text">
                                <h3 class="title-note">Additional information</h3>
                                <label for="note">Order notes (optional)</label>
                                <textarea name="note" id="note" cols="30" rows="5"
                                    placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="bill">
                            <div class="cart-total border-bottom">
                                <h2>Your order</h2>
                            </div>
                            <div class="total-product border-bottom">
                                <p>Product</p>
                                <p>Subtotal</p>
                            </div>
                            @foreach ($cart as $productId => $item)
                                <div class="list-product border-bottom d-flex justify-content-between align-items-center">
                                    <div class="info d-flex justify-content-between gap-3">
                                        <div class="name">{{ $item['name'] }}</div>
                                        <div class="count">x {{ $item['quantity'] }}</div>
                                    </div>
                                    <div class="price">
                                        @if (is_null($item['promotion']) || $item['promotion'] == '0')
                                            <span class="cost">
                                                ${{ number_format($item['price'] * $item['quantity'], 2, '.', ',') }}
                                            </span>
                                        @else
                                            <span class="discount active">
                                                ${{ number_format($item['promotion'] * $item['quantity'], 2, '.', ',') }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            @endforeach

                            <div class="total border-bottom">
                                <p>Total</p>
                                <div class="price d-flex align-items-center">
                                    <span>$
                                        {{ number_format(array_sum(array_map(function ($item) {return ($item['promotion'] ?? $item['price']) * $item['quantity'];}, $cart)),2,'.',',') }}
                                    </span>
                                </div>
                            </div>
                            <div class="proceed-to-checkout">
                                <h5 class="title">Select your payment method</h5>
                                <div class="selectPayment">
                                    <div class="checkout__input__checkbox">
                                        <label for="COD">
                                            <div class="thumb">
                                                <img src="{{ asset('assets/client/images/icon/icon_cash.png') }}"
                                                    alt="">
                                            </div>
                                            Cash on Delivery
                                            <input type="radio" id="COD" name="payment_method" value="COD"
                                                onclick="checkOnlyOne(this)">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                    <div class="checkout__input__checkbox">
                                        <label for="payment">
                                            <div class="thumb">
                                                <img src="{{ asset('assets/client/images/icon/icon_credit_card.png') }}"
                                                    alt="">
                                            </div>
                                            Credit Card/ Debit Card
                                            <input type="radio" id="payment" name="payment_method" value="VNBANK"
                                                onclick="checkOnlyOne(this)">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                    <div class="checkout__input__checkbox">
                                        <label for="paypal">
                                            <div class="thumb">
                                                <img src="{{ asset('assets/client/images/icon/icon_mastercard.png') }}"
                                                    alt="">
                                            </div>
                                            Master Card
                                            <input type="radio" id="paypal" name="payment_method" value="INTCARD"
                                                onclick="checkOnlyOne(this)">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                                <p style="text-align: left">Your personal data will be used to process your order, support
                                    your experience throughout
                                    this website, and for other purposes described in our privacy policy.</p>
                                <div class="btn-proceed">
                                    <x-client.button title="Place Order"></x-client.button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('myscript')
    {{-- <script src="{{ asset('assets/client/js/selectPayment.js') }}"></script> --}}
@endsection
