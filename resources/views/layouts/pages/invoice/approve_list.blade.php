<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-primary">
                    <h4 class="card-title">Invoice Approve List</h4>

                    <a href="{{ route('add_invoice') }}" class="btn btn-sm btn-success">
                        <i class="fa fa-reply"></i><span class="btn-icon-add"></span>Invoice</a>
                </div>

                <div class="card-body" id="reload">
                    <div class="table-responsive">
                        <table id="example3" class="display table table-hover">
                            <thead>
                                <tr>
                                    <th>Sl. No.</th>
                                    <th>Date</th>
                                    <th>Customer Name</th>
                                    <th>Invoice No</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="purchase_tbody">
                                @foreach ($allinvoice as $row)

                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ date('d-m-y', strtotime($row->date)) }}</td>
                                    <td>{{ $row->customerName->company_name }}</td>
                                    <td>{{ $row->inv_no }}</td>
                                    <td>{{ $row->total_amount }}</td>
                                    <td>
                                        @if($row->status == 0)
                                        <button class="btn btn-sm btn-primary light view" data-id="{{ $row->id }}">Pending</button>
                                        @elseif($row->status == 1)
                                        <button class="btn btn-sm btn-primary light view" data-id="{{ $row->id }}">Success</button>
                                        @endif
                                    </td>
                                <td>
                                    <div class="btngroup">
                                        <form action="{{ route('invoice_approve',['id' => $row->id]) }}" method="post" >
                                           
                                            <button class="btn btn-success light display-inline" title="Approved">
                                                <i class="fa fa-check-circle"></i>
                                            </button>
                                            
                                            @csrf
                                            @method('PATCH')
                                        </form>

                                        <form action="{{ route('invoice_cancaled',['id' => $row->id]) }}" method="post" >
                                            
                                            <button class="btn btn-primary light edit" title="Delete">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                            
                                            @csrf
                                            @method('PATCH')
                                        </form>
                                    </div>
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
                <div class="modal-header bg-primary">
                    <h5 class="modal-title">Invoice View</h5>
                    <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span></button>
                </div>

                <form class="form-valide" action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body py-2">
                        <div class="row" id="main-row-data">

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Invoice No. </label>
                                    <input type="text" id="ordernoview" name="po_no" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Date</label>
                                    <input type="date" name="inv_date" id="inv_dateview" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Customer Name :<span class="text-danger">*</span></label>
                                    <select name="supplier_id" id="supplierIdview" @selected(true) disabled class="form-control dropdwon_select" required>
                                        @foreach($customer as $row)
                                            <option value="{{ $row->id }}">{{ $row->company_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>


                        <div class="row mt-3">
                            <div class="col-md-12">
                                <table class="table table-bordered table-striped table-hover" id="productTable">
                                    <thead>
                                        <tr>
                                            <th>Grade</th>
                                            <th>Location</th>
                                            <th>Quantity</th>
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
           url: '{{ route('invoice_view') }}',
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
                       <td><input type="text" class="form-control" value="${detail.grade.name}" readonly></td>
                       <td><input type="text" class="form-control" value="${detail.location}" readonly></td>
                       <td><input type="text" class="form-control" value="${detail.qty_m3}" readonly></td>
                       <td><input type="text" class="form-control" value="${detail.qty_cft}" readonly></td>
                       <td><input type="text" class="form-control" value="${detail.unit_price_cft}" readonly></td>
                       <td><input type="text" class="form-control" value="${detail.sub_total}" readonly></td>


                   </tr>`;
                   $('#productTable tbody').append(newRow);
               });


           }
       });
   });
</script>




