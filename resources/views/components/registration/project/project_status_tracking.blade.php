<div class="card">
        <div class="card-header">
            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#projectStatus" aria-expanded="true"
                aria-controls="projectStatus">
                Project Status
            </button>
        </div>
        <div class="collapse show" id="projectStatus">
            <div class="container mt-2 mb-2">
                @foreach ($projectRegis-> statusTracking as $status)
                    @if ($status-> project_registration_status == 0)
                    <div class="card-header">
                        <p>
                            Registered - Project registered at <b>{{$status-> created_at}}</b>.
                        </p>
                        <p>
                            @if (count($projectRegis-> statusTracking) == 1 && $projectRegis-> statusTracking-> first()-> project_registration_status == 0)
                                <form action="{{route('project.regisration.approval.start',[$projectRegis-> id, 1])}}" method="post">
                                    @csrf
                                    <button type="submit">Start Approval Process</button>
                                    <input type="hidden" name="stage" value="1">

                                </form>
                            @else
                                
                            @endif
                            </p>
                    </div>
                    @elseif($status-> project_registration_status == 1)
                        @component('components.registration.approval.recommendation_detail', ['status' => $status, 'recommendedBy' => 1])
                            
                        @endcomponent
                    @elseif($status-> project_registration_status == 2)
                        @component('components.registration.approval.recommendation_detail', ['status' => $status, 'recommendedBy' => 2])
                            
                        @endcomponent    
                    @elseif($status-> project_registration_status == 3)
                        @component('components.registration.approval.recommendation_detail', ['status' => $status, 'recommendedBy' => 3])
                            
                        @endcomponent   
                    @elseif($status-> project_registration_status == 4)
                        @component('components.registration.approval.approval_detail', ['status' => $status])
                                
                        @endcomponent   
                    @elseif($status-> project_registration_status == 5)

                    <div class="card-header">
                        Approved - Project Approved at <b>{{$status-> created_at}}</b>.
                    </div>
                    @elseif($status-> project_registration_status == 6)
                    <div class="card-header">
                        Rejected - Project rejected at <b>{{$status-> created_at}}</b>.
                    </div>
                    @elseif($status-> project_registration_status == 7)
                        @component('components.registration.approval.recommendation_detail', ['status' => $status, 'recommendedBy' => 7])
                                
                        @endcomponent
                    @elseif($status-> project_registration_status == 8)
                        @component('components.registration.approval.recommendation_detail', ['status' => $status, 'recommendedBy' => 8])
                            
                        @endcomponent    
                    @elseif($status-> project_registration_status == 9)
                        @component('components.registration.approval.recommendation_detail', ['status' => $status, 'recommendedBy' => 9])
                            
                        @endcomponent 
                    @endif
                @endforeach
            </div>
        </div>
    </div>
