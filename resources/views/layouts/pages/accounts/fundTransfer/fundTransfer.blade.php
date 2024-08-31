<x-app-layout>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <!-- card header -->
                <div class="card-header">
                    <h4 class="card-title">
                      Fund Transfer
                    </h4>
                    <a href="" class="btn btn-sm btn-primary"><i class="fa fa-reply"></i><span class="btn-icon-add"></span>Back</a>
                </div>
                <!-- card body -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12" style="">
                                <div class="form-validation">
                                    
                                    <form action="{{ route('store_fund_transfer') }}" method="POST" enctype="multipart/form-data" data-parsley-validate class="form-horizontal form-label-left" onsubmit="return validateForm()">
                                        @csrf
                                        
                                        <div class="row mt-3">
                                            <div class="col-md-12">
                                                <table id="audit-design-matrix-table" class="table table-bordered" style="width: 100%">
                                                    <thead class="thead-light" style="">
                                                    <tr>
                                                        <th width="25%" style="text-transform: capitalize">Trans Name</th>
                                                        <th width="25%" style="text-transform: capitalize">Amount</th>
                                                        <th width="17%" style="text-transform: capitalize">Debit</th>
                                                        <th width="17%" style="text-transform: capitalize">Credit</th>
                                                        <th width="15%" style="text-transform: capitalize">Action
                                                            <button type="button"  title="Add"
                                                                    onclick=""
                                                                    class="btn btn-icon btn-outline-warning border-0 btn-xs mr-2 add_row">
                                                                    <span class="fa fa-plus"></span>
                                                            </button>
                                                        </th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr class="audit_design_matrix_row addr" >
                                                           
                                                            <input type="hidden" style="border-radius: 30px" class="form-control" name="data[1][date]" value="{{ now()->format('Y-m-d') }}">
                                                            <td style="border: 0px">
                                                                <select name="data[1][trans_name]" style="border-radius: 30px" id="accountId" class="form-control " required>
                                                                    <option value="" selected disabled> select head name </option>
                                                                    <option value="Cash">Cash</option>
                                                                    @foreach ($allbankName as $data)
                                                                         <option value="{{ $data->id }}">{{ $data->bank_name }}</option>
                                                                    @endforeach
                                                               </select>
                                                            </td >

                                                            <td>
                                                                <input type="number" style="border-radius: 30px" readonly  name="" id="totalAmount" class="form-control expected_benefits" >
                                                            </td>

                                                           
                                                            <td>
                                                                <input type="number" style="border-radius: 30px" name="data[1][debit]" id="amount"   class="form-control amount" >
                                                            </td>
                                                            <td>
                                                                <input type="number" style="border-radius: 30px" name="data[1][credit]" id="amount"   class="form-control credit" >

                                                            </td>
                                                             <td>
                                                                <div style="display: flex">
                                                                    <button id="add_row" type="button" title="Add"
                                                                            onclick=""
                                                                            class="btn btn-icon btn-outline-warning border-0 btn-xs mr-2 add_row">
                                                                        <span class="fa fa-plus"></span>
                                                                    </button>

                                                                    <button type='button' title="Remove"
                                                                            data-row='row1'
                                                                            onclick=""
                                                                            class='btn btn-icon btn-outline-danger btn-xs border-0 mr-2 delete_row'>
                                                                        <span class='fa fa-trash'></span>
                                                                    </button>
                                                                </div>
                                                            </td>
                                                        </tr>

                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="col-md-12">
                                                <table id="" class=" " style="width: 100% ;">
                                                    <thead class="" style="position: sticky; z-index: 10;">
                                                        <tr>
                                                            <th width="25%"  ></th>
                                                            <th width="25%" ></th>
                                                            <th width="17%" ></th>
                                                            <th width="17%" ></th>
                                                            <th width="15%" >
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                        <tr class=" addr" >

                                                            <td style="border-top:1px solid; border-right:0px solid; border-bottom:1px solid">

                                                            </td>

                                                            <td style="border-top:1px solid; border-right:0px solid; border-bottom:1px solid;padding-top:6px;padding-bottom:6px">
                                                                <h6 style="font-weight: bold;padding:0px;margin:0px">Total:</h6>
                                                            </td>
                                                            <td style="border-top:1px solid; border-right:0px solid; border-bottom:1px solid">
                                                                <h6 style="font-weight: bold;padding:0px;margin:0px" id="total_amount_debit">0.00</h6>
                                                            </td>
                                                            <td style="border-top:1px solid; border-left:0px solid; border-bottom:1px solid">
                                                                <h6 style="font-weight: bold;padding:0px;margin:0px" id="total_amount_credit">0.00</h6>
                                                            </td>
                                                             <td style="border-top:1px solid; border-left:0px solid; border-bottom:1px solid">

                                                            </td>
                                                        </tr>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        <div class="row mt-4">
                                            <div class="col-md-4"></div>
                                            <div class="col-md-4"></div>
                                            <div class="col-md-4">
                                                <div style="margin-left: 165px; width:100px">
                                                    {{-- <button type="submit" style="border-radius: 30px;width:100%" class="btn btn-success btn-sm"><span style="font-size: 17px">Save</span></button> --}}
                                                    <button id="saveButton" type="submit" style="border-radius: 30px;width:100%" class="btn btn-success btn-sm"><span style="font-size: 17px">Save</span></button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    @if (Session::has('success'))
        <script>
            toastr.success("Contra Voucher  save successfully");
        </script>

    @endif
