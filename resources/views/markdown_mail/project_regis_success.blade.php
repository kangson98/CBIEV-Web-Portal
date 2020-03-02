@component('mail::message')
# Successful Project Registration
Dear, {{ $recipient }}

@component('mail::panel')

Your Idea/Project  {{$projectName}} has been register. <br>
Your Project Registration Tracking Number is {{$trackingNO}} <br>


Thank you for your registration! <br>
@endcomponent


@component('mail::button', ['url' =>$url])
Click Me
@endcomponent

Regards,<br>
{{ config('app.name') }}
@endcomponent
