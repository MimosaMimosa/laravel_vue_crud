<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel 9 with vue 3 vite</title>

    </head>
    <body>
        <div id="modal"></div>
        <div id="app"></div>
        @routes
        @vite('resources/js/app.js')
    </body>
</html>
