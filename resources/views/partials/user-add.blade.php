<div class="add-wrapper" {{--v-show="songForm"--}}>
    Bitte gib den Usernamen ein:
    <form action="{{$baseurl}}/users" method="post">
        {{csrf_field()}}
        <input name="name" type="text">
        <input name="email" type="email">
        <button type="submit">Speichern</button>
    </form>
    <button class="cancel"{{-- v-on:click="songForm = false"--}}>
        Abbrechen
    </button>
</div>
