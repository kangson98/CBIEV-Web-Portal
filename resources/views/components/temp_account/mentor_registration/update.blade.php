<div class="card">
    <div class="card-header">
        Update Mentor Registration <br>
        <small>Please enter your updated Experiences</small>
    </div>
    <div class="m-1 p-3 card-body">
        <form action="{{route('mentor.temp.registration.update')}}" method="post">
            @csrf

            <input type="hidden" name="mrID" value="{{Crypt::encrypt($mentorRegis-> id)}}">
            @component('components.registration.mentor.form.mentor_exp')
                    
            @endcomponent

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>