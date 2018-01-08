<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Todo App</title>

        <!-- CSRF Stuff -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <script>window.Laravel = { csrfToken: '{{ csrf_token() }}' }</script>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('build/css/app.css') }}">
    </head>
    <body>
        <header>
            <div class="container">
                <div class="row">
                    <div class="logo center-block">
                        <h1>ToDo <span class="glyphicon glyphicon-ok"></span></h1>
                    </div>
                </div>
            </div>
        </header>

        <div id="app" class="container">
            <task-list></task-list>
        </div>

        <!-- Scripts -->
        <script src="{{ asset('/build/js/app.js') }}"></script>
    </body>
</html>
