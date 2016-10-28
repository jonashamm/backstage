<!doctype html>
<html lang="de">
<head>
    <link href='https://fonts.googleapis.com/css?family=Catamaran:400,700|Cambay:400,700' rel='stylesheet' type='text/css'>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>backstage</title>
    <link href="{{ asset('bower_components/normalize-css/normalize.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('dist/custom.css') }}">
</head>
<body>
<div class="page-wrapper" id="backstage">
    <div class="user-actions">
        @if(!empty($currentUser))
            <div class="greeting">
                Hi {{$currentUser->name}}!
            </div>

        @endif

        <a href="{{$baseurl}}/instruments">Instrumente</a>

        <a href="{{$baseurl}}/users">Mitglieder</a>

        @if(!empty($currentUser))
            <form action="{{$baseurl}}/logout" method="post">
                {{csrf_field()}}
                <button type="submit">Logout</button>
            </form>
        @endif
    </div>
    @yield('content')
</div>

<script src="{{ asset('bower_components/vue/dist/vue.js') }}"></script>
<script src="{{ asset('src/scripts/custom.js') }}"></script>
</body>
</html>