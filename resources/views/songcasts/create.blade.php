@extends('app')

@section('content')

    <h1>Create New Songcast</h1>

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form method="post" action="{{url('/songcasts')}}" enctype="multipart/form-data">
        {{ csrf_field() }}
        @include ('songcasts.form')
    </form>

@endsection