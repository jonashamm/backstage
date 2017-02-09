@extends('app')

@section('content')
    <div class="accept-invitation">
        <div class="inner">


            <h3>Bitte lege ein (neues) Passwort fest</h3>

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
                <div class="formfield">
                    <label for="password">Neues Passwort</label>
                    <input type="password" name="password" placeholder="Neues Passwort">
                </div>
                <div class="formfield">
                    <label for="password_confirmation">Neues Passwort wiederholen</label>
                    <input type="password" name="password_confirmation" placeholder="Neues Passwort wiederholen">
                </div>
                <input type="hidden" name="code" value="{{ $code }}">
                <input type="hidden" name="user_id" value="{{ $user_id }}">
                <button>Passwort speichern</button>
            </form>
        </div>
    </div>
@endsection