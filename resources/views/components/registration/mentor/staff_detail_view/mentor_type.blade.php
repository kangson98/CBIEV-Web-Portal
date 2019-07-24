<div class="card">
    <div class="card-header">
        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#mentroCatTy" aria-expanded="false"
            aria-controls="mentroCatTy">
            Mentor Type/Category
        </button>
    </div>
    <div class="collapse" id="mentroCatTy">
        <div class="card-body">
            <div class="p-2 row">
                <div class="col col-sm-3">Mentor Category</div>
                <div class="col col-sm-6">
                    @if ($mentorRegis -> category == 1)
                    Internal Mentor
                    @elseif($mentorRegis -> category == 2)
                    External Mentor
                    @endif
                </div>
                <span class="border-bottom "></span>
            </div>
            <div class="p-2 row">
                <div class="col col-sm-3">Applied Mentor Type</div>
                
                <div class="col col-sm-6">
                    @foreach ($mentorRegis-> mentorType as $mentorType)
                        {{$mentorType-> name}}. 
                    @endforeach
                </div>
                <span class="border-bottom "></span>
            </div>
        </div>
    </div>
</div>
