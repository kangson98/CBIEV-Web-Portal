<div class="card">
    <div class="card-header">
        Director Approval Form - Investor Registration
    </div>
    <div class="card-body">
        <form action="{{route('investor.approval.post')}}" method="post">

            @csrf
            <input type="hidden" name="appID" value="{{$appID}}">
            <input type="hidden" name="approvalType" value="{{Crypt::encrypt($approvalType)}}">
                {{-- <div class="form-group">
                    @switch($approvalType)
                        @case(1)
                            <p>
                                This mentor registration was <strong>RECOMMENDED</strong> by Manager <br>
                            </p>
    
                            <div>
                                <button type="submit">Approve</button>
                            </div>
                            <div>
                                <button type="submit">Not Approve</button>
                            </div>
                            
                        @case(2)
                            <p>
                                This mentor registration was <strong>NOT RECOMMEND</strong> by Manager <br>
                                Do you agree to the recommendation done by Manager?
                            </p>
                            <div>
                                <button type="submit">Agree</button>
                                <button type="submit">Not Agree</button>
                            </div>
                    @endswitch
                </div> --}}
                @if ($approvalType == 1)
                    <p>
                        This investor registration was <strong>RECOMMENDED</strong> by Manager <br>
                    </p>
                @endif
                @if ($approvalType == 2)
                    <p>
                        This investor registration was <strong>NOT RECOMMENDED</strong> by Manager <br>
                    </p>
                @endif
                <div class="form-row">
                    @switch($approvalType)
                        @case(1)
                            <div class="form-group col-sm-4">Do you approve this investor registration?<span style="color:red"> *</span></div>
                            <div class="form-group col-md-6">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="approval" id="approvalYes"
                                        value="1">
                                    <label class="form-check-label" for="approvalYes">Yes</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="approval" id="approvalNo"
                                        value="0">
                                    <label class="form-check-label" for="approvalNo">No</label>
                                </div>
                            </div>
                            @break
                        @case(2)
                            <div class="form-group col-sm-4">Do you agree to the manager's recommendation?<span style="color:red"> *</span></div>
                            <div class="form-group col-md-6">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="approval" id="approvalYes"
                                        value="1">
                                    <label class="form-check-label" for="approvalYes">Agree</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="approval" id="approvalNo"
                                        value="0">
                                    <label class="form-check-label" for="approvalNo">No Agree</label>
                                </div>
                            </div>
                            @break
                    @endswitch
                    @if ($errors->has('approval'))
                    <div class="alert alert-danger" role="alert">
                            Approval Field is <strong class="" style="color:red">Required</strong>. Please select
                        your Approval.
                    </div>
                    @endif
                </div>
            
            <div class="form-row">
                <label for="projectDesc">Approval Comment</label><span style="color:red"> *</span>
                <textarea class="form-control" id="approvalComment" name="approvalComment" cols="30" rows="10" value=""></textarea>
                @if ($errors->has('approvalComment'))
                <div class="alert alert-danger" role="alert">
                        Approval Comment Field is <strong class="" style="color:red">Required</strong>. Please enter your comment.
                </div>
                @endif
                </span>
                <span class="focus-border"></span>
            </div>

            <div class="form-row mt-2">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</div>