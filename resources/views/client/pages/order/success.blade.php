@extends('client.layouts.master')

@section('title')
    Order Success - Jewelry
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/client/css/order/success.css') }}">
@endsection

@section('content')
    <div class="order-success">
        <div class="container">
            <x-client.breadcrumb firstlink="{{ route('home') }}" from="Home Page" secondlink="{{ route('home.cart.success') }}"
                to="Success"></x-client.breadcrumb>
        </div>
        <div class="container">
            <h1>Order Success</h1>
            <a href="{{ route('home.shop') }}" class="btn-proceed">
                <x-client.button title="Continue shopping" type="submit"></x-client.button>
            </a>
        </div>
    </div>
@endsection
