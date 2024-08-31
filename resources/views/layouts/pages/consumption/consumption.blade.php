<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                       Consumption List
                    </h4>

                </div>

                <div class="card-body" id="reload">
                    <div class="table-responsive">
                        <table id="example3" class="display " style="min-width: 845px">
                            <thead>
                                <tr>
                                    <th>SL.NO</th>
                                    <th>Customer Name</th>
                                    <th>Invoice No</th>
                                    <th>Date</th>
                                    <th>Amount</th>
                                    <th>Status</th>

                                </tr>
                            </thead>
                            <tbody id="purchase_tbody">
                                @foreach ($invoice as $row)

                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $row->customerName->company_name }}</td>
                                    <td>
                                        @if($consum->has($row->id))
                                        <a href="#">{{ $row->inv_no }}</a>
                                        @else
                                        <a href="{{ route('consum_add',$row->id) }}" style="color: rgb(252, 9, 9)">{{ $row->inv_no }}</a>
                                        @endif

                                    </td>

                                    <td>{{ $row->date }}</td>
                                    <td>{{ $row->total_amount }}</td>
                                    <td>
                                        @if($consum->has($row->id))
                                        <button type="button" class="btn btn-success" style="padding: 3px">Complete</button>
                                        @else
                                            <button type="button" class="btn btn-danger" style="padding: 3px">Un Complete</button>
                                        @endif
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

    <!--view modal-->

    <div class="modal fade bd-example-modal-lg-view" id="viewmodal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Invoice View</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <form class="form-valide" action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body py-2">
                        <div class="row" id="main-row-data">
                            <div class="col-md-4">
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label">INV-NO : </label>
                                    <div class="col-md-8">
                                        <input type="text" readonly id="ordernoview" name="po_no" class="form-control" style="border:none">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4" style="margin-left: -28px">
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label">Inv Date : </label>
                                    <div class="col-md-8">
                                        <input type="date" readonly name="inv_date" id="inv_dateview" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group row">
                                    <label class="col-md-5 col-form-label">Customer Name :<span class="text-danger">*</span></label>
                                    <div class="col-md-7">
                                        <select name="supplier_id" id="supplierIdview" @selected(true) disabled class="form-control dropdwon_select" required>
                                            {{-- @foreach($customer as $row)
                                                <option value="{{ $row->id }}">{{ $row->Saller_name }}</option>
                                            @endforeach --}}
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label for="" class="col-md-2">Remarks :</label>
                                    <div class="col-md-10">
                                        <textarea name="remarks" readonly id="remarksview" cols="30" rows="2" class="form-control" style="width: 95%; margin-left: 32px;"></textarea>
                                    </div>
                                </div>
                            </div>

                        </div>


                        <div class="row mt-3">
                            <div class="col-md-12">
                                <table class="table table-bordered" id="productTable">
                                    <thead>
                                        <tr>
                                            <th>Grade</th>
                                            <th>Location</th>
                                            <th>Quantity (M3)</th>
                                            <th>Quantity(CFT)</th>
                                            <th>Unit price(CFT)</th>
                                            <th>Total Price</th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-12">
                                <div class="float-right">
                                    <input type="text" readonly class="form-control" id="totalview">
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

</x-app-layout>

<script>
    $(document).on('click', '.view', function() {
       var id = $(this).data('id');
       $.ajax({
           url: '',
           method: 'GET',
           dataType: "JSON",
           data: {id: id},
           success: function(data) {

               $('#viewmodal').modal('show');
               $('#ordernoview').val(data.inv_no);
               $('#inv_dateview').val(data.date);
               $('#supplierIdview').val(data.cus_id);
               $('#totalview').val(data.total_amount);
               $('#remarksview').val(data.description);

               // Clear the existing rows
               $('#productTable tbody').empty();

               // var total = data.purchaseDetails.sum('sub_total');

               // Loop through purchase details and append rows
               data.invdetail.forEach(function(detail) {
                   var newRow = `
                   <tr>
                       <td>${detail.grade.name}</td>
                       <td>${detail.location}</td>
                       <td>${detail.qty_m3}</td>
                       <td>${detail.qty_cft}</td>
                       <td>
                           ${detail.unit_price_cft}

                       </td>
                       <td>
                           ${detail.sub_total}

                       </td>


                   </tr>`;
                   $('#productTable tbody').append(newRow);
               });


           }
       });
   });
</script>




