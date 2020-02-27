<div class="card">
    <div class="card-header">
        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#companyInfo" aria-expanded="false"
            aria-controls="companyInfo">
            Mentor Company Info
        </button>
    </div>
    <div class="collapse" id="companyInfo">
        <div class="card-body">
            <div class="p-2 row">
                <div class="col col-sm-3">Company Name<span style="color:red">*</span></div>
                <div class="col col-sm-6">{{ $company -> company_name }}</div>
                <span class="border-bottom "></span>
            </div>
            <div class="p-2 row">
                <div class="col col-sm-3">Business Registration No,</div>
                <div class="col col-sm-6">{{ $company -> company_reg_no }}</div>
                <span class="border-bottom "></span>
            </div>
        </div>
    </div>
</div>