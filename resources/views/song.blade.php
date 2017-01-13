@extends('app')

@section('content')
    <div class="song">
        <div class="meta">
            <div class="inner">
                <strong>Song</strong>
                <h2>[[song.name]]</h2>
            </div>
        </div>

        <form action="{{$baseurl}}/songs/{{$song->id}}" method="post" id="song-update" enctype="multipart/form-data">
            <div class="inner">
                {{ csrf_field() }}
                {{ method_field('patch') }}
                <input name="name" type="text" v-model="song.name"><br>
                <label>
                    <span class="label-text">Noten</span>
                    <input type="file" name="one_file">
                </label>
                <input type="file" name="hubsi">
                <label>
                    <span class="label-text">Tonart</span>
                    <input type="text" name="key" v-model="song.key">
                </label>
                <label>
                    <span class="label-text">Dauer</span>
                    <input type="text" v-model="song.duration" name="duration">
                </label>
                <label>
                    <span class="label-text">Link zur Vorlage</span>
                    <input type="text" v-model="song.link_to_original" name="link_to_original">
                </label>
                <label>
                    <span class="label-text">Original-Interpret</span>
                    <input type="text" v-model="song.original_performer" name="original_performer">
                </label>
                <textarea name="extrainfo" v-model="song.extrainfo" placeholder="Trage hier weitere Infos ein"></textarea>
            </div>
        </form>

        <div class="songcast">
            <div class="inner">
                <h3>Besetzung:</h3>
                <transition-group name="list">
                    <div v-for="(songcast, index) in song.songcasts" class="songcasts" v-bind:key="songcast">
                        <div class="instrument">[[ songcast.cast.instrument.name ]]</div>
                        <div class="user">[[ songcast.cast.user.name ]]</div>
                        <button v-on:click="songcastDelete(songcast, index)" class="delete">@include('icon-files.bin')</button>
                    </div>
                </transition-group>


                <div class="add">
                    <div v-for="(instrumentInSong,index) in instrumentsInSong">
                        <strong class="hint" v-show="justAddingInstrument && !selectedInstrument">Wähle ein Instrument</strong>
                        <strong class="hint" v-show="selectedInstrument && !selectedInstrumentUser">Wähle ein Person für das Instrument</strong>
                        <strong class="hint" v-show="selectedInstrumentUser">Klicke auf "Hinzufügen"</strong><br>
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
                        <button class="songcast-save"
                                v-if="selectedInstrumentUser && selectedInstrument"
                                v-on:click="songcastSave('{{$song->id}}',selectedInstrument, selectedInstrumentUser)">
                            Hinzufügen
                        </button>
                    </div>


                    <transition name="fade">
                        <div v-if="info" class="info info-warn">Bereits hinzugefügt</div>
                    </transition>
                    <button v-on:click="instrumentAddCancel" v-show="justAddingInstrument" class="cancel">Abbrechen</button>
                    <button v-on:click="instrumentAdd" v-show="!justAddingInstrument">Intrument hinzufügen</button>
                </div>
            </div>
        </div>


        <div class="appendix">
            <div class="inner">
                @if($song->attachments != [])
                    <h3>Dateien zum Song:</h3>
                    <ul class="attachments">
                        <li v-for="(attachment, index) in song.attachments">
                            <a :href="'{{url('/')}}/uploads/' + attachment.name"> [[ attachment.name ]] </a>
                            <button v-on:click="attachmentDelete(attachment, index)" class="delete">@include('icon-files.bin')</button>
                        </li>
                    </ul>
                @endif

                <button type="submit" form="song-update" v-show="!justAddingInstrument">Songänderungen speichern</button>
            </div>
        </div>
    </div>
@endsection