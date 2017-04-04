<div class="songcast hide-initially">
    <div class="inner">
        <h2>Besetzung</h2>
        <transition-group name="list">
            <div v-for="(songcast, index) in song.songcasts" class="songcasts" :key="songcast">
                <div class="instrument">[[ songcast.cast.instrument.name ]]</div>
                <div class="user">[[ songcast.cast.user.name ]]</div>
                <button v-on:click="songcastDelete(songcast, index)" class="delete">@include('icon-files.bin')</button>
            </div>
        </transition-group>

        <div class="empty" v-if="song.songcasts < 1 && !justAddingInstrument">Um jemanden hinzuzufügen, aufs Plus klicken</div>

        <div class="add">
            <div v-for="(instrumentInSong,index) in instrumentsInSong" :key="instrumentInSong">
                <strong class="hint" v-show="justAddingInstrument && !selectedInstrument">Wähle ein Instrument</strong>
                <strong class="hint" v-show="selectedInstrument && !selectedInstrumentUser">Wähle ein Person für das Instrument</strong>
                <strong class="hint" v-show="selectedInstrumentUser">Klicke auf "Hinzufügen"</strong><br>
                <div v-for="instrument in instruments" :key="instrument" :class="{'selected': selectedInstrument == instrument}" v-show="selectedInstrument == instrument || !selectedInstrument" class="instrument">
                    <div class="instrument-name" v-on:click="instrumentSelectToggle(instrument)">[[ instrument.name ]]</div>
                    <div class="instrument-user"
                         v-show="selectedInstrument == instrument"
                         v-for="instrumentUser in instrument.users" :key="instrumentUser"
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
            <button class="add" v-on:click="instrumentAdd" v-show="!justAddingInstrument">+</button>
        </div>
    </div>
</div>