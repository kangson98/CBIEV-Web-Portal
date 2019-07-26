@component('mail::message')
# Mentor Registration Approval Invitation
Dear, {{ $recipient }}
    You have been invited to approve this Investor Registration.

<br>
@component('mail::button', ['url' => $url])
Click Me
@endcomponent

Regards,<br>
{{ config('app.name') }}
@endcomponent
