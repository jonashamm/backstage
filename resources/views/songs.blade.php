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
                    <th>Noten</th>
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
                                ({{$song->original_performer}})
                            @endif
                        </td>
                        <td class="sheet">
                            @if($song->attachments)
                                @foreach($song->attachments as $attachment)
                                    <a href="{{ url('/uploads/'.$attachment->name) }}" target="_blank">
                                        {{$attachment->name}}
                                    </a><br>
                                @endforeach
                            @endif
                        </td>
                        <td>
                            @include('partials.delete-button',['object' => 'song'])
                        </td>
                        <td>
                            <a href="{{$baseurl}}/songs/{{$song->id}}">
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