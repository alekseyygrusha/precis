<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8"/>
    <link rel="icon" href="/images/icons/icon_32_32.png" type="image/x-icon">
    {{--Остальные размеры доделать--}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="//fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet"/>
    <title>Precis</title>

    {!! file_get_contents(public_path('svg/sprite.svg')) !!}
    @vite(['resources/js/app.js'])
</head>
<body>

<div id="app"></div>
    @vite(['resources/scss/app.scss'])
</body>
</html>
