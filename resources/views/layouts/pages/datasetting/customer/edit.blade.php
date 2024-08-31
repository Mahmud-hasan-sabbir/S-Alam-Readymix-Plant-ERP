<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Customer Edit page</h4>
                    <a href="{{ route('information.index',['cat_id' => 2]) }}" class="btn btn-sm btn-primary"><i class="fa fa-reply"></i><span class="btn-icon-add"></span>Back</a>
                </div>
                <div class="card-body">
                    <form class="form-valide" action="{{ route('customer_update',$customerEdit->id ) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body py-2 px-4">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-md-5 col-form-label">Customer Name

                                        </label>
                                        <div class="col-md-7">
                                           <input type="text" value="{{ $customerEdit->company_name }}" placeholder=" customer name.." id="" aria-invalid aria-required="true"  name="customer_name" class="form-control" >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <div class="col-md-8">
                                            <div class="form-group row">
                                                <label for="" class="col-md-5">Security Cheque</label>
                                                <div class="col-md-7">
                                                    <input type="file" name="security_cheque" class="form-control"  id="">

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group row">
                                                <div id="file-preview" style="margin-top: 10px;">
                                                    @if (pathinfo($customerEdit->security_cheque, PATHINFO_EXTENSION) == 'pdf')
                                                        <a href="{{ asset($customerEdit->security_cheque) }}" target="_blank">{{ basename($customerEdit->security_cheque) }}</a>
                                                    @elseif (in_array(pathinfo($customerEdit->security_cheque, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif']))
                                                        <img src="{{ asset($customerEdit->security_cheque) }}" alt="Attachment" style="width: 40px; height: 40px;">
                                                    @else
                                                        {{ basename($customerEdit->security_cheque) }}
                                                    @endif
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-md-5 col-form-label">Project Name

                                        </label>
                                        <div class="col-md-7">
                                           <input type="text" value="{{ $customerEdit->project_name }}" placeholder=" project name.." id="" aria-invalid aria-required="true"  name="project_name" class="form-control" >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <div class="col-md-8">
                                            <div class="form-group row">
                                                <label for="" class="col-md-5">Bank Guaranty</label>
                                                <div class="col-md-7">
                                                    <input type="file" name="bank_guaranty" class="form-control"  id="">

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group row">
                                                <div id="file-preview" style="margin-top: 10px;">
                                                    @if (pathinfo($customerEdit->bank_guaranty, PATHINFO_EXTENSION) == 'pdf')
                                                        <a href="{{ asset($customerEdit->bank_guaranty) }}" target="_blank">{{ basename($customerEdit->bank_guaranty) }}</a>
                                                    @elseif (in_array(pathinfo($customerEdit->bank_guaranty, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif']))
                                                        <img src="{{ asset($customerEdit->bank_guaranty) }}" alt="Attachment" style="width: 40px; height: 40px;">
                                                    @else
                                                        {{ basename($customerEdit->bank_guaranty) }}
                                                    @endif
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-md-5 col-form-label">Contact Person

                                        </label>
                                        <div class="col-md-7">
                                           <input type="text" value="{{ $customerEdit->contact_person }}" placeholder=" contact person.." id="" aria-invalid aria-required="true"  name="contact_person" class="form-control" >
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <div class="col-md-8">
                                            <div class="form-group row">
                                                <label for="" class="col-md-5">Work Order</label>
                                                <div class="col-md-7">
                                                    <input type="file" name="work_order" class="form-control"  id="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group row">
                                                <div id="file-preview" style="margin-top: 10px;">
                                                    @if (pathinfo($customerEdit->work_order, PATHINFO_EXTENSION) == 'pdf')
                                                        <a href="{{ asset($customerEdit->work_order) }}" target="_blank">{{ basename($customerEdit->work_order) }}</a>
                                                    @elseif (in_array(pathinfo($customerEdit->work_order, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif']))
                                                        <img src="{{ asset($customerEdit->work_order) }}" alt="Attachment" style="width: 40px; height: 40px;">
                                                    @else
                                                        {{ basename($customerEdit->work_order) }}
                                                    @endif
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-md-5 col-form-label">Site Location

                                        </label>
                                        <div class="col-md-7">
                                           <input type="text" value="{{ $customerEdit->Address }}" placeholder=" site location.." id="" aria-invalid aria-required="true"  name="site_location" class="form-control" >
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <div class="col-md-8">
                                            <div class="form-group row">
                                                <label for="" class="col-md-5">NID</label>
                                                <div class="col-md-7">
                                                    <input type="file" name="nid" class="form-control"  id="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group row">
                                                <div id="file-preview" style="margin-top: 10px;">
                                                    @if (pathinfo($customerEdit->nid, PATHINFO_EXTENSION) == 'pdf')
                                                        <a href="{{ asset($customerEdit->nid) }}" target="_blank">{{ basename($customerEdit->nid) }}</a>
                                                    @elseif (in_array(pathinfo($customerEdit->nid, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif']))
                                                        <img src="{{ asset($customerEdit->nid) }}" alt="Attachment" style="width: 40px; height: 40px;">
                                                    @else
                                                        {{ basename($customerEdit->nid) }}
                                                    @endif
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="" class="col-md-5">Status</label>
                                        <div class="col-md-7">
                                            <select name="status" id="" class="form-control">
                                                <option value="Active" {{ $customerEdit->Status == 'Active' ? 'selected' : '' }}>Active</option>
                                                <option value="Inactive" {{ $customerEdit->Status == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <div class="col-md-8">
                                            <div class="form-group row">
                                                <label for="" class="col-md-5">Attachment</label>
                                                <div class="col-md-7">
                                                    <input type="file" name="attachment" class="form-control"  id="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group row">
                                                <div id="file-preview" style="margin-top: 10px;">
                                                    @if (pathinfo($customerEdit->attachment, PATHINFO_EXTENSION) == 'pdf')
                                                        <a href="{{ asset($customerEdit->attachment) }}" target="_blank">{{ basename($customerEdit->attachment) }}</a>
                                                    @elseif (in_array(pathinfo($customerEdit->attachment, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif']))
                                                        <img src="{{ asset($customerEdit->attachment) }}" alt="Attachment" style="width: 40px; height: 40px;">
                                                    @else
                                                        {{ basename($customerEdit->attachment) }}
                                                    @endif
                                                </div>
                                                
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-md-5 col-form-label">Email

                                        </label>
                                        <div class="col-md-7">
                                            <input type="email" value="{{ $customerEdit->Email }}" id="email" placeholder="customer Email.." aria-invalid aria-required="true"  name="email" class="form-control" >
                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-md-5 col-form-label">Mobile Number

                                        </label>
                                        <div class="col-md-7">
                                            <input class="input form-control" value="{{ $customerEdit->mobile_no }}"  placeholder="mobile no .." id="personnalNumber" type="tel" name="mobile_no" placeholder="" autocomplete="off"  aria-labelledby="InputLabel" aria-invalid aria-required="true"  tabindex="1" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="" class="col-md-5">Opening Date</label>
                                        <div class="col-md-7">
                                            <input type="date" value="{{ $customerEdit->opening_date }}" name="date" class="form-control"  id="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="" class="col-md-5">Note</label>
                                        <div class="col-md-7">
                                            <textarea name="note" placeholder="note....." class="form-control"  id="" cols="30" rows="2">{{ $customerEdit->note }}</textarea>
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











