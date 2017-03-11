<!doctype html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>backstage</title>
    <link rel="stylesheet" href="https://cdn.plyr.io/2.0.11/plyr.css">
    <link rel="stylesheet" href="{{ asset('dist/all-styles.min.css?v=1489234019466') }}">

    <link rel="apple-touch-icon" sizes="180x180" href="{{url('/')}}/apple-touch-icon.png">
    <link rel="icon" type="image/png" href="{{url('/')}}/favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="{{url('/')}}/favicon-16x16.png" sizes="16x16">
    <link rel="manifest" href="{{url('/')}}/manifest.json">

    <link rel="mask-icon" href="{{url('/')}}/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="theme-color" content="#00a3ad">
</head>
<body>
<div class="page-wrapper" id="backstage" :class="{'js-loaded': vueLoaded}">
    <header>
        <div class="inner">
            <a href="{{url('/')}}" class="logo">
                @include('icon-files.backstage')
            </a>
            <div class="user-actions">
                @if(!empty(Auth::user()))
                    <div class="greeting">
                        Hi {{$currentUser->name}}!
                    </div>

                    <a href="{{$baseurl}}/songs">Songs</a>

                    <a href="{{$baseurl}}/instruments">Instrumente</a>

                    <a href="{{$baseurl}}/users">Mitglieder</a>
                @endif

                @if(!empty(Auth::user()))
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

<script src="{{ asset('dist/all-vendor-scripts.js?v=1489234019466') }}"></script>
<script src="{{ asset('dist/custom.js?v=1489234019466') }}"></script>
<script src="https://cdn.jsdelivr.net/sortable/1.4.2/Sortable.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.13.1/lodash.min.js"></script>
<script src="https://cdn.rawgit.com/David-Desmaisons/Vue.Draggable/master/dist/vuedraggable.min.js"></script>
</body>
</html>