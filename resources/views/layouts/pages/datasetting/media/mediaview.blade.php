<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Media view page</h4>
                    <a href="{{ route('information.index',['cat_id' => 4]) }}" class="btn btn-sm btn-primary"><i class="fa fa-reply"></i><span class="btn-icon-add"></span>Back</a>
                </div>
                <div class="card-body">
                    <form class="form-valide" action="" method="POST" enctype="multipart/form-data" id="mediaInfoform">
                        @csrf
                        <div class="modal-body py-2 px-4">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-md-5 col-form-label">Name
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-md-7">
                                           <input type="text" readonly maxlength="25" value="{{ $mediaInfoView->Saller_name }}" placeholder=" member name.." id="name" aria-invalid aria-required="true" required name="name" class="form-control" >
                                        </div>
                                    </div>
                                </div>
    
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-md-5 col-form-label">Email
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-md-7">
                                            <input type="email" readonly id="email" value="{{ $mediaInfoView->Email }}" placeholder="Saller Email.." aria-invalid aria-required="true" required name="email" class="form-control" >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-md-5 col-form-label">Phone Number</label>
                                        <div class="col-md-7">
                                            <input type="text" readonly  id="phoneNumber" value="{{ $mediaInfoView->personal_no }}" required name="phoneNumber"  class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="" class="col-md-5">NID Number</label>
                                        <div class="col-md-7">
                                            <input class="input form-control" readonly value="{{ $mediaInfoView->NID }}" id="NID" name="nid" type="tel" name="nid" placeholder="X-XXXX-XXXXX-XX-X" autocomplete="off" autofocus title="National ID Input" aria-labelledby="InputLabel" aria-invalid aria-required="true" required tabindex="1" />
                                        </div>
                                    </div>
    
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-md-5 col-form-label">Gender
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-md-7">
                                           <select name="gender" @selected(true) disabled aria-invalid aria-required="true" required id="gender" class="form-control">
                                                <option value="" selected disabled>select gender</option>
                                                <option  value="Male" {{ $mediaInfoView->Gender == "Male" ? 'selected':'' }}>Male</option>
                                                <option  value="Female" {{ $mediaInfoView->Gender == "Female" ? 'selected':'' }}>Female</option>
                                           </select>
                                        </div>
                                    </div>
                                </div>
    
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-md-5 col-form-label">Father Name
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-md-7">
                                            <input type="text" readonly value="{{ $mediaInfoView->Father_name }}" id="f_name" maxlength="25" placeholder="Father name.." aria-invalid aria-required="true" required name="f_name" class="form-control" >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="" class="col-md-5">Em-contact-name</label>
                                        <div class="col-md-7">
                                            <input type="text" readonly value="{{ $mediaInfoView->E_C_Name }}" maxlength="25" placeholder="Emergency-contact-name .." id="e-c-name" aria-invalid aria-required="true" required name="e_c_name" class="form-control">
                                        </div>
                                    </div>
    
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="" class="col-md-5">Em-contact-number</label>
                                        <div class="col-md-7">
    
                                            <input class="input form-control" readonly value="{{ $mediaInfoView->E_C_Number }}"  placeholder="Emergency-contact-number .." id="EcontactNumber" type="tel" name="e_c_number" placeholder="" autocomplete="off"  aria-labelledby="InputLabel" aria-invalid aria-required="true" required tabindex="1" />
                                        </div>
                                    </div>
    
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="" class="col-md-5">Relationship</label>
                                        <div class="col-md-7">
                                            <input type="text" readonly value="{{ $mediaInfoView->Relation_ship }}" required id="relation" name="relationship" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="" class="col-md-5">Image</label>
                                        <div class="col-md-7">
                                            <img src="{{ asset($mediaInfoView->Image) }}" alt="" id="imageshowedit" style="width: 40px;height:40px">
                                          
                                           
                                        </div>
                                    </div>
    
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label for="" class="col-md-2">Address</label>
                                        <div class="col-md-10">
                                            <textarea name="address" readonly required class="form-control" id="address" cols="30" rows="3" style="margin-left: 45px; width:857px">{{ $mediaInfoView->Address }}</textarea>
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











