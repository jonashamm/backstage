@extends('app')

@section('content')

    <h1>Attachmenttypes</h1>

    <a href="{{ url('/attachmenttypes/create') }}" title="Add New Attachmenttype">Add New Attachmenttype</a>
    <br/>

    <table >
        <thead>
        <tr>
            <th>ID</th>
            <th> Name </th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($attachmenttypes as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->name }}</td>
                <td>
                    <a href="{{ url('/attachmenttypes/' . $item->id) }}" title="View Attachmenttype">View Attachmenttype</a>
                    <a href="{{ url('/attachmenttypes/' . $item->id . '/edit') }}" title="Edit Attachmenttype">Edit Attachmenttype</a>
                    <form action="{{ url('/attachmenttypes/' . $item->id) }}" method="post">
                        {{ method_field('delete') }}
                        {{ csrf_field() }}
                        <button type="submit" title="Delete Attachmenttype" onclick="return confirm('Confirm delete?')">Delete Attachmenttype</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="pagination-wrapper"> {!! $attachmenttypes->render() !!} </div>

@endsection