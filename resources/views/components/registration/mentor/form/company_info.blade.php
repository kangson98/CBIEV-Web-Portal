<div class=" text-center" style="margin-top:1rem;">
    <div class="m-3"><strong>------------------------------------------------------------------ Company Information(If applicable) ------------------------------------------------------------------</strong></div>
</div>
<div class="form-group row">
    <div class="col-sm-12">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="1" name="" id="mentorHasCompany" :disabled="mentorHasCompanyDisable" v-on:click="checkMentorHasCompany($event)" v-model="mentorHasCompany">
            <label class="form-check-label" for="mentorHasCompany" >
                Check if own a company.
            </label>
        </div>
        <input type="hidden" name="mentorHasCompany" v-model="mentorHasCompany">
    </div>
</div>
<div class="form-group row">
    <label for="mentorCompanyRegNo" class="col-sm-2 col-form-label">Company Registration No</label>
    <div class="col-sm-10">
        <input type="text" name="" id="mentorCompanyRegNo" class="form-control" :disabled="mentorComponyRegNoDisable" v-model="mentorCompanyRegNo">
        <input type="hidden" name="mentorCompanyRegNo" v-model="mentorCompanyRegNo">
    </div>
</div>
<div class="form-group row">
    <label for="mentorCompanyName" class="col-sm-2 col-form-label">Company Name<span style="color:red">*</span></label>
    <div class="col-sm-10">
        <input type="text" name="" id="mentorCompanyName" class="form-control" :disabled="mentorComponyNameDisable" v-model="mentorCompanyName">
        <input type="hidden" name="mentorCompanyName" v-model="mentorCompanyName">
    </div>
</div>
<div class="form-group row">
    <label for="mentorPosition" class="col-sm-2 col-form-label">Position<span style="color:red">*</span></label>
    <div class="col-sm-10">
        <input type="text" name="" id="mentorPosition" class="form-control" :disabled="mentorPositionDisable" v-model="mentorPosition">
        <input type="hidden" name="mentorPosition" v-model="mentorPosition">

    </div>
</div>
<div class="form-group row">
    <label for="mentorDepartment" class="col-sm-2 col-form-label">Center/Department/Faculty<span style="color:red">*</span></label>
    <div class="col-sm-10">
        <select name="mentorDepartment" id="mentorDepartment" class="form-control" :disabled="mentorDepartmentDisable">
            @foreach ($centerFaculty as $name => $id)
            <option value="{{$id}}">{{$name}}</option>                
            @endforeach
        </select>
    </div>
</div>
<div class="form-group row">
    <label for="mentorCompanyEmail" class="col-sm-2 col-form-label">UC Email/Official Email<span style="color:red">*</span></label>
    <div class="col-sm-10">
        <input type="text" name="" id="mentorCompanyEmail" class="form-control" :disabled="mentorOfficialEmailDisable" v-model="mentorOfficialEmail">
        <input type="hidden" name="mentorCompanyEmail" v-model="mentorOfficialEmail">
    </div>
</div>
