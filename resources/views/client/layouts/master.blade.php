<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

    <link rel="shortcut icon" href="{{ asset('assets/admin/images/logo/favicon.png') }}" type="image/x-icon">

    <!-- Custom styles for this template-->

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Slick -->
    <link rel="stylesheet" type="text/css" charset="UTF-8"
        href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.min.css" />
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />

    <!-- Slick -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/client/slick/slick.css') }}" />
    {{-- Add the new slick-theme.css if you want the default styling --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/client/slick/slick-theme.css') }}" />
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>


    <link rel="stylesheet" href="{{ asset('assets/client/css/stylemain.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/client/css/Header.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/client/css/Footer.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/client/css/breadcrumb.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/client/css/Button.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/client/css/Button02.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/client/css/ToTop.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/client/css/input.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/client/css/search.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/client/css/heading.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/client/css/CartProduct.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/client/css/CardNews.css') }}">
    @yield('style')
</head>

<body>
    @if (empty($isHome))
        @include('client.blocks.header')
    @endif
    @include('components.client.search')
    @yield('content')
    @include('client.components.toTop')
    @include('client.blocks.footer')


    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>

    <!-- Bootstrap -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>

    <!-- Sweet Alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('assets/client/js/sweetnotification2.js') }}"></script>


    <!-- Slick -->
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

    <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="{{ asset('assets/client/slick/slick.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/client/js/carousel.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/client/js/scrollToTop.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/client/js/closeSearchBar.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/client/js/activeSearchBar.js') }}"></script>

    @yield('myscript')
</body>

</html>
