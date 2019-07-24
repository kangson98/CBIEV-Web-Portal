@component('mail::message')
# Mentor Registration Recommendation Invitation
Dear, {{ $recipient }}
    You have been invited to review this Mentor Registration.

<br>
One of your Faculty/Center member, {{$mentorName}}, have submited a mentor registration.
@component('mail::button', ['url' =>$url])
Click Me
@endcomponent

Regards,<br>
{{ config('app.name') }}
@endcomponent
