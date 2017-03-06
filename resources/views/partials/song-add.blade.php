<div class="song-add-wrapper add-wrapper" v-show="songForm">
    Bitte gib den Songnamen ein:
    <form  method="post" v-on:submit.prevent="songAdd">
        {{csrf_field()}}
        <input name="name" type="text" required v-model="newSongName">
        <button type="submit">Speichern</button>
    </form>
    <button class="cancel" v-on:click="songForm = false">
        Abbrechen
    </button>
</div>