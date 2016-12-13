<div class="add-wrapper instrument-add-wrapper" v-show="instrumentForm">
    <form action="{{$baseurl}}/instruments" method="post">
        {{csrf_field()}}
        <input name="name" type="text" required>
        <button type="submit">Speichern</button>
    </form>
    <button class="cancel" v-on:click="instrumentForm = false">
        Abbrechen
    </button>
</div>
