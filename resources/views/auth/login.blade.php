@extends('app')

@section('content')
    <div class="login">
        <div class="inner">
            <h1>Login</h1>
            <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                {{ csrf_field() }}

                <div class="{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email">E-Mail Address</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>

                    @if ($errors->has('email'))
                        <strong>{{ $errors->first('email') }}</strong>
                    @endif
                </div>

                <div class="{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="password">Password</label>
                    <input id="password" type="password" name="password" required>

                    @if ($errors->has('password'))
                        <strong>{{ $errors->first('password') }}</strong>
                    @endif
                </div>

                <label>
                    <input type="checkbox" name="remember"> Remember Me
                </label>

                <button type="submit">
                    Login
                </button>

                <a href="{{ url('/password/reset') }}">
                    Forgot Your Password?
                </a>
            </form>
        </div>
    </div>
@endsection
