<div class="card">
        <div class="card-header">
            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#companyAddress" aria-expanded="false"
                aria-controls="companyAddress">
                Company Address
            </button>
        </div>
        <div class="collapse" id="companyAddress" >
            @foreach ($addresses as $address)
            <div class="card-body">
                    <div class="p-2 row">
                        <div class="col col-sm-3">
                            @if ($address-> address_type == 1)
                                Registered Address
                            @elseif($address-> address_type == 2)
                                Business Address
                            @endif
                        </div>
                        <div class="col col-sm-6">
                                {{ $address -> address-> line_1 }}, <br>
                                {{ $address -> address-> line_2 }}, <br>
                                {{ $address -> address-> city}}, {{ $address -> address-> zip  }}. <br>
                                {{ $address -> address-> state }} <br>
                                
                        </div>
                        <span class="border-bottom "></span>
                    </div>

                </div>
            @endforeach
        </div>
    </div>