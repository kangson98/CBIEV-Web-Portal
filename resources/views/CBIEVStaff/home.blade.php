@extends('layouts.admin-app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">STAFF Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    {{-- @component('components.who')
                        
                    @endcomponent --}}
                    @if(Auth::guard('cbiev-staff')->check())
                        Hello {{Auth::guard('cbiev-staff')->user()->name}}
                    @endif
                        <div>
                            <ul>
                                <li><a href="{{route('project.registration.list')}}">Project Registration</a></li>
                            </ul>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
