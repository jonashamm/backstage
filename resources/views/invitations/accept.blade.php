@extends('app')

@section('content')
    <h3>Bitte lege dein Passwort fest</h3>

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{url('/')}}/redeem-invitation" method="post">
        {{ csrf_field() }}
        <input type="password" name="password">
        <input type="password" name="password_confirmation">
        <input type="hidden" name="code" value="{{ $code }}">
        <input type="hidden" name="user_id" value="{{ $user_id }}">
        <button>Passwort speichern</button>
    </form>

@endsection