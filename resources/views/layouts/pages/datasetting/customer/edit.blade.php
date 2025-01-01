<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-primary">
                    <h4 class="card-title">Update Customer</h4>

                    <a href="{{ route('information.index',['cat_id' => 2]) }}" class="btn btn-sm btn-success">
                        <i class="fa fa-reply"></i><span class="btn-icon-add"></span>Back</a>
                </div>

                <div class="card-body">
                    <form class="form-valide" action="{{ route('customer_update',$customerEdit->id ) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body py-2 px-4">
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="customer_name" class="form-label">Customer Name</label>
                                        <input type="text" name="customer_name" class="form-control" id="customer_name"value="{{ $customerEdit->company_name }}" placeholder="Customer Name">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="contact_person" class="form-label">Contact Person</label>
                                        <input type="text" name="contact_person" class="form-control" id="contact_person"value="{{ $customerEdit->contact_person }}" placeholder="Contact Person">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="project_name" class="form-label">Project Name</label>
                                        <input type="text" value="{{ $customerEdit->project_name }}" placeholder="Project Name" id="project_name" name="project_name" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="site_location" class="form-label">Project Location</label>
                                        <input type="text" value="{{ $customerEdit->Address }}" placeholder="Project Location" id="site_location" name="site_location" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="mobile_no" class="form-label">Mobile Number</label>
                                        <input class="form-control" value="{{ $customerEdit->mobile_no }}" placeholder="+88 01716 014 680" id="mobile_no" type="text" name="mobile_no">
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" value="{{ $customerEdit->Email }}" id="email" placeholder="s.alamreadymix@gmail.com" name="email" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="date" class="form-label">Opening Date</label>
                                        <input type="date" value="{{ $customerEdit->opening_date }}" name="date" class="form-control" id="date" placeholder="Select Date">
                                    </div>
                                </div>

                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="status" class="form-label">Status</label>
                                        <select name="status" id="status" class="form-control">
                                            <option value="Active" {{ $customerEdit->Status == 'Active' ? 'selected' : '' }}>Active</option>
                                            <option value="Inactive" {{ $customerEdit->Status == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nid" class="form-label">NID</label>
                                        <input type="file" name="nid" class="form-control" id="nid">
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="work_order" class="form-label">Work Order</label>
                                        <input type="file" name="work_order" class="form-control"  id="work_order">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div id="file-preview">
                                            @if (pathinfo($customerEdit->nid, PATHINFO_EXTENSION) == 'pdf')
                                                <a href="{{ asset($customerEdit->nid) }}" target="_blank">{{ basename($customerEdit->nid) }}</a>
                                            @elseif (in_array(pathinfo($customerEdit->nid, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif']))
                                                <img src="{{ asset($customerEdit->nid) }}" alt="Attachment" style="width: 100px; height: 100px;">
                                            @else
                                                {{ basename($customerEdit->nid) }}
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group row">
                                        <div id="file-preview">
                                            @if (pathinfo($customerEdit->work_order, PATHINFO_EXTENSION) == 'pdf')
                                                <a href="{{ asset($customerEdit->work_order) }}" target="_blank">{{ basename($customerEdit->work_order) }}</a>
                                            @elseif (in_array(pathinfo($customerEdit->work_order, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif']))
                                                <img src="{{ asset($customerEdit->work_order) }}" alt="Attachment" style="width: 100px; height: 100px;">
                                            @else
                                                {{ basename($customerEdit->work_order) }}
                                            @endif
                                        </div>

                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="security_cheque" class="form-label">Security Cheque</label>
                                        <input type="file" name="security_cheque" class="form-control"  id="security_cheque">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="bank_guaranty" class="form-label">Bank Guaranty</label>
                                        <input type="file" name="bank_guaranty" class="form-control" id="bank_guaranty">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div id="file-preview" style="margin-top: 10px;">
                                            @if (pathinfo($customerEdit->security_cheque, PATHINFO_EXTENSION) == 'pdf')
                                                <a href="{{ asset($customerEdit->security_cheque) }}" target="_blank">{{ basename($customerEdit->security_cheque) }}</a>

                                            @elseif (in_array(pathinfo($customerEdit->security_cheque, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif']))
                                                <img src="{{ asset($customerEdit->security_cheque) }}" alt="Attachment" style="width: 100px; height: 100px;">
                                            @else
                                                {{ basename($customerEdit->security_cheque) }}
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div id="file-preview" style="margin-top: 10px;">
                                            @if (pathinfo($customerEdit->bank_guaranty, PATHINFO_EXTENSION) == 'pdf')
                                                <a href="{{ asset($customerEdit->bank_guaranty) }}" target="_blank">{{ basename($customerEdit->bank_guaranty) }}</a>
                                            @elseif (in_array(pathinfo($customerEdit->bank_guaranty, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif']))
                                                <img src="{{ asset($customerEdit->bank_guaranty) }}" alt="Attachment" style="width: 100px; height: 100px;">
                                            @else
                                                {{ basename($customerEdit->bank_guaranty) }}
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="attachment" class="form-label">Attachment</label>
                                        <input type="file" name="attachment" class="form-control" id="attachment">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <div id="file-preview">
                                            @if (pathinfo($customerEdit->attachment, PATHINFO_EXTENSION) == 'pdf')
                                                <a href="{{ asset($customerEdit->attachment) }}" target="_blank">{{ basename($customerEdit->attachment) }}</a>
                                            @elseif (in_array(pathinfo($customerEdit->attachment, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif']))
                                                <img src="{{ asset($customerEdit->attachment) }}" alt="Attachment" style="width: 100px; height: 100px;">
                                            @else
                                                {{ basename($customerEdit->attachment) }}
                                            @endif
                                        </div>                                        
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="note" class="form-label">Note</label>
                                        <textarea name="note" placeholder="Project Description" class="form-control" id="note" cols="30" rows="3">{{ $customerEdit->note }}</textarea>
                                    </div>
                                </div>

                                

                            </div>
                        </div>
                        <div class="modal-footer" style="height:50px">
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











