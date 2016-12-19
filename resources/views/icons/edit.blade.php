@extends('app')

@section('content')

    <h1>Edit Icon {{ $icon->id }}</h1>

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ url('/icons/' . $icon->id) }}" method="post" enctype="multipart/form-data">
        {{ method_field('patch') }}
        {{ csrf_field() }}
        @include ('icons.form', ['submitButtonText' => 'Update'])
    </form>

@endsection