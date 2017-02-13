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

            <form role="form" method="POST" action="{{ route('password.email') }}">
                {{ csrf_field() }}

                <div class="{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email">E-Mail-Adresse</label>

                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                    @if ($errors->has('email'))
                        <strong>{{ $errors->first('email') }}</strong>
                    @endif
                </div>

                <button type="submit">
                    Password-Zurücksetzen Link schicken
                </button>
            </form>
        </div>
    </div>
@endsection
