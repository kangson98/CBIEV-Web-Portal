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
                            Dean/Head Recommendation
                        </div>
                        @break
                    @case(2)
                        <div class="card-header">
                            Manager Recommendation
                        </div>
                        
                        @break
                    @case(3)
                        <div class="card-header">
                            Director Approval
                        </div>
                        
                        @break
                @endswitch

            @endforeach
        </div>
    </div>
</div>