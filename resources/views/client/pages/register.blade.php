@extends('client.layouts.master')

@section('title')
    My Account
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/client/css/register.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/client/css/input.css') }}">
@endsection

@section('content')
    <div class="container">
        <x-client.breadcrumb firstlink="{{ route('home') }}" from="Home Page" secondlink="{{ route('home.register') }}"
            to="Register/Login"></x-client.breadcrumb>
        <div class="Template">
            <div class="row">
                <div class="col-lg-5">
                    <div class="form">
                        <h2 class="form-title">Login</h2>
                        <form action="{{ route('login') }}" method="POST">
                            @csrf
                            <x-input-label for="email" :value="__('Email address')" />
                            <x-client.input type="email" id="email" name="email" class="input"
                                placeholder="Enter your email..." required></x-client.input>

                            <x-input-label for="password" :value="__('Password')" />
                            <x-client.input type="password" id="password" name="password" class="input"
                                placeholder="Enter your pasword..." required></x-client.input>
                            <a href="/" class="a">Lost your password?</a>
                            <x-client.button title="LOGIN" type="submit" class="btn-submit"></x-client.button>
                        </form>
                        <div class="line">
                            <div class="thumb">
                                <img src="{{ asset('assets/client/images/icon/linedecor.png') }}" alt="">
                            </div>
                        </div>
                        <a href="{{ route('google.redirect') }}">
                            <i class="fa-brands fa-google" style="color: white"></i>
                            <x-client.button title="CONTINUE WITH GOOGLE" type="submit"
                                class="btn-login-google"></x-client.button>
                        </a>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="form">
                        <h2 class="form-title">Register</h2>
                        <form action="{{ route('register') }}" method="POST">
                            @csrf
                            <x-input-label for="email" :value="__('Email address')" />
                            <x-client.input type="email" id="email" name="email" class="input"
                                placeholder="Enter your email..." value="{{ old('email') }}" required></x-client.input>
                            <x-input-error :messages="$errors->get('email')" class="m-2" />

                            <x-input-label for="password" :value="__('Password')" />
                            <x-client.input type="password" id="password" name="password" class="input"
                                placeholder="Enter your pasword..." required></x-client.input>
                            <x-input-error :messages="$errors->get('password')" class="m-2" />

                            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                            <x-client.input id="password_confirmation" type="password" name="password_confirmation" required
                                autocomplete="new-password" class="input" placeholder="Enter your pasword..."
                                required></x-client.input>
                            <x-input-error :messages="$errors->get('password_confirmation')" class="m-2" />
                            <div class="noti">
                                <p>Your personal data will be used to support your experience throughout this website, to
                                    manage access to your account, and for other purposes described in our privacy policy.
                                </p>
                            </div>
                            <x-client.button title="REGISTER" type="submit" class="btn-submit"></x-client.button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('myscript')
    <script type="text/javascript" src="{{ asset('assets/client/js/addActiveInput.js') }}"></script>
@endsection
