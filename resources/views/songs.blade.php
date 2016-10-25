@extends('app')

@section('content')
    <h2>Unsere songs</h2>

    @if (Session::get('song_name'))
        <em class="info success">
            Der Song {{Session::get('song_name')}} wurde erfolgreich gelöscht!
        </em>
    @endif

    <table class="songs">
        <thead>
            <tr class="head">
                <th>Sänger/in</th>
                <th>Song</th>
                <th>Tonart</th>
                <th>Noten</th>
                <th></th>
                <th></th>
            </tr>
        </thead>

        <tbody>
            @foreach($songs as $song)
                <tr>
                    <td>-</td>
                    <td><strong>
                            <a href="{{$baseurl}}/songs/{{$song->id}}">{{$song->name}}</a></strong> (-)</td>
                    <td>-</td>
                    <td><a href="test">-</a></td>
                    <td></td>
                    <td>
                        <form action="{{$baseurl}}/songs/{{$song->id}}" method="post">
                            {{csrf_field()}}
                            {{ method_field('delete') }}
                            <button type="submit">@include('icons.delete')</button>
                        </form>
                    </td>
                    <td>
                        <a href="{{$baseurl}}/songs/{{$song->id}}"><button>@include('icons.mode_edit')</button></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @include('partials.song-add')

    <button class="song-add-toggler" v-show="!songForm" v-on:click="songForm = !songForm">
        +
    </button>

@endsection