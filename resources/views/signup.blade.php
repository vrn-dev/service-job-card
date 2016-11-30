<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Log In</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ URL::to('src/css/main.css') }}">
</head>
<body>
@include('includes.message-block')
<div class="row">
    <div class="col-md-4 col-md-offset-4 bg-info">
        <h3>Sign Up</h3>
        <form action="{{ route('signUpSubmit') }}" method="post">
            <div class="form-group {{ $errors->has('username') ? 'has-error' : '' }}">
                <label for="username">Username:</label>
                <input type="text" class="form-control" name="username" id="username" value="{{ Request::old('username') }}">
            </div>
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="personName">Full Name:</label>
                <input type="text" class="form-control" name="name" id="name" value="{{ Request::old('name') }}">
            </div>
            <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                <label for="username">Email:</label>
                <input type="email" class="form-control" name="email" id="email" value="{{ Request::old('email') }}">
            </div>
            <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                <label for="password">Password:</label>
                <input type="password" class="form-control" name="password" id="password" value="{{ Request::old('password') }}">
            </div>
            <div class="form-group {{ $errors->has('repeatPassword') ? 'has-error' : '' }}">
                <label for="username">Repeat Password:</label>
                <input type="password" class="form-control" name="repeatPassword" id="repeatPassword" value="{{ Request::old('repeatPassword') }}">
            </div>
            <div class="form-group">
                <button class="btn btn-primary" type="submit">Sign In</button>
            </div>
            <input type="hidden" name="_token" value="{{ Session::token() }}">
        </form>
    </div>

</div>


<script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-migrate-3.0.0.min.js" integrity="sha256-JklDYODbg0X+8sPiKkcFURb5z7RvlNMIaE3RA2z97vw=" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>
</html>