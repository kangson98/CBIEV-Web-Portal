@extends('layouts.form_layout')

@section('form_content')
<div class="container">
    <div class="m-3">
        <div>
            <div class="text-center mp-3">
                <h4 class="display-4 form-title">iSpark Mentor Registration Form</h4>
            </div>
        <div class="mt-5 ">
            <form action="{{route('mentor.registration.submit')}}" method="post">
                @csrf
                @component('components.registration.mentor.type_category')
                    
                @endcomponent
                @component('components.registration.mentor.personal_info')
                    
                @endcomponent
                @component('components.registration.mentor.company_info',['centerFaculty' => $centerFaculty])
                    
                @endcomponent
                @component('components.registration.mentor.mentor_exp')
                    
                @endcomponent
                @component('components.registration.mentor.mentor_declaration')
                    
                @endcomponent
    
                <button class="btn btn-primary" type="submit">Submit</button>
            </form> 
        </div>
    </div>
</div>
@endsection