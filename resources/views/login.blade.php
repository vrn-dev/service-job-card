<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Log In</title>
    <link rel="stylesheet" href="{{ URL::to('src/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ URL::to('src/css/main.css') }}">
</head>
<body>
@include('includes.message-block')
<div class="row">
    <div class="col-md-4 col-md-offset-4 col-xs-6 col-xs-offset-3 bg-info">
        <h3>Sign In</h3>
        <form action="{{ route('signInSubmit') }}" method="post">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" class="form-control" name="username" id="username" value="{{ Request::old('username') }}" required autofocus>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" name="password" id="password" value="{{ Request::old('password') }}" required>
                <input type="hidden" name="_token" value="{{ Session::token() }}">
            </div>
            <div class="form-group">
                <button class="btn btn-primary" type="submit">Sign In</button>
            </div>
        </form>
    </div>

</div>

<script src="{{ URL::to('src/js/jquery.min.js') }}"></script>
<script src="{{ URL::to('src/js/bootstrap.min.js') }}"></script>
</body>
</html>