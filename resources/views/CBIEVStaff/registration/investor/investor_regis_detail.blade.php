@extends('layouts.admin-app')

@section('content')
<div class="container" >
@component('components.registration.investor.staff_detail_view.company_info', ['investorRegis' => $investorRegis])
    
@endcomponent
@component('components.registration.investor.staff_detail_view.contact_person', ['contactPersons' => $investorRegis-> contactPerson])
    
@endcomponent 
@component('components.registration.investor.staff_detail_view.contacts', ['contacts' => $investorRegis-> contact])
    
@endcomponent
@component('components.registration.investor.staff_detail_view.address', ['addresses' => $investorRegis-> addressList])
    
@endcomponent
@component('components.registration.investor.staff_detail_view.status_tracking', ['investorRegis' => $investorRegis])
    
@endcomponent
</div>

@endsection