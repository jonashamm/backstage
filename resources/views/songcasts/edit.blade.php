@extends('layouts.app')

@section('content')

    <h1>Edit Songcast {{ $songcast->id }}</h1>

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ url('/songcasts/' . $songcast->id) }}" method="post" enctype="multipart/form-data">
        {{ method_field('patch') }}
        {{ csrf_field() }}
        @include ('songcasts.form', ['submitButtonText' => 'Update'])
    </form>

@endsection