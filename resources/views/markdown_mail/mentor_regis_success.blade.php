@component('mail::message')
# Successful Mentor Registration
Dear, {{ $recipient }}

@component('mail::panel')

Your Mentor Registration is submited. <br>
Your Tracking No is [Tracking No]
Thank you for your registration! <br>
@endcomponent


Regards,<br>
{{ config('app.name') }}
@endcomponent
