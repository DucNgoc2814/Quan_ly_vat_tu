<!doctype html>
<html class="no-js" lang="en-US">


<!-- Mirrored from htmldemo.net/jantrik/jantrik/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 08 Oct 2024 14:02:24 GMT -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title') || GEMO</title>
    <meta name="description" content="Default Description">
    <meta name="keywords" content="E-commerce" />
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- place favicon.ico in the root directory -->
    <link rel="shortcut icon" type="image/x-icon" href="img/icon/favicon.png">
    <!-- Google Font css -->
    <link href="https://fonts.googleapis.com/css?family=Lily+Script+One" rel="stylesheet">

    @include('client.layouts.partials.css')
    <!-- modernizr js -->
    <script src="js/vendor/modernizr-2.8.3.min.js"></script>
</head>

<body>
    
    <!-- Wrapper Start -->
    <div class="wrapper homepage">
        <!-- Header Area Start -->
        <header>
            @include('client.layouts.partials.success')
            <!-- Header Top Start -->
            @include('client.layouts.partials.header-top')
            <!-- Header Top End -->
            <!-- Header Bottom Start -->
            @include('client.layouts.partials.header-bottom')
            <!-- Header Bottom End -->
        </header>
        <!-- Header Area End -->
        @yield('content')

        @include('client.layouts.partials.footer')
    </div>
    <!-- Wrapper End -->

    @include('client.layouts.partials.js')
    @if (session('authorization'))
        {{ session('authorization') }}
    @endif

</body>

</html>
@yield('scripts')
