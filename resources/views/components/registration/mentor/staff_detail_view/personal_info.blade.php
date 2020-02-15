<div class="card">
    <div class="card-header">
        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#mentorInfo" aria-expanded="false"
            aria-controls="mentorInfo">
            Mentor Personal Info
        </button>
    </div>
    <div class="collapse" id="mentorInfo">
        <div class="card-body">
            <div class="p-2 row">
                <div class="col col-sm-3">Name<span style="color:red">*</span></div>
                <div class="col col-sm-6">{{ $mentorRegis -> name }}</div>
                <span class="border-bottom "></span>
            </div>
            <div class="p-2 row">
                <div class="col col-sm-3">IC<span style="color:red">*</span></div>
                <div class="col col-sm-6">{{ $mentorRegis -> ic }}</div>
                <span class="border-bottom "></span>
            </div>
            <div class="p-2 row">
                <div class="col col-sm-3">Contact<span style="color:red">*</span></div>
                <div class="col col-sm-6">
                    {{$mentorRegis-> contact}}
                </div>
            </div>
            <div class="p-2 row">
                <div class="col col-sm-3">Email<span style="color:red">*</span></div>
                <div class="col col-sm-9">
                    {{ $mentorRegis -> email }}
                </div>                
            </div>
            <div class="p-2 row">
                <div class="col col-sm-3">File<span style="color:red">*</span></div>
                <div class="col col-sm-9">
                    {{-- {{ $mentorRegis -> fileUpload }} --}}
                    <img src="<?php echo asset('storage/mentor_registration/1/mentor_registration_image.png')?>" >
                    {{Storage::url('mentor_registration/1/mentor_registration_image.png')}}
            </div>
        </div>
    </div>
</div>
