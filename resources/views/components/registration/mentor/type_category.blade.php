<div class="form-group row">
    <label for="mentorCategory" class="col-sm-2 col-form-label">Mentor Category</label>
    <div class="col-sm-10">
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="mentorCategory" id="mentorCategoryIn" value="1"  v-on:change="internalMentor">
            <label class="form-check-label" for="mentorCategoryIn">Internal</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="mentorCategory" id="mentorCategoryEx" value="2" v-on:change="externalMentor">
            <label class="form-check-label" for="mentorCategoryEx">External</label>
        </div>
    </div>
</div>
<div class="form-group row">
    <label for="mentorType" class="col-sm-2 col-form-label">Mentor Type</label>
    <div class="col-sm-10">
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" name="mentorTypeBusi" id="mentorTypeBusi">
            <label class="form-check-label" for="mentorTypeBusi">Business Mentor</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" name="mentorTypeTech" id="mentorTypeTech">
            <label class="form-check-label" for="mentorTypeTech">Technical Mentor</label>
        </div>
    </div>
</div>