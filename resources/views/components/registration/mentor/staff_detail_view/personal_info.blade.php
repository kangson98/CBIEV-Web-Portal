<div class="card">
    <div class="card-header">
        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#mentorInfo" aria-expanded="false"
            aria-controls="mentorInfo">
            Mentor Personal Info
        </button>
    </div>
    <div class="collapse" id="mentorInfo">
        <div class="card-body">
            <div class="p-2 row">
                <div class="col col-sm-3">Name</div>
                <div class="col col-sm-6">{{ $mentorRegis -> name }}</div>
                <span class="border-bottom "></span>
            </div>
            <div class="p-2 row">
                <div class="col col-sm-3">IC</div>
                <div class="col col-sm-6">{{ $mentorRegis -> ic }}</div>
                <span class="border-bottom "></span>
            </div>
            <div class="p-2 row">
                <div class="col col-sm-3">Contact</div>
                <div class="col col-sm-6">
                    {{$mentorRegis-> contact}}
                </div>
            </div>
            <div class="p-2 row">
                <div class="col col-sm-3">Email</div>
                <div class="col col-sm-9">
                    {{ $mentorRegis -> email }}
                </div>
            </div>
        </div>
    </div>
</div>
