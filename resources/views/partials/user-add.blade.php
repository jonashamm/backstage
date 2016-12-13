<div class="add-wrapper" v-show="userForm">
    Bitte gib den Usernamen ein:
    <form action="{{$baseurl}}/users" method="post">
        {{csrf_field()}}
        <input name="name" type="text">
        <input name="email" type="email">
        <button type="submit">Speichern</button>
    </form>
    <button class="cancel" v-on:click="userForm = false">
        Abbrechen
    </button>
</div>
