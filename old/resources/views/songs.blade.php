@extends('app')

@section('content')
    <h2>Unsere songs</h2>

    @if (Session::get('song_name'))
        Der Song {{Session::get('song_name')}} wurde erfolgreich gelöscht!
    @endif

    <table class="songs">
        <thead>
            <tr class="head">
                <th>Sänger/in</th>
                <th>Song</th>
                <th>Tonart</th>
                <th>Noten Test</th>
                <th></th>
                <th></th>
            </tr>
        </thead>

        <tbody>
            @foreach($songs as $song)
                <tr>
                    <td>-</td>
                    <td><strong>{{$song->name}}</strong> (-)</td>
                    <td>-</td>
                    <td><a href="test">-</a></td>
                    <td></td>
                    <td>
                        <form action="{{$baseurl}}/song/delete/{{$song->id}}" method="post">
                            {{csrf_field()}}
                            <button type="submit">@include('icons.delete')</button>
                        </form>
                    </td>
                    <td>
                        <a href="{{$baseurl}}/song/{{$song->id}}"><button>@include('icons.mode_edit')</button></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <form action="{{$baseurl}}/song/create" method="post">
        {{csrf_field()}}
        <input name="name" type="text">
        <button type="submit">Speichern</button>
    </form>

@endsection