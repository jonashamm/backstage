@extends('app')

@section('content')
    <div class="user">
        <div class="inner">
            <h2> {{$user->name}}</h2>

            <h3>User spielt folgende Instrumente:</h3>
            @foreach($user->instruments as $instrument)
                {{$instrument->name}}<br>
            @endforeach

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