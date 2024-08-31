{{-- @extends('admin.app')
@section('main_content')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script> --}}
<x-app-layout>
<div class="page-content">
	<div class="row">
		<div class="col-md-12 grid-margin stretch-card">
			<div class="card">
				<div class="card-header">
					<h6 class="card-title">
						Add Purchase
						<a href="" class="btn btn-inverse-primary float-end" data-bs-toggle="tooltip" data-bs-placement="left" title="Purchase List">
							<i class="fa-solid fa-list-ul"></i> View All
						</a>
					</h6>
				</div>

				<div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-4 form-group">
                            <label for="purchase_no" class="form-label">Purchase No. <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="purchase_no" value="" id="purchase_no" readonly>
                        </div>

                        <div class="col-md-4 form-group">
                            <label for="date"  class="form-label">Purchase Date</label>
                            <div class="input-group flatpickr" id="flatpickr-date">
								<input type="text" name="date" id="date" value="" class="form-control" placeholder="Select date" data-input>
								<span class="input-group-text input-group-addon" data-toggle><i data-feather="calendar"></i></span>
							</div>
                        </div>

                        <div class="col-md-4 form-group">
                            <label for="supplier_id" class="form-label">Supplier Name</label>
							<select name="supplier_id" id="supplier_id" class="js-example-basic-single form-select form-control" data-width="100%">
								<option value="">Select Supplier</option>
								@foreach($allSupplier as $row)
								<option value="{{ $row->id }}">{{ $row->Saller_name }}</option>
								@endforeach
							</select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4 form-group">
                            <label for="category_id" class="form-label">Category Name</label>
							<select name="category_id" id="category_id" class="js-example-basic-single form-select form-control" data-width="100%">
								<option value="">Select Category</option>
                                @foreach($allcategory as $row)
								<option value="{{ $row->id }}">{{ $row->name }}</option>
								@endforeach
							</select>
                        </div>

                        <div class="col-md-4 form-group">
                            <label for="product_id" class="form-label">Product Name</label>
							<select name="product_id" id="product_id" class="js-example-basic-single form-select form-control" data-width="100%">
								<option value="">Select Product</option>

							</select>
                        </div>

                        <div class="col-md-4 form-group">
                            <label for="product_id" class="form-label">&nbsp;</label>
							<button type="submit" class="btn btn-inverse-primary addEventMore" data-bs-toggle="tooltip" data-bs-placement="right" title="Add New Row" style="margin-top: 28px">+ Add More</button>
                        </div>
                    </div>

                    <form action="" method="POST" id="myForm">
                        @csrf

                        <table class="table table-striped table-bordered table-sm">
                            <thead>
                                <tr>
                                    <th>Category</th>
                                    <th>Product Name</th>
                                    <th>Challan No.</th>
                                    <th>Truck No.</th>
                                    <th>Quantity</th>
                                    <th>Unit Price</th>
                                    <th>Truck Fare</th>
                                    <th>Total Price</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody id="addRow" class="addRow">

                            </tbody>

                            <tbody>
                                <tr>
                                    <td colspan="6"></td>
                                    <td style="text-align: right; font-weight: bold;">Total</span></td>
                                    <td>
                                    	<div class="input-group">
											<span class="input-group-text">৳</span>
										  	<input class="form-control mb-4 mb-md-0 total" style="text-align: right;" name="total_amount" id="total_amount" value="0" readonly >
										</div>
                                    </td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>

                        <div class="form-group mt-3">
                            <button type="submit" class="btn btn-inverse-primary" data-bs-toggle="tooltip" data-bs-placement="right" title="Create New Purchase">Submit</button>
                        </div>
                    </form>
                </div> <!-- End Card Body -->
			</div>
		</div>
	</div>
</div>




<script id="document-template" type="text/x-handlebars-template">

<tr class="delete_row" id="delete_row">
    <input type="hidden" name="date[]" value="">
    <input type="hidden" name="purchase_no[]" value="">
    <input type="hidden" name="supplier_id[]" value="">

    <td>
        <input type="hidden" name="category_id[]" value="">

    </td>

     <td>
        <input type="hidden" name="product_id[]" value="">

    </td>

    <td>
		<div class="input-group">
			<span class="input-group-text"><i class="fa-solid fa-receipt"></i></span>
		  	<input class="form-control mb-4 mb-md-0 challan_no" name="challan_no[]" autofocus autocomplete="off">
		</div>
    </td>

    <td>
		<div class="input-group">
			<span class="input-group-text"><i class="fa-solid fa-truck-pickup"></i></span>
		  	<input class="form-control mb-4 mb-md-0 truck_no" name="truck_no[]">
		</div>
    </td>

    <td>
		<div class="input-group">
			<span class="input-group-text">kg</span>
		  	<input class="form-control mb-4 mb-md-0 quantity" style="text-align: right;" name="quantity[]" value="" autocomplete="off">
		</div>
    </td>

    <td>
		<div class="input-group">
			<span class="input-group-text">৳</span>
		  	<input class="form-control mb-4 mb-md-0 unit_price" style="text-align: right;" name="unit_price[]" value="" autocomplete="off">
		</div>
    </td>

    <td>
        <div class="input-group">
            <span class="input-group-text">৳</span>
            <input class="form-control mb-4 mb-md-0 fare" style="text-align: right;" name="fare[]" value="" autocomplete="off">
        </div>
    </td>

    <td>
		<div class="input-group">
			<span class="input-group-text">৳</span>
		  	<input class="form-control mb-4 mb-md-0 total" style="text-align: right;" name="total[]" value="0" readonly>
		</div>
    </td>

    <td>
    	<button type="button" class="btn btn-inverse-danger removeeventmore" data-bs-toggle="tooltip" data-bs-placement="right" title="Create New Purchase"><i class="fa-solid fa-xmark"></i></button>
    </td>
