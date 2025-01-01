<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                     Edit Invoice
                    </h4>
                    

                </div>
                <div class="card-body">
                    <form class="form-valide" action="{{ route('update_invoice',$findinvoice->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body py-2">
                            <div class="row" id="main-row-data">
                                <input type="hidden" name="total_amount_hidden" id="total_amount_hidden">
                                <div class="col-md-4">
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label">INV-No : </label>
                                        <div class="col-md-8">
                                            <input type="text" readonly id="orderNO" name="inv_no" value="{{ $findinvoice->inv_no }}"  class="form-control" style="border:none">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4" style="margin-left: -28px">
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label">INV-Date : </label>
                                        <div class="col-md-8">
                                            <input type="date" name="inv_date" id="inv_date" class="form-control" value="{{ $findinvoice->date }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group row">
                                        <label class="col-md-5 col-form-label">Customer Name :
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-md-7">
                                            <select name="customer_id" id="customerid" class="form-control dropdwon_select" required>
                                            <option selected disabled>--Select--</option>
                                            @foreach($customer as $row)
                                                <option value="{{ $row->id}}" {{ $row->id == $findinvoice->cus_id ? 'selected' : '' }}>{{ $row->company_name}}</option>
                                             @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="" class="col-md-2">Remarks :</label>
                                        <div class="col-md-10">
                                            <textarea name="remarks" id="remarks" cols="30" rows="2" class="form-control" style="width: 95%; margin-left: 32px;">{{ $findinvoice->description }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group row">
                                        <label class="col-md-5 col-form-label">Grade Name :
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-md-7">
                                            <select name="grade_id" id="gradeid" class="form-control dropdwon_select" required>
                                            <option selected disabled>--Select--</option>
                                            @foreach($allgrade as $row)
                                                <option value="{{ $row->id}}">{{ $row->name}}</option>
                                            @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>



                                <div class="col-md-2">
                                    <div class="form-group row">
                                        <div>
                                            <button type='button' class="btn btn-sm btn-primary add_row"><i class="fa fa-plus"></i><span class="btn-icon-add"></span>Add More</button>
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
                                                <th>Service Search</th>
                                                <th>Total Price</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($findinvoice->invdetail as $detail)

                                            <tr class="delete_row" id="delete_row">
                                                <td>
                                                    <select name="grade_id[]" style="border: none">
                                                        <option value="{{ $detail->grade->id }}">{{ $detail->grade->name }}</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <div class="input-group">
                                                        <input class="form-control mb-4 mb-md-0 challan_no" name="location[]" value="{{ $detail->location }}" autofocus autocomplete="off">
                                                    </div>

                                                </td>
                                                <td>
                                                    <div class="input-group">
                                                        {{-- <span class="input-group-text">m3</span> --}}
                                                        <input class="form-control mb-4 mb-md-0 qtym3" value="{{ $detail->qty_m3 }}" name="qty_m3[]">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="input-group">
                                                        {{-- <span class="input-group-text">QTY(CFT)</span> --}}
                                                        <input class="form-control mb-4 mb-md-0 qtycft" readonly value="{{ $detail->qty_cft }}" id="qtycft" readonly style="text-align: right;" name="qty_cft[]" value="" autocomplete="off">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="input-group">
                                                        {{-- <span class="input-group-text">৳</span> --}}
                                                        <input class="form-control mb-4 mb-md-0 unit_pricecft" value="{{ $detail->unit_price_cft }}" style="text-align: right;" name="unit_price_cft[]" value="" autocomplete="off">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="input-group">
                                                        {{-- <span class="input-group-text">৳</span> --}}
                                                        <input class="form-control mb-4 mb-md-0 service_price" value="{{ $detail->service_search }}" style="text-align: right;" name="service_price_cft[]" value="" autocomplete="off">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="input-group">

                                                        <input class="form-control mb-4 mb-md-0 sub_total" readonly name="sub_total[]" value="{{ $detail->sub_total }}" autofocus autocomplete="off">
                                                    </div>

                                                </td>
                                                <td>
                                                    <button type="button" class=" removeeventmore btn btn-icon btn-outline-danger btn-xs border-0 mr-2" data-bs-toggle="tooltip" data-bs-placement="right" title="Create New Purchase"> <span class='fa fa-trash'></span></button>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-12">
                                    <div class="float-right">
                                        <span style="margin-left: -90px"><b>Total:</b></span>
                                        {{-- <h6>Total <span style="border: 1px solid #2222; padding: 10px 40px; margin-left: 10px"> {{ $findinvoice->total_amount }}</span></h6> --}}
                                        <input type="text" class="form-control" style="margin-top: -27px" readonly name="total_amount_hidden" id="totaledit" value="{{ $findinvoice->total_amount }}">
                                    </div>
                                </div>


                            </div>

                        </div>
                        <div class="modal-footer" style="height:50px">
                            <button type="button" class="btn btn-sm btn-danger light" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-sm btn-primary submit_btn">Update</button>
                        </div>
                    </form>
                </div>
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

                <input class="form-control mb-4 mb-md-0" name="location[]" autofocus autocomplete="off">
            </div>
        </td>

        <td>
            <div class="input-group">
                {{-- <span class="input-group-text">m3</span> --}}
                <input class="form-control mb-4 mb-md-0 qtym3" name="qty_m3[]">
            </div>
        </td>

        <td>
            <div class="input-group">
                {{-- <span class="input-group-text">QTY(CFT)</span> --}}
                <input class="form-control mb-4 mb-md-0 qtycft" id="qtycft" readonly style="text-align: right;" name="qty_cft[]" value="" autocomplete="off">
            </div>
        </td>

        <td>
            <div class="input-group">
                {{-- <span class="input-group-text">৳</span> --}}
                <input class="form-control mb-4 mb-md-0 unit_pricecft" style="text-align: right;" name="unit_price_cft[]" value="" autocomplete="off">
            </div>
        </td>
        <td>
            <div class="input-group">
                {{-- <span class="input-group-text">৳</span> --}}
                <input class="form-control mb-4 mb-md-0 service_price" style="text-align: right;" name="service_price_cft[]" value="" autocomplete="off">
            </div>
        </td>

        <td>
            <div class="input-group">
                {{-- <span class="input-group-text">৳</span> --}}
                <input class="form-control mb-4 mb-md-0 sub_total" readonly style="text-align: right;" name="sub_total[]" value="" autocomplete="off">
            </div>
        </td>

        <td>
            <button type="button" class=" removeeventmore btn btn-icon btn-outline-danger btn-xs border-0 mr-2" data-bs-toggle="tooltip" data-bs-placement="right" title="Create New Purchase"> <span class='fa fa-trash'></span></button>
        </td>
    </tr>
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.7.7/handlebars.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
{{-- <script>
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
                editinvoice();
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
            editinvoice();

        });

    });

    function formatNumber(num) {
        return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }
    function editinvoice() {
        var total = 0;
        $('#productTable tbody tr').each(function() {
            var qty_m3 = parseFloat($(this).find('.qtym3').val()) || 0;
            var qtycft = qty_m3 * 35.315;
            var unit_pricecft = parseFloat($(this).find('.unit_pricecft').val()) || 0;
            var unitpricecft = qtycft * unit_pricecft;

            $(this).find("input.qtycft").val(qtycft.toFixed(2));
            $(this).find("input.sub_total").val(unitpricecft.toFixed(2));
            total += unitpricecft;
        });

        var totalDecimal = total.toFixed(2).split('.')[1];
        if (parseInt(totalDecimal) >= 50) {
            total = Math.ceil(total);
        } else {
            total = Math.floor(total);
        }

        var formattedSum = formatNumber(total);

        $('#totaledit').val(formattedSum);
        $('#total_amount_hidden').val(formattedSum);
    }
    $(document).on('input', '.qtym3, .unit_pricecft', function() {
        editinvoice();
    });




</script> --}}


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
                editinvoice();
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
            editinvoice();
        });

        // Update invoice calculations when any input changes
        $(document).on('input', '.qtym3, .unit_pricecft, .service_price', function() {
            editinvoice();
        });
    });

    function formatNumber(num) {
        return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    function editinvoice() {
        var total = 0;
        $('#productTable tbody tr').each(function() {
            var qty_m3 = parseFloat($(this).find('.qtym3').val()) || 0;
            var unit_pricecft = parseFloat($(this).find('.unit_pricecft').val()) || 0;
            var service_price = parseFloat($(this).find('.service_price').val()) || 0;
            var qtycft = qty_m3 * 35.315;
            var subtotal = (qtycft * unit_pricecft) + service_price;

            $(this).find("input.qtycft").val(qtycft.toFixed(2));
            $(this).find("input.sub_total").val(formatNumber(subtotal.toFixed(2)));

            total += subtotal; // Accumulate total amount
        });

        // Adjust total to be rounded up or down
        var totalDecimal = total.toFixed(2).split('.')[1];
        if (parseInt(totalDecimal) >= 50) {
            total = Math.ceil(total);
        } else {
            total = Math.floor(total);
        }

        var formattedSum = formatNumber(total);
        $('#totaledit').val(formattedSum);
        $('#total_amount_hidden').val(formattedSum);
    }
</script>










