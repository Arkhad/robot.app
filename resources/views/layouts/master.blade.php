<!DOCTYPE html>
<html>
<head>
    <!--Import Google Icon Font-->
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.1/css/materialize.min.css">

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <title>App Name - @yield('title')</title>
</head>

<body>
<div class="container">
    @include('partials.nav')
    <div class="row">
        <div class="col s4">
        @section('sidebar')
            This is the master sidebar.
        @show
        </div>
        <div class="col s8">
        @yield('content')
        </div>
    </div>
    @include('partials.footer')
</div>
<!--Import jQuery before materialize.js-->
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.1/js/materialize.min.js"></script>
<script>
    $(".button-collapse").sideNav();
</script>
</body>
</html>