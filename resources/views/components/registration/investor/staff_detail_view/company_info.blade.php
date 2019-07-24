<div class="card">
        <div class="card-header">
            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#companyInfo" aria-expanded="false"
                aria-controls="companyInfo">
                Company Info
            </button>
        </div>
        <div class="collapse" id="companyInfo">
            <div class="card-body">
                <div class="p-2 row">
                    <div class="col col-sm-3">Company Registered Name</div>
                    <div class="col col-sm-6">{{ $investorRegis -> company_registered_name }}</div>
                    <span class="border-bottom "></span>
                </div>
                <div class="p-2 row">
                    <div class="col col-sm-3">Business Registration No.</div>
                    <div class="col col-sm-6">{{ $investorRegis -> business_registered_no }}</div>
                    <span class="border-bottom "></span>
                </div>
                <div class="p-2 row">
                    <div class="col col-sm-3">Paid Up Capital</div>
                    <div class="col col-sm-6">{{ $investorRegis -> paid_up_capital }}</div>
                    <span class="border-bottom "></span>
                </div>
                <div class="p-2 row">
                    <div class="col col-sm-3">Company Website</div>
                <div class="col col-sm-6">
                    <a href="//{{$investorRegis -> company_website}}" target="_blank">{{ $investorRegis -> company_website }}</a>
                </div>
                    <span class="border-bottom "></span>
                </div>
                <div class="p-2 row">
                    <div class="col col-sm-3">Business Classification</div>
                    <div class="col col-sm-6">{{ $investorRegis -> business_classification }}</div>
                    <span class="border-bottom "></span>
                </div>
                <div class="p-2 row">
                    <div class="col col-sm-3">Business Description</div>
                    <div class="col col-sm-6">{{ $investorRegis -> business_description }}</div>
                    <span class="border-bottom "></span>
                </div>
                <div class="p-2 row">
                    <div class="col col-sm-3">Area of Interest</div>
                    <div class="col col-sm-6">{{ $investorRegis -> area_of_intereseted }}</div>
                    <span class="border-bottom "></span>
                </div>
                <div class="p-2 row">
                    <div class="col col-sm-3">Join Panel?</div>
                    <div class="col col-sm-6">
                        @if ($investorRegis -> is_join_panel == 1)
                            Yes
                        @else
                            No
                        @endif
                    </div>
                    <span class="border-bottom "></span>
                </div>
            </div>
        </div>
    </div>