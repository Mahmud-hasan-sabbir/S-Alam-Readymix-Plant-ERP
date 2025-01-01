<x-app-layout>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-primary">
                    <h4 class="card-title text-white">Update Password</h4>
                </div>

                <div class="card-body">

                    @if(count($errors))
                        @foreach($errors->all() as $error)
                        <div class="alert alert-secondary" role="alert">{{ $error }}</div>
                        @endforeach
                    @endif
                    <form action="{{ route('update.password') }}" method="POST">
                        @csrf

                        <div class="mb-3 row">
                            <label for="old_password" class="col-sm-2 col-form-label">Old Password</label>

                            <div class="col-sm-10">
                                <input type="password" class="form-control" name="old_password" id="old_password" value="{{ old('old_password') }}">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="new_password" class="col-sm-2 col-form-label">New Password</label>

                            <div class="col-sm-10">
                                <input type="password" class="form-control" name="new_password" id="new_password" value="{{ old('new_password') }}">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="confirm_password" class="col-sm-2 col-form-label">New Password</label>

                            <div class="col-sm-10">
                                <input type="password" class="form-control" name="confirm_password" id="confirm_password" value="{{ old('confirm_password') }}">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="submit" class="col-sm-2 col-form-label"></label>

                            <div class="col-sm-10">

                                <button type="submit" class="btn btn-success" data-bs-toggle="tooltip" data-bs-placement="right" title="Create New Invoice">Update Password</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


