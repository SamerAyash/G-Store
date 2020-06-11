<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link href="https://fonts.googleapis.com/css?family=Roboto|Vidaloka&display=swap|Roboto+Condensed|Squada+One|Anton|Lato|Prompt|Playfair+Display|Open+Sans:600" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>GStore</title>
    <link rel="icon" href="{{asset('assets/img/G.png')}}" type="image/x-icon">
    <link href="{{asset('assets/css/all.css')}}" rel="stylesheet">



</head>
<body>
<nav class=" navbar navbar-expand-lg navbar-light bg-light nav-custom ">
    <a class="navbar-brand" href="{{route('home')}}"><img src="{{asset('assets/img/gtore.png')}}" class="navbar-img" height="25px"></a>
    <div class="ml-auto">
        <span class=" language  ">English </span>
    </div>
</nav>
    <div id="app" style="margin-top: 100px">
        <router-view></router-view>
    </div>
</body>
</html>
    <script src="{{mix('js/app.js')}}"></script>
    <link href="{{asset('assets/css/login.css')}}" rel="stylesheet">
    @csrf

