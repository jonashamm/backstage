@extends('app')

@section('content')
    <div class="user">
        <div class="inner">
            <h1 class="username">{{$user->name}}</h1>
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
        </div>
    </div>
@endsection