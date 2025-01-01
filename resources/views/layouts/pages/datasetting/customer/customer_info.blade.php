<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-primary">
                    <h4 class="card-title">
                        @if ($type == 1) All Supplier List
                        @elseif ($type == 2) All Customer List
                        @elseif($type == 3)All Employee List
                        @endif
                    </h4>
                    <div>
                        <a href="" data-toggle="modal" data-target=".bd-example-modal-lg" class="btn btn-sm btn-success p-1 px-2"><i class="fa fa-plus"></i></i><span class="btn-icon-add"></span>Create</a>
                    </div>


                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example3" class="display table table-hover">
                            <thead>
                                <tr>
                                    <th>Sl. No.</th>
                                    <th>Customer name</th>
                                    <th>Project name</th>
                                    <th>Mobile no</th>
                                    <th>Site location</th>
                                    <th>Status</th>
                                    <th >Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($allInformation as $item )
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->company_name }}</td>
                                        <td>{{ $item->project_name }}</td>
                                        <td>{{ $item->mobile_no }}</td>
                                        <td>{{ $item->Address }}</td>
                                        <td>
                                            <span class="badge light badge-success">
                                                {{ $item->Status }}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('customer_edit',$item->id) }}" class="btn btn-primary light"> 
                                                <i class="fa fa-pencil"></i>
                                            </a>

                                            <a href="{{ route('customer_view',$item->id) }}" class="btn btn-success light">
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
                    <h5 class="modal-title">Create New Customer</h5>
                    
                    <button type="button" class="close" data-dismiss="modal">
                        <span class="text-white">&times;</span>
                    </button>
                </div>

                <form class="form-valide" action="{{ route('store_saler',$type) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body py-2 px-4">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="customer_name" class="form-label">Customer Name <span class="text-danger">*</span></label>
                                    <input type="text" name="customer_name" class="form-control" placeholder="Customer Name" id="customer_name" required autofocus>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="contact_person" class="form-label">Contact Person</label>
                                    <input type="text" placeholder="Contact Person" id="contact_person" name="contact_person" class="form-control" >
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="project_name" class="form-label">Project Name</label>
                                    <input type="text" placeholder="Project Name" id="project_name" name="project_name" class="form-control" >
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="site_location" class="form-label">Project Location</label>
                                    <input type="text" placeholder="Project Location" id="site_location" name="site_location" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="mobile_no" class="form-label">Mobile Number</label>
                                    <input type="text" class="form-control" name="mobile_no" placeholder="+88 01711222333" id="mobile_no">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" id="email" placeholder="Email" name="email" class="form-control" >
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="date" class="form-label">Opening Date</label>
                                    <input type="date" name="date" class="form-control" id="date" placeholder="Select Date" value="{{ old('date') ? old('date') : date('Y-m-d') }}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="status" class="form-label">Status</label>
                                    <select name="status" id="" class="form-control">
                                        <option value="Active">Active</option>
                                        <option value="Inactive">Inactive</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nid" class="col-md-5">NID</label>
                                    <input type="file" name="nid" class="form-control" id="nid">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="work_order" class="col-md-5">Work Order</label>
                                    <input type="file" name="work_order" class="form-control"  id="work_order">
                                </div>
                            </div>


                            <!-- <div class="col-md-6">
                                <div class="form-group row">
                                    <label for="" class="col-md-5">Category</label>
                                    <div class="col-md-7">

                                        <input type="text" selected disabled value="{{ $type == 2 ? 'Customer Info' : '' }}" class="form-control" style="background-color: gray; color:white">
                                    </div>
                                </div>
                            </div> -->

                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="security_cheque" class="form-label">Security Cheque</label>
                                    <input type="file" name="security_cheque" class="form-control" id="security_cheque">
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
                                                       
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="note">Note</label>
                                    <textarea name="note" placeholder="Project Description" class="form-control" id="note" cols="30" rows="3"></textarea>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
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
    const input = document.getElementById("NID");
    const mask = new IMask(input, { mask: "0-0000-00000-0000-0"
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
       const mask = new IMask(input, { mask: "000000000000000"
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
       const input = document.getElementById("EcontactNumber");
       const mask = new IMask(input, { mask: "000000000000000"
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
       const input = document.getElementById("personnalNumber");
       const mask = new IMask(input, { mask: "000000000000000"
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


