<!doctype html>
<html lang="de">
<head>
     <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>backstage</title>
    <link rel="stylesheet" href="{{ asset('dist/all-styles.min.css?v=2.0') }}">

    <link rel="apple-touch-icon" sizes="180x180" href="{{url('/')}}/apple-touch-icon.png">
    <link rel="icon" type="image/png" href="{{url('/')}}/favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="{{url('/')}}/favicon-16x16.png" sizes="16x16">
    <link rel="manifest" href="{{url('/')}}/manifest.json">
    <link rel="mask-icon" href="{{url('/')}}/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="theme-color" content="#00a3ad">
</head>
<body>
<div class="page-wrapper" id="backstage">
    <header>
        <div class="inner">
            <a href="{{url('/')}}" class="logo">
                @include('icon-files.backstage')
            </a>
            <div class="user-actions">
                @if(!empty($currentUser))
                    <div class="greeting">
                        Hi {{$currentUser->name}}!
                    </div>
                @endif
                <a href="{{$baseurl}}/songs">Songs</a>

                <a href="{{$baseurl}}/instruments">Instrumente</a>

                <a href="{{$baseurl}}/users">Mitglieder</a>

                @if(!empty($currentUser))
                    <form action="{{$baseurl}}/logout" method="post">
                        {{csrf_field()}}
                        <button type="submit">Logout</button>
                    </form>
                @endif
            </div>
        </div>
    </header>
    @yield('content')
</div>

<script src="{{ asset('dist/all-scripts.min.js?v=2.0') }}"></script>
</body>
</html>