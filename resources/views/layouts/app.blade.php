<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="{{ asset('assets/images/logo.jpg') }}" type="image/x-icon">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="stylesheet" href="{{ asset('assets/icons/icons.css') }}">

        @isset($extra_head)
            {{ $extra_head }}
        @endisset

        @vite(['resources/css/styles.css', 'resources/js/app.js'])
        
        <title>{{ config('app.name', 'Laravel') }}</title>
    </head>
    <body>
        {{ $slot }}

        @isset($javascript)
            {{ $javascript }}
            <script src="{{ asset('assets/js/alert.js') }}"></script>
            <script src="{{ asset('assets/js/custom.js') }}"></script>
        @else
            <script src="{{ asset('assets/js/jquery.js') }}"></script>
            <script src="{{ asset('assets/js/alert.js') }}"></script>
            <script src="{{ asset('assets/js/custom.js') }}"></script>
        @endisset
    </body>
</html>
