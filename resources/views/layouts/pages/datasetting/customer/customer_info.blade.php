<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
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
                        <table id="example3" class="display " style="min-width: 845px">
                            <thead>
                                <tr>
                                    <th>SL.NO</th>
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
                                        <td>{{ $item->Status }}</td>

                                        <td style="width:210px;">
                                            <a href="{{ route('customer_edit',$item->id) }}" class="btn btn-sm btn-success p-1 px-2"><i class="fa fa-pencil"></i></i><span class="btn-icon-add"></span>Edit</a>
                                            <a href="{{ route('customer_view',$item->id) }}" class="btn btn-sm btn-danger p-1 px-2"><i class="fa fa-pencil"></i></i><span class="btn-icon-add"></span>View</a>
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
                <div class="modal-header">
                    <h5 class="modal-title">
                         Information
                    </h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <form class="form-valide" action="{{ route('store_saler',$type) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body py-2 px-4">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-5 col-form-label">Customer Name
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-md-7">
                                       <input type="text" placeholder=" customer name.." id="" aria-invalid aria-required="true" required name="customer_name" class="form-control" >
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label for="" class="col-md-5">Category</label>
                                    <div class="col-md-7">

                                        <input type="text" selected disabled value="{{ $type == 2 ? 'Customer Info' : '' }}" class="form-control" style="background-color: gray; color:white">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-5 col-form-label">Project Name

                                    </label>
                                    <div class="col-md-7">
                                       <input type="text" placeholder=" project name.." id="" aria-invalid aria-required="true"  name="project_name" class="form-control" >
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label for="" class="col-md-5">Security Cheque</label>
                                    <div class="col-md-7">
                                        <input type="file" name="security_cheque" class="form-control"  id="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-5 col-form-label">Contact Person

                                    </label>
                                    <div class="col-md-7">
                                       <input type="text" placeholder=" contact person.." id="" aria-invalid aria-required="true"  name="contact_person" class="form-control" >
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label for="" class="col-md-5">Bank Guaranty</label>
                                    <div class="col-md-7">
                                        <input type="file" name="bank_guaranty" class="form-control"  id="">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-5 col-form-label">Site Location

                                    </label>
                                    <div class="col-md-7">
                                       <input type="text" placeholder=" site location.." id="" aria-invalid aria-required="true"  name="site_location" class="form-control" >
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label for="" class="col-md-5">Work Order</label>
                                    <div class="col-md-7">
                                        <input type="file" name="work_order" class="form-control"  id="">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label for="" class="col-md-5">Status</label>
                                    <div class="col-md-7">
                                        <select name="status" id="" class="form-control">
                                            <option value="Active">Active</option>
                                            <option value="Inactive">Inactive</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label for="" class="col-md-5">NID</label>
                                    <div class="col-md-7">
                                        <input type="file" name="nid" class="form-control"  id="">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-5 col-form-label">Email

                                    </label>
                                    <div class="col-md-7">
                                        <input type="email" id="email" placeholder="customer Email.." aria-invalid aria-required="true"  name="email" class="form-control" >
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label for="" class="col-md-5">Attachment</label>
                                    <div class="col-md-7">
                                        <input type="file" name="attachment" class="form-control"  id="">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-5 col-form-label">Mobile Number

                                    </label>
                                    <div class="col-md-7">
                                        <input class="input form-control"  placeholder="mobile no .." id="personnalNumber" type="tel" name="mobile_no" placeholder="" autocomplete="off"  aria-labelledby="InputLabel" aria-invalid aria-required="true"  tabindex="1" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label for="" class="col-md-5">Opening Date</label>
                                    <div class="col-md-7">
                                        <input type="date" name="date" class="form-control"  id="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label for="" class="col-md-5">Note</label>
                                    <div class="col-md-7">
                                        <textarea name="note" placeholder="note....." class="form-control"  id="" cols="30" rows="2"></textarea>
                                    </div>
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


