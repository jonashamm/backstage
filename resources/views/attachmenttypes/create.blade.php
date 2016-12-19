@extends('app')

@section('content')

    <h1>Create New Attachmenttype</h1>

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form method="post" action="{{url('/attachmenttypes')}}" enctype="multipart/form-data">
        {{ csrf_field() }}
        @include ('attachmenttypes.form')
    </form>

@endsection