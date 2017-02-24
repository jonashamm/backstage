@extends('app')

@section('content')
    <div class="song">
        <div class="meta">
            <div class="inner">
                <strong>Song</strong>
                <h1 v-text="song.name"></h1>
            </div>
        </div>

        <div class="spinner show-initially">
            <div class="double-bounce1"></div>
            <div class="double-bounce2"></div>
        </div>

        @include('song-partials.meta')

        @include('song-partials.songcast')

        @include('song-partials.songfiles')



        <div class="inner">
            <form action="{{$baseurl}}/songs/{{$song->id}}" method="post" class="delete">
                {{csrf_field()}}
                {{ method_field('delete') }}
                <button type="submit" onclick="return confirm('Wirklich löschen?')" >Song löschen @include('icon-files.delete')</button>
            </form>
        </div>
    </div>
@endsection