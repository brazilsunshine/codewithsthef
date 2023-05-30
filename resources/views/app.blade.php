<!DOCTYPE html>
<html lang="en" style="width: 101%;">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sthefane Oliveira</title>
    <link rel="stylesheet" href="/css/dist/output.css">
    <link rel="shortcut icon" href="/img/favicon.png">
    <!-- Dropzone -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/dropzone.css" />
    <script>

        <?php
            $permissions = auth()->check()
                ? auth()->user()->jsPermissions()
                : 'null'
        ?>

        window.Laravel = {
            jsPermissions: {!! $permissions !!}
        }

    </script>
</head>


<body>
<div id="app" v-cloak>
    @yield('content')
</div>
</body>

<script src="/js/app.js"></script>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous"/>
</html>
