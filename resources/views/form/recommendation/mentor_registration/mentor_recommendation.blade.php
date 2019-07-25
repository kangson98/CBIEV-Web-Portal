@extends('layouts.form_layout')
@section('form_content')
<div class="container" >
    <h1>iSpark Project Recommendation</h1>
    <div class="container-fluid">
        @switch($type)
        @case(1)
            @component('components.registration.mentor.staff_detail_view.personal_info', ['mentorRegis' => $mentorRegis])
            a
            @endcomponent
            @component('components.registration.mentor.staff_detail_view.mentor_type', ['mentorRegis' => $mentorRegis])
                
            @endcomponent
            @component('components.registration.mentor.staff_detail_view.mentor_experience', ['mentorRegisExp' => $mentorRegis-> mentorRegistrationExperience])
                
            @endcomponent
        @case(2)
            @component('components.recommendation.mentor_registration.mentor_recommendation_form', ['type' => $type, 'recID' => $recID])
            
            @endcomponent
            @break
            @case(3)
            @component('components.recommendation.mentor_registration.mentor_approval_form', ['type' => $type, 'appID' => $appID, 'approvalType' => $approvalType])
                
            @endcomponent
            @break
        @endswitch
        

    </div>
</div>

@endsection

