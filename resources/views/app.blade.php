<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sthefane Oliveira</title>
    <link rel="stylesheet" href="/css/dist/output.css">
    <link rel="shortcut icon" href="/img/favicon.png">
    <!-- Dropzone -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/dropzone.css" />
</head>


<body>
<div id="app" v-cloak>
    @yield('content')
</div>
</body>
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
<script src="/js/app.js"></script>
<script src="https://kit.fontawesome.com/9552ebdda6.js" crossorigin="anonymous"></script>
</html>
