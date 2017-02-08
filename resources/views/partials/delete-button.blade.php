<form action="{{$baseurl}}/{{$object}}s/{{$$object->id}}" method="post" class="delete-button">
    {{csrf_field()}}
    {{ method_field('delete') }}
    <button type="submit" onclick="return confirm('Wirklich löschen?')" >@include('icon-files.delete')</button>
</form>