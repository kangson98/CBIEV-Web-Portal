@component('mail::message')
# Invitation
Dear, {{ $recipient }}

Your project <strong>{{ $projectTitle}}</strong> is not recommended.
Please click the link below and make some updates.

@component('mail::button', ['url' =>$url])
Click Me
@endcomponent

Regards,<br>
{{ config('app.name') }}
@endcomponent
