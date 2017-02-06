@extends('app')

@section('content')
    <h3>Bitte lege dein Passwort fest</h3>
    <form action="{{url('/')}}/redeem-invitation" method="post">
        {{ csrf_field() }}
        <input type="password" name="password">
        <input type="password" name="password_confirmation">
        <input type="hidden" name="code" value="{{ $code }}">
        <input type="hidden" name="user_id" value="{{ $user_id }}">
        <button>Passwort speichern</button>
    </form>
@endsection