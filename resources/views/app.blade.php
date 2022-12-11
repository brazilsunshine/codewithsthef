<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SO</title>
    <link rel="stylesheet" href="/css/dist/output.css">
    <link rel="shortcut icon" href="#">
    <!-- Dropzone -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/dropzone.css" />
</head>


<body class="bg-gray-background">
<div id="app" v-cloak>
    @yield('content')
</div>
</body>
<script src="/js/app.js"></script>
</html>
