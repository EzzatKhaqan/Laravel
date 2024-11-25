<!DOCTYPE html>
<html class="h-100" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>@yield('title')</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('dist/images/favicon.png')}}">
    <link href="{{asset('dist/css/style.css')}}" rel="stylesheet">

</head>

<body class="h-100">
   @yield("content")

    <script src="{{asset('dist/plugins/common/common.min.js')}}"></script>
    <script src="{{asset('dist/js/custom.min.js')}}"></script>
    <script src="{{asset('dist/js/settings.js')}}"></script>
    <script src="{{asset('dist/js/gleek.js')}}"></script>
    <script src="{{asset('js/styleSwitcher.js')}}"></script>
</body>
</html>

