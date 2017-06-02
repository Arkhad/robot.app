<!doctype html>
<html lang="en">
<head>
    <meta charset="{{$charset?? 'utf8'}}">
    <title>Back @yield('title')</title>
    <!--Import Google Icon Font-->
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/css/materialize.min.css">
    <link rel="stylesheet" href="{{url('css/app.css')}}">
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    @section('head')
    @show
</head>
<body>
    <div class="container">
    </div>
    @include('partials.flash')
    <div class="container">
        <div class="row">
            @section('sidebar')
            <div class="col s3">
                <ul class="" >
                    <li class="active" >
                        <a href="{{route('home')}}">Accueil</a>
                    </li>
                    <li>
                        <a href="{{route('logout')}}">Se déconnecté</a>
                    </li>
                    <li>
                        <a href="{{url('dashboard')}}">Dashboard</a>
                    </li>
                </ul>
            </div>
            @show
            <div class="col s9">
              <h2>Hello {{$user? $user->name : ''}}</h2>
                @yield('content')
            </div>
        </div>
    </div>
    <footer class="container">
        <div class="row">
        </div>
    </footer>
    @section('scripts')
<script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script><!-- Compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/js/materialize.min.js"></script>
<script>
    $(".button-collapse").sideNav();
    $('select').material_select();
    $('.parallax').parallax();
</script>
@show
</body>
</html>