@extends('layouts.admin-app')

@section('content')
<div class="container">
   <div class="header">
       Project Registration List
       <div class="table-responsive mt-2">
            <table class="table table-hover">
                <thead class="thead-light">
                    <th scope="col">ID</th>
                    <th scope="col">Registered Company Name</th>
                    <th scope="col">Aproval Status</th>
                    <th scope="col">Registered At</th>
                </thead>
                <tbody>
                    @foreach ($investorRegistrations as $ir)
                    <tr>
                        <th scope="col">{{$ir-> id}}</th>
                        <td>
                            <a href="{{route('investor.registration.detail', [$ir-> id])}}">{{$ir-> company_registered_name}}</a>
                        </td>
                        <td>
                            @switch($ir-> statusTrackingLatest()-> investor_registration_status)
                                @case(0)
                                Submited
                                    @break
                                @case(1)
                                Manager Recommendation
                                    @break
                                @case(2)
                                Director Approval
                                    @break
                                @case(3)
                                Registration Approved
                                    @break
                                @case(4)
                                Registration Rejected
                                @break                                                
                        @endswitch
                        </td>
                        <td>{{$ir-> created_at}}</td>
                    </tr>
                    @endforeach
                </tbody>

            </table>
       </div>
   </div>
</div>
@endsection