</tr>

</script>

<script type="text/javascript">
    $(document).ready(function(){
        $(document).on('click', '.addEventMore', function(){
            var date          = $('#date').val();
            var purchase_no   = $('#purchase_no').val();
            var supplier_id   = $('#supplier_id').val();
            var category_id   = $('#category_id').val();
            var category_name = $('#category_id').find('option:selected').text();
            var product_id    = $('#product_id').val();
            var product_name  = $('#product_id').find('option:selected').text();


            if(purchase_no == ''){
                $.notify("Purchase No is Required" ,  {globalPosition: 'top right', className:'error' });
                return false;
            }

            if(date == ''){
                $.notify("Date is Required" ,  {globalPosition: 'top right', className:'error' });
                return false;
            }

            if(supplier_id == ''){
                $.notify("Supplier is Required" ,  {globalPosition: 'top right', className:'error' });
                return false;
            }

            if(category_id == ''){
                $.notify("Category is Required" ,  {globalPosition: 'top right', className:'error' });
                return false;
            }

            if(product_id == ''){
                $.notify("Product Field is Required" ,  {globalPosition: 'top right', className:'error' });
                return false;
            }

            var source = $('#document-template').html();
            var template = Handlebars.compile(source);


            var data = {
                date:date,
                purchase_no:purchase_no,
                supplier_id:supplier_id,
                category_id:category_id,
                category_name:category_name,
                product_id:product_id,
                product_name:product_name
            };

            var html = template(data);
            $('#addRow').append(html);
        });

        $(document).on("click",".removeeventmore",function(event){
            $(this).closest(".delete_row").remove();
            totalAmountPrice();
        });


        $(document).on('keyup click','.unit_price,.quantity', function(){
            var unit_price = $(this).closest("tr").find("input.unit_price").val();
            var quantity = $(this).closest("tr").find("input.quantity").val();

            var total = unit_price * quantity;

            $(this).closest("tr").find("input.total").val(total);

            totalAmountPrice();
        });


        function totalAmountPrice(){
            var sum = 0;

            $(".total").each(function(){
                var value = $(this).val();

                if(!isNaN(value) && value.length != 0){
                    sum += parseFloat(value);
                }
            });

            $('#total_amount').val(sum);
        }


    });
</script>


<script>
    $(function(){
        $(document).on('change', '#supplier_id', function(){
            var supplier_id = $(this).val();

            $.ajax({
                url: "",
                type: "GET",
                data:{supplier_id:supplier_id},
                success:function(data){
                    var html = '<option value="">Select Category</option>';

                    $.each(data, function(key, v){
                        html+= '<option value="'+ v.category_id +'">'+ v.category.name +'</option>';
                    });

                    $('#category_id').html(html);
                }
            });
        });
    });
</script>

<script>
    $(function(){
        $(document).on('change', '#category_id', function(){
            var id = $(this).val();

            $.ajax({
                url: "{{ route('get_materials') }}",
                type: "GET",
                data: {id},
                success:function(response){
                    var product = $('#product_id');
                    product.append('<option value="">Select Product</option>');

                    $.each(response, function(key, value) {
                        product.append('<option value="' + value.id + '">' + value.name + '</option>');
                    });

                }
            });
        });
    });
</script>

<!-- Form Validation -->
<script type="text/javascript">
    $(document).ready(function (){
        $('#myForm').validate({
            rules: {
                quantity: {
                    required : true,
                },
                unit_price: {
                    required : true,
                },
            },

            messages :{
                quantity: {
                    required : 'Please Enter Quantity',
                },
                quantity: {
                    required : 'Please Enter Unit Price',
                },
            },

            errorElement : 'span',

            errorPlacement: function (error,element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },

            highlight : function(element, errorClass, validClass){
                $(element).addClass('is-invalid');
            },

            unhighlight : function(element, errorClass, validClass){
                $(element).removeClass('is-invalid');
            },
        });
    });

</script>
<!-- End Form Validation -->
</x-app-layout>
