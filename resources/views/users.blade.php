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
            <div class="invite-user">
                <h2>User einladen</h2>
                <form action="{{url('/')}}/invite" method="post">
                    <input name="name" type="text" placeholder="Name">
                    <input name="email" type="email" placeholder="E-Mail-Adresse">
                </form>
            </div>


            @include('partials.user-add')

            <button class="song-add-toggler" v-show="!userForm" v-on:click="userForm = !userForm">
                +
            </button>
        </div>
    </div>

@endsection