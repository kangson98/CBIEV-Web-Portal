@component('mail::message')
# Investor Registration Recommendation Invitation
Dear, {{ $recipient }}
    You have been invited to recommend this Investor Registration.

@component('mail::button', ['url' => $url])
Click Me
@endcomponent

Regards,<br>
{{ config('app.name') }}
@endcomponent
