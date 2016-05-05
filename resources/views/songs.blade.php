@extends('app')

@section('content')
    <h2>Our songs</h2>
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
                    <td>@include('icons.delete')</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection