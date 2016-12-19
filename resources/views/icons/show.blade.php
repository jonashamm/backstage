@extends('app')

@section('content')
    <h1>Icon {{ $icon->id }}</h1>

    <a href="{{ url('/icons/' . $icon->id . '/edit') }}" title="Edit Icon">Edit Icon</a>
    <form action="{{ url('/icons/' . $icon->id) }}" method="post">
        {{ method_field('delete') }}
        {{ csrf_field() }}
        <button type="submit" title="Delete Icon" onclick="return confirm('Confirm delete?')">Delete Icon</button>
    </form>

    <table>
        <tbody>
        <tr>
            <th>ID</th>
            <td>{{ $icon->id }}</td>
        </tr>
        <tr><th> Name </th><td> {{ $icon->name }} </td></tr>
        </tbody>
    </table>
@endsection