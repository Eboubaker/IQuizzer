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
        <meta name="title" content="Quizzer — Create Quizzes and Exams For your Students">
        <meta name="description" content="Quizzer offers a modern management system for your Students, Track their results and history">

        <!-- Open Graph / Facebook -->
        <meta property="og:type" content="website">
        <meta property="og:url" content="http://iquizzer.online/">
        <meta property="og:title" content="Quizzer — Create Quizzes and Exams For your Students">
        <meta property="og:description" content="Quizzer offers a modern management system for your Students, Track their results and history">
        <meta property="og:image" content="{{ asset('img/meta-image.png') }}">

        <!-- Twitter -->
        <meta property="twitter:card" content="summary_large_image">
        <meta property="twitter:url" content="http://iquizzer.online/">
        <meta property="twitter:title" content="Quizzer — Create Quizzes and Exams For your Students">
        <meta property="twitter:description" content="Quizzer offers a modern management system for your Students, Track their results and history">
        <meta property="twitter:image" content="{{ asset('img/meta-image.png') }}">
        <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico?v=2') }}"/>
            <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <script src="{{ mix('js/app.js') }}"></script>
        <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;500;700;900&display=swap" rel="stylesheet">
        @stack('header-sources')
    </head>
    <body class="antialiased bg-gray-100" x-data="noticesHandler()" @notice.window="add($event.detail)">

        @include('items.loading')
        @include('_nav')

        @include('_toast')
        <div class="page min-h-screen">
            @yield('content')
        </div>
        @include('_footer')
        @stack('scripts')
    </body>
<script>
    if(!window.readyFunc)
    {
        window.readyFunc = function(){
            $('#loading-animation').hide();
        };
    }
    $(document).ready(window.readyFunc);
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
