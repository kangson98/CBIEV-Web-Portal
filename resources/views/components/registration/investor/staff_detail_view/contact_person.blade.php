<div class="card">
        <div class="card-header">
            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#companyPerson" aria-expanded="false"
                aria-controls="companyPerson">
                Company Info
            </button>
        </div>
        <div class="collapse" id="companyPerson">
            @foreach ($contactPersons as $contactPerson)
            <div class="card-body">
                    <div class="p-2 row">
                        <div class="col col-sm-3">Contact Person Name</div>
                        <div class="col col-sm-6">{{ $contactPerson -> contact_person_name }}</div>
                        <span class="border-bottom "></span>
                    </div>
                    <div class="p-2 row">
                        <div class="col col-sm-3">Contact Person Position</div>
                        <div class="col col-sm-6">{{ $contactPerson -> contact_person_position }}</div>
                        <span class="border-bottom "></span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>