<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<a href="{{ route('auth.sc.facebook') }}">Facebook</a>

@if(Auth::user())
    <h1>Hello {{ Auth::user()->name }}</h1>
    <img src="{{ Auth::user()->avatar }}" width="200px" alt="">
@endif;
</body>
</html>




