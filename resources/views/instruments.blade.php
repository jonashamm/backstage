@extends('app')

@section('content')
    <div class="instruments-list">
        <div class="inner">
            <h2>Unsere Instrumente</h2>

            @if (Session::get('instrument_name'))
                <em class="info success">
                    Das Instrument {{Session::get('instrument_name')}} wurde erfolgreich gelöscht!
                </em>
            @endif

            <ul class="instruments">
                @foreach($instruments as $instrument)
                    <li>
                        <div class="name">
                            {{$instrument->name}}
                        </div>

                        @include('partials.delete-button',['object' => 'instrument'])
                    </li>
                @endforeach
            </ul>

            @include('partials.instrument-add')

            <button class="song-add-toggler" v-show="!instrumentForm" v-on:click="instrumentForm = !instrumentForm">
                +
            </button>
        </div>
    </div>
@endsection