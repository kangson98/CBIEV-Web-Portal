<div class="form-row">
    <div class="form-group col-md-6">
        <label for="projectTitle">Type</label>
        <input class="form-control" value="{{$person -> member_type}}" disabled>
    </div>
    <div class="form-group col-md-6">
        <label>Name</label>
        <input class="form-control" value="{{$person -> name}}" disabled>
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-6">
        <label for="projectTitle">Contact</label>
        <input class="form-control" value="{{$person -> contact}} " disabled>
    </div>
    <div class="form-group col-md-6">
        <label>Email</label>
        <input class="form-control" value="{{$person -> email}}" disabled>
    </div>
</div>
@if ($person-> company_id != null)
<div class="form-row">
    <div class="form-group col-md-6">
        <label for="projectTitle">Company Name</label>
        <input class="form-control" value="{{$person -> company-> company_name}}" disabled>
    </div>
    <div class="form-group col-md-6">
        <label>Official Email</label>
        <input class="form-control" value="{{$person -> company_email}}" disabled>
    </div>
</div>
@endif  
<div class="form-row">
    <div class="form-group col-md-6">
        <label for="projectTitle">Position</label>
        <input class="form-control" value="{{$person -> position}}" disabled>
    </div>
</div>  
@if ($person-> member_type == 1 || $person-> member_type == 2)
<div class="form-row">
    <div class="form-group col-md-6">
        <label for="projectTitle">Staff ID/Alumni ID </label>
        <input class="form-control" value="{{$person-> uc_id}}" disabled>
    </div>
    <div class="form-group col-md-6">
        <label>Center/Department/Faculty</label>
        <input class="form-control" value="{{$person-> centerFaculty-> code }}" disabled>
    </div>
</div>    
@endif
<div class="form-row">
    <div class="form-group col-md-6">
        <label for="">
            <input type="checkbox" name="infoCheck" id="infoCheck" value="yes">
            I confirm information above is valid and correct.
        </label>
        @if ($errors->has('infoCheck'))
        <div class="alert alert-danger" role="alert">
            Please check <strong class="" style="color:red">Required</strong>
        </div>
        @endif
    </div>
</div>