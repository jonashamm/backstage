@extends('app')

@section('content')
    <h1>Attachmenttype {{ $attachmenttype->id }}</h1>

    <a href="{{ url('/attachmenttypes/' . $attachmenttype->id . '/edit') }}" title="Edit Attachmenttype">Edit Attachmenttype</a>
    <form action="{{ url('/attachmenttypes/' . $attachmenttype->id) }}" method="post">
        {{ method_field('delete') }}
        {{ csrf_field() }}
        <button type="submit" title="Delete Attachmenttype" onclick="return confirm('Confirm delete?')">Delete Attachmenttype</button>
    </form>

    <table>
        <tbody>
        <tr>
            <th>ID</th>
            <td>{{ $attachmenttype->id }}</td>
        </tr>
        <tr><th> Name </th><td> {{ $attachmenttype->name }} </td></tr>
        </tbody>
    </table>
@endsection