<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        COM-Expense
                    </h4>
                    <a href="" data-toggle="modal" data-target=".bd-example-modal-lg" class="btn btn-sm btn-success p-1 px-2">
                        <i class="fa fa-plus"></i><span class="btn-icon-add"></span>Create
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example3" class="display" style="min-width: 845px">
                            <thead>
                                <tr>
                                    <th>SL.NO</th>
                                    <th>Head Name</th>
                                    <th>Mode</th>
                                    <th>Date</th>
                                    <th>Amount</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($allexpense as $data )

                                <tr style="{{ $data->is_approve == 1 ? 'background-color: #cfad57 !important; color: black' : '' }}">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $data->expenseHead->name }}</td>
                                    <td>{{ $data->pay_mode }}</td>
                                    <td>{{ $data->pay_date }}</td>
                                    <td>{{ $data->pay_amount }}</td>
                                    <td>
                                        <div style="margin-left:-35px">
                                            <button type="button" {{ $data->is_approve == 1 ? 'disabled' : '' }} class="btn btn-sm btn-success p-1 px-2 edit" id="Edit" data-id="{{ $data->id }}" >Edit</button>
                                            <button type="button" class="btn btn-sm btn-danger p-1 px-2 view" id="view" data-id="{{ $data->id }}" >View</button>
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

    <!-- create modal open-->

    <div class="modal fade bd-example-modal-lg" id="" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        Create COM-Expense
                    </h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <form class="form-valide" action="{{ route('store_co_expense') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body py-2 px-4">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label for="" class="col-md-5">Head Name</label>
                                    <div class="col-md-7">
                                        <select name="head_id" required id="supplierId" class="form-control dropdwon_select">
                                            <option value="" selected disabled>Select a Head name</option>
                                            @foreach ($headname as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>

                                            @endforeach

                                        </select>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label for="" class="col-md-5"> Payment Reason</label>
                                    <div class="col-md-7">
                                        <select name="pay_reason" required id="" class="form-control">
                                            <option value="" @selected(true) @disabled(true)>Select a payment reason</option>
                                            <option value="Office Expense">Office Expense</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                              <div class="form-group row">
                                <label for="" class="col-md-5"> Pay Mode</label>
                                <div class="col-md-7">
                                  <select name="pay_mode" id="paymentMode" required class="form-control" onchange="toggleFields()">
                                    <option value="" selected disabled>Select a Pay Mode</option>
                                    <option value="Cash">Cash</option>
                                    <option value="Bank">Bank</option>
                                  </select>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="row" id="cashaccountidrow" style="display: none">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label for="" class="col-md-5">Cash Total Amount</label>
                                    <div class="col-md-7">
                                        <input type="text" readonly id="cashtotalamount" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                          <div class="row" >
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label for="" class="col-md-5"> Pay Date</label>
                                    <div class="col-md-7">
                                        <input type="date" value="{{ now()->format('Y-m-d') }}" name="pay_date" id="" class="form-control" >
                                    </div>
                                </div>
                            </div>
                        </div>
                          <div class="row" id="bankNameRow" style="display: none">
                            <div class="col-md-12">
                              <div class="form-group row">
                                <label for="" class="col-md-5">Bank Name</label>
                                <div class="col-md-7">
                                    <select name="bank_name"  id="bankName" class="form-control">
                                        <option value="" selected disabled>Select a Bank Name</option>
                                        @foreach ($allbankName as $item)
                                            <option value="{{ $item->id }}">{{ $item->bank_name }}</option>

                                        @endforeach
                                    </select>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="row" id="bankaccountidrow" style="display: none">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label for="" class="col-md-5">Bank Total Amount</label>
                                    <div class="col-md-7">
                                        <input type="text" readonly id="banktotalamount" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                          <div class="row" id="checkNumberRow" style="display: none">
                            <div class="col-md-12">
                              <div class="form-group row">
                                <label for="" class="col-md-5"> Check Number</label>
                                <div class="col-md-7">
                                  <input type="text" name="check_num" readonly id="checkNumber" class="form-control" placeholder="Enter Check Number">
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="row" id="checkDateRow" style="display: none">
                            <div class="col-md-12">
                              <div class="form-group row">
                                <label for="" class="col-md-5"> Check issu Date</label>
                                <div class="col-md-7">
                                  <input type="date"  name="check_date" id="checkDate" class="form-control">
                                </div>
                              </div>
                            </div>
                          </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label for="" class="col-md-5"> Payment Amount</label>
                                    <div class="col-md-7">
                                        <input type="number" name="pay_amount" required id="payamount" class="form-control" placeholder="Enter Payment Amount">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label for="" class="col-md-5"> Remarks</label>
                                    <div class="col-md-7">
                                        <textarea name="remarks" id="" cols="30" rows="2" class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer" style="height:50px">
                        <div style="margin-right:-10px">
                            <button type="submit" class="btn btn-sm btn-primary" id="subbtn">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- edit modal open-->

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Supplier payment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
                <form class="form-valide" action="{{ route('update_co_expense') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body py-2 px-4">
                            <input type="hidden" name="hidden_id" id="hiddenId">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label for="" class="col-md-5">Head Name</label>
                                        <div class="col-md-7">
                                            <select name="head_id" @selected(true) disabled id="supplierIdedit" class="form-control dropdwon_select">
                                                @foreach ($headname as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>

                                                @endforeach

                                            </select>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label for="" class="col-md-5"> Payment Reason</label>
                                        <div class="col-md-7">
                                            <select name="pay_reason" @selected(true) disabled required id="reasonedit" class="form-control">
                                                <option value="" @selected(true) @disabled(true)>Select a payment reason</option>
                                                <option value="Office Expense">Office Expense</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                  <div class="form-group row">
                                    <label for="" class="col-md-5"> Pay Mode</label>
                                    <div class="col-md-7">
                                      <select name="pay_mode" @selected(true) disabled id="paymentModeEdit" class="form-control" onchange="toggleFields()">
                                        <option value="" selected disabled>Select a Pay Mode</option>
                                        <option value="Cash">Cash</option>
                                        <option value="Bank">Bank</option>
                                      </select>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="row" id="cashaccountidrowedit" style="display: none">
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label for="" class="col-md-5">Cash Total Amount</label>
                                        <div class="col-md-7">
                                            <input type="text" readonly id="cashtotalamountedit" class="form-control" value="1000"> <!-- Example value -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                              <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label for="" class="col-md-5"> Pay Date</label>
                                        <div class="col-md-7">
                                            <input type="date" value="" name="pay_date" id="paydate" class="form-control" >
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row" id="bankaccountidrowedit" style="display: none">
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label for="" class="col-md-5">Bank Total Amount</label>
                                        <div class="col-md-7">
                                            <input type="text" readonly id="banktotalamountedit" class="form-control" value="5000"> <!-- Example value -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                              <div class="row" id="bankaccountidrowedit" style="display: none">
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label for="" class="col-md-5">Bank Total Amount</label>
                                        <div class="col-md-7">
                                            <input type="text" readonly id="banktotalamountedit" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                              <div class="row" id="checkNumberEdit" style="display: none">
                                <div class="col-md-12">
                                  <div class="form-group row">
                                    <label for="" class="col-md-5"> Check Number</label>
                                    <div class="col-md-7">
                                      <input type="text" name="" readonly id="checkno" class="form-control" placeholder="Enter Check Number">
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="row" id="checkDateEdit" style="display: none">
                                <div class="col-md-12">
                                  <div class="form-group row">
                                    <label for="" class="col-md-5"> Check issu Date</label>
                                    <div class="col-md-7">
                                      <input type="date" name="" readonly id="checkDateedit" class="form-control">
                                    </div>
                                  </div>
                                </div>
                              </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label for="" class="col-md-5"> Payment Amount</label>
                                        <div class="col-md-7">
                                            <input type="number" name="pay_amountedit" id="payamountedit" class="form-control" placeholder="Enter Payment Amount">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label for="" class="col-md-5"> Remarks</label>
                                        <div class="col-md-7">
                                            <textarea name="remarks" id="remarks" cols="30" rows="2" class="form-control"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer" style="height:50px">
                            <div style="margin-right:-10px">
                                <button type="submit" class="btn btn-sm btn-primary" id="upbtn">Update</button>
                            </div>

                        </div>
                </form>
            </div>
        </div>
    </div>

    <!-- view modal open-->

    <div class="modal fade" id="exampleModalview" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">View expense Payment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
                <form class="form-valide" action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body py-2 px-4">

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label for="" class="col-md-5">Head Name</label>
                                        <div class="col-md-7">
                                            <select name="supplier_id" id="supplierview" @selected(true) disabled class="form-control dropdwon_select">
                                                <option value="" selected disabled>Select a member name</option>
                                                @foreach ($headname as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>

                                                @endforeach

                                            </select>

                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label for="" class="col-md-5"> Payment Reason</label>
                                        <div class="col-md-7">
                                            <select name="pay_reason" @selected(true) disabled required id="reasonview" class="form-control">
                                                <option value="" @selected(true) @disabled(true)>Select a payment reason</option>
                                                <option value="Office Expense">Office Expense</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                <div class="form-group row">
                                    <label for="" class="col-md-5"> Pay Mode</label>
                                    <div class="col-md-7">
                                    <select name="pay_mode" id="paymentModeview" @selected(true) disabled class="form-control" onchange="toggleFields()">
                                        <option value="" selected disabled>Select a Pay Mode</option>
                                        <option value="Cash">Cash</option>
                                        <option value="Bank">Bank</option>
                                    </select>
                                    </div>
                                </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label for="" class="col-md-5"> Pay Date</label>
                                        <div class="col-md-7">
                                            <input type="date" value="" readonly name="pay_date" id="paydateview" class="form-control" >
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row" id="bankNameRowview" style="display: none">
                                <div class="col-md-12">
                                <div class="form-group row">
                                    <label for="" class="col-md-5">Bank Name</label>
                                    <div class="col-md-7">
                                        <select name="bank_name" @selected(true) disabled id="bankNameview" class="form-control">
                                            <option value="" selected disabled>Select a Bank Name</option>
                                            @foreach ($allbankName as $item)
                                                <option value="{{ $item->id }}">{{ $item->bank_name }}</option>

                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                </div>
                            </div>
                            <div class="row" id="checkNumberView" style="display: none">
                                <div class="col-md-12">
                                <div class="form-group row">
                                    <label for="" class="col-md-5"> Check Number</label>
                                    <div class="col-md-7">
                                    <input type="text" name="check_num" readonly id="checknoview" class="form-control" placeholder="Enter Check Number">
                                    </div>
                                </div>
                                </div>
                            </div>
                            <div class="row" id="checkdatView" style="display: none">
                                <div class="col-md-12">
                                <div class="form-group row">
                                    <label for="" class="col-md-5"> Check issu Date</label>
                                    <div class="col-md-7">
                                    <input type="date" name="check_date" readonly id="checkDateview" class="form-control">
                                    </div>
                                </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label for="" class="col-md-5"> Payment Amount</label>
                                        <div class="col-md-7">
                                            <input type="number" name="pay_amount" readonly id="payamountview" class="form-control" placeholder="Enter Payment Amount">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label for="" class="col-md-5"> Remarks</label>
                                        <div class="col-md-7">
                                            <textarea name="remarks" readonly id="remarksview" cols="30" rows="2" class="form-control"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer" style="height:50px">
                            <div style=" margin-right:-28px">

                            </div>

                        </div>
                </form>

            </div>
          </div>
    </div>





</x-app-layout>

<script>
    $('.dropdwon_select').each(function () {
          $(this).select2({
              dropdownParent: $(this).parent()
          });
      });
</script>

<script>
   function toggleFields() {
     var payMode = document.getElementById('paymentMode');
     var checkNumberRow = document.getElementById('checkNumberRow');
     var checkDateRow = document.getElementById('checkDateRow');
     var bankNameRow = document.getElementById('bankNameRow');
     var bankaccountidrow = document.getElementById('bankaccountidrow');


     if (payMode.value === 'Bank') {
       checkNumberRow.style.display = 'block';
       checkDateRow.style.display = 'block';
       bankNameRow.style.display = 'block';
       bankaccountidrow.style.display = 'block';

     } else {
       checkNumberRow.style.display = 'none';
       checkDateRow.style.display = 'none';
       bankNameRow.style.display = 'none';
       bankaccountidrow.style.display = 'none';

     }
   }
 </script>

<script>

$(document).ready(function () {
    toggleFields();

    $("#paymentModeEdit").change(function () {
        toggleFields();
    });

    function toggleFields() {
        var payMode = $("#paymentModeEdit").val();
        var checkNumberRow = $("#checkNumberEdit");
        var checkDateRow = $("#checkDateEdit");
        var bankNameRow = $("#bankNameRowEdit");
        var cashaccrowedit = $('#cashaccountidrowedit');
        var bankaccrowedit = $('#bankaccountidrowedit');


        if (payMode === "Bank") {
            checkNumberRow.show();
            checkDateRow.show();
            bankNameRow.show();
            bankaccrowedit.show();
            cashaccrowedit.hide();
        } else {
            checkNumberRow.hide();
            checkDateRow.hide();
            bankNameRow.hide();
            bankaccrowedit.hide();
            cashaccrowedit.show();
        }
    }

    $(".edit").click(function () {
    var Id = $(this).data('id');
    alert(Id);
    $.ajax({
        url: "{{ route('expense_payment_edit') }}",
        method: 'GET',
        dataType: 'JSON',
        data: {
            'id': Id,
        },
        success: function (response) {

            $('#exampleModal').modal('show');
            $('#hiddenId').val(response.editexpense.id);
            $('#supplierIdedit').val(response.editexpense.ex_head_id).trigger('change');
            $('#reasonedit').val(response.editexpense.pay_reason);
            $('#paymentModeEdit').val(response.editexpense.pay_mode);

            $('#bankNameedit').val(response.editexpense.bank_name);
            $('#checkno').val(response.editexpense.check_num);
            $('#checkDateedit').val(response.editexpense.check_date);
            $('#paydate').val(response.editexpense.pay_date);


            $('#payamountedit').val(response.editexpense.pay_amount);
            $('#cashtotalamountedit').val(response.value);
            $('#banktotalamountedit').val(response.value);
            $('#remarks').val(response.editexpense.remarks);

            // $(document).on('change', '#supplierIdedit', function() {
            //     var id = $(this).val();
            //     alert(id);
            //     $.ajax({
            //         url: "{{ route('get_totalamount_sup') }}",
            //         method: 'GET',
            //         dataType: 'JSON',
            //         data: {
            //             id: id
            //         },
            //         success: function(data) {
            //             console.log(data);

            //             $('#totalamountedit').val(data.amount_due);
            //         }
            //     });
            // });

            // $(document).on('change', '#bankNameedit', function() {
            //     var payMode = $(this).val();

            //     $.ajax({
            //         url: "{{ route('get_currentaccount_bank') }}",
            //         method: 'GET',
            //         dataType: 'JSON',
            //         data: {
            //             id: payMode
            //         },
            //         success: function(data) {
            //             console.log(data);
            //             $('#banktotalamountedit').val(data.totalAmount);

            //         },
            //         error: function(xhr, status, error) {
            //             console.error('Error:', error);
            //         }
            //     });
            // });

            // $(document).on('change', '#bankNameedit', function() {
            //     var id = $(this).val();
            //     $.ajax({
            //         url: "{{ route('get_acc_no') }}",
            //         method: 'GET',
            //         dataType: 'JSON',
            //         data: {
            //             id: id
            //         },
            //         success: function(data) {
            //             console.log(data);

            //             $('#checkno').val(data.acc_no);
            //         }
            //     });
            // });

            toggleFields();

        }
    });
});
});

// view modal open js
$(document).ready(function () {
    toggleFields();

    $("#paymentModeview").change(function () {
        toggleFields();
    });

    function toggleFields() {
        var payMode = $("#paymentModeview").val();
        var checkNumberRow = $("#checkNumberView");
        var checkDateRow = $("#checkdatView");
        var bankNameView = $("#bankNameRowview");

        if (payMode === "Bank") {
            checkNumberRow.show();
            checkDateRow.show();
            bankNameView.show();
        } else {
            checkNumberRow.hide();
            checkDateRow.hide();
            bankNameView.hide();
        }
    }

    $(".view").click(function () {
        var viewId = $(this).data('id');
        alert(viewId);
        $.ajax({
            url: "{{ route('expense_payment_edit') }}",
            method: 'GET',
            dataType: 'JSON',
            data: {
                'id': viewId,
            },
            success: function (response) {

                console.log(response);
                $('#exampleModalview').modal('show');
                $('#supplierview').val(response.editexpense.ex_head_id).trigger('change');
                $('#reasonview').val(response.editexpense.pay_reason);
                $('#paymentModeview').val(response.editexpense.pay_mode);
                $('#paydateview').val(response.editexpense.pay_date);
                $('#bankNameview').val(response.editexpense.bank_name);
                $('#checknoview').val(response.editexpense.check_num);
                $('#checkDateview').val(response.editexpense.check_date);
                $('#payamountview').val(response.editexpense.pay_amount);
                $('#remarksview').val(response.editexpense.remarks);

                toggleFields();
            }
        });
    });
});

</script>

<script>
    $(document).on('change', '#supplierId', function() {
        var id = $(this).val();
        $.ajax({
            url: "{{ route('get_totalamount_sup') }}",
            method: 'GET',
            dataType: 'JSON',
            data: {
                id: id
            },
            success: function(data) {
                console.log(data);

                $('#totalamount').val(data.amount_due);
            }
        });
    });


    $(document).on('change', '#bankName', function() {
        var id = $(this).val();
        $.ajax({
            url: "{{ route('get_acc_no') }}",
            method: 'GET',
            dataType: 'JSON',
            data: {
                id: id
            },
            success: function(data) {
                console.log(data);
                $('#checkNumber').val(data.acc_no);
            }
        });
    });

</script>

<script>
    $(document).on('change', '#paymentMode', function() {
        var payMode = $(this).val();

        $.ajax({
            url: "{{ route('get_currentaccount_cash') }}",
            method: 'GET',
            dataType: 'JSON',
            data: {
                id: payMode
            },
            success: function(data) {
                console.log(data);

                if (data.totalAmount === 0) {
                    // Hide the row if the total amount is 0
                    $('#cashaccountidrow').hide();
                } else {
                    $('#cashaccountidrow').show();
                    $('#cashtotalamount').val(data.totalAmount);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
            }
        });
    });


    // get bank total amount

    $(document).on('change', '#bankName', function() {
        var payMode = $(this).val();

        $.ajax({
            url: "{{ route('get_currentaccount_bank') }}",
            method: 'GET',
            dataType: 'JSON',
            data: {
                id: payMode
            },
            success: function(data) {
                console.log(data);
                $('#banktotalamount').val(data.totalAmount);

            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
            }
        });
    });
</script>

<script>
    document.getElementById('subbtn').addEventListener('click', function(event) {
        var cashtotalamount = parseFloat($('#cashtotalamount').val());
        var banktotalamount = parseFloat($('#banktotalamount').val());
        var paymentMode = $('#paymentMode').val();
        var paymentAmount = parseFloat($('#payamount').val());
        var valid = true;

        if (paymentMode == 'Cash') {
            if (isNaN(cashtotalamount) || cashtotalamount == 0) {
                alert("Cash total amount cannot be zero.");
                valid = false;
            } else if (paymentAmount > cashtotalamount) {
                alert("Payment amount exceeds cash total amount.");
                valid = false;
            }
        } else if (paymentMode == 'Bank') {
            if (isNaN(banktotalamount) || banktotalamount == 0) {
                alert("Bank total amount cannot be zero.");
                valid = false;
            } else if (paymentAmount > banktotalamount) {
                alert("Payment amount exceeds bank total amount.");
                valid = false;
            }
        }

        if (!valid) {
            event.preventDefault(); // Prevent form submission if not valid
        }
    });
</script>

<script>

    document.getElementById('upbtn').addEventListener('click',function(){
        var cashtotalamount = parseFloat($('#cashtotalamountedit').val());
        var banktotalamount = parseFloat($('#banktotalamountedit').val());
        var paymentMode = $('#paymentModeEdit').val();
        var paymentAmount = parseFloat($('#payamountedit').val());
        var valid = true;

        if (paymentMode == 'Cash') {
            if (isNaN(cashtotalamount) || cashtotalamount == 0) {
                alert("Cash total amount cannot be zero.");
                valid = false;
            } else if (paymentAmount > cashtotalamount) {
                alert("Payment amount exceeds cash total amount.");
                valid = false;
            }
        } else if (paymentMode == 'Bank') {
            if (isNaN(banktotalamount) || banktotalamount == 0) {
                alert("Bank total amount cannot be zero.");
                valid = false;
            } else if (paymentAmount > banktotalamount) {
                alert("Payment amount exceeds bank total amount.");
                valid = false;
            }
        }

        if (!valid) {
            event.preventDefault();
        }
    });

    </script>


























