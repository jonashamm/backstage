<div class="instrument-add-wrapper" {{--v-show="songForm"--}}>
    <form action="{{$baseurl}}/instruments" method="post">
        {{csrf_field()}}
        <input name="name" type="text">
        <button type="submit">Speichern</button>
    </form>
    <button class="cancel"{{-- v-on:click="songForm = false"--}}>
        Abbrechen
    </button>
</div>
