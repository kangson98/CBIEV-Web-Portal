@extends('layouts.form_layout')
@section('form_content')
<div class="container" >
    <h1>iSpark Investor Registration Recommendation</h1>
    <div class="container-fluid">
        @switch($type)
        @case(1)
            @component('components.recommendation.investor_registration.investor_recommendation_form', ['type' => $type, 'recID' => $recID])
            
            @endcomponent
            @break
        @case(2)
            @component('components.recommendation.investor_registration.investor_approval_form', ['type' => $type, 'appID' => $appID, 'approvalType' => $approvalType])
                
            @endcomponent
            @break
        @endswitch
        

    </div>
</div>

@endsection

