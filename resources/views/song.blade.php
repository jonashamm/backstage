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
    </form>

    <h3>Besetzung:</h3>
    <transition-group name="list">
        <div v-for="(songcast, index) in song.songcasts" class="songcasts" v-bind:key="songcast">
            <div class="instrument">[[ songcast.instrument_user.instrument.name ]]</div>
            <div class="user">[[ songcast.instrument_user.user.name ]]</div>
            <button v-on:click="songcastDelete(songcast, index)">x</button>
        </div>
    </transition-group>

<br><br>
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
            Hinzufügen
        </div>
    </div>

    <br>
    <br>
    <br>
    <transition name="fade">
        <div v-if="info" class="info info-warn">Bereits hinzugefügt</div>
    </transition>

    <button v-on:click="instrumentAdd" v-show="!justAddingInstrument">Intrument hinzufügen</button><br>


    @if(!empty($song->attachments))
        <h3>Dateien zum Song:</h3>
        <ul class="attachments">
            @foreach($song->attachments as $attachment)
                <li>
                    <a href="{{url('/')}}/uploads/{{$attachment->name}}">{{$attachment->name}}</a>
                </li>
            @endforeach
        </ul>

    @endif


    <button type="submit" form="song-update">Songänderungen speichern</button>
@endsection