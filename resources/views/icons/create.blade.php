@extends('app')

@section('content')
<div class="inner">
    <h1>Create New Icon</h1>

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form method="post" action="{{url('/icons')}}" enctype="multipart/form-data">
        {{ csrf_field() }}
        @include ('icons.form')
    </form>
</div>


@endsection