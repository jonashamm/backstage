@extends('app')

@section('content')
    <h2>Mitglieder</h2>
    <ul class="instruments">
        @foreach($users as $user)
            <li>
                <a href="{{url('/')}}/users/{{$user->id}}">{{$user->name}}</a>
                @include('partials.delete-button',['object' => 'user'])
            </li>
        @endforeach
    </ul>

    @include('partials.user-add')
@endsection