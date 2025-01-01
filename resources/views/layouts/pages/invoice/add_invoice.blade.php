<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-primary">
                    <h4 class="card-title">All Invoice List</h4>

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
                                    <th>Date</th>
                                    <th>Customer Name</th>
                                    <th>Invoice No</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($allinvoice as $item )
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ date('d-m-y', strtotime($item->date)) }}</td>
                                        <td class="text-left">{{ $item->customerName->company_name }}</td>
                                        <td>{{ $item->inv_no }}</td>
                                        <td class="text-right">{{ $item->total_amount }}</td>
                                        <td>
                                    @if($item->status == 0) 
                                    <span class="badge light badge-danger">Pending</span>
                                    @elseif($item->status == 1)
                                    <span class="badge light badge-success">Success</span>
                                    @elseif($item->status == 2)
                                    <span class="badge light badge-error">Cancaled</span>
                                    @endif
                                        </td>

                                        <td>
                                            @if($item->status == 0)
                                            <a href="{{ route('invoice_edit',$item->id) }}" class="btn btn-primary light">
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                            @endif

                                            <button class="btn btn-success light view" data-id="{{ $item->id }}">
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


      <!-- create modal open -->

      <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title">Create Invoice</h5>
                    <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span></button>
                </div>

                <form class="form-valide" action="{{ route('store_invoice') }}" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
                    @csrf
                    <div class="modal-body py-2">
                        <div class="row" id="main-row-data">
                            <input type="hidden" name="total_amount_hidden" id="total_amount_hidden">
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inv_no" class="form-label">Invoice No.</label>
                                    <input type="text" readonly id="inv_no" name="inv_no" value="{{ $inv_codes }}"  class="form-control">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inv_date" class="form-label">Date</label>
                                    <input type="date" name="inv_date" id="inv_date" class="form-control" value="{{ old('date') ? old('date') : date('Y-m-d') }}" required>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Customer Name <span class="text-danger">*</span></label>
                                    <select name="customer_id" id="customerid" class="form-control dropdwon_select" required>
                                        <option selected disabled>Select Customer</option>
                                        @foreach($customer as $row)
                                            <option value="{{ $row->id }}">{{ $row->company_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="gradeid" class="form-label">Grade Name<span class="text-danger">*</span></label>
                                    <select name="grade_id" id="gradeid" class="form-control dropdwon_select" required>
                                        <option selected disabled>Select Grade</option>
                                        @foreach($allgrade as $row)
                                            <option value="{{ $row->id }}">{{ $row->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <button type='button' class="btn btn-sm btn-primary add_row" style="margin-top: 32px;">
                                        <i class="fa fa-plus"></i><span class="btn-icon-add"></span>Add More
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-12">
                                <table class="table table table-striped table-bordered" id="productTable">
                                    <thead class="table-head">
                                        <tr>
                                            <th>Grade</th>
                                            <th>Location</th>
                                            <th>Quantity</th>
                                            <th>Quantity (CFT)</th>
                                            <th>Unit price</th>
                                            <th>Service Charge</th>
                                            <th>Total Amount</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- New rows will be appended here -->
                                    </tbody>
                                </table>
                            </div> 

                            <div class="col-md-12">
                                <div class="float-right">
                                    <h6>Total <span class="form-total" id="total_amount">0.00</span></h6>
                                </div>
                            </div>

                            <!-- <div class="col-md-12">
                                <div class="form-group">
                                    <label for="remarks" class="form-label">Remarks</label>
                                    <textarea name="remarks" id="remarks" cols="30" rows="3" class="form-control" placeholder="Note"></textarea>
                                </div>
                            </div> -->
                        </div>

                    </div>
                    <div class="modal-footer" style="height:50px">
                        <button type="submit" class="btn btn-sm btn-primary submit_btn">Submit</button>
                    </div>
                </form>

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
                                    <label class="form-label">Invoice No.</label>
                                    <input type="text" id="ordernoview" name="po_no" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Date : </label>
                                    <input type="date" readonly name="inv_date" id="inv_dateview" class="form-control">
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


                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-bordered table-striped table-hover" id="productTable">
                                    <thead>
                                        <tr>
                                            <th>Grade</th>
                                            <th>Location</th>
                                            <th>Quantity (M3)</th>
                                            <th>Quantity(CFT)</th>
                                            <th>Unit price(CFT)</th>
                                            <th>Service Search</th>
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
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-danger light" data-dismiss="modal">Close</button>

                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>


<script id="document-template" type="text/x-handlebars-template">
    <tr class="delete_row" id="delete_row">

        <td>
            <input type="hidden" name="grade_id[]" value="@{{grade_id}}">
            @{{ grade_name }}
        </td>

        <td>
            <div class="input-group">
                <input class="form-control mb-4 mb-md-0" name="location[]" autofocus>
            </div>
        </td>

        <td>
            <div class="input-group">
                <input type="text" class="form-control mb-4 mb-md-0 qtym3" name="qty_m3[]" required>
            </div>
        </td>

        <td>
            <div class="input-group">
                <input type="text" class="form-control mb-4 mb-md-0 qtycft" id="qtycft" readonly style="text-align: right;" name="qty_cft[]" value="" autocomplete="off">
            </div>
        </td>

        <td>
            <div class="input-group">
                <input required class="form-control mb-4 mb-md-0 unit_pricecft" style="text-align: right;" name="unit_price_cft[]" value="" autocomplete="off">
            </div>
        </td>
        <td>
            <div class="input-group">
                <input  class="form-control mb-4 mb-md-0 service_price" style="text-align: right;" name="service_price_cft[]" value="" autocomplete="off">
            </div>
        </td>

        <td>
            <div class="input-group">
                <input class="form-control mb-4 mb-md-0 sub_total" readonly style="text-align: right;" name="sub_total[]" value="" autocomplete="off">
            </div>
        </td>

        <td>
            <button type="button" class=" removeeventmore btn btn-primary light me-2 px-3" data-bs-toggle="tooltip" data-bs-placement="right" title="Delete"> <span class='fa fa-trash'></span></button>
        </td>
    </tr>
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.7.7/handlebars.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        $('.add_row').click(function() {

            var gradeid = $('#gradeid').val();
            var gradeidselected = $('#gradeid option:selected').text();
            var customerid = $('#customerid').val();



            if (customerid && gradeid) {
                var source = $("#document-template").html();
                var template = Handlebars.compile(source);

                var context = {
                    grade_id: gradeid,
                    grade_name: gradeidselected,
                };

                var html = template(context);
                $('#productTable tbody').append(html);
            } else {
                if (!customerid) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Missing Data',
                        text: 'Please select a customer name before adding a new row.'
                    });
                } else if (!gradeid) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Missing Data',
                        text: 'Please select a grade name before adding a new row.'
                    });
                }
            }
        });

        $(document).on('click', '.removeeventmore', function(event) {
            $(this).closest('.delete_row').remove();
            totalAmountPrice();
        });
    });

</script>


{{-- <script>
    $(document).on('input','.qtym3,.unit_pricecft', function(){
            var qty_m3 = $(this).closest("tr").find("input.qtym3").val();
            var qtycft = qty_m3 * 35.315;
            var unit_pricecft =  $(this).closest("tr").find("input.unit_pricecft").val();
            var unitpricecft =  qtycft * unit_pricecft;



            $(this).closest("tr").find("input.qtycft").val(qtycft.toFixed(2));
            $(this).closest("tr").find("input.sub_total").val(formatNumber(unitpricecft.toFixed(2)));
            totalAmountPrice();
    });



    function formatNumber(num) {
    return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

function totalAmountPrice() {
    var sum = 0;

    $(".sub_total").each(function() {
        var value = $(this).val().replace(/,/g, '');

        if (!isNaN(value) && value.length != 0) {
            sum += parseFloat(value);
        }
    });

    var sumDecimal = sum.toFixed(2).split('.')[1];
    if (parseInt(sumDecimal) >= 50) {
        sum = Math.ceil(sum);
    } else {
        sum = Math.floor(sum);
    }

    var formattedSum = formatNumber(sum);

    $('#total_amount').text(formattedSum);
    $('#total_amount_hidden').val(formattedSum);
}
</script> --}}

<script>
    $(document).on('input', '.qtym3, .unit_pricecft, .service_price', function () {
        var $row = $(this).closest("tr");
        var qty_m3 = parseFloat($row.find("input.qtym3").val()) || 0;
        var unit_pricecft = parseFloat($row.find("input.unit_pricecft").val()) || 0;
        var qtycft = qty_m3 * 35.315; // Conversion from M3 to CFT
        var service_price = parseFloat($row.find("input.service_price").val()) || 0;

        // Calculate subtotal based on qty and unit price
        var subtotal = qtycft * unit_pricecft;

        // If service price is entered, add it to the subtotal
        subtotal += service_price;

        $row.find("input.qtycft").val(qtycft.toFixed(2));
        $row.find("input.sub_total").val(formatNumber(subtotal.toFixed(2)));

        totalAmountPrice();
    });

    function formatNumber(num) {
        return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    function totalAmountPrice() {
        var sum = 0;

        $(".sub_total").each(function () {
            var value = $(this).val().replace(/,/g, '');

            if (!isNaN(value) && value.length != 0) {
                sum += parseFloat(value);
            }
        });

        var sumDecimal = sum.toFixed(2).split('.')[1];
        if (parseInt(sumDecimal) >= 50) {
            sum = Math.ceil(sum);
        } else {
            sum = Math.floor(sum);
        }

        var formattedSum = formatNumber(sum.toFixed(2));

        $('#total_amount').text(formattedSum);
        $('#total_amount_hidden').val(formattedSum);
    }
</script>




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
                       <td>${detail.grade.name}</td>
                       <td>${detail.location}</td>
                       <td>${detail.qty_m3}</td>
                       <td>${detail.qty_cft}</td>
                       <td>
                           ${detail.unit_price_cft}

                       </td>
                        <td>
                           ${detail.service_search}

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

<script>
    function validateForm() {
        // Check for required select inputs
        let customerid = document.getElementById('customerid').value;
        let gradeid = document.getElementById('gradeid').value;
        let invDate = document.getElementById('inv_date').value;

        if (!customerid || !gradeid || !invDate) {
            alert("Please fill all required fields.");
            return false;
        }

        // Check if any rows are added in the product table
        let rows = document.querySelectorAll("#productTable tbody tr");
        if (rows.length === 0) {
            alert("Please add all input field value.");
            return false;
        }

        return true;
    }
</script>





