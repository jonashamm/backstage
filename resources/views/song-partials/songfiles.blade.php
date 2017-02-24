<div class="songfiles hide-initially">
    <div class="inner">
        <h2>Dateien</h2>

        <div class="empty" v-if="song.attachments < 1 && !justAddingAttachment">Um eine Datei (Mp3, Noten, etc.) hinzuzufügen, aufs Plus klicken</div>

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
                                            <source :src="'{{url('/')}}/uploads/' + attachment.physical_name" type="audio/mp3">
                                            Your browser does not support the audio element.
                                        </audio>
                                    </div>
                                    <div class="audio-container" v-else-if="attachmenttype.typical_extension == 'mp4'">
                                        <video controls preload="none">
                                            <source :src="'{{url('/')}}/uploads/' + attachment.physical_name" type="video/mp4">
                                            Your browser does not support the audio element.
                                        </video>
                                    </div>

                                    [[ attachment.name ]]
                                    <form :action="'{{$baseurl}}/download-file/' + attachment.id" method="post">
                                        {{ csrf_field() }}
                                        <button type="submit" class="text-button">Download</button>
                                    </form>
                                    <div class="attachment-comment" v-if="attachment.comment"><span class="comment">Info: </span>[[ attachment.comment ]]</div>
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
                <input v-show="attachmenttypeChosen" type="text" name="attachment_comment" v-model="attachment_comment">
                <div v-show="attachmenttypeChosen">
                    <button type="submit" v-on:click.prevent="attachmentAdd($event)">Hinzufügen</button>
                </div>
            </div>
            <div id="output" class="container"></div>
        </form>

        <div class="progressbar" v-show="justUploading">
            <div class="progress" :style="{'width': percentCompleted + '%'}">
            </div>
            <div class="text">
                [[ percentCompleted ]] % hochgeladen
            </div>
        </div>

        <button v-on:click="endAddingAttachment" v-show="justAddingAttachment" class="cancel">Abbrechen</button>
        <button class="add" v-on:click="justAddingAttachment = !justAddingAttachment" v-show="!justAddingAttachment">+</button>
    </div>
</div>