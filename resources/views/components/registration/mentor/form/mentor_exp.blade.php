<div class=" text-center" style="margin-top:1rem;">
    <div class="m-3"><strong>Mentoring Experience</strong></div>
</div>
<div class="form-group row">
    <label for="mentorCategory" class="col-sm-4 col-form-label">Have you had experience in Mentoring before</label>
    <div class="col-sm-8">
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="mentorHasExp" id="mentorHasExpYes" value="1" @click="unhide">
            <label class="form-check-label" for="mentorHasExpYes">Yes</label>
        </div>
        <div class="form-check form-check-inline" >
            <input class="form-check-input" type="radio" name="mentorHasExp" id="mentorHasExpNo" value="0" @click="hide">
            <label class="form-check-label" for="mentorHasExpNo">No</label>
        </div>
    </div>
</div>
<div class="form-row m-2" v-if="seen">
        <label for="mentorExpText">If you <strong>had</strong> experience, please state the type of mentoring capabilities or skills you would like to provide?<br>
            If you <strong>have not</strong> officially mentor before, what experience do you have that lends yourself to mentoring?<span style="color:red"> *</span></label>
        <textarea class="form-control" id="mentorExpText" name="mentorExpText" cols="30" rows="5" value="">{{ old('mentorExpText')}}</textarea>
        <span class="focus-border"></span>
</div>
<div class="form-row m-2">
        <label for="mentorExpEntrepreneuship">What is your experience, if any, with entrepreneuship?</label><span style="color:red"> *</span>
        <textarea class="form-control" id="mentorExpEntrepreneuship" name="mentorExpEntrepreneuship" cols="30" rows="5" value="">{{ old('mentorExpEntrepreneuship')}}</textarea>
        <span class="focus-border"></span>
</div>
<div class="form-group row">
    <label for="mentorCategory" class="col-sm-7 col-form-label">Are you willing to commit 1 - 2 hours every month for mentoring purpose?</label>
    <div class="col-sm-5">
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="mentoring" id="mentoringYes" value="1">
            <label class="form-check-label" for="mentoringYes">Yes</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="mentoring" id="mentoringNo" value="0">
            <label class="form-check-label" for="mentoringNo">No</label>
        </div>
    </div>
</div>
<div class="form-row m-2">
    <label for="howHearProgram">How did you hear of our program?</label><span style="color:red"> *</span>
    <textarea class="form-control" id="howHearProgram" name="howHearProgram" cols="30" rows="5" value="">{{ old('howHearProgram')}}</textarea>
    <span class="focus-border"></span>
</div>
{{-- <div class="form-group row">
    <label for="mentor" class="col-sm-2 col-form-label"></label>
    <div class="col-sm-10">
        <textarea name="mentorExpText" id="mentorExpText" cols="30" rows="10"></textarea>
    </div>
</div> --}}