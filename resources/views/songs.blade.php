@extends('app')

@section('content')
    <div class="songlist">
        <span></span>
        <div class="inner">

            @if (Session::get('song_name'))
                <em class="info success">
                    Der Song {{Session::get('song_name')}} wurde erfolgreich gelöscht!
                </em>
            @endif

            @if (Session::get('password_set'))
                <em class="info success">
                    Das Passwort wurde erfolgreich gespeichert. Du kannst jetzt loslegen :)
                </em>
            @endif

            <ul class="songs-list">
                <li>
                    <div class="singer">
                        Sänger/in
                    </div>
                    <div class="songtitle">
                        Song
                    </div>
                    <div class="audio">
                    </div>
                    <div class="actions">
                    </div>
                </li>

                <li v-for="song in songs" >
                    <div v-show="song.songcasts" class="singer">
                        <template v-for="songcast in song.songcasts">
                            <template v-if="songcast.cast.instrument.name == 'Gesang'">
                                [[ songcast.cast.user.name ]]
                            </template>
                        </template>
                    </div>
                    <div class="song-in-list" class="songtitle">
                        <strong>
                            <a :href="'{{$baseurl}}/songs/' + song.id">[[ song.name ]]</a>
                        </strong>
                        <template v-if="song.original_performer">
                            <div class="original-performer">([[ song.original_performer ]])</div>
                        </template>
                    </div>
                    <div class="audio">

                        <template v-if="song.most_recent_audiofile">
                            <audio preload="none" controls="false">
                                <source :src="'{{$baseurl}}/uploads/' + song.most_recent_audiofile.physical_name" type="audio/mpeg">
                                Your browser does not support the audio element.
                            </audio>
                        </template>
                    </div>
                    <div class="actions">
                        <a :href="'{{$baseurl}}/songs/' + song.id" class="edit-button text-button button">
                            Details
                        </a>
                    </div>

                </li>
            </ul>

            @include('partials.song-add')

            <button class="song-add-toggler" v-show="!songForm" v-on:click="songForm = !songForm">
                +
            </button>
        </div>
    </div>


@endsection