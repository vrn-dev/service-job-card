<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>@yield('title')</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="{{ URL::to('src/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ URL::to('src/css/main.css') }}">
    <link rel="stylesheet" href="{{ URL::to('src/fa/css/font-awesome.css') }}">
    <link rel="stylesheet" href="{{ URL::to('/src/css/jquey.datatables.css') }}">
    <link rel="stylesheet" href="{{ URL::to('/src/css/chosen.css') }}">
    <link rel="stylesheet" href="{{ URL::to('/src/css/jquery-ui.css') }}">
    <link rel="stylesheet" href="{{ URL::to('/src/css/jquery-ui.theme.css') }}">
    <link rel="stylesheet" href="{{ URL::to('/src/css/jquery-ui.structure.css') }}">


    @yield('styles')
</head>
<body>
@include('includes.header')
<div class="container">
    @yield('content')
</div>

<script src="{{ URL::to('src/js/jquery.js') }}"></script>
<script src="{{ URL::to('src/js/jquery-ui.js') }}"></script>
<script src="{{ URL::to('src/js/bootstrap.js') }}"></script>
<script src="{{ URL::to('/src/js/jquery.datatables.js') }}"></script>
<script src="{{ URL::to('/src/js/chosen.jquery.js') }}"></script>
<script src="{{ URL::to('src/js/app.js') }}"></script>
@include('includes.js_vars')
@yield('scripts')

</body>
</html>