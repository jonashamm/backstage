@extends('app')

@section('content')
    <h1>Songcast {{ $songcast->id }}</h1>

    <a href="{{ url('/songcasts/' . $songcast->id . '/edit') }}" title="Edit Songcast">Edit Songcast</a>
    <form action="{{ url('/songcasts/' . $songcast->id) }}" method="post">
        {{ method_field('delete') }}
        {{ csrf_field() }}
        <button type="submit" title="Delete Songcast" onclick="return confirm('Confirm delete?')">Delete Songcast</button>
    </form>

    <table>
        <tbody>
        <tr>
            <th>ID</th>
            <td>{{ $songcast->id }}</td>
        </tr>
        <tr><th> Song Id </th><td> {{ $songcast->song_id }} </td></tr><tr><th> Instrument User Id </th><td> {{ $songcast->instrument_user_id }} </td></tr>
        </tbody>
    </table>
@endsection