<div class="meta-infos" :class="{'editmode': metaEdit}">
    <div class="static-info" v-show="!metaEdit">
        <div class="inner">
            <button v-on:click="metaEdit = !metaEdit" class="toggler">
                @include('icon-files.mode_edit')
            </button>

			<?php $song_attributes = array(
				[ 'Tonart', 'key' ],
				[ 'Dauer', 'duration' ],
				[ 'Youtube-Vorlage', 'link_to_original' ],
				[ 'Original-Interpret', 'original_performer' ],
				[ 'Und außerdem...', 'extrainfo' ]
			); ?>

            <div class="value empty" v-if="!song.key && !song.duration && !song.link_to_original && !song.original_performer && !song.extrainfo">Um Infos hinzuzufügen, auf den Pfeilbutton rechts in diesem Feld klicken</div>
            @foreach($song_attributes as $attribute)
                <template v-if="song.{{$attribute[1]}}">
                    <h4>{{$attribute[0]}}</h4>
                    <div class="value" v-text="song.{{$attribute[1]}}">
                    </div>
                </template>
            @endforeach
        </div>

    </div>

    <div class="dynamic-info" v-if="metaEdit">
        <div class="inner">
            <button v-on:click="metaEdit = !metaEdit" class="toggler">
                x
            </button>
            <form action="{{$baseurl}}/songs/{{$song->id}}" method="post" id="song-update" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('patch') }}
                <div class="formfield">
                    <label>Titel</label>
                    <input type="text" v-model="song.name"><br>
                </div>
                <div class="formfield">
                    <label>Tonart</label>
                    <input type="text" v-model="song.key">
                </div>
                <div class="formfield">
                    <label>Dauer</label>
                    <input type="text" v-model="song.duration">
                </div>
                <div class="formfield">
                    <label>Link zur Vorlage</label>
                    <input type="text" v-model="song.link_to_original">
                </div>
                <div class="formfield">
                    <label>Original-Interpret</label>
                    <input type="text" v-model="song.original_performer">
                </div>
                <div class="formfield extra-infos">
                    <label>Weitere Infos</label>
                    <textarea v-model="song.extrainfo" placeholder="Trage hier weitere Infos ein"></textarea>
                </div>
                <button type="submit" v-show="metaEdit" v-on:click.prevent="songUpdate(song.id)">Songänderungen speichern</button>
            </form>
        </div>
    </div>
</div>
