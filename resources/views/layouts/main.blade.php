<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'My Laravel App')</title>
    <!-- <link rel="stylesheet" href="{{ asset('css/app.css') }}"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Scripts -->
    <!-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <link href="//cdn.datatables.net/2.2.2/css/dataTables.dataTables.min.css" rel="stylesheet">
    <script src="//cdn.datatables.net/2.2.2/js/dataTables.min.js"></script>

   
</head>
<body>
    <header>
        <h1>@yield('header', 'Welcome to My Laravel App')</h1>
    </header>

    <div class="container">
        <div class="row">
            @include('layouts.nav')
            @yield('content')
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>