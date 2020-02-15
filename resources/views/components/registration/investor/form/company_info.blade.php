<div class=" text-center" style="margin-top:1rem;">
    <div class="m-3"><strong>Company Information</strong></div>
</div>
<div class="form-group row">
    <label for="companyRegisteredName" class="col-sm-3 col-form-label">Registered Company Name<span
            style="color:red">*</span></label>
    <div class="col-sm-9">
        <input type="text" name="companyRegisteredName" id="companyRegisteredName" class="form-control">
    </div>
</div>
<div class="form-group row">
    <label for="companyBusinessRegNo" class="col-sm-3 col-form-label">Company Registration No<span
            style="color:red">*</span></label>
    <div class="col-sm-9">
        <input type="text" name="companyBusinessRegNo" id="companyBusinessRegNo" class="form-control">
    </div>
</div>
<div class="form-group row">
    <label for="companyRegAddress" class="col-sm-3 col-form-label">Registered Address<span
            style="color:red">*</span></label>
    <div class="col-sm-9">
        @component('components.address.address', ['type' => 'register'])

        @endcomponent
    </div>
</div>
<div class="form-group row">
    <label for="sameAddress" class="col-sm-3 col-form-label">Business Address<span style="color:red">*</span></label>
    <div class="col-sm-9">
        <div class="form-group">
            <input class="form-check-input" type="checkbox" name="sameAddress" id="sameAddress">
            <label class="form-check-label" for="sameAddress">
                Check if business address same as registered address
            </label>
        </div>
        @component('components.address.address', ['type' => 'business'])

        @endcomponent
    </div>
</div>
<div class="form-group row">
    <label for="companyPaidUpCap" class="col-sm-3 col-form-label">Paid Up Capital<span
            style="color:red">*</span></label>
    <div class="col-sm-9">
        <input type="text" name="companyPaidUpCap" id="companyPaidUpCap" class="form-control">
    </div>
</div>
<div class="form-group row">
    <label for="companyWebsite" class="col-sm-3 col-form-label">Company Website(If any)</label>
    <div class="col-sm-9">
        <input type="text" name="companyWebsite" id="companyWebsite" class="form-control">
    </div>
</div>
