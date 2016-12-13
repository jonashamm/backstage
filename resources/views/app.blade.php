<!doctype html>
<html lang="de">
<head>
    <link href='https://fonts.googleapis.com/css?family=Catamaran:400,700|Cambay:400,700' rel='stylesheet' type='text/css'>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>backstage</title>
    <link rel="stylesheet" href="{{ asset('dist/all-styles.min.css') }}">
</head>
<body>
<div class="page-wrapper" id="backstage">
    <header>
        <div class="inner">
            <a href="{{url('/')}}" class="logo">
                @include('icons.backstagepass')
                <span class="text">
            backstage
        </span>
            </a>
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
        </div>
    </header>
    @yield('content')
</div>

<script src="{{ asset('dist/all-scripts.min.js') }}"></script>
</body>
</html>