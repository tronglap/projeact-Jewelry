@extends('client.layouts.master')

@section('title')
    Blog - Jewelry
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/client/css/banner.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/client/css/blog/widget-blog.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/client/css/blog/list-blog.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/client/css/pagination.css') }}">
@endsection

@section('content')
    <div class="blog">
        <x-client.banner imageBanner="blog.jpg">
            <div class="title">BLOG</div>
            <x-client.breadcrumb firstlink="{{ route('home') }}" from="Home Page"
                secondlink="{{ route('home.blog.index') }}" to="Blog" />
        </x-client.banner>
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="list-blog">
                        @foreach ($datas as $data)
                            <div class="blog-item">
                                <div class="thumb">
                                    <a href="{{ route('home.blog.detail', ['blog' => $data->id]) }}">
                                        <img width="1000" height="510" class="image-blog"
                                            src="{{ asset('assets/images/' . $data['image_url']) }}"
                                            alt="{{ $data['title'] }}">
                                    </a>
                                </div>
                                <div class="blog-content">
                                    <div class="created-at">
                                        <p>{{ \Carbon\Carbon::parse($data['created_at'])->format('F d, Y') }} - By Admin</p>

                                    </div>
                                    <h3 class="blog-title">
                                        <a href="{{ route('home.blog.detail', ['blog' => $data->id]) }}">
                                            {{ $data['title'] }}
                                        </a>
                                    </h3>
                                    <div class="blog-description-short">
                                        <p> {!! $data['content'] !!} </p>
                                    </div>
                                    <div class="more-link">
                                        <a class="view-more"
                                            href="{{ route('home.blog.detail', ['blog' => $data->id]) }}">VIEW MORE</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                    <div class="per-page">
                        @include('client.components.paginationBlog')
                    </div>
                </div>
                <div class="col-lg-4">
                    @include('client.components.widgetBlog', [
                        'blogCategories' => $blogCategories,
                        'recentPosts' => $recentPosts,
                    ])
                </div>

            </div>
        </div>
    </div>
@endsection

@section('myscript')
@endsection
