@extends('layouts.form_layout')

@section('form_content')
<div class="container">
    <div class="m-3">
        <div class="text-center mp-3">
            <h4 class="display-4 form-title">iSpark Investor Registration Form</h4>
        </div>
        <div class="mtb-5 ">
            <form action="{{route('investor.registration.submit')}}" method="post">
                @csrf
                @component('components.registration.investor.company_info')
                    
                @endcomponent
                @component('components.registration.investor.contact_person')
                    
                @endcomponent
                @component('components.registration.investor.company_contact')
                    
                @endcomponent
                @component('components.registration.investor.company_activity')
                    
                @endcomponent
                @component('components.registration.investor.investor_declaration')
                    
                @endcomponent
                
                <button class="btn btn-primary" type="submit">Submit</button>
            </form> 
        </div>
    </div>
@endsection
