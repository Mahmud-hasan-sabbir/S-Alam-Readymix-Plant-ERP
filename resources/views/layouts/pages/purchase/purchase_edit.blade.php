<div class="modal fade bd-example-modal-lg-edit" id="editmodal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content" style="width: 1270px;margin-left:-60px">
            <div class="modal-header">
                <h5 class="modal-title">Purchase Order Edit</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <form class="form-valide" action="{{ route('update_purchase') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body py-2">
                    <div class="row" id="main-row-data">
                        <input type="hidden"  name="total_amount" id="totalAmountupdate">
                        <input type="hidden" name="hiddenid" id="hiddenid">
                        <div class="col-md-4">
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label">Order No : </label>
                                <div class="col-md-8">
                                    <input type="text" readonly id="orderNOeeee" name="po_no" class="form-control" style="border:none">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4" style="margin-left: -28px">
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label">Order Date : </label>
                                <div class="col-md-8">
                                    <input type="date" name="inv_date" id="inv_dateedit" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group row">
                                <label class="col-md-5 col-form-label">Supplier Name :<span class="text-danger">*</span></label>
                                <div class="col-md-7">
                                    <select name="supplier_id" id="supplierIdedit" class="form-control dropdwon_select" >
                                        @foreach($allSupplier as $row)
                                            <option value="{{ $row->id }}">{{ $row->company_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group row">
                                <label class="col-md-5 col-form-label">Category Name :
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="col-md-7">
                                    <select name="" id="categoryIdedit" class="form-control dropdwon_select" >
                                    <option selected disabled>--Select--</option>
                                    @foreach($allcategory as $row)
                                        <option value="{{ $row->id}}">{{ $row->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group row">
                                <label class="col-md-5 col-form-label">Materials Name :
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="col-md-7">
                                    <select name="" id="materialIdedit" class="form-control dropdwon_select" >

                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group row">
                                <label class="col-md-5 col-form-label">Store Name :
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="col-md-7">
                                    <select name="store_id" id="storeIdedit" class="form-control dropdwon_select" >
                                        <option selected disabled>--Select--</option>
                                        @foreach ($allstoreName as $row)
                                            <option value="{{$row->id}}">{{$row->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="" class="col-md-2">Remarks :</label>
                                <div class="col-md-10">
                                    <textarea name="remarks" id="remarksedit" cols="30" rows="2" class="form-control" style="width: 95%; margin-left: 32px;"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group row">
                                <label class="col-md-5 col-form-label">Unit Name :
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="col-md-7">
                                    <select name="unit_id" id="unitIdedit" class="form-control dropdwon_select" >
                                        <option selected disabled>--Select--</option>
                                        @foreach ($allunit as $row)
                                            <option value="{{$row->id}}">{{$row->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group row">
                                <div style="margin-left:80px;margin-top:8px">
                                    <button type='button' class="btn btn-sm btn-primary add_row_edit"><i class="fa fa-plus"></i><span class="btn-icon-add"></span>Add More</button>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row mt-3">
                        <div class="col-md-12">

                            <table class="table table-bordered" id="productTableedit">
                                <thead>
                                    <tr>
                                        <th>Category</th>
                                        <th>Product</th>
                                        <th>Store</th>
                                        <th>Unit</th>
                                        <th>Challan No</th>
                                        <th>Truck No</th>
                                        <th>Quantity</th>
                                        <th>Unit Price</th>
                                        <th>Truck Fee</th>
                                        <th>Total</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- New rows will be appended here -->
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-12">
                            <div class="float-right" id="totaledit">
                                <h6 style="margin-left: -125px">Total amount</h6>
                                <input type="text" style="margin-top: -35px" class="form-control totaledit" readonly>
                            </div>
                        </div>
                        <div class="col-md-12" style="margin-top: 15px">
                            <div class="float-right" id="discount-container">
                                <h6 style="margin-left: -125px">Discount</h6>
                                <input type="text" style="margin-top: -35px" name="discount" id="discount" class="form-control discount" placeholder="0.00">
                            </div>
                        </div>
                        <div class="col-md-12" style="margin-top: 15px">
                            <div class="float-right" id="netamount">
                                <h6 style="margin-left: -125px">Net amount</h6>
                                <input type="text" style="margin-top: -35px" name="netamount" id="netamont" class="form-control netamount" placeholder="0.00" readonly>
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

<script>
   $(document).on('click', '.edit', function() {
    var id = $(this).data('id');
    $.ajax({
        url: '{{ route('purchase_edit') }}',
        method: 'GET',
        dataType: "JSON",
        data: { id: id },
        success: function(data) {
            $('#editmodal').modal('show');
            $('#orderNOeeee').val(data.purchaseEdit.PO_No);
            $('#hiddenid').val(data.purchaseEdit.id);
            $('#inv_dateedit').val(data.purchaseEdit.order_date);
            $('#supplierIdedit').val(data.purchaseEdit.supplier_id);
            $('#remarksedit').val(data.purchaseEdit.remarks);
            $('#productTableedit tbody').empty();

            $('.discount').val(data.purchaseEdit.discount);

            var total = 0;
            data.purchaseDetails.forEach(function(detail) {

                // Parse sub_total to ensure it's a number
                var subTotal = parseFloat(detail.sub_total) || 0;

                var newRow = `
                    <tr>
                        <td><input type="hidden" name="category_id[]" value="${detail.category.id}">${detail.category.name}</td>
                        <td><input type="hidden" name="material_id[]" value="${detail.material.id}">${detail.material.name}</td>
                        <td><input type="hidden" name="store_id[]" value="${detail.store.id}">${detail.store.name}</td>
                        <td><input type="hidden" name="unit_id[]" value="${detail.unit.id}">${detail.unit.name}</td>
                        <td><input class="form-control mb-4 mb-md-0 challan_no" value="${detail.challan_no}" name="challan_no[]"></td>
                        <td><input class="form-control mb-4 mb-md-0 truck_no" value="${detail.truck_no}" name="truck_no[]"></td>
                        <td><input class="form-control mb-4 mb-md-0 quantityedit" value="${detail.Qty}" name="quantityedit[]"></td>
                        <td><input class="form-control mb-4 mb-md-0 unit_price_edit" value="${detail.unit_price}" name="unit_price_edit[]"></td>
                        <td><input class="form-control mb-4 mb-md-0 truckfeeedit" value="${detail.truck_fee}" name="truckfeeedit[]"></td>
                        <td><input class="form-control mb-4 mb-md-0 sub_totaledit" value="${subTotal.toFixed(2)}" name="sub_totaledit[]" readonly></td>
                        <td><button type="button" class="removeeventmore btn btn-icon btn-outline-danger btn-xs border-0 mr-2" title="Remove"><span class='fa fa-trash'></span></button></td>
                    </tr>`;
                $('#productTableedit tbody').append(newRow);

                total += subTotal; // Accumulate the total
            });

            var netamont = total - data.purchaseEdit.discount;
            $('.netamount').val(netamont.toFixed(2));

            // Update the total fields with the calculated total
            $('.totaledit').val(total.toFixed(2));
            $('#totalAmountupdate').val(netamont.toFixed(2));
        }
    });
});

$(document).on('click', '.add_row_edit', function() {

    var categoryId = $('#categoryIdedit').val();
    var categorySelected = $('#categoryIdedit option:selected').text();
    var materialId = $('#materialIdedit').val();
    var materialSelected = $('#materialIdedit option:selected').text();
    var storeId = $('#storeIdedit').val();
    var storeSelected = $('#storeIdedit option:selected').text();
    var unitId = $('#unitIdedit').val();
    var unitSelected = $('#unitIdedit option:selected').text();

    if (categoryId && materialId && storeId && unitId) {
        var newRow = `
        <tr>

            <td><input type="hidden" name="category_id[]" value="${categoryId}">${categorySelected}</td>
            <td><input type="hidden" name="material_id[]" value="${materialId}">${materialSelected}</td>
            <td><input type="hidden" name="store_id[]" value="${storeId}">${storeSelected}</td>
            <td><input type="hidden" name="unit_id[]" value="${unitId}">${unitSelected}</td>
            <td><input class="form-control mb-4 mb-md-0 challan_no" required name="challan_no[]"></td>
            <td><input class="form-control mb-4 mb-md-0 truck_no" required name="truck_no[]"></td>
            <td><input class="form-control mb-4 mb-md-0 quantityedit" required name="quantityedit[]"></td>
            <td><input class="form-control mb-4 mb-md-0 unit_price_edit" required name="unit_price_edit[]"></td>
            <td><input class="form-control mb-4 mb-md-0 truckfeeedit" name="truckfeeedit[]"></td>
            <td><input class="form-control mb-4 mb-md-0 sub_totaledit" name="sub_totaledit[]" readonly></td>
            <td><button type="button" class="removeeventmore btn btn-icon btn-outline-danger btn-xs border-0 mr-2" title="Remove"><span class='fa fa-trash'></span></button></td>
        </tr>`;
        $('#productTableedit tbody').append(newRow);
        calculateSubtotalAndTotal();
    } else {
        Swal.fire({
            icon: 'error',
            title: 'Missing Data',
            text: 'Please ensure all fields are selected before adding a new row.'
        });
    }
});

$(document).on('click', '.removeeventmore', function() {
    $(this).closest('tr').remove();
    calculateSubtotalAndTotal();
});

function calculateSubtotalAndTotal() {
    var total = 0;
    var netAmount = parseFloat($('#netamont').val()) || 0; // Get the initial net amount or default to 0

    $('#productTableedit tbody tr').each(function() {
        var quantity = parseFloat($(this).find('.quantityedit').val()) || 0; // Get quantity or default to 0
        var tonconv = quantity / 1000; // Convert quantity to tons
        var unitPrice = parseFloat($(this).find('.unit_price_edit').val()) || 0; // Get unit price or default to 0
        var truckFee = parseFloat($(this).find('.truckfeeedit').val()) || 0; // Get truck fee or default to 0

        var subtotal = (tonconv * unitPrice) - truckFee; // Calculate subtotal
        $(this).find('.sub_totaledit').val(subtotal.toFixed(2)); // Update the subtotal input field

        total += subtotal; // Sum all the subtotals
    });


    var discount = $('.discount').val() || 0;
    netAmount = total - discount;

    // Update the total display
    $('#totaledit').empty();
    $('#netamount').empty();

    var netamontfield = '<div class="float-right">' +
                        '<h6 style="margin-left: -125px;">Net amount</h6>' +
                        '<input type="text" style="margin-top: -35px;" class="form-control netamount" value="' + netAmount.toFixed(2) + '" readonly>' +
                        '</div>';
    $('#netamount').append(netamontfield);

    var inputField = '<div class="float-right">' +
                     '<h6 style="margin-left: -125px;">Total amount</h6>' +
                     '<input type="text" style="margin-top: -35px;" class="form-control totaledit" value="' + total.toFixed(2) + '" readonly>' +
                     '</div>';
    $('#totaledit').append(inputField);

    // Set the total amount in a hidden input (if needed)
    $('#totalAmountupdate').val(netAmount.toFixed(2));
}




$(document).on('input', '.quantityedit, .unit_price_edit, .truckfeeedit', function() {
    calculateSubtotalAndTotal();
});

$(document).on('input', '.discount', function() {

    calculateSubtotalAndTotal();
});

</script>



