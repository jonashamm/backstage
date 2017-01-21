<div class="songfiles">
    <div class="inner">
        <h2>Dateien</h2>

        @if($song->attachments != [])
            <div v-for="attachmenttype in songattachments" class="attachment-type">
                <transition name="list">
                    <div v-if="attachmenttype.attachments != 0">
                        <h3>[[ attachmenttype.name ]]</h3>
                        <ul class="attachments">
                            <transition-group name="list">
                                <li v-for="(attachment, index) in attachmenttype.attachments" v-bind:key="attachment">
                                    <div class="audio-container" v-if="attachmenttype.typical_extension == 'mp3'">
                                        <audio controls preload="none">
                                            <source :src="'{{url('/')}}/uploads/' + attachment.physical_name" type="audio/mpeg">
                                            Your browser does not support the audio element.
                                        </audio>
                                        <a :href="'{{url('/')}}/uploads/' + attachment.physical_name" download>Download</a>
                                    </div>

                                    <a v-else :href="'{{url('/')}}/uploads/' + attachment.physical_name" target="_blank">xxxx [[ attachment.name ]] </a>
                                    <button v-on:click="attachmentDelete(attachment, index, attachmenttype.id)" class="delete">@include('icon-files.bin')</button>
                                </li>
                            </transition-group>
                        </ul>
                    </div>
                </transition>
            </div>
        @endif


        <form v-if="justAddingAttachment">
            <div class="formfield">
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

        <button v-on:click="justAddingAttachment = !justAddingAttachment" v-show="justAddingAttachment" class="cancel">Abbrechen</button>
        <button v-on:click="justAddingAttachment = !justAddingAttachment" v-show="!justAddingAttachment">Datei hinzufügen</button>
    </div>
</div>