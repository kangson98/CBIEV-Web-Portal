<div class="card">
    <div class="card-header">
        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#mentorExp" aria-expanded="false"
            aria-controls="mentorExp">
            Mentor Experiences
        </button>
    </div>
    <div class="collapse" id="mentorExp">
        <div class="card-body">
            <div class="p-2 row">
                <div class="col col-sm-3">Has mentoring experience?</div>
                <div class="col col-sm-6">
                    @if ($mentorRegisExp-> mentor_has_exp == 1)
                        Yes
                    @else
                        No
                    @endif
                </div>
                <span class="border-bottom "></span>
            </div>
            <div class="p-2 row">
                <div class="col col-sm-3">Mentoring Experience/Experience to mentoring</div>
                <div class="col col-sm-6">{{$mentorRegisExp-> mentor_exp_text}}</div>
                <span class="border-bottom "></span>
            </div>
            <div class="p-2 row">
                <div class="col col-sm-3">Experience in Entrepreneurship</div>
                <div class="col col-sm-6">{{$mentorRegisExp-> mentor_exp_entrepreneuship}}</div>
                <span class="border-bottom "></span>
            </div>
            <div class="p-2 row">
                <div class="col col-sm-3">Agree to 1-2 hour mentoring session</div>
                <div class="col col-sm-6">
                    @if ($mentorRegisExp-> mentoring == 1)
                        Yes
                    @else
                        No
                    @endif
                </div>
                <span class="border-bottom "></span>
            </div>
            <div class="p-2 row">
                <div class="col col-sm-3">How you hear?</div>
                <div class="col col-sm-6">{{$mentorRegisExp-> how_hear_program}}</div>
                <span class="border-bottom "></span>
            </div>
        </div>
    </div>
</div>
