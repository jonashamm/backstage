@extends('app')

@section('content')
<div class="inner">
    <h1>Icons</h1>

    <a href="{{ url('/icons/create') }}" title="Add New Icon">Add New Icon</a>
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
        @foreach($icons as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->name }}</td>
                <td>
                    <a href="{{ url('/icons/' . $item->id) }}" title="View Icon">View Icon</a>
                    <a href="{{ url('/icons/' . $item->id . '/edit') }}" title="Edit Icon">Edit Icon</a>
                    <form action="{{ url('/icons/' . $item->id) }}" method="post">
                        {{ method_field('delete') }}
                        {{ csrf_field() }}
                        <button type="submit" title="Delete Icon" onclick="return confirm('Confirm delete?')">Delete Icon</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="pagination-wrapper"> {!! $icons->render() !!} </div>

</div>

@endsection