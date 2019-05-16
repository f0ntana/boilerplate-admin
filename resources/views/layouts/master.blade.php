<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ url('css/app.css')}}">
    <title>{{ config('app.name') }}</title>
</head>
<body>
    @include('layouts.sidebar')
    <div class="main-content">
        @include('layouts.topbar')
        @yield('content')
    </div>
    <script src="{{ url('js/app.js')}}"></script>
    @yield('scripts')
</body>
</html>
