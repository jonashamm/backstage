@extends('app')

@section('content')
    <div class="song">
        <div class="meta">
            <div class="inner">
                <strong>Song</strong>
                <h1>[[song.name]]</h1>
            </div>
        </div>

        @include('song-partials.meta')

        @include('song-partials.songcast')

        @include('song-partials.songfiles')
    </div>
@endsection