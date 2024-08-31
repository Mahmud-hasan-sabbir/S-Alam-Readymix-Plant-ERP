<x-app-layout>
    <style>
        .text {
    background: #d7dae3 !important;
    border: 1px solid transparent !important;
    min-width: 50px !important;
    display: flex !important;
    justify-content: center !important;
    padding: 0.532rem 0.75rem !important;
}
    </style>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                       Purchase List
                    </h4>
                    <button data-toggle="modal" data-target=".bd-example-modal-lg" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i><span class="btn-icon-add"></span>Add New</button>
                </div>

                <div class="card-body" id="reload">
                    <div class="table-responsive">
                        <table id="example3" class="display " style="min-width: 845px">
                            <thead>
                            <tr>

                                <th>SL.No</th>
                                <th>Supplier Name</th>
                                <th>PO-No</th>
                                <th>Date</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Action</th>

                            </tr>
                            </thead>
                            <tbody id="purchase_tbody">
                                @foreach ($allPurchase as $key => $row)
                                <tr style="{{ $row->is_approve == 1 ? 'background-color: #cfad57 !important; color: black' : '' }}">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $row->supplierName->company_name }}</td>
                                    <td>{{ $row->PO_No }}</td>
                                    <td>{{ $row->order_date }}</td>
                                    <td>{{ $row->Total_purchase_amount }}</td>
                                    <td>{{ $row->status == 1 ? 'Pending': 'Success' }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-info edit" data-id="{{ $row->id }}"   style="{{ $row->is_approve == 1 ? 'display: none;' : '' }}">Edit</button>
                                        <button class="btn btn-sm btn-success view" data-id="{{ $row->id }}">View</button>
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
    <!--=======//Modal Show Data//========-->
    @include('layouts.pages.purchase.purchase_show')

    <!--=======//Modal Show Data Edit//========-->
    @include('layouts.pages.purchase.purchase_edit')

    <!-- view modal open-->
    @include('layouts.pages.purchase.purchase_view')

</x-app-layout>


<script id="document-template" type="text/x-handlebars-template">
    <tr class="delete_row" id="delete_row">

        <td>
            <input type="hidden" name="category_id[]" value="@{{category_id}}">
            @{{ category_name }}
        </td>

        <td>
            <input type="hidden" name="product_id[]" value="@{{product_id}}">
            @{{ product_name }}
        </td>
        <td>
            <input type="hidden" name="store_id[]" value="@{{store_id}}">
            @{{ store_name }}
        </td>
        <td>
            <input type="hidden" name="unit_id[]" value="@{{unit_id}}">
            @{{ unit_name }}
        </td>

        <td>
            <div class="input-group">

                <input class="form-control mb-4 mb-md-0 challan_no" required name="challan_no[]" autofocus autocomplete="off">
            </div>
        </td>

        <td>
            <div class="input-group">
                <input class="form-control mb-4 mb-md-0 truck_no" required name="truck_no[]">
            </div>
        </td>

        <td>
            <div class="input-group">

                <input class="form-control mb-4 mb-md-0 quantity" required style="text-align: right;" name="quantity[]" value="" autocomplete="off">
            </div>
        </td>

        <td>
            <div class="input-group">
                {{-- <span class="input-group-text">৳</span> --}}
                <input class="form-control mb-4 mb-md-0 unit_price" required style="text-align: right;" name="unit_price[]" value="" autocomplete="off">
            </div>
        </td>

        <td>
            <div class="input-group">
                {{-- <span class="input-group-text">৳</span> --}}
                <input class="form-control mb-4 mb-md-0 truckfee" style="text-align: right;" name="truck_fee[]" value="" autocomplete="off">
            </div>
        </td>

        <td>
            <div class="input-group">
                {{-- <span class="input-group-text">৳</span> --}}
                <input class="form-control mb-4 mb-md-0 subtotal" style="text-align: right;" name="sub_total[]" value="0" readonly>
            </div>
        </td>

        <td>
            <button type="button" class=" removeeventmore btn btn-icon btn-outline-danger btn-xs border-0 mr-2" data-bs-toggle="tooltip" data-bs-placement="right" title="Create New Purchase"> <span class='fa fa-trash'></span></button>
        </td>
    </tr>
</script>



<script>
     $(document).on('change', '#categoryId', function() {
    var id = $(this).val();

    $.ajax({
        url: '{{ route('get_materials') }}',
        method: 'GET',
        dataType: "JSON",
        data: {'id': id},
        success: function(response) {
            var materialId = $('#materialId');
            materialId.empty();
            materialId.append('<option selected disabled>--Select--</option>');
            $.each(response, function(key, value) {
                materialId.append('<option value="' + value.id + '">' + value.name + '</option>');
            });
        }
    });
});

$(document).on('change', '#categoryIdedit', function() {
    var id = $(this).val();

    $.ajax({
        url: '{{ route('get_materials') }}',
        method: 'GET',
        dataType: "JSON",
        data: {'id': id},
        success: function(response) {
            var materialId = $('#materialIdedit');
            materialId.empty();
            materialId.append('<option selected disabled>--Select--</option>');
            $.each(response, function(key, value) {
                materialId.append('<option value="' + value.id + '">' + value.name + '</option>');
            });
        }
    });
});
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.7.7/handlebars.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        $('.add_row').click(function() {
            var supplierId = $('#supplierId').val();

            var categoryId = $('#categoryId').val();
            var categorySelected = $('#categoryId option:selected').text();
            var materialId = $('#materialId').val();
            var materialSelected = $('#materialId option:selected').text();
            var storeId = $('#storeId').val();
            var storeSelected = $('#storeId option:selected').text();
            var unitId = $('#unitId').val();
            var unitSelected = $('#unitId option:selected').text();

            if (supplierId && categoryId && materialId && storeId && unitId) {
                var source = $("#document-template").html();
                var template = Handlebars.compile(source);

                var context = {
                    category_id: categoryId,
                    category_name: categorySelected,
                    product_id: materialId,
                    product_name: materialSelected,
                    store_id: storeId,
                    store_name: storeSelected,
                    unit_id: unitId,
                    unit_name: unitSelected
                };

                var html = template(context);
                $('#productTable tbody').append(html);
            } else {
                if (!supplierId) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Missing Data',
                        text: 'Please select a supplier name before adding a new row.'
                    });
                } else if (!categoryId) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Missing Data',
                        text: 'Please select a category name before adding a new row.'
                    });
                } else if (!materialId) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Missing Data',
                        text: 'Please select a material name before adding a new row.'
                    });
                } else if (!storeId) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Missing Data',
                        text: 'Please select a store name before adding a new row.'
                    });
                }else if (!unitId) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Missing Data',
                        text: 'Please select a unit name before adding a new row.'
                    });
                }
            }
        });

        $(document).on('click', '.removeeventmore', function(event) {
            $(this).closest('.delete_row').remove();
            totalAmountPrice();
        });
    });


    $(document).ready(function() {
    $(document).on('input', '.unit_price, .quantity, .truckfee', function() {
        var amount = $(this).closest("tr").find("input.unit_price").val();
        var qty = $(this).closest("tr").find("input.quantity").val();
        var qtyconton = qty / 1000; // Convert quantity to tons
        var truckfee = $(this).closest("tr").find("input.truckfee").val();
        var subtotal = (qtyconton * amount) - truckfee; // Calculate subtotal

        $(this).closest("tr").find("input.subtotal").val(subtotal.toFixed(2)); // Update subtotal
        totalAmountPrice(); // Update total and net amount
    });

    $(document).on('input', '#discount', function() {
        totalAmountPrice(); // Update total and net amount on discount change
    });

    function totalAmountPrice() {
        var sum = 0;

        // Sum all subtotals
        $(".subtotal").each(function() {
            var value = $(this).val();
            if (!isNaN(value) && value.length != 0) {
                sum += parseFloat(value);
            }
        });

        var discount = parseFloat($('#discount').val()) || 0;
        var totalWithDiscount = sum - discount;


        $('#total').val(totalWithDiscount.toFixed(2));
        $('#netamount').val(totalWithDiscount.toFixed(2));

        $('#totaledit').val(totalWithDiscount);
        $('#total_amount').val(totalWithDiscount.toFixed(2));
    }
});


</script>



<script>
     $(document).on('click', '.view', function() {
        var id = $(this).data('id');
        $.ajax({
            url: '{{ route('purchase_edit') }}',
            method: 'GET',
            dataType: "JSON",
            data: {id: id},
            success: function(data) {
                $('#viewmodal').modal('show');
                $('#ordernoview').val(data.purchaseEdit.PO_No);
                $('#inv_dateview').val(data.purchaseEdit.order_date);
                $('#supplierIdview').val(data.purchaseEdit.supplier_id);
                $('#totalview').val(data.purchaseEdit.Total_purchase_amount);
                $('#remarksview').val(data.purchaseEdit.remarks);

                var discount = parseFloat(data.purchaseEdit.discount) || 0;
                $('#discountview').val(discount.toFixed(2));



                // Clear the existing rows
                $('#productTable tbody').empty();

                var total = 0;

                // var total = data.purchaseDetails.sum('sub_total');

                // Loop through purchase details and append rows
                data.purchaseDetails.forEach(function(detail) {
                    var subTotal = parseFloat(detail.sub_total) || 0;
                    var newRow = `
                    <tr>
                        <td>${detail.category.name}</td>
                        <td>${detail.material.name}</td>
                        <td>${detail.store.name}</td>
                        <td>${detail.unit.name}</td>
                        <td>
                            ${detail.challan_no}

                        </td>
                        <td>
                            ${detail.truck_no}

                        </td>
                        <td>
                            ${detail.Qty}

                        </td>
                        <td>
                            ${detail.unit_price}

                        </td>
                        <td>
                            ${detail.truck_fee}

                        </td>
                        <td>
                            ${detail.sub_total}

                        </td>

                    </tr>`;
                    $('#productTable tbody').append(newRow);

                    total += subTotal;


                });

                $('#totalamountview').val(total.toFixed(2));





            }
        });
    });
</script>











