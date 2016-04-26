<!doctype html>
<html lang="de">
<head>
    <link href='https://fonts.googleapis.com/css?family=Catamaran:400,700|Cambay:400,700' rel='stylesheet' type='text/css'>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>backstage</title>
    <link href="{{ asset('bower_components/normalize-css/normalize.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="dist/frontend-global.css">
</head>
<body>

<div class="page-wrapper">
    @yield('content')
</div>

<script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('src/scripts/custom.js') }}"></script>
</body>
</html>