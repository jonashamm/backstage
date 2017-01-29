@extends('app')

@section('content')
    <div class="songlist">
        <div class="inner">
            <h2>Unsere songs</h2>

            @if (Session::get('song_name'))
                <em class="info success">
                    Der Song {{Session::get('song_name')}} wurde erfolgreich gelöscht!
                </em>
            @endif


            <table class="songs">
                <thead>
                <tr class="head">
                    <th>Sänger/in</th>
                    <th>Song</th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>

                <tbody>
                @foreach($songs as $song)

                    <tr>
                        <td>
                            @if(!empty($song->songcasts))
                                @foreach($song->songcasts as $songcast)
                                    @if($songcast->cast->instrument->name == "Gesang")
                                        {{$songcast->cast->user->name}}
                                    @endif
                                @endforeach
                            @else
                                -
                            @endif
                        </td>
                        <td><strong>
                                <a href="{{$baseurl}}/songs/{{$song->id}}">{{$song->name}}</a>
                            </strong>
                            @if($song->original_performer)
                                <div class="original-performer">({{$song->original_performer}})</div>
                            @endif
                        </td>
                        <td class="audio">
                            @if(count($song->most_recent_audiofile) > 0)
                                <audio controls preload="none">
                                    <source src="{{url('/')}}/uploads/{{$song->most_recent_audiofile->physical_name}}" type="audio/mpeg">
                                    Your browser does not support the audio element.
                                </audio>
                            @endif
                        </td>
                        <td class="acions">
                            @include('partials.delete-button',['object' => 'song'])

                            <a href="{{$baseurl}}/songs/{{$song->id}}" class="edit-button">
                                <button>
                                    @include('icon-files.mode_edit')
                                </button>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            @include('partials.song-add')

            <button class="song-add-toggler" v-show="!songForm" v-on:click="songForm = !songForm">
                +
            </button>
        </div>
    </div>


@endsection