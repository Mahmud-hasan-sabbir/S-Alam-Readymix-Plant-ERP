<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Loan Paid For bank</h4>
                    <h6 style="padding: 0px;margin:0px">

                    </h6>
                    <a href="" data-toggle="modal" data-target=".bd-example-modal-lg" class="btn btn-sm btn-success p-1 px-2"><i class="fa fa-plus"></i></i><span class="btn-icon-add"></span>Create</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example3" class="display " style="min-width: 845px">
                            <thead>
                                <tr>
                                    <th>SL.#</th>
                                    <th>Bank Name</th>
                                    <th>Loan Amount</th>
                                    <th>Paid Loan Amount</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($paidloan as $item)
                                <tr style="{{ $item->is_approve == 1 ? 'background-color: #c9d9dd !important;color:black' : '' }}">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->bank->bank_name }}</td>
                                    <td>{{ $item->loan_amount }}</td>
                                    <td>{{ $item->pay_loan_amount }}</td>
                                    <td>{{ $item->date }}</td>
                                    <td>
                                        <div style="width: 128px">
                                            @if ($item->is_approve != 1)
                                                <button type="button" class="btn btn-sm btn-success p-1 px-2" id="edit_data" data-id="{{ $item->id }}" style="margin-left: -15px">
                                                    <i class="fa fa-folder-open"></i><span class="btn-icon-add"></span>Edit
                                                </button>
                                            @endif
                                            <button type="button" class="btn btn-sm btn-info p-1 px-2" id="view_data" data-id="{{ $item->id }}" style="float: right">
                                                <i class="fa fa-folder-open"></i><span class="btn-icon-add"></span>View
                                            </button>
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


    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        loan paid for bank
                    </h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <form class="form-valide" action="{{ route('store_loan_paid') }}" method="POST" enctype="multipart/form-data" id="advancedsalaryform">
                    @csrf
                    <div class="modal-body py-2 px-4">
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <div class="row">
                                    <label class="col-md-5 col-form-label" for="emp_namee"> Bank Name: </label>
                                    <div class="col-md-7">
                                        <select name="bank_id" id="bankname" required class="form-control">
                                            <option value="" selected disabled>Select Bank</option>
                                            @foreach ($allbankName as $item)
                                                <option value="{{ $item->id }}">{{ $item->bank_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 bankacc_no">
                                <div class="row">
                                    <label class="col-md-5 col-form-label" for="per_number">acc no:</label>
                                    <div class="col-md-7">
                                        <input type="text" id="accNo" required class="form-control" readonly value="" name="acc_no">
                                    </div>
                                </div>
                            </div>
                           
                        </div>
                    

                        <div class="row mt-2">
                            <div class="col-md-6 bankacc_no">
                                <div class="row">
                                    <label class="col-md-5 col-form-label" for="per_number">Bank Amount:</label>
                                    <div class="col-md-7">
                                        <input type="text" id="banktotalamm" required class="form-control" readonly value="" name="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <label class="col-md-5 col-form-label"> Loan Amount : </label>
                                    <div class="col-md-7">
                                        <input type="number" name="loan_amount" readonly class="form-control" id="loanamount">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <div class="row">
                                    <label class="col-md-5 col-form-label">Interest Loan : </label>
                                    <div class="col-md-7">
                                       <input type="text" class="form-control" readonly id="interest_loan" name="interest_loan" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <label class="col-md-5 col-form-label" for="per_number">Pay Date :</label>
                                    <div class="col-md-7">
                                        <input type="date" id="date" required class="form-control" name="date">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <div class="row">
                                    <label class="col-md-5 col-form-label" for="per_number"> Year</label>
                                    <div class="col-md-7">
                                        <input type="text" id="year" required class="form-control" readonly value="{{ date('Y') }}" name="year">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <label class="col-md-5 col-form-label"> Pay Loan Amount : </label>
                                    <div class="col-md-7">
                                        <input type="number" name="pay_loan_amount"  class="form-control" id="pay_loan_amount">
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <div class="row">
                                    <label class="col-md-5 col-form-label" for="per_number"> Remarks :</label>
                                    <div class="col-md-7">
                                        <textarea name="remarks" id="remarks" cols="30" rows="2" class="form-control" ></textarea>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="modal-footer" style="height:50px">
                        <button type="button" class="btn btn-sm btn-info" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-sm btn-success" id="subbtn">Submit</button>

                    </div>
                </form>
            </div>
        </div>
    </div>

</x-app-layout>

<script>
    $(document).on('click', '#edit_data', function () {
         var itemId = $(this).data('id');

         $.ajax({
             url: '{{ route('edit_paid_bank_loan') }}',
             method: 'GET',
             dataType: "JSON",
             data: { 'id': itemId },
             success: function (response) {
                 console.log(response);
                 $('.bd-example-modal-lg').modal('show');
                 $('#bankname').val(response.editloan.bank_id).prop('selected', true);
                 $('#accNo').val(response.editloan.acc_no).prop('selected', true);
                 $('#banktotalamm').val(response.value);
                 $('#loanamount').val(response.editloan.loan_amount);
                 $('#pay_loan_amount').val(response.editloan.pay_loan_amount);
                 $('#date').val(response.editloan.date);
                 $('#interest_loan').val(response.editloan.interest_loan);
                 $('#year').val(response.editloan.year);
                 $('#remarks').val(response.editloan.remarks);
                 var updateRoute = '{{ route('update_bank_loan_paid', ['id' => ':id']) }}';
                 updateRoute = updateRoute.replace(':id', response.editloan.id);
                 $('#advancedsalaryform').attr('action', updateRoute);
                 $('#advancedsalaryform').find('button[type="submit"]').text('Update');

                   
                }
            });
        });

 </script>


<script>
    $(document).on('click', '#view_data', function () {
         var itemId = $(this).data('id');

         $.ajax({
             url: '{{ route('edit_paid_bank_loan') }}',
             method: 'GET',
             dataType: "JSON",
             data: { 'id': itemId },
             success: function (response) {
                 console.log(response);
                 $('.bd-example-modal-lg').modal('show');
                 $('#bankname').val(response.editloan.bank_id).prop('selected', true);
                 $('#bankname').prop('disabled', true);
                 $('#accNo').val(response.editloan.acc_no).prop('selected', true);
                    $('#accNo').prop('disabled', true);
                 $('#banktotalamm').val(response.value);
                    $('#banktotalamm').prop('disabled', true);
                 $('#loanamount').val(response.editloan.loan_amount);
                    $('#loanamount').prop('disabled', true);
                 $('#pay_loan_amount').val(response.editloan.pay_loan_amount);
                    $('#pay_loan_amount').prop('disabled', true);
                 $('#date').val(response.editloan.date);
                    $('#date').prop('disabled', true);
                 $('#interest_loan').val(response.editloan.interest_loan);
                    $('#interest_loan').prop('disabled', true);
                 $('#year').val(response.editloan.year);
                    $('#year').prop('disabled', true);
                 $('#remarks').val(response.editloan.remarks);
                    $('#remarks').prop('disabled', true);
                 $('#advancedsalaryform').find('button[type="submit"]').hide();

                   
                }
         });
     });
 </script>




<script>

$(document).on('change', '#bankname', function() {
        var id = $(this).val();
        alert(id);
        $.ajax({
            url: "{{ route('get_bank_detail') }}",
            method: 'GET',
            dataType: 'JSON',
            data: {
                id: id
            },
            success: function(data) {
                console.log(data);
                $('#loanamount').val(data.totalloanamount);
                $('#interest_loan').val(data.totalinterest);
                $('#accNo').val(data.accno);
                $('#banktotalamm').val(data.totalbankvalue);
            }
        });
    });


</script>




























