<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Supplier Edit page</h4>
                    <a href="{{ route('information.index', ['cat_id' => 1]) }}" class="btn btn-sm btn-primary"><i class="fa fa-reply"></i><span class="btn-icon-add"></span>Back</a>
                </div>
                <div class="card-body">
                    <form class="form-valide" action="{{ route('update_supplier',$supplierEdit->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body py-2 px-4">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-md-5 col-form-label">Company Name
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-md-7">
                                           <input type="text" value="{{ $supplierEdit->company_name }}" placeholder="company name.." id="" aria-invalid aria-required="true"  name="com_name" class="form-control" >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-md-5 col-form-label">Contact Person
                                        </label>
                                        <div class="col-md-7">
                                           <input type="text" value="{{ $supplierEdit->contact_person }}" placeholder="contact person.." id="" aria-invalid aria-required="true"  name="contact_name" class="form-control" >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-md-5 col-form-label">Mobile no</label>
                                        <div class="col-md-7">
                                            <input class="input form-control" value="{{ $supplierEdit->mobile_no }}"  placeholder=" Mobile number.." id="" type="tel" name="mobile_no" placeholder="" autocomplete="off"  aria-labelledby="InputLabel" aria-invalid aria-required="true"  tabindex="1" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-md-5 col-form-label">Email
                                        </label>
                                        <div class="col-md-7">
                                            <input type="email" id=""  value="{{ $supplierEdit->Email }}" placeholder=" Email.." aria-invalid aria-required="true"  name="email" class="form-control" >
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="" class="col-md-5">Security Cheque</label>
                                        <div class="col-md-7">

                                            <input type="file" name="security_cheque"  class="form-control"  id="">
                                            <div id="file-preview" style="margin-top: 10px;">
                                                @if (pathinfo($supplierEdit->security_cheque, PATHINFO_EXTENSION) == 'pdf')
                                                    <a href="{{ asset($supplierEdit->security_cheque) }}" target="_blank">{{ basename($supplierEdit->security_cheque) }}</a>
                                                @elseif (in_array(pathinfo($supplierEdit->security_cheque, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif']))
                                                    <img src="{{ asset($supplierEdit->security_cheque) }}" alt="Attachment" style="width: 40px; height: 40px;">
                                                @else
                                                    {{ basename($supplierEdit->security_cheque) }}
                                                @endif
                                            </div>
                                           
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="" class="col-md-5">Bank Guaranty</label>
                                        <div class="col-md-7">

                                            <input type="file" name="bank_guaranty" class="form-control"  id="">
                                            <div id="file-preview" style="margin-top: 10px;">
                                                @if (pathinfo($supplierEdit->bank_guaranty, PATHINFO_EXTENSION) == 'pdf')
                                                    <a href="{{ asset($supplierEdit->bank_guaranty) }}" target="_blank">{{ basename($supplierEdit->bank_guaranty) }}</a>
                                                @elseif (in_array(pathinfo($supplierEdit->bank_guaranty, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif']))
                                                    <img src="{{ asset($supplierEdit->bank_guaranty) }}" alt="Attachment" style="width: 40px; height: 40px;">
                                                @else
                                                    {{ basename($supplierEdit->bank_guaranty) }}
                                                @endif
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="attachment" class="col-md-5">Attachment</label>
                                        <div class="col-md-7">
                                            <input type="file" name="attachment" class="form-control" id="attachment">
                                            <!-- Display Image, PDF Preview, or File Name -->
                                            <div id="file-preview" style="margin-top: 10px;">
                                                @if (pathinfo($supplierEdit->attachment, PATHINFO_EXTENSION) == 'pdf')
                                                    <a href="{{ asset($supplierEdit->attachment) }}" target="_blank">{{ basename($supplierEdit->attachment) }}</a>
                                                @elseif (in_array(pathinfo($supplierEdit->attachment, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif']))
                                                    <img src="{{ asset($supplierEdit->attachment) }}" alt="Attachment" style="width: 40px; height: 40px;">
                                                @else
                                                    {{ basename($supplierEdit->attachment) }}
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="" class="col-md-5">Opening Date</label>
                                        <div class="col-md-7">
                                            <input type="date" name="date" value="{{ $supplierEdit->opening_date }}" class="form-control"  id="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="" class="col-md-5">Status</label>
                                        <div class="col-md-7">
                                            <select name="status" id="" class="form-control">
                                                <option value="Active" {{ $supplierEdit->Status == 'Active' ? 'selected' : ''}}>Active</option>
                                                <option value="Inactive" {{ $supplierEdit->Status == 'Inactive' ? 'selected' : ''}}>Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="" class="col-md-5"> Address</label>
                                        <div class="col-md-7">
                                            <textarea name="address" class="form-control"  id="" cols="30" rows="2">{{ $supplierEdit->Address }}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="" class="col-md-5">Note</label>
                                        <div class="col-md-7">
                                            <textarea name="note" class="form-control"  id="" cols="30" rows="2">{{ $supplierEdit->note }}</textarea>
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













