<div class="card">
    <div class="card-header">
        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#statusTracking" aria-expanded="false"
            aria-controls="statusTracking">
            Mentor Approval Status Info
        </button>
    </div>
    <div class="collapse" id="statusTracking">
        <div class="container mt-2 mb-2">
            @foreach ($mentorRegis-> statusTracking as $status)
                @switch($status-> mentor_registration_status)
                    @case(0)
                    <div class="card-header">
                        <p>
                            Registered - Mentor Registration submited at <b>{{$status-> created_at}}</b>.
                        </p>
                        <p>
                            @if (count($mentorRegis-> statusTracking) == 1 && $mentorRegis-> statusTracking-> first()-> project_registration_status == 0)
                                <form action="{{route('mentor.regisration.approval.start',[$mentorRegis-> id, 1])}}" method="post">
                                    @csrf
                                    <button type="submit">Start Approval Process</button>
                                    <input type="hidden" name="stage" value="1">
    
                                </form>
                            @else
                                
                            @endif
                            </p>
                    </div>
                        @break
                    @case(1)
                        <div class="card-header">
                            <p>
                                Dean/Head Recommendation -
                                @php
 
                                    $log = $mentorRegis-> statusTracking-> where('mentor_registration_status', 1)->first()-> deanHeadRecommendation->first()-> deanHeadRecommendationLog-> sortByDesc('created_at')-> first()
                                @endphp
                                @switch($log-> status)
                                    @case(0)
                                        Dean Head notified at <u>{{$log-> created_at}}</u>
                                        @break
                                    @case(1)
                                        Complete at <u>{{$log-> created_at}}</u> with <strong>RECOMMENDED</strong>
                                        @break
                                    @case(2)
                                        Complete at <u>{{$log-> created_at}}</u> with <strong>NOT RECOMMENDED</strong>
                                        @break
                                    @case(5)
                                        <strong>AUTO APPROVED</strong> at <u>{{$log-> created_at}}</u>
                                        @break
                                    @default
                                        N/A
                                @endswitch 
                            </p>
                        </div>
                        @break
                    @case(2)
                        <div class="card-header">
                            <p>
                                Manager Recommendation -
                                @php
                                    $log = $mentorRegis-> statusTracking-> where('mentor_registration_status', 2)->first()-> managerRecommendation-> managerRecommendationLog-> sortByDesc('created_at')-> first()
                                @endphp
                                @switch($log-> status)
                                    @case(0)
                                        Manager notified at <u>{{$log-> created_at}}</u>
                                        @break
                                    @case(1)
                                        Complete at <u>{{$log-> created_at}}</u> with <strong>RECOMMENDED</strong>
                                        @break
                                    @case(2)
                                        Complete at <u>{{$log-> created_at}}</u> with <strong>NOT RECOMMENDED</strong>
                                        @break
                                    @default
                                        N/A
                                @endswitch 
                            </p>
                        </div>
                        @break
                    @case(3)
                        <div class="card-header">
                            <p>
                                Director Approval -
                                @php
                                    $log = $mentorRegis-> statusTracking-> where('mentor_registration_status', 3)->first()-> directorApproval-> first()-> directorApprovalLog-> sortByDesc('created_at')-> first()
                                @endphp
                                @switch($log-> status)
                                    @case(0)
                                        Director notified at <u>{{$log-> created_at}}</u>
                                        @break
                                    @case(1)
                                        Complete at <u>{{$log-> created_at}}</u> with <strong>APPROVED</strong>
                                        @break
                                    @case(2)
                                        Complete at <u>{{$log-> created_at}}</u> with <strong>NOT APPROVED</strong>
                                        @break
                                    @case(3)
                                        Complete at <u>{{$log-> created_at}}</u> with <strong>AGREE</strong>
                                        @break
                                    @case(4)
                                        Complete at <u>{{$log-> created_at}}</u> with <strong>NOT AGREE</strong>
                                        @break
                                    @default
                                        N/A
                                @endswitch 
                            </p>
                        </div>
                        
                        @break
                @endswitch
            @endforeach
        </div>
    </div>
</div>