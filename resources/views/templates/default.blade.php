<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Chatty</title>

    <link rel="stylesheet" href="{{ URL::asset('css/app.css') }}">
</head>
<body>
    @include('templates.partials.navigation')
    <div class="container">
        @yield('content')
    </div>
</body>
</html>
