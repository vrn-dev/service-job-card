<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>@yield('title')</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="{{ URL::to('src/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ URL::to('src/css/main.css') }}">
    <link rel="stylesheet" href="{{ URL::to('src/fa/css/font-awesome.min.css') }}">


    @yield('styles')
</head>
<body>
@include('includes.header')
<div class="container">
    @yield('content')
</div>

<script src="{{ URL::to('src/js/jquery.min.js') }}"></script>
<script src="{{ URL::to('src/js/jquery-migrate.min.js') }}"></script>
<script src="{{ URL::to('src/js/bootstrap.min.js') }}"></script>
<script src="{{ URL::to('src/js/app.js') }}"></script>
@yield('scripts')
</body>
</html>