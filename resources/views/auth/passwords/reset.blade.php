@extends('app')

@section('content')
    <div class="reset-password">
        <div class="inner">
            <h1>Passwort zurücksetzen</h1>

            @if (session('status'))
                <div class="info success">
                    {{ session('status') }}
                </div>
            @endif

            <form class="form-horizontal" role="form" method="POST" action="{{ route('password.request') }}">
                {{ csrf_field() }}
                <input type="hidden" name="token" value="{{ $token }}">

                <div class="{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email">E-Mail-Adresse</label>
                    <input id="email" type="email" name="email" value="{{ $email or old('email') }}" required autofocus>

                    @if ($errors->has('email'))
                        <strong>{{ $errors->first('email') }}</strong>
                    @endif
                </div>

                <div class="{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="password">Passwort</label>
                    <input id="password" type="password" name="password" required>

                    @if ($errors->has('password'))
                        <strong>{{ $errors->first('password') }}</strong>
                    @endif
                </div>

                <div class="{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                    <label for="password-confirm">Passwort bestätigen</label>
                    <input id="password-confirm" type="password" name="password_confirmation" required>

                    @if ($errors->has('password_confirmation'))
                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                    @endif
                </div>
                <button type="submit">
                    Passwort zurücksetzen
                </button>
            </form>
        </div>
    </div>
@endsection
