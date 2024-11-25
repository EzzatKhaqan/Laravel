<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <title>@yield('title')</title>

    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('dist/../../assets/images/favicon.png')}}">
    <link href="{{asset('dist/css/style.css')}}" rel="stylesheet">


    <!-- Scripts -->
{{--    @vite(['resources/sass/app.scss', 'resources/js/app.js'])--}}
</head>
<body>

    <main class="py-4">
        @yield('content')
    </main>

    <script src="{{asset('dist/plugins/common/common.min.js')}}"></script>
    <script src="{{asset('dist/js/custom.min.js')}}"></script>
    <script src="{{asset('dist/js/settings.js')}}"></script>
    <script src="{{asset('dist/js/gleek.js')}}"></script>
    <script src="{{asset('dist/js/styleSwitcher.js')}}"></script>

</body>
</html>

