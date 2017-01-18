@extends('app')

@section('content')
    <div class="song">
        <div class="meta">
            <div class="inner">
                <strong>Song</strong>
                <h1>[[song.name]]</h1>
            </div>
        </div>

        <form action="{{$baseurl}}/songs/{{$song->id}}" method="post" class="meta-infos" id="song-update" enctype="multipart/form-data">
            <div class="inner">
                <h2>Infos</h2>
                {{ csrf_field() }}
                {{ method_field('patch') }}
                <div class="formfield">
                    <label>Titel</label>
                    <input name="name" type="text" v-model="song.name"><br>
                </div>
                <div class="formfield">
                    <label>Tonart</label>
                    <input type="text" name="key" v-model="song.key">
                </div>
                <div class="formfield">
                    <label>Dauer</label>
                    <input type="text" v-model="song.duration" name="duration">
                </div>
                <div class="formfield">
                    <label>Link zur Vorlage</label>
                    <input type="text" v-model="song.link_to_original" name="link_to_original">
                </div>
                <div class="formfield">
                    <label>Original-Interpret</label>
                    <input type="text" v-model="song.original_performer" name="original_performer">
                </div>
                <div class="formfield extra-infos">
                    <label>Weitere Infos</label>
                    <textarea name="extrainfo" v-model="song.extrainfo" placeholder="Trage hier weitere Infos ein"></textarea>
                </div>
                <button type="submit" v-show="!justAddingInstrument">Songänderungen speichern</button>
            </div>

        </form>

        <div class="songcast">
            <div class="inner">
                <h2>Besetzung:</h2>
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


        <div class="songfiles">
            <div class="inner">
                <h2>Dateien</h2>

                @if($song->attachments != [])
                    <ul class="attachments">
                        <transition-group name="list">
                            <li v-for="(attachment, index) in song.attachments" v-bind:key="attachment">
                                <a :href="'{{url('/')}}/uploads/' + attachment.physical_name" target="_blank"> [[ attachment.name ]] </a>
                                <button v-on:click="attachmentDelete(attachment, index)" class="delete">@include('icon-files.bin')</button>
                            </li>
                        </transition-group>
                    </ul>
                @endif

                <form>
                    <div class="formfield">
                        <label>Noten</label>
                        <input type="file" name="file" v-on:change="fileExistCheck" id="file">
                        <div v-show="fileChosen">
                            als
                            <select v-model="attachmenttypeChosen" name="type">
                                <option>-</option>
                                <option v-bind:value="type.id" v-for="type in attachmenttypes"> [[ type.name ]]</option>
                            </select>
                        </div>
                        <input type="hidden" v-model="song.id" name="song_id">
                        <div v-show="attachmenttypeChosen">
                            <button type="submit" v-on:click.prevent="attachmentAdd($event)">Hinzufügen</button>
                        </div>
                    </div>
                    <div id="output" class="container"></div>
                </form>
            </div>
        </div>
    </div>
@endsection