@component('mail::message')
# Project Registration Recommendation Invitation
Dear, {{ $recipient }}
    You have been invited to review this Project/Idea.

<br>

@isset($rerun)
    The Project/Idea {{$projectTitle}} was updated. Please reevaluate the project details.
@endisset

@component('mail::button', ['url' =>$url])
Click Me
@endcomponent

Regards,<br>
{{ config('app.name') }}
@endcomponent
