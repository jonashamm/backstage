@extends('app')

@section('content')
    <div class="login">
        <div class="inner">
            <h1>Login</h1>
            <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                {{ csrf_field() }}

                <div class="formfield {{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email">E-Mail-Adresse</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>

                    @if ($errors->has('email'))
                        <strong>{{ $errors->first('email') }}</strong>
                    @endif
                </div>

                <div class="formfield {{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="password">Passwort</label>
                    <input id="password" type="password" name="password" required>

                    @if ($errors->has('password'))
                        <strong>{{ $errors->first('password') }}</strong>
                    @endif
                </div>

                <label class="stay-logged-in">
                    <input type="checkbox" name="remember"> Eingeloggt bleiben
                </label><br>

                <button type="submit">
                    Login
                </button>

                <a class="password-forgotten" href="{{ url('/password/reset') }}">
                    Passwort vergessen?
                </a>
                <br>
            </form>
        </div>
    </div>
@endsection
