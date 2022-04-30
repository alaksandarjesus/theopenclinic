<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('favicon/apple-touch-icon.png')}}">
<link rel="icon" type="image/png" sizes="32x32" href="{{asset('favicon/favicon-32x32.png')}}">
<link rel="icon" type="image/png" sizes="16x16" href="{{asset('favicon/favicon-16x16.png')}}">
<link rel="manifest" href="{{asset('favicon/site.webmanifest')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{url('css/tailwind.css')}}">
    <link rel="stylesheet" href="{{url('css/libs.css')}}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{url('css/app.css')}}">
    <title>AMS Clinic</title>
</head>

<body class="overflow-auto">

    <div class="super-container mb-5">
        @yield('layout-content')
    </div>


    @include('components.modals.alert')
    
    @include('components.modals.confirm')

    @include('components.loader')

    @yield('layout-page-templates')
    <script>
    window.variables = {
        baseurl: "{{url('/')}}",

    }
    </script>
    <script src="{{url('js/libs.js')}}"></script>
    <script src="{{url('js/app.js')}}"></script>
</body>

</html>