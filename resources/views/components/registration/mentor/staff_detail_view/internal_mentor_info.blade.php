<div class="card">
    <div class="card-header">
        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#internalMentor" aria-expanded="false"
            aria-controls="internalMentor">
            Internal Mentor Info
        </button>
    </div>
    <div class="collapse" id="internalMentor">
        <div class="card-body">
            <div class="p-2 row">
                <div class="col col-sm-3">Center/Faculty Name</div>
                <div class="col col-sm-6">{{ $internalMentor-> centerFaculty-> name }}</div>
                <span class="border-bottom "></span>
            </div>
        </div>
    </div>
</div>
