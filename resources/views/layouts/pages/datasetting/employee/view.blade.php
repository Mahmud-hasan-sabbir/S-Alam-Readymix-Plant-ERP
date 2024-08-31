<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Employee View page</h4>
                    <a href="{{ route('information.index',['cat_id' => 3]) }}" class="btn btn-sm btn-primary"><i class="fa fa-reply"></i><span class="btn-icon-add"></span>Back</a>
                </div>
                <div class="card-body">
                    <form class="form-valide" action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body py-2 px-4">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-md-5 col-form-label">Name
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-md-7">
                                           <input type="text" readonly value="{{ $employeeview->company_name }}" placeholder=" Employee name.." id="" aria-invalid aria-required="true" required name="name" class="form-control" >
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-md-5 col-form-label">Email

                                        </label>
                                        <div class="col-md-7">
                                            <input type="email" readonly value="{{ $employeeview->Email }}" id="email" placeholder="Saller Email.." aria-invalid aria-required="true"   name="email" class="form-control" >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="" class="col-md-5">NID </label>
                                        <div class="col-md-7">
                                            
                                            <img src="{{ asset($employeeview->nid) }}" alt="" style="width: 40px;height:40px">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-md-5 col-form-label">Mobile number

                                        </label>
                                        <div class="col-md-7">
                                            <input class="input form-control" readonly value="{{ $employeeview->mobile_no }}"  placeholder="Emergency-contact-number .." id="personnalNumber" type="tel" name="personalNumber" placeholder="" autocomplete="off"  aria-labelledby="InputLabel" aria-invalid aria-required="true"  tabindex="1" />
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-md-5 col-form-label">Designation
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-md-7">
                                            <select name="employeeDesignation" @selected(true) disabled id="" required class="form-control">
                                                <option value="" selected disabled>Select a Designation</option>
                                                @foreach ($allDesignation as $item )
                                                    <option value="{{ $item->id }}" {{ $item->id == $employeeview->Designation ? 'selected' : '' }}>{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-md-5 col-form-label">Date Of Joining
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-md-7">
                                            <input type="date" id="" readonly value="{{ $employeeview->Date_of_join }}"  name="Date_of_join"  class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-md-5 col-form-label">Gender

                                        </label>
                                        <div class="col-md-7">
                                           <select name="gender" @selected(true) disabled aria-invalid aria-required="true"  id="gender" class="form-control">
                                                <option value="" selected disabled>select gender</option>
                                                <option value="Male" {{ $employeeview->Gender == 'Male' ? 'selected' : '' }}>Male</option>
                                                <option value="Female" {{ $employeeview->Gender == 'Female' ? 'selected' : '' }}>Female</option>
                                           </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="" class="col-md-5">Status</label>
                                        <div class="col-md-7">
                                            <select name="employeeStatus" @selected(true) disabled id=""  class="form-control">
                                                <option value="" selected disabled>Select status</option>
                                                <option value="Full time" {{ $employeeview->Status == 'Full time' ? 'selected' : '' }}>Full time</option>
                                                <option value="Half time" {{ $employeeview->Status == 'Half time' ? 'selected' : '' }}>Half time</option>
                                                <option value="Part time" {{ $employeeview->Status == 'Part time' ? 'selected' : '' }}>Part time</option>
                                                <option value="Temporary" {{ $employeeview->Status == 'Temporary' ? 'selected' : '' }}>Temporary</option>
                                                <option value="Parmanent" {{ $employeeview->Status == 'Parmanent' ? 'selected' : '' }}>Parmanent</option>
                                                <option value="Contractual" {{ $employeeview->Status == 'Contractual' ? 'selected' : '' }}>Contractual</option>

                                            </select>
                                        </div>
                                    </div>
                                </div>



                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="" class="col-md-5">Image</label>
                                        <div class="col-md-7">
                                           
                                            <img src="{{ asset($employeeview->image) }}" alt="" style="width: 40px;height:40px">
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="" class="col-md-5">Salary
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-md-7">
                                            <input type="number" readonly value="{{ $employeeview->salary }}" placeholder="enter a salary..." required class="form-control" name="salary">
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="" class="col-md-5">Address</label>
                                        <div class="col-md-7">
                                            <textarea name="address" readonly class="form-control" id="address" cols="30" rows="3">{{ $employeeview->Address }}</textarea>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                        <div class="modal-footer" style="height:50px">
                            <button type="button" class="btn btn-sm btn-danger light" data-dismiss="modal">Close</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>












