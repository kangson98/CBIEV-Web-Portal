<div class="form-group">
    <label for="{{$type}}AddressLine1">Address Line 1</label>
    <input type="text" name="{{$type}}AddressLine1" id="{{$type}}AddressLine1" class="form-control">
</div>
<div class="form-group">
    <label for="{{$type}}AddressLine2">Address Line 2</label>
    <input type="text" name="{{$type}}AddressLine2" id="{{$type}}AddressLine2" class="form-control">
</div>
<div class="form-row">
    <div class="form-group col-md-6">
        <label for="{{$type}}AddressCity">City</label>
        <input type="text"id="{{$type}}AddressCity" name="{{$type}}AddressCity" class="form-control" >
    </div>
    <div class="form-group col-md-4">
        <label for="{{$type}}AddressState">State</label>
        <select  name="{{$type}}AddressState" id="{{$type}}AddressState" class="form-control">
            <option>Johor</option>
            <option>Kedah</option>
            <option>Kelantan</option>
            <option>Malacca</option>
            <option>Negeri Sembilam</option>
            <option>Pahang</option>
            <option>Penang</option>
            <option>Perak</option>
            <option>Perlis</option>
            <option>Sabah</option>
            <option>Sarawak</option>
            <option>Selangor</option>
            <option>Terengganu</option>
        </select>
    </div>
    <div class="form-group col-md-2">
        <label for="{{$type}}AddressZip">Zip</label>
        <input type="text" name="{{$type}}AddressZip" id="{{$type}}AddressZip" class="form-control">
    </div>
</div>