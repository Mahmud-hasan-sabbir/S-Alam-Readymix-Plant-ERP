<x-app-layout>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-primary">
                    <h4 class="card-title">Raw Invoice List</h4>

                    <button data-toggle="modal" data-target=".bd-example-modal-lg" class="btn btn-sm btn-success">
                        <i class="fa fa-plus"></i>
                        <span class="btn-icon-add"></span>Add New
                    </button>
                </div>

                <div class="card-body" id="reload">
                    <div class="table-responsive">
                        <table id="example3" class="display">
                            <thead>
                            <tr>
                                <th>SL.No</th>
                                <th>RI-NO</th>
                                <th>Date</th>
                                <th>Customer Name</th>
                                <th>Total Sale Amount</th>
                                <th>discount</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody id="purchase_tbody">
                                @foreach ($allrawinvoice as $key => $row)
                                <tr style="{{ $row->is_approve == 0 ? 'background-color: #cfad57 !important; color: black' : '' }}">
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $row->RI_No }}</td></td>
                                    <td>{{ date('d-m-y', strtotime($row->order_date)) }}
                                    <td>{{ $row->customer->company_name }}</td>

                                    <td>{{ number_format($row->Total_sale_amount) }}</td>
                                    <td>{{ number_format($row->discount) }}</td>
                                    <td>
                                        @if($row->is_approve == 1)
                                            <span class="badge light badge-success">Success</span>
                                        @elseif($row->is_approve == 0)
                                            <span class="badge light badge-primary">Pending</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($row->is_approve == 0)
                                        <button class="btn btn-info light delete" data-id="{{ $row->id }}">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                        @endif
                                        <button class="btn btn-success light view" data-id="{{ $row->id }}">
                                            <i class="fa-regular fa-eye"></i>
                                        </button>
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
    @include('layouts.pages.rawinvoice.rawinvoice_show')

    <!--=======//Modal Show Data Edit//========-->
    @include('layouts.pages.rawinvoice.rawinvoice_edit')

    <!-- view modal open-->
    @include('layouts.pages.rawinvoice.rawinvoice_view')

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

        <td><input type="hidden" name="stock_id[]" value="@{{stock_id}}">@{{stock_id}}</td>

        <td>
            <div class="input-group">
                <input class="form-control mb-4 mb-md-0 truck_no" required name="location[]">
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

var selectedStockValue = 0; // Store selected stock value

$(document).on('change', '#materialId', function() {
    var materialId = $(this).val();

    $.ajax({
        url: '{{ route('get_stock_value') }}',
        method: 'GET',
        dataType: 'JSON',
        data: { 'material_id': materialId },
        success: function(response) {
            selectedStockValue = response.stock_value ? response.stock_value : 0; // Store stock value
            $('#stockValue').text(selectedStockValue); // Show in UI
        }
    });
});



$(document).on('change', '#categoryIdedit', function() {
    var id = $(this).val();

    $.ajax({
        url: '',
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
            var materialId = $('#materialId').val();
            var materialSelected = $('#materialId option:selected').text();


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
                    unit_name: unitSelected,
                    stock_id: selectedStockValue,
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
    // Calculate subtotal when quantity or unit price is changed
    $(document).on('input', '.unit_price, .quantity', function() {
        var row = $(this).closest("tr");
        var unitName = row.find("td").eq(3).text().trim();
        var amount = parseFloat(row.find("input.unit_price").val()) || 0; // Unit Price
        var qty = parseFloat(row.find("input.quantity").val()) || 0; // Quantity
        var truckfee = parseFloat(row.find("input.truckfee").val()) || 0; // Truck Fee

        var subtotal = 0;

        // Calculation based on unit type
        if (['Kg', 'Pcs', 'Beg', 'Litter'].includes(unitName)) {
            subtotal = (qty * amount) - truckfee;
        } else {
            var qtyconton = qty / 1000; // Convert to tons
            subtotal = (qtyconton * amount) - truckfee;
        }

        // Update subtotal field
        row.find("input.subtotal").val(subtotal.toFixed(2));

        // Update total amount
        totalAmountPrice();
    });

    // Function to calculate total price including discount
    function totalAmountPrice() {
        var sum = 0;

        // Loop through all subtotal fields and sum the values
        $(".subtotal").each(function() {
            var value = parseFloat($(this).val()) || 0;
            sum += value;
        });

        var discount = parseFloat($('#discount').val()) || 0;
        var totalWithDiscount = sum - discount;

        // Update total fields
        $('#total').val(totalWithDiscount.toFixed(2));
        $('#netamount').val(totalWithDiscount.toFixed(2));
        $('#totaledit').val(totalWithDiscount);
        $('#total_amount').val(totalWithDiscount.toFixed(2));
    }

    // Event listener for discount input change
    $(document).on('input', '#discount', function() {
        totalAmountPrice();
    });
});

</script>



<script>
     $(document).on('click', '.view', function() {
        var id = $(this).data('id');

        $.ajax({
            url: '{{ route('rawinvoiceview') }}',
            method: 'GET',
            dataType: "JSON",
            data: {id: id},
            success: function(data) {

                $('#viewmodal').modal('show');
                $('#RI_No').val(data.rawinvoice.RI_No);
                $('#inv_dateview').val(data.rawinvoice.order_date);
                $('#supplierIdview').val(data.rawinvoice.customer_id);
                $('#totalview').val(data.rawinvoice.Total_sale_amount);
                $('#remarksview').val(data.rawinvoice.remarks);

                var discount = parseFloat(data.rawinvoice.discount) || 0;
                $('#discountview').val(discount.toFixed(2));



                // Clear the existing rows
                $('#productTable tbody').empty();

                var total = 0;

                data.invoicedetails.forEach(function(detail) {

                    var subTotal = parseFloat(detail.sub_total) || 0;
                    var newRow = `
                    <tr>
                        <td>${detail.category_name}</td>
                        <td>${detail.material_name}</td>
                        <td>${detail.store_name}</td>
                        <td>${detail.unit_name}</td>
                        <td>
                            ${detail.location}

                        </td>

                        <td>
                            ${detail.Qty}

                        </td>
                        <td>
                            ${detail.unit_price}

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

<script>
   $(document).on('click', '.delete', function() {
    var id = $(this).data('id');

    Swal.fire({
        title: 'Are you sure?',
        text: "You want to delete this data!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '{{ route('rawinvoicedelete') }}',
                method: 'GET',
                data: {id: id},
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            title: 'Deleted!',
                            text: 'Your file has been deleted.',
                            icon: 'success'
                        }).then(() => {
                            location.reload();
                        });
                    }
                }
            });
        }
    });
});


</script>











