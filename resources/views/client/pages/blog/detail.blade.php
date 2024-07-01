@extends('client.layouts.master')


@section('title')
    {{ $data['title'] }}
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/client/css/blog/detail.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/client/css/blog/widget-blog.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/client/css/banner.css') }}">
@endsection

@section('content')
    <div class="detail">
        <x-client.banner imageBanner="blog.jpg">
            <div class="title"> {{ $data['title'] }}</div>
            <x-client.breadcrumb firstlink="{{ route('home') }}" from="Home Page" secondlink="{{ route('home.blog.index') }}"
                to="Blog" />
        </x-client.banner>
        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="blog-item">
                            <div class="thumb">
                                <img width="1000" height="510" class="image-blog"
                                    src="{{ asset('assets/images/' . $data['image_url']) }}" alt="">
                            </div>
                            <div class="blog-content">
                                <div class="created-at">
                                    <p>{{ \Carbon\Carbon::parse($data['created_at'])->format('F d, Y') }} - By Admin</p>
                                </div>
                                <h3 class="blog-title">
                                    {{ $data['title'] }}
                                </h3>
                                <div class="blog-description-short">
                                    <p> {!! $data['content'] !!} </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        @include('client.components.widgetBlog', ['blogCategories' => $blogCategories])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('myscript')
@endsection
