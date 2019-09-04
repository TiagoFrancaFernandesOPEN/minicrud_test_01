<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

        <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css" media="screen,projection"/>
    
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <script> BASE_URL_API = '{{ URL::to('/').'/api/' }}';</script>
    <script> BASE_URL = '{{ URL::to('/').'/' }}';</script>
</head>

<body>
    <header>
        <nav>
        <div class="nav-wrapper">
            <a href="{{ route('site.home') }}" class="brand-logo">@yield('logo',env('APP_NAME'))</a>
            <a href="#" data-target="mobile" class="sidenav-trigger"><i class="material-icons">menu</i></a>
            <ul class="right hide-on-med-and-down">
                @include('_resourses/menu')
            </ul>
        </div>
        </nav>
        <ul class="sidenav" id="mobile">
            @include('_resourses/menu')
        </ul>
    </header>
    <div id="app">
        @include('_resourses/flash-message')
    </div>
    <br clear="all">
    <br clear="all">
