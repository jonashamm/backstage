@if ($errors->any())
    <ul class="errors">
        @foreach ($errors->all() as $error)
            <li class="info warn">{{ $error }}</li>
        @endforeach
    </ul>
@endif