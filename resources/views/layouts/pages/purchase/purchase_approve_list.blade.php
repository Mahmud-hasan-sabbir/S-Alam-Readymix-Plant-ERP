<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-primary">
                    <h4 class="card-title">Purchase Approve List</h4>

                    {{-- <button data-toggle="modal" data-target=".bd-example-modal-lg" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i><span class="btn-icon-add"></span>Add New</button> --}}
                </div>

                <div class="card-body" id="reload">
                    <div class="table-responsive">
                        <table id="example3" class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Sl. No.</th>
                                    <!-- <th>PO No.</th> -->
                                    <th>Date</th>
                                    <th>Supplier Name</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th>View</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody id="purchase_tbody">
                                @foreach ($allPurchase as $row)

                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <!-- <td>{{ $row->PO_No }}</td> -->

                                    <td>{{ date('d-m-y', strtotime($row->order_date)) }}</td>
                                    <td>{{ $row->supplierName->company_name }}</td>
                                    <td>{{ number_format($row->Total_purchase_amount) }}</td>
                                    <td>
                                        @if($row->status == 0)
                                            <span class="badge light badge-danger">Pending</span>
                                        @endif
                                    </td>
                                    <td>
                                        <button data-id="{{ $row->id }}" class="view btn btn-info light" title="View">
                                            <i class="fa-regular fa-eye"></i>
                                        </button>
                                    </td>
                                    <td>
                                        <div class="approve_btn">
                                            <form action="{{ route('purchase_approve',['id' => $row->id]) }}" method="post" >
                                                <button class="btn btn-success light" title="Approve">
                                                    <i class="fa fa-check-circle"></i>
                                                </button>
                                                @csrf
                                                @method('PATCH')
                                            </form>
                                            <form action="{{ route('purchase_calcaled',['id' => $row->id]) }}" method="post" >
                                                <button class="btn btn-danger light" title="Delete">
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


    <div class="modal fade bd-example-modal-lg" id="viewmodal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content" style="width: 1270px;margin-left:-60px">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title">Purchase Order</h5>
                    <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span></button>
                </div>

                <form class="form-valide" action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body py-2">
                        <div class="row" id="main-row-data">
                            <input type="hidden" name="total_amount" id="total_amount">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Order No : </label>
                                    <input type="text" readonly id="ordernoview" name="po_no" value=""  class="form-control">

                                    {{-- <label  class="col-form-label" name="po_no" id="inv_no">{{ $purchase_codes }}</label> --}}
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Order Date : </label>
                                    <input type="date" name="inv_date" readonly id="inv_dateview" class="form-control" value="">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Supplier Name : <span class="text-danger">*</span></label>
                                    <input type="text" id="supplierIdview" class="form-control" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-12">
                                <table class="table table-bordered" id="productTable">
                                    <thead>
                                        <tr>
                                            <th>Category</th>
                                            <th>Product</th>
                                            <th>store</th>
                                            <th>Unit</th>
                                            <th>Challan No</th>
                                            <th>Truck No</th>
                                            <th>Quantity</th>
                                            <th>Unit Price</th>
                                            <th>Truck Fee</th>
                                            <th>Sub_Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- New rows will be appended here -->
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-12">
                                <div class="float-right">
                                    <h6 style="margin-left: -125px">Total Amount</h6>
                                    <input type="text" style="margin-top: -35px" id="totalamountview" class="form-control totaledit" readonly>
                                </div>
                            </div>
                            <div class="col-md-12" style="margin-top: 15px">
                                <div class="float-right" id="discount-container">
                                    <h6 style="margin-left: -125px">Discount</h6>
                                    <input type="text" style="margin-top: -35px" readonly name="discount" id="discountview" class="form-control discount" placeholder="0.00">
                                </div>
                            </div>
                            <div class="col-md-12" style="margin-top: 15px">
                                <div class="float-right" id="netamount">
                                    <h6 style="margin-left: -125px">Total Amount</h6>
                                    <input type="text" readonly class="form-control" id="totalview" style="margin-top: -35px">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="" class="form-label">Notes :</label>
                                    <textarea name="remarks" readonly id="remarksview" cols="30" rows="2" class="form-control"></textarea>
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
        url: '{{ route('purchase_approve_view') }}',
        method: 'GET',
        dataType: "JSON",
        data: {id: id},
        success: function(data) {


            $('#viewmodal').modal('show');
            $('#ordernoview').val(data.purchaseapproveview.PO_No);
            $('#inv_dateview').val(data.purchaseapproveview.order_date);
            $('#totalview').val(data.purchaseapproveview.Total_purchase_amount);
            $('#remarksview').val(data.purchaseapproveview.remarks);
            $('#supplierIdview').val(data.suppliername);

            var discount = parseFloat(data.purchaseapproveview.discount) || 0;
            $('#discountview').val(discount.toFixed(2));

            // Clear the existing rows
            $('#productTable tbody').empty();

            var total = 0;

            // Loop through purchase details and append rows

                data.purDetails.forEach(function(detail) {
                    var subTotal = parseFloat(detail.sub_total) || 0;
                    var newRow = `
                    <tr>
                        <td>${detail.category.name}</td>
                        <td>${detail.material.name}</td>
                        <td>${detail.store.name}</td>
                        <td>${detail.unit.name}</td>
                        <td>${detail.challan_no}</td>
                        <td>${detail.truck_no}</td>
                        <td>${detail.Qty}</td>
                        <td>${detail.unit_price}</td>
                        <td>${detail.truck_fee}</td>
                        <td>${detail.sub_total}</td>
                    </tr>`;
                    $('#productTable tbody').append(newRow);
                    total += subTotal;
                });

                $('#totalamountview').val(total.toFixed(2));
        },
        error: function(xhr, status, error) {
            console.error(error); // Log the error for debugging
        }
    });
});
</script>





