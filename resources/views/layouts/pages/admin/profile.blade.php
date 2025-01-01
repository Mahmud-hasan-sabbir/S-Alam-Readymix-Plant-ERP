<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-primary">
                    <h4 class="card-title text-white">User Profile</h4>
                </div>

                <div class="card-body">
                    <div class="row">
                    	<div class="col-md-3 text-center">                   		
                    		
                    		<img src="{{asset('public')}}/images/profile/fix/{{ Auth::user()->profile_photo_path }}" alt="" width="150px" class="img-thumbnail rounded "> <br>

                    		<a href="{{ route('profile.edit') }}" class="btn btn-xs btn-primary light mr-1 mt-2">Edit Profile</a>
                    	</div>

                    	<div class="col-md-9">
                    		<h4 class="card-title">User Information</h4>
                    		<table class="table table-bordered table-striped table-hover">
                    			<tr>
                					<th width="30%">User Name</th>
                					<td>{{ $admin->name }}</td>
                				</tr>

                				<tr>
                					<th width="30%">Email</th>
                					<td>{{ $admin->email }}</td>
                				</tr>

                				<tr>
                					<th width="30%">Contact Number</th>
                					<td>{{ $admin->contact_number }}</td>
                				</tr>

                				<tr>
                					<th width="30%">User Role</th>
                					<td>{{ $admin->role_name }}</td>
                				</tr>
                    		</table>
                    	</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>



