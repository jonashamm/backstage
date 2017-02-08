@extends('app')

@section('content')
    <div class="user">
        <div class="inner">
            <h1 class="username">{{$user->name}}
                @if(!empty($user->invitation))
                    @if(!$user->invitation->redeemed)
                        <span class="badge invited">Eingeladen</span>
                    @else
                        <span class="badge active">Aktiv</span>
                    @endif
                @endif
            </h1>
            <strong>spielt folgende Instrumente:</strong><br>

            <ul class="instruments-linked">
                @foreach($user->instruments as $instrument)
                    <li>
                        <div class="name">
                            {{$instrument->name}}
                        </div>
                        <form method="post" action="{{url('/')}}/casts/{{$user->id}}/{{$instrument->id}}" {{--v-on:click="instrumentUserUnlink()"--}}>
                            {{ csrf_field() }}
                            {{ method_field('delete') }}
                            <button type="submit" class="unlink">@include('icon-files.chain-broken')</button>
                        </form>
                    </li>
                @endforeach
            </ul>

            <h3>Instrument hinzufügen</h3>

            <form method="post" action="{{url('/')}}/users/{{$user->id}}">
                {{ csrf_field() }}
                {{ method_field('patch') }}
                <select name="instrument" id="">
                    @foreach($instruments as $instrument)
                        <option value="{{$instrument->id}}">
                            {{$instrument->name}}
                        </option>
                    @endforeach
                </select>
                <button type="submit">Save</button>
            </form>

         {{--   @if(!$user->password)

                @else
                    {{ $user->name }} wurde eingeladen, aktiv mitzumachen.
                @endif
            @endif--}}

            @if(empty($user->invitation))
                <div class="invite-user-box">
                    <p>{{ $user->name }} nimmt noch nicht aktiv teil. Willst du sie/ihn einladen?</p>
                    <form action="{{url('/')}}/invite" method="post">
                        {{ csrf_field() }}
                        <input name="user_id" type="hidden" value="{{ $user->id }}">
                        <input name="name" type="hidden" value="{{ $user->name }}">
                        <input name="email" type="hidden" value="{{ $user->email }}">
                        <button type="submit">{{ $user->name }} jetzt einladen</button>
                    </form>
                </div>
            @endif
        </div>
    </div>
@endsection