@extends('layouts.admin-app')

@section('content')
<div class="container">
   <div class="header">
       Project Registration List

       <div class="table-responsive mt-2">
            <table class="table table-hover">
                <thead class="thead-light">
                    <th scope="col">ID</th>
                    <th scope="col">Project Title</th>
                    <th scope="col">Aproval Status</th>
                    <th scope="col">Registered At</th>
                </thead>
                <tbody>
                    @foreach ($projectRegistrations as $pr)
                    <tr>
                        <th scope="col">{{$pr-> id}}</th>
                        <td>
                            <a href="{{route('project.registration.detail', [$pr-> id])}}">{{$pr-> project_title}}</a>
                        </td>
                        <td>
                        @switch($pr-> statusTracking()-> orderBy('created_at','desc')-> first()-> project_registration_status)
                            @case(0)
                            Submited
                                @break
                            @case(1)
                            Supervisor Recommendation
                                @break
                            @case(2)
                            Dean/Head Recommendation
                                @break
                            @case(3)
                            Manager Recommendation
                                @break
                            @case(4)
                            Director Approval
                                @break
                            @case(5)
                            Registration Approved
                                @break
                            @case(6)
                            Registration Rejected
                                @break                                                
                        @endswitch
                        </td>
                        <td>{{$pr-> created_at}}</td>
                    </tr>

                    @endforeach
                </tbody>

            </table>
       </div>
   </div>
</div>
@endsection
