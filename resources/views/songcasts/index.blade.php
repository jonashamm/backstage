@extends('layouts.app')

@section('content')

    <h1>Songcasts</h1>

    <a href="{{ url('/songcasts/create') }}" title="Add New Songcast">Add New Songcast</a>
    <br/>

    <table >
        <thead>
        <tr>
            <th>ID</th>
            <th> Song Id </th><th> Instrument User Id </th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($songcasts as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->song_id }}</td><td>{{ $item->instrument_user_id }}</td>
                <td>
                    <a href="{{ url('/songcasts/' . $item->id) }}" title="View Songcast">View Songcast</a>
                    <a href="{{ url('/songcasts/' . $item->id . '/edit') }}" title="Edit Songcast">Edit Songcast</a>
                    <form action="{{ url('/songcasts/' . $item->id) }}" method="post">
                        {{ method_field('delete') }}
                        {{ csrf_field() }}
                        <button type="submit" title="Delete Songcast" onclick="return confirm('Confirm delete?')">Delete Songcast</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="pagination-wrapper"> {!! $songcasts->render() !!} </div>

@endsection