<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Employee Edit page</h4>
                    <a href="{{ route('information.index',['cat_id' => 3]) }}" class="btn btn-sm btn-primary"><i class="fa fa-reply"></i><span class="btn-icon-add"></span>Back</a>
                </div>
                <div class="card-body">
                    <form class="form-valide" action="{{ route('update_employee',$employeeEdit->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body py-2 px-4">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-md-5 col-form-label">Name
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-md-7">
                                           <input type="text" value="{{ $employeeEdit->company_name }}" placeholder=" Employee name.." id="" aria-invalid aria-required="true" required name="name" class="form-control" >
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-md-5 col-form-label">Email

                                        </label>
                                        <div class="col-md-7">
                                            <input type="email" value="{{ $employeeEdit->Email }}" id="email" placeholder="Saller Email.." aria-invalid aria-required="true"   name="email" class="form-control" >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="" class="col-md-5">NID </label>
                                        <div class="col-md-7">
                                            <input type="file"  class="form-control" name="nid">
                                            <div id="file-preview" style="margin-top: 10px;">
                                                @if (pathinfo($employeeEdit->nid, PATHINFO_EXTENSION) == 'pdf')
                                                    <a href="{{ asset($employeeEdit->nid) }}" target="_blank">{{ basename($employeeEdit->nid) }}</a>
                                                @elseif (in_array(pathinfo($employeeEdit->nid, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif']))
                                                    <img src="{{ asset($employeeEdit->nid) }}" alt="Attachment" style="width: 40px; height: 40px;">
                                                @else
                                                    {{ basename($employeeEdit->nid) }}
                                                @endif
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-md-5 col-form-label">Mobile number

                                        </label>
                                        <div class="col-md-7">
                                            <input class="input form-control" value="{{ $employeeEdit->mobile_no }}"  placeholder="Emergency-contact-number .." id="personnalNumber" type="tel" name="personalNumber" placeholder="" autocomplete="off"  aria-labelledby="InputLabel" aria-invalid aria-required="true"  tabindex="1" />
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-md-5 col-form-label">Designation
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-md-7">
                                            <select name="employeeDesignation" id="" required class="form-control">
                                                <option value="" selected disabled>Select a Designation</option>
                                                @foreach ($allDesignation as $item )
                                                    <option value="{{ $item->id }}" {{ $item->id == $employeeEdit->Designation ? 'selected' : '' }}>{{ $item->name }}</option>
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
                                            <input type="date" id="" value="{{ $employeeEdit->Date_of_join }}"  name="Date_of_join"  class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-md-5 col-form-label">Gender

                                        </label>
                                        <div class="col-md-7">
                                           <select name="gender" aria-invalid aria-required="true"  id="gender" class="form-control">
                                                <option value="" selected disabled>select gender</option>
                                                <option value="Male" {{ $employeeEdit->Gender == 'Male' ? 'selected' : '' }}>Male</option>
                                                <option value="Female" {{ $employeeEdit->Gender == 'Female' ? 'selected' : '' }}>Female</option>
                                           </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="" class="col-md-5">Status</label>
                                        <div class="col-md-7">
                                            <select name="employeeStatus" id=""  class="form-control">
                                                <option value="" selected disabled>Select status</option>
                                                <option value="Full time" {{ $employeeEdit->Status == 'Full time' ? 'selected' : '' }}>Full time</option>
                                                <option value="Half time" {{ $employeeEdit->Status == 'Half time' ? 'selected' : '' }}>Half time</option>
                                                <option value="Part time" {{ $employeeEdit->Status == 'Part time' ? 'selected' : '' }}>Part time</option>
                                                <option value="Temporary" {{ $employeeEdit->Status == 'Temporary' ? 'selected' : '' }}>Temporary</option>
                                                <option value="Parmanent" {{ $employeeEdit->Status == 'Parmanent' ? 'selected' : '' }}>Parmanent</option>
                                                <option value="Contractual" {{ $employeeEdit->Status == 'Contractual' ? 'selected' : '' }}>Contractual</option>

                                            </select>
                                        </div>
                                    </div>
                                </div>



                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="" class="col-md-5">Image</label>
                                        <div class="col-md-7">
                                            <input type="file" src=""  id="image" name="emp_image" alt="" class="form-control">
                                            <img src="{{ asset($employeeEdit->image) }}" alt="" style="width: 40px;height:40px">
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="" class="col-md-5">Salary
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-md-7">
                                            <input type="number" value="{{ $employeeEdit->salary }}" placeholder="enter a salary..." required class="form-control" name="salary">
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="" class="col-md-5">Address</label>
                                        <div class="col-md-7">
                                            <textarea name="address"  class="form-control" id="address" cols="30" rows="3">{{ $employeeEdit->Address }}</textarea>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                        <div class="modal-footer" style="height:50px">
                            <button type="button" class="btn btn-sm btn-danger light" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-sm btn-primary submit_btn">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>

<script src="https://cdnjs.cloudflare.com/ajax/libs/imask/3.3.0/imask.min.js"></script>

<script>
 document.addEventListener("DOMContentLoaded", () => {
    const input = document.getElementById("NID");
    const mask = new IMask(input, { mask: "0-0000-00000-00-0"
    });
    function validNationalID(id) {
    if (id.length != 13) return false;
    for (i = 0, sum = 0; i < 12; i++) {
      sum += parseInt(id.charAt(i)) * (13 - i);
    }
    let mod = sum % 11;
    let check = (11 - mod) % 10;
    if (check == parseInt(id.charAt(12))) {
      return true;
    }
    return false;
  }
});

</script>

<script>
    document.addEventListener("DOMContentLoaded", () => {
       const input = document.getElementById("EphoneNumberr");
       const mask = new IMask(input, { mask: "0000000000000"
       });
       function validNationalID(id) {
       if (id.length != 13) return false;
       for (i = 0, sum = 0; i < 12; i++) {
         sum += parseInt(id.charAt(i)) * (13 - i);
       }
       let mod = sum % 11;
       let check = (11 - mod) % 10;
       if (check == parseInt(id.charAt(12))) {
         return true;
       }
       return false;
     }
   });

</script>

<script>
    document.addEventListener("DOMContentLoaded", () => {
       const input = document.getElementById("personalNumber");
       const mask = new IMask(input, { mask: "0000000000000"
       });
       function validNationalID(id) {
       if (id.length != 13) return false;
       for (i = 0, sum = 0; i < 12; i++) {
         sum += parseInt(id.charAt(i)) * (13 - i);
       }
       let mod = sum % 11;
       let check = (11 - mod) % 10;
       if (check == parseInt(id.charAt(12))) {
         return true;
       }
       return false;
     }
   });

</script>











