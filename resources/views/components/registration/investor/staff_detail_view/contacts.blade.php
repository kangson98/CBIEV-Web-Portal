<div class="card">
        <div class="card-header">
            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#companyContact" aria-expanded="false"
                aria-controls="companyContact">
                Company Contact
            </button>
        </div>
        <div class="collapse" id="companyContact">
            @foreach ($contacts as $contact)
            <div class="card-body">
                    <div class="p-2 row">
                        <div class="col col-sm-3">Contact Type</div>
                        <div class="col col-sm-6">
                           @switch($contact -> contact_type)
                               @case(1)
                                   HP No
                                   @break
                               @case(2)
                                   Tel No
                                   @break
                               @case(3)
                                   Email
                                   @break
                               @case(4)
                                   Fax
                                   @break
                               @default
                                   
                           @endswitch
                        </div>
                        <span class="border-bottom "></span>
                    </div>
                    <div class="p-2 row">
                        <div class="col col-sm-3">Contact</div>
                        <div class="col col-sm-6">{{ $contact -> contact_detail }}</div>
                        <span class="border-bottom "></span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>