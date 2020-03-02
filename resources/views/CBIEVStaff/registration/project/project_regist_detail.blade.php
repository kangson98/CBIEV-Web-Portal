@extends('layouts.admin-app')

@section('content')
<div class="container-fluid" >
    <div>
        <a href="{{ route('project.file.list', $projectRegis->id)}}">Project File List</a>
    </div>
    @component('components.registration.project.project_info', ['projectRegis' => $projectRegis])
        
    @endcomponent
    @component('components.registration.project.project_member', ['projectRegis' => $projectRegis, 'leaderID' => $projectRegis-> team_leader])
        
    @endcomponent
    @component('components.registration.project.project_supervisor', ['projectRegis' => $projectRegis])
        
    @endcomponent
    @component('components.registration.project.project_status_tracking', ['projectRegis' => $projectRegis])
        
    @endcomponent
</div>

@endsection

