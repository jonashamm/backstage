@extends('app')

@section('content')
    <h2>Unsere Instrumente</h2>

    @if (Session::get('instrument_name'))
        <em class="info success">
            Das Instrument {{Session::get('instrument_name')}} wurde erfolgreich gelöscht!
        </em>
    @endif

    <ul class="instruments">
        @foreach($instruments as $instrument)
            <li>
                {{$instrument->name}}
                @include('partials.delete-button',['object' => 'instrument'])
            </li>
        @endforeach
    </ul>

    @include('partials.instrument-add')

    <button class="song-add-toggler" v-show="!songForm" v-on:click="songForm = !songForm">
        +
    </button>

@endsection