<form action="{{$baseurl}}/{{$object}}s/{{$$object->id}}" method="post">
    {{csrf_field()}}
    {{ method_field('delete') }}
    <button type="submit">@include('icons.delete')</button>
</form>