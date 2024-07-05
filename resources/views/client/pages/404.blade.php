@extends('client.layouts.master')

@section('title')
    404 Error - Jewelry
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/client/css/404.css') }}">
@endsection

@section('content')
    <div class="page-error">
        <div class="container">
            <div class="error-404">
                <div class="image-404">
                    <div class="thumb">
                        <img src="{{ asset('assets/client/images/icon/404.png') }}" alt="">
                    </div>
                </div>
                <div class="content">
                    <div class="thumb">
                        <img src="{{ asset('assets/client/images/icon/404_number.png') }}" alt="">
                    </div>
                    <h1 class="error-subtitle">Opps! That Links Is Broken</h1>
                    <p class="error-text">The page you're looking for might have been removed, had its name changed, or is
                        temporarily
                        unavailable.
                    </p>
                </div>
                <a href="{{ route('home') }}" class="btn-back">
                    <x-client.button title="BACK TO HOMEPAGE"></x-client.button>
                </a>
            </div>
        </div>
    </div>
@endsection

@section('myscript')
@endsection
