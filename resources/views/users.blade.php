@extends('app')

@section('content')
    <h2>Mitglieder</h2>
    <ul class="instruments">
        @foreach($users as $user)
            <li>
                {{$user->name}}
                @include('partials.delete-button',['object' => 'user'])
            </li>
        @endforeach
    </ul>

    @include('partials.user-add')
@endsection