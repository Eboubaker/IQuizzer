<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @hasSection('title')
            <title>@yield('title') - {{ config('app.name') }}</title>
        @else
            <title>{{ config('app.name') }}</title>
        @endif

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{ mix('css/main.css') }}">
        <script src="{{ mix('js/app.js') }}"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-icons/3.0.1/iconfont/material-icons.min.css" integrity="sha256-x8PYmLKD83R9T/sYmJn1j3is/chhJdySyhet/JuHnfY=" crossorigin="anonymous" />
        <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;500;700;900&display=swap" rel="stylesheet">
        @stack('header-sources')
    </head>
    <body class="antialiased bg-gray-100">
        @include('items.loading')
        @include('_nav')
        @yield('content')
        @stack('scripts')
    </body>
<script>
    $(document).ready(function(){
        $('#loading-animation').hide();
    });
    $(document).on("keydown","form", function(event)
    {
        let node = event.target.nodeName.toLowerCase();
        let type = $(event.target).prop('type').toLowerCase();

        if(node!='textarea' && type!='submit' && (event.keyCode == 13 || event.keyCode == 169))
        {
            event.preventDefault();
            return false;
        }
    });
    document.addEventListener("DOMContentLoaded", function(event) {console.log('loaded');});
</script>
</html>
