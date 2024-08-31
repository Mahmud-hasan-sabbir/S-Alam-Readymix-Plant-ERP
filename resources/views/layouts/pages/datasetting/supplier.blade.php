<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        @if ($type == 1) All Member List
                        @elseif ($type == 2) All Employee List
                        @else All Supplier List
                        @endif
                    </h4>
                    <div>
                        <a href="" data-toggle="modal" data-target=".bd-example-modal-lg" class="btn btn-sm btn-success p-1 px-2"><i class="fa fa-plus"></i></i><span class="btn-icon-add"></span>Create</a>
                        <a href="{{ route('information.index',['cat_id' => 4]) }}" class="btn btn-sm btn-danger p-1 px-2"><i class="fa fa-plus"></i></i><span class="btn-icon-add"></span>Next</a>

                    </div>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example3" class="display " style="min-width: 845px">
                            <thead>
                                <tr>
                                    <th>SL.NO</th>
                                    <th>Saller Name</th>
                                    <th>Phone number</th>
                                    <th>Email</th>
                                    <th>Image</th>
                                    <th >Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($allInformation as $item )
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->Saller_name }}</td>
                                        <td>{{ $item->personal_no }}</td>
                                        <td>{{ $item->Email }}</td>
                                        <td>
                                            <img src="{{ asset($item->Image) }}" alt="" style="width: 70px" height="60px">
                                        </td>
                                        <td style="width:210px;">
                                            <a href="{{ route('supplier_edit', $item->id) }}" class="btn btn-sm btn-success p-1 px-2"><i class="fa fa-pencil"></i></i><span class="btn-icon-add"></span>Edit</a>
                                            <a href="{{ route('supplier_view', $item->id) }}" class="btn btn-sm btn-danger p-1 px-2"><i class="fa fa-pencil"></i></i><span class="btn-icon-add"></span>View</a>
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
                                    <label class="col-md-5 col-form-label">Name
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-md-7">
                                       <input type="text" maxlength="25" placeholder=" name.." id="sallerName" aria-invalid aria-required="true" required name="name" class="form-control" >
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label for="" class="col-md-5">Category</label>
                                    <div class="col-md-7">
                                        <input type="text" selected disabled value="{{ $type == 3 ? 'Supplier Info' : '' }}" class="form-control" style="background-color: gray; color:white">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-5 col-form-label">Email
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-md-7">
                                        <input type="email" id="email" placeholder="Saller Email.." aria-invalid aria-required="true" required name="email" class="form-control" >
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-5 col-form-label">Cell no
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-md-7">
                                        {{-- <input type="number" maxlength="25" aria-invalid aria-required="true" id="" required id="phonenumber" name="phonenumber" class="form-control"> --}}
                                        <input class="input form-control"  placeholder=" phone number.." id="phoneNumber" type="tel" name="personalNumber" placeholder="" autocomplete="off"  aria-labelledby="InputLabel" aria-invalid aria-required="true" required tabindex="1" />
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-5 col-form-label">Gender
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-md-7">
                                       <select name="gender" aria-invalid aria-required="true" required id="gender" class="form-control">
                                            <option value="" selected disabled>select gender</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                       </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label for="" class="col-md-5">NID Number</label>
                                    <div class="col-md-7">
                                        <input class="input form-control" id="citizenid" type="tel" name="nid" placeholder="X-XXXX-XXXXX-XX-X" autocomplete="off" autofocus title="National ID Input" aria-labelledby="InputLabel" aria-invalid aria-required="true" required tabindex="1" />
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-md-5 col-form-label">Father Name
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-md-7">
                                        <input type="text" id="f_name" maxlength="25" placeholder="Father name.." aria-invalid aria-required="true" required name="f_name" class="form-control" >
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label for="" class="col-md-5">Emergency-contact-name</label>
                                    <div class="col-md-7">
                                        <input type="text" maxlength="25" placeholder="Emergency-contact-name .." id="e-c-name" aria-invalid aria-required="true" required name="e_c_name" class="form-control">
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label for="" class="col-md-5">Emergency-contact-number</label>
                                    <div class="col-md-7">
                                        {{-- <input type="number"  placeholder="Emergency-contact-number .." id="EphoneNumber" name="e_c_number" class="form-control"> --}}
                                        <input class="input form-control"  placeholder="Emergency-contact-number .." id="EphoneNumber" type="tel" name="e_c_number" placeholder="" autocomplete="off"  aria-labelledby="InputLabel" aria-invalid aria-required="true" required tabindex="1" />
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label for="" class="col-md-5">Relationship</label>
                                    <div class="col-md-7">
                                        <input type="text" id="relation" name="relationship" class="form-control">
                                    </div>
                                </div>

                            </div>



                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label for="" class="col-md-5"> Present Address</label>
                                    <div class="col-md-7">
                                        <textarea name="address" class="form-control" id="address" cols="30" rows="3"></textarea>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label for="" class="col-md-5">Photo</label>
                                    <div class="col-md-7">
                                        <input type="file" src="" id="image" name="image" alt="" class="form-control">
                                    </div>
                                </div>

                            </div>

                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label for="" class="col-md-5">permanent Address</label>
                                    <div class="col-md-7">
                                        <textarea name="permanentAddress" class="form-control" id="address" cols="30" rows="3"></textarea>
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










