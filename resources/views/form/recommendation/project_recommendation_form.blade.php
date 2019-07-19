@extends('layouts.form_layout')
@section('form_content')
<div class="container" >
    <h1>iSpark Project Recommendation</h1>
    <div class="container-fluid">
        @component('components.registration.project.project_info', ['projectRegis' => $projectRegis])
        a
        @endcomponent
        @component('components.registration.project.project_member', ['projectRegis' => $projectRegis, 'leaderID' => $projectRegis-> team_leader])
            
        @endcomponent
        @component('components.registration.project.project_supervisor', ['projectRegis' => $projectRegis])
            
        @endcomponent
        @component('components.recommendation.project_recommendation_form', ['type' => $type, 'person' => $person, 'recID' => $recID])
            
        @endcomponent

    </div>
</div>

@endsection

