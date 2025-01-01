<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-primary">
                    <h4 class="card-title text-white">Update User Profile</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('profile.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3 row">
                            <label for="name" class="col-sm-2 col-form-label">User Name</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="name" id="name" value="{{ $admin->name }}">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="email" class="col-sm-2 col-form-label">Email</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="email" id="email" value="{{ $admin->email }}">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="contact_number" class="col-sm-2 col-form-label">Contact Number</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="contact_number" id="contact_number" value="{{ $admin->contact_number }}">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="role_name" class="col-sm-2 col-form-label">User Role</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="role_name" id="role_name" value="{{ $admin->role_name }}" readonly>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="profile" class="col-sm-2 col-form-label">Profile Photo</label>

                            <div class="col-sm-10">
                                 <input type="file" class="form-control" name="profile_photo_path" id="images" value="{{ $admin->profile_photo_path }}">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="profile" class="col-sm-2 col-form-label"></label>

                            <div class="col-sm-10">
                                 <img src="{{asset('public')}}/images/profile/fix/{{ Auth::user()->profile_photo_path }}" id="showImage" width="100px">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="submit" class="col-sm-2 col-form-label"></label>

                            <div class="col-sm-10">

                                <button type="submit" class="btn btn-success" data-bs-toggle="tooltip" data-bs-placement="right" title="Create New Invoice">Update Profile</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


<script>
    $(document).ready(function(){
        $('#images').change(function(e){
            var reader = new FileReader();

            reader.onload = function(e){
                $('#showImage').attr('src', e.target.result);
            }

            reader.readAsDataURL(e.target.files['0']);
        });
    });
</script>
