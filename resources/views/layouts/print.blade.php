<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{url('css/libs.css')}}">
    <link rel="stylesheet" href="{{url('css/tailwind.css')}}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{url('css/app.css')}}">
    <title>AMS Clinic</title>
</head>

<body onload="window.print()">

@yield('body')
    <script src="{{url('js/libs.js')}}"></script>
    <script src="{{url('js/app.js')}}"></script>
</body>

</html>
