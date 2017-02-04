@component('mail::message')
# Hallo {{ $invited_user->name }}!

{{ $active_user->name }} hat dich zu **backstage** eingeladen.

@component('mail::button', ['url' => url('/') . '/accept-invitation/' . $code . '/' . $invited_user->id ])
Einladung annehmen
@endcomponent

Danke!<br>
@endcomponent
