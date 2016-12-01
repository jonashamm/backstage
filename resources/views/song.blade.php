@extends('app')

@section('content')
    <h2>Update Song {{$song->name}}</h2>

    @if (Session::get('song_name'))
        Den Song {{Session::get('song_name')}} bearbeiten:
    @endif

    <form action="{{$baseurl}}/songs/{{$song->id}}" method="post" id="song-update" enctype="multipart/form-data">
        {{ csrf_field() }}
        {{ method_field('patch') }}
        <input name="name" type="text" value="{{$song->name}}">
        <input type="file" multiple name="file"><br>

        {{--<select>
            @foreach($users as $user)
                <option value="{{$user->id}}">{{$user->name}}</option>
            @endforeach
        </select>--}}
        <select v-for="instrument in instruments" name="instruments[]">
            @foreach($instruments as $instrument)
                <option value="{{$instrument->id}}">{{$instrument->name}}</option>
            @endforeach
        </select>
    </form>
    <button @click="instrumentAdd">Intrument hinzufügen</button><br>
    <button type="submit" form="song-update">Update</button>

    <h3>Dateien zum Song:</h3>
    @if(!empty($song->attachments))
        <ul class="attachments">
            @foreach($song->attachments as $attachment)
                <li>
                    <a href="{{url('/')}}/uploads/{{$attachment->name}}">{{$attachment->name}}</a>
                </li>
            @endforeach
        </ul>

    @endif

@endsection