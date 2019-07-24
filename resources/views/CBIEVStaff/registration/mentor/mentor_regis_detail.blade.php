@extends('layouts.admin-app')

@section('content')
<div class="container" >
@component('components.registration.mentor.staff_detail_view.personal_info', ['mentorRegis' => $mentorRegis])
    
@endcomponent
@if ($mentorRegis-> category == 1)
@component('components.registration.mentor.staff_detail_view.internal_mentor_info', ['internalMentor' => $mentorRegis-> internalMentorDetail])
    
@endcomponent 
@endif
@component('components.registration.mentor.staff_detail_view.mentor_type', ['mentorRegis' => $mentorRegis])
    
@endcomponent
@if ($mentorRegis-> company_id != null)
@component('components.registration.mentor.staff_detail_view.company_info', ['company' => $mentorRegis-> company])
    
@endcomponent
@endif
@component('components.registration.mentor.staff_detail_view.mentor_experience', ['mentorRegisExp' => $mentorRegis-> mentorRegistrationExperience])
    
@endcomponent
@component('components.registration.mentor.staff_detail_view.status_tracking', ['mentorRegis' => $mentorRegis])
    
@endcomponent
</div>

@endsection