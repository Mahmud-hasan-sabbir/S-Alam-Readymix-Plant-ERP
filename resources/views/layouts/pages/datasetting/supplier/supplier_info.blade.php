<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-primary">
                    <h4 class="card-title">
                        @if ($type == 1) All Supplier List
                        @elseif ($type == 2) All Customer List
                        @else All Employee List
                        @endif
                    </h4>
                    <div>
                        <a href="" data-toggle="modal" data-target=".bd-example-modal-lg" class="btn btn-sm btn-success p-1 px-2">
                            <i class="fa fa-plus"></i><span class="btn-icon-add"></span>Create</a>
                    </div>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example3" class="display table table-hover">
                            <thead>
                                <tr>
                                    <th>Sl. No.</th>
                                    <th>Company Name</th>
                                    <th>Contact Person</th>
                                    <th>Mobile No.</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($allInformation as $item )
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->company_name }}</td>
                                        <td>{{ $item->contact_person }}</td>
                                        <td>{{ $item->mobile_no }}</td>
                                        <td>{{ date('d-m-y', strtotime($item->opening_date)) }}</td>
                                        <td><span class="badge light badge-success">{{ $item->Status }}</span></td>

                                        <td style="width:210px;">
                                            <a href="{{ route('supplier_edit', $item->id) }}" class="btn btn-success light">
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                            <a href="{{ route('supplier_view', $item->id) }}" class="btn btn-primary light">
                                                <i class="fa-regular fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


      <!-- create modal open -->

      <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title">Create New Supplier</h5>
                    <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span></button>
                </div>

                <form class="form-valide" action="{{ route('store_saler',$type) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body py-2 px-4">
                        <div class="row">
                            <div class="col-md-6">
                                <div for="com_name" class="form-group">
                                    <label class="form-label">Company Name <span class="text-danger">*</span></label>
                                    <input type="text" placeholder="Company Name" id="com_name" required name="com_name" class="form-control" autofocus>
                                </div>
                            </div>

<!--                             <div class="col-md-6">
                                <div class="form-group row">
                                    <label for="" class="col-md-5">Category</label>
                                    <div class="col-md-7">
                                        <input type="text" selected disabled value="{{ $type == 1 ? 'Supplier Info' : '' }}" class="form-control" style="background-color: gray; color:white">
                                    </div>
                                </div>
                            </div> -->

                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label for="contact_name" class="form-label">Contact Person</label>
                                    <input type="text" placeholder="Contact Person" id="contact_name" name="contact_name" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="mobile_no" class="form-label">Mobile no</label>
                                    <input class="input form-control"  placeholder="Mobile no" id="mobile_no" type="text" name="mobile_no"/>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" id="email" placeholder="Email" name="email" class="form-control" >
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="date" class="form-label">Opening Date</label>
                                    <input type="date" name="date" class="form-control" placeholder="Select Date" id="date">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="status" class="form-label">Status</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="Active">Active</option>
                                        <option value="Inactive">Inactive</option>
                                    </select>
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
                                    <label for="attachment" class="form-label">Attachment</label>
                                    <input type="file" name="attachment" class="form-control" id="attachment">
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="address" class="form-label">Address</label>
                                    <textarea name="address" class="form-control" id="address" cols="30" rows="2"></textarea>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="note" class="form-label">Note</label>
                                    <textarea name="note" class="form-control" id="note" cols="30" rows="2"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer" style="height:50px">
                        <button type="button" class="btn btn-sm btn-danger light" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-sm btn-primary submit_btn">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

<script src="https://cdnjs.cloudflare.com/ajax/libs/imask/3.3.0/imask.min.js"></script>

<script>
 document.addEventListener("DOMContentLoaded", () => {
    const input = document.getElementById("citizenid");
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
       const input = document.getElementById("phoneNumber");
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
       const input = document.getElementById("EphoneNumber");
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










