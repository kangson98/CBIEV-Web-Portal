<div class=" text-center" style="margin-top:1rem;">
    <div class="m-3"><strong>-------------------------------------------------------------------------- Personal Information -------------------------------------------------------------------------</strong></div>
</div>
<div class="form-group row">
    <label for="mentorName" class="col-sm-2 col-form-label">Name<span style="color:red">*</span></label>
    <div class="col-sm-10">
        <input type="text" name="mentorName" required="" placeholder="Insert name" id="mentorName" class="form-control">
    </div>
</div>
<div class="form-group row">
    <label for="mentorICPass" class="col-sm-2 col-form-label">IC No/Passport No<span style="color:red">*</span></label>
    <div class="col-sm-10">
        <input type="text" name="mentorICPass" placeholder="Example:xxxxxx-xx-xxxx, etc..." required="" pattern="[0-9]{6}[-][0-9]{2}[-][0-9]{4}" title="Example:xxxxxx-xx-xxxx" id="mentorICPass" class="form-control">
    </div>
</div>
<div class="form-group row">
    <label for="mentorContact" class="col-sm-2 col-form-label">Contact<span style="color:red">*</span></label>
    <div class="col-sm-10">
        <input type="text" name="mentorContact" placeholder="Example:012-xxxxxxx, etc..." required="" pattern="0[0-9]{2}[-][0-9]{7,}" title="Example:012-xxxxxxx, etc...." id="mentorContact" class="form-control">
    </div>
</div>
<div class="form-group row">
    <label for="mentorEmail" class="col-sm-2 col-form-label">Email<span style="color:red">*</span></label>
    <div class="col-sm-10">
        <input type="text" name="mentorEmail" placeholder="Example:ABC123@gmail.com, etc..." required="" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.com$" title="Example:Example:ABC123@gmail.com" id="mentorEmail" class="form-control">
    </div>

    {{-- add attach file here--}}
    <template>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card card-default">
                        <div class="card-header">Upload IC/Passport(png)</div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3" v-if="image">
                                    <img :src="image" class="img-responsive" height="70" width="90">
                                </div>
                                <div class="col-md-6">
                                    <input type="file" v-on:change="onImageChange" class="form-control" name="mentorFile" id="mentorFile">
                                </div>
                                <div class="col-md-3">
                                    <button class="btn btn-success btn-block" v-on:click="uploadImage">Upload
                                        Image</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </template>

    {{-- <script>
        export default {
            data() {
                return {
                    image: ''
                }
            },

            methods: {
                onImageChange(e) {
                    let files = e.target.files || e.dataTransfer.files;
                    if (!files.length)
                        return;
                    this.createImage(files[0]);
                },
                createImage(file) {
                    let reader = new FileReader();
                    let vm = this;
                    reader.onload = (e) => {
                        vm.image = e.target.result;
                    };
                    reader.readAsDataURL(file);
                },
                /* Submits the file to the server */
                uploadImage() {
                    axios.post('/image/store', {
                            image: this.image
                        })
                        /* .then(response => {
                   console.log(response);*/
                        .then(function () {
                            console.log('SUCCESS file upload!');
                        })
                        .catch(function () {
                            console.log('FAILURE file upload!!');
                        });
                },
            }
        }

    </script> --}}
    </template>
</div>
