@extends('app')

@section('content')
    <strong>Song</strong>
    <h2>{{$song->name}}</h2>

    @if (Session::get('song_name'))
        Den Song {{Session::get('song_name')}} bearbeiten:
    @endif

    <form action="{{$baseurl}}/songs/{{$song->id}}" method="post" id="song-update" enctype="multipart/form-data">
        {{ csrf_field() }}
        {{ method_field('patch') }}
        <input name="name" type="text" value="{{$song->name}}">
        <input type="file" multiple name="file"><br>

        <div v-for="(instrumentInSong,index) in instrumentsInSong">

            <div v-for="instrument in instruments" :class="{'selected': selectedInstrument == instrument}" v-show="selectedInstrument == instrument || !selectedInstrument" class="instrument">
                <div class="instrument-name" v-on:click="instrumentSelectToggle(instrument)">[[ instrument.name ]]</div>
                <div class="instrument-user"
                     v-show="selectedInstrument == instrument"
                     v-for="instrumentUser in instrument.users"
                     v-on:click="instrumentUserSelectToggle(instrumentUser)"
                     :class="{'selected': selectedInstrumentUser == instrumentUser}">
                    [[ instrumentUser.name ]]
                </div>
            </div>
            <br>
            <div class="songcast-save"
                 v-if="selectedInstrumentUser && selectedInstrument"
                 v-on:click="songcastSave('{{$song->id}}',selectedInstrument, selectedInstrumentUser)">
                Ok
            </div>
        </div>
    </form>

    <div v-for="songcast in song.songcasts">
        [[ songcast.instrument_user.instrument.name ]] /
        [[ songcast.instrument_user.user.name ]]
    </div>


    <br>
    <br>
    <br>
    <transition name="fade">
        <div v-if="info">Bereits hinzugefügt</div>
    </transition>

    <button v-on:click="instrumentAdd" v-show="!justAddingInstrument">Intrument hinzufügen</button><br>
    <button type="submit" form="song-update">Update</button>


    <h3>Dateien zum Song:</h3>
    @if(!empty($song->attachments))
        <ul class="attachments">
            @foreach($song->attachments as $attachment)
                <li>
                    <a href="{{url('/')}}/uploads/{{$attachment->name}}">{{$attachment->name}}</a>
                </li>
            @endforeach
        </ul>

    @endif

@endsection