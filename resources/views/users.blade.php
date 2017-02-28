@extends('app')

@section('content')
    <div class="users-list">
        <div class="inner">
            <h2>Mitglieder</h2>
            <ul class="users">
                @foreach($users as $user)
                    <li>
                        <div class="name">
                            <a href="{{url('/')}}/users/{{$user->id}}">{{$user->name}}</a>
                            @if(!empty($user->invitation))
                                @if(!$user->invitation->redeemed)
                                    <span class="badge invited">Eingeladen</span>
                                @else
                                    <span class="badge active">Aktiv</span>
                                @endif
                            @endif
                        </div>

                        @include('partials.delete-button',['object' => 'user'])
                    </li>
                @endforeach
            </ul>

            @include('_errors.errors-general')

            <div class="invite-user">
                <h2>User einladen</h2>
                <form action="{{url('/')}}/invite" method="post">
                    {{ csrf_field() }}
                    <input name="name" type="text" placeholder="Name" value="{{ old('name') }}" class="{{ $errors->has('name') ? ' has-error' : ''}}" >
                    <input name="email" type="email" placeholder="E-Mail-Adresse" value="{{ old('email') }}"  class="{{ $errors->has('email') ? ' has-error' : ''}}" v-on:keyup="removeErrorClass">
                    <button type="submit">Einladen</button>
                </form>
            </div>


            @include('partials.user-add')

            <button class="song-add-toggler" v-show="!userForm" v-on:click="userForm = !userForm">
                +
            </button>
        </div>
    </div>

@endsection