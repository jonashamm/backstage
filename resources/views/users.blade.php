@extends('app')

@section('content')
    <div class="users-list">
        <div class="inner">
            <h2>Mitglieder</h2>
            <ul class="instruments">
                @foreach($users as $user)
                    <li>
                        <div class="name">
                            <a href="{{url('/')}}/users/{{$user->id}}">{{$user->name}}</a>
                        </div>

                        @include('partials.delete-button',['object' => 'user'])
                    </li>
                @endforeach
            </ul>

            @include('partials.user-add')

            <button class="song-add-toggler" v-show="!userForm" v-on:click="userForm = !userForm">
                +
            </button>
        </div>
    </div>

@endsection