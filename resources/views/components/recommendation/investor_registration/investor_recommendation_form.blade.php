<div class="card">
    <div class="card-header">
        @switch($type)
            @case(1)
                Manager Recommendation Form
        @endswitch
        - Investor Registration
    </div>
    <div class="card-body">
        @if ($type == 1)  
            <form action="{{route('investor.recommendation.manager.post')}}" method="post" >
        @endif
            @csrf
            <input type="hidden" name="type" value="{{Crypt::encrypt($type)}}">
            <input type="hidden" name="recID" value="{{Crypt::encrypt($recID)}}">
            <div class="form-row">
                <div class="form-group col-sm-4">Do you recommend this investor registration?<span style="color:red"> *</span></div>
                <div class="form-group col-md-6">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="recommendation" id="recommendationYes"
                            value="1">
                        <label class="form-check-label" for="recommendationYes">Yes</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="recommendation" id="recommendationNo"
                            value="0">
                        <label class="form-check-label" for="recommendationNo">No</label>
                    </div>
                </div>
                @if ($errors->has('recommendation'))
                <div class="alert alert-danger" role="alert">
                    Recommendation Field is <strong class="" style="color:red">Required</strong>. Please select
                    your recommendation
                </div>
                @endif
            </div>
            <div class="form-row">
                <div class="form-group col-md-10">
                    <label for="recommendationReason">Reason for not recommend</label><span style="color:red"> *</span>
                    <textarea class="form-control" id="recommendationReason" name="recommendationReason" cols="30"
                        rows="10" value=""></textarea>
                    @if ($errors->has('recommendationReason'))
                    <div class="alert alert-danger" role="alert">
                        Recommendation Reason Field is <strong class="" style="color:red">Required</strong> if you select <strong>NO</strong> at recommendation.
                        Please enter your reason.
                    </div>
                    @endif
                    </span>
                    <span class="focus-border"></span>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-10">
                    <label for="recommendationComment">Recommendation Comment</label><span style="color:red"> *</span>
                    <textarea class="form-control" id="recommendationComment" name="recommendationComment" cols="30"
                        rows="10" value=""></textarea>
                    @if ($errors->has('recommendationComment'))
                    <div class="alert alert-danger" role="alert">
                        Recommendation Comment Field is <strong class="" style="color:red">Required</strong>.
                        Please enter your comment.
                    </div>
                    @endif
                    </span>
                    <span class="focus-border"></span>
                </div>
            </div>

            <button class="btn btn-primary" type="submit">Submit</button>
        </form>
    </div>
</div>