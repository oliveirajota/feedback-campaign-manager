@include('layouts.partials.sidebar')
@include('layouts.partials.top-nav')
@include('layouts.partials.footer')

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>


<body class="nav-md">
<div class="container body">
    <div class="main_container">

        @yield('sidebar')

        @yield('top-navigation')

        <div class="right_col" role="main">
            <div class="">
                @yield('content')
            </div>
        </div>


    </div>
    @yield('footer')
</div>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>

@yield('js')
</html>