</x-app-layout>

<script>
    var count = 2;
    $("#audit-design-matrix-table").on("click", ".add_row", function() {
        var i = count;
        count++;
        $('#audit-design-matrix-table > tbody:last').append(
        `<tr class="audit_design_matrix_row">
          
            <input type="hidden" style="border-radius: 30px" class="form-control" name="data[${i}][date]" value="{{ now()->format('Y-m-d') }}">
           
            <td>
                <select name="data[${i}][trans_name]" style="border-radius: 30px" id="accountId" class="form-control " required>
                    <option value="" selected disabled> select head name </option>
                    <option value="Cash">Cash</option>
                    @foreach ($allbankName as $data)
                    <option value="{{ $data->id }}">{{ $data->bank_name }}</option>
                    @endforeach
                </select>
            </td>

            <td>
                <input type="number" style="border-radius: 30px" readonly  name="" id="totalAmount" class="form-control expected_benefits" >
            </td>
           
            <td>
                <input type="number" style="border-radius: 30px" name="data[${i}][debit]" id="" class="form-control amount" >
            </td>
            <td>
                <input type="number" style="border-radius: 30px" name="data[${i}][credit]" id="" class="form-control credit" >

            </td>
        <td>
            <div style="display: flex">
                    <button id="add_row" type="button" title="Add"
                onclick=""
                class="btn btn-icon btn-outline-warning border-0 btn-xs mr-2 add_row">
                 <span class="fa fa-plus"></span>
                 </button>

                <button type='button' title="Remove"
             data-row='row1'
                 onclick=""
                    class='btn btn-icon btn-outline-danger btn-xs border-0 mr-2 delete_row'>
                 <span class='fa fa-trash'></span>
                </button>
                </div>
         </td>
        </tr>`

    );
    });

    $("#audit-design-matrix-table").on("click", ".delete_row", function() {
        $(this).closest("tr").remove();
        // var currentRows = $(this).closest("tr");
        // curent_total = currentRows.find('.amount').val();
        // sum_all = $(this).find('#total_amount').val();
        // $(this).find('#total_amount').val(sum_all - curent_total);
        calc();
    });




    // dropdown select two js code

    $('.dropdwon_select').each(function () {
           $(this).select2({
               dropdownParent: $(this).parent()
           });
       });




   

    $(document).on('change','#accountId',function(){
        var id = $(this).val();
        var currentRow = $(this).closest("tr");

     $.ajax({
            url:'{{ route('get_currentaccount_balance') }}',
            method:'GET',
            dataType:"JSON",
            data:{'id':id},
            success:function(response){
                console.log(response);
                currentRow.find('#totalAmount').val(response.totalAmount);
            }
        });
 });

 // debit and credit sum and condition holo debit = credit hoy tahole button active

 $('#audit-design-matrix-table').on('keyup change', function () {
        calc();
    });

    $('.amount').on('keyup change', function (){
        calc();
    });

    $('.credit').on('keyup change', function () {
        calc();
    });

    function calc() {
        var totalDebit = 0;
        var totalCredit = 0;

        $('.audit_design_matrix_row').each(function (i, element) {
            var currentRow = $(this);
            var debit = currentRow.find('.amount').val();
            var credit = currentRow.find('.credit').val();

            if (!isNaN(debit) && debit !== '') {
                totalDebit += parseFloat(debit);
            }
            if (!isNaN(credit) && credit !== '') {
                totalCredit += parseFloat(credit);
            }
        });

        // Update the content of the h6 headings with the calculated totals
        $('#total_amount_debit').text(totalDebit.toFixed(2));
        $('#total_amount_credit').text(totalCredit.toFixed(2));

        // Check if the sums are equal, and enable/disable the button accordingly
        if (totalDebit === totalCredit) {
            $('#saveButton').prop('disabled', false); // Enable the button
        } else {
            $('#saveButton').prop('disabled', true); // Disable the button
        }
    }

</script>



<script>
    function toggleDebitCreditFields(triggeringInput) {
    var currentRow = triggeringInput.closest('.audit_design_matrix_row');
    var debitInput = currentRow.find('.amount');
    var creditInput = currentRow.find('.credit');

    if (triggeringInput.hasClass('amount') && triggeringInput.val() !== '') {
        debitInput.show();
        creditInput.hide();
    } else if (triggeringInput.hasClass('credit') && triggeringInput.val() !== '') {
        debitInput.hide();
        creditInput.show();
    } else {
        // If neither debit nor credit has a value, show both fields
        debitInput.show();
        creditInput.show();
    }
}

$('#audit-design-matrix-table').on('keyup change', '.amount', function () {
    toggleDebitCreditFields($(this));
});

$('#audit-design-matrix-table').on('keyup change', '.credit', function () {
    toggleDebitCreditFields($(this));
});
</script>

<script>
    function validateForm() {
        var selectElements = document.getElementsByClassName('accountId');
        var headName1 = selectElements[0].value;
        var headName2 = selectElements[1].value;

        if (headName1 === headName2) {
            alert('Bank names cannot be the same.');
            return false; // Prevent form submission
        }

        return true; // Allow form submission
    }
</script>











