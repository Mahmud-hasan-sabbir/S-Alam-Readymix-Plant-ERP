<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Paid Salary </h4>
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
                                    <th>Employee Name</th>
                                    <th>Designation</th>
                                    <th>Salary</th>
                                    <th>ad_salary</th>
                                    <th>Paid Salary</th>
                                    <th>Absence</th>
                                    <th>Month</th>
                                    <th>Mode</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($paidsalary as $item)
                                    <tr style="{{ $item->status == 1 ? 'background-color: #cfad57 !important; color: black' : '' }}">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->employee->company_name }}</td>
                                        <td>{{ $item->employee->desig->name }}</td>
                                        <td>{{ $item->employee->salary }}</td>
                                        <td>{{ $item->adv_salary }}</td>
                                        <td>{{ $item->paid_salary }}</td>
                                        <td>{{ $item->absence??0 }}</td>
                                        <td>{{ $item->month }}</td>
                                        <td>{{ $item->pay_mode }}</td>
                                        <td>{{ $item->date }}</td>
                                        <td>
                                            <div style="width: 128px">
                                                <button type="button" {{ $item->status == 1 ? 'disabled' : '' }} class="btn btn-sm btn-success p-1 px-2" id="edit_data"  data-id="{{ $item->id }}" style="margin-left: -15px"><i class="fa fa-folder-open"></i></i><span class="btn-icon-add"></span>Edit</button>
                                                <button type="button"  class="btn btn-sm btn-info p-1 px-2" id="view_data"  data-id="{{ $item->id }}" style="float: right"><i class="fa fa-folder-open"></i></i><span class="btn-icon-add"></span>View</button>
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
                        Create Paid Salary
                    </h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <form class="form-valide" action="{{ route('store_paid_salary') }}" method="POST" enctype="multipart/form-data" id="advancedsalaryform">
                    @csrf
                    <div class="modal-body py-2 px-4">
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <div class="row">
                                    <label class="col-md-5 col-form-label" for="emp_namee"> Employee Name: </label>
                                    <div class="col-md-7">
                                        <select name="emp_id" id="employeeName" required class="form-control">
                                            <option value="" selected disabled>Select Employee</option>
                                            @foreach ($employee as $item)
                                                <option value="{{ $item->id }}">{{ $item->company_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <label class="col-md-5 col-form-label">Current Salary : </label>
                                    <div class="col-md-7">
                                        <input type="number" name="current_salary" readonly class="form-control" id="currentSalary">
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <div class="row">
                                    <label class="col-md-5 col-form-label" for="designation"> Designation: </label>
                                    <div class="col-md-7">
                                        <input type="text"  class="form-control" readonly id="designation" name="designation">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="row">
                                    <label class="col-md-5 col-form-label" for="per_number">Absence</label>
                                    <div class="col-md-7">
                                        <input type="text"  class="form-control" id="absense" name="absence">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <div class="row">
                                    <label class="col-md-5 col-form-label" for="designation"> Month: </label>
                                    <div class="col-md-7">
                                        <select name="month" id="month" required class="form-control">
                                            <option value="" selected disabled >Select a Month</option>
                                            <option value="January">January</option>
                                            <option value="February">February</option>
                                            <option value="March">March</option>
                                            <option value="April">April</option>
                                            <option value="May">May</option>
                                            <option value="June">June</option>
                                            <option value="July">July</option>
                                            <option value="August">August</option>
                                            <option value="September">September</option>
                                            <option value="October">October</option>
                                            <option value="November">November</option>
                                            <option value="December">December</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <label class="col-md-5 col-form-label">Advanced Salary : </label>
                                    <div class="col-md-7">
                                       <input type="number" readonly class="form-control" id="advancedSalary" name="adv_salary" required>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <div class="row">
                                    <label class="col-md-5 col-form-label" for="per_number"> Pay Mode :</label>
                                    <div class="col-md-7">
                                        <select name="pay_mode" required id="pay_mode" class="form-control">
                                            <option value="" selected disabled>select a pay mode</option>
                                            <option value="Cash">Cash</option>
                                            <option value="Bank">Bank</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 cash-field" style="display: none">
                                <div class="row">
                                    <label class="col-md-5 col-form-label" for="cash_total_amount"> Cash Total Amount :</label>
                                    <div class="col-md-7">
                                        <input type="number"  class="form-control" readonly id="cashtotalamount" name="" placeholder="cash total amount">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 bank-field" style="display: none">
                                <div class="row">
                                    <label class="col-md-5 col-form-label" for="bank_name"> Bank Name</label>
                                    <div class="col-md-7">
                                        <select name="bank_name" id="bank_name" class="form-control">
                                            <option value="" selected disabled>select a bank</option>
                                            @foreach ($allbank as $item)
                                                <option value="{{ $item->id }}">{{ $item->bank_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6 bankacc_no" style="display: none">
                                <div class="row">
                                    <label class="col-md-5 col-form-label" for="per_number">acc no:</label>
                                    <div class="col-md-7">
                                        <input type="text" id="accNo" required class="form-control" readonly value="" name="acc_no">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 banktotalfield" style="display: none">
                                <div class="row">
                                    <label class="col-md-5 col-form-label" for="per_number"> Bank Total Amount :</label>
                                    <div class="col-md-7">
                                        <input type="number" id="banktotalamount" readonly class="form-control" name="">
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <div class="row">
                                    <label class="col-md-5 col-form-label">Paid Salary : </label>
                                    <div class="col-md-7">
                                       <input type="number" required class="form-control" id="paidamount" name="paid_salary" placeholder="paid salary" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <label class="col-md-5 col-form-label" for="per_number"> Date :</label>
                                    <div class="col-md-7">
                                        <input type="date" id="date" required class="form-control" name="date">
                                    </div>
                                </div>
                            </div>

                        </div>


                        <div class="row mt-2">
                            <div class="col-md-6">
                                <div class="row">
                                    <label class="col-md-5 col-form-label" for="per_number"> Remarks :</label>
                                    <div class="col-md-7">
                                        <textarea name="remarks" id="remarks" cols="30" rows="2" class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <label class="col-md-5 col-form-label" for="per_number"> Year</label>
                                    <div class="col-md-7">
                                        <input type="text" id="year" required class="form-control" readonly value="{{ date('Y') }}" name="year">
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
    $(document).on('change', '#employeeName', function () {
        var employeeId = $(this).val();
        $.ajax({
            url: '{{ route('get_employee_salary') }}',
            method: 'GET',
            dataType: "JSON",
            data: { 'id': employeeId },
            success: function (response) {
                console.log(response);
                $('#currentSalary').val(response.salary);
                $('#designation').val(response.designation_name);
            }
        });
    });
</script>


<script>
    $(document).on('click', '#edit_data', function () {
         var itemId = $(this).data('id');

         $.ajax({
             url: '{{ route('edit_paid_salary') }}',
             method: 'GET',
             dataType: "JSON",
             data: { 'id': itemId },
             success: function (response) {
                 console.log(response);
                 $('.bd-example-modal-lg').modal('show');
                 $('#employeeName').val(response.editpaidsalary.emp_id).prop('selected', true);
                 $('#employeeName').prop('disabled', true);
                 $('#designation').val(response.editpaidsalary.employee.desig.name).prop('disabled', true);
                 $('#absense').val(response.editpaidsalary.absence);
                 $('#currentSalary').val(response.currentSalary).prop('disabled', true);
                 $('#remarks').val(response.editpaidsalary.remarks);
                 $('#month').val(response.editpaidsalary.month).prop('selected', true);
                 $('#month').prop('disabled', true);
                 $('#pay_mode').val(response.editpaidsalary.pay_mode).prop('selected', true);
                 $('#pay_mode').prop('disabled', true);

                 // Show or hide fields based on pay_mode
                 if (response.editpaidsalary.pay_mode === 'Cash') {
                     $('.cash-field').show();
                     $('.bank-field').hide();
                     $('.bankacc_no').hide();
                     $('.banktotalfield').hide();
                     $('#cashtotalamount').val(response.value);
                 } else if (response.editpaidsalary.pay_mode === 'Bank') {
                     $('.cash-field').hide();
                     $('.bank-field').show();
                     $('.banktotalfield').show();
                     $('#banktotalamount').val(response.value);
                     $('#bank_name').val(response.editpaidsalary.bank_name).prop('selected', true);
                     $('#bank_name').prop('disabled', true);
                     $('.bankacc_no').show();
                    $('#accNo').val(response.editpaidsalary.acc_no).prop('selected', true);
                    $('#accNo').prop('disabled', true);
                 } else {
                     $('.cash-field').hide();
                     $('.bank-field').hide();
                 }

                 $('#advancedSalary').val(response.editpaidsalary.adv_salary);
                 $('#paidamount').val(response.editpaidsalary.paid_salary);
                 $('#date').val(response.editpaidsalary.date);

                 var updateRoute = '{{ route('update_paid_salary', ['id' => ':id']) }}';
                 updateRoute = updateRoute.replace(':id', response.editpaidsalary.id);
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
             url: '{{ route('edit_paid_salary') }}',
             method: 'GET',
             dataType: "JSON",
             data: { 'id': itemId },
             success: function (response) {
                 console.log(response);
                 $('.bd-example-modal-lg').modal('show');
                 $('#employeeName').val(response.editpaidsalary.emp_id).prop('selected', true);
                 $('#employeeName').prop('disabled', true);
                 $('#designation').val(response.editpaidsalary.employee.desig.name).prop('disabled', true);
                 $('#absense').val(response.editpaidsalary.absence).prop('disabled', true);
                 $('#currentSalary').val(response.currentSalary).prop('disabled', true);
                 $('#remarks').val(response.editpaidsalary.remarks).prop('disabled', true);
                 $('#month').val(response.editpaidsalary.month).prop('disabled', true);
                 $('#month').prop('disabled', true);
                 $('#pay_mode').val(response.editpaidsalary.pay_mode).prop('selected', true);
                 $('#pay_mode').prop('disabled', true);

                 // Show or hide fields based on pay_mode
                 if (response.editpaidsalary.pay_mode === 'Cash') {
                     $('.cash-field').show();
                     $('.bank-field').hide();
                     $('.bankacc_no').hide();
                     $('.banktotalfield').hide();
                     $('#cashtotalamount').val(response.value);
                 } else if (response.editpaidsalary.pay_mode === 'Bank') {
                     $('.cash-field').hide();
                     $('.bank-field').show();
                     $('.banktotalfield').show();
                     $('#banktotalamount').val(response.value);
                     $('#bank_name').val(response.editpaidsalary.bank_name).prop('selected', true);
                     $('#bank_name').prop('disabled', true);
                     $('.bankacc_no').show();
                    $('#accNo').val(response.editpaidsalary.acc_no).prop('selected', true);
                    $('#accNo').prop('disabled', true);
                 } else {
                     $('.cash-field').hide();
                     $('.bank-field').hide();
                 }
                 $('#advancedSalary').val(response.editpaidsalary.adv_salary).prop('disabled', true);
                 $('#paidamount').val(response.editpaidsalary.paid_salary).prop('disabled', true);
                 $('#date').val(response.editpaidsalary.date).prop('disabled', true);
                 $('#advancedsalaryform').find('button[type="submit"]').hide();

             }
         });
     });
 </script>

 <script>

    $(document).ready(function() {
        $('#pay_mode').change(function() {
            var selectedValue = $(this).val();
            if (selectedValue === 'Cash') {
                $('.cash-field').show();
                $('.bank-field').hide();
                $('.banktotalfield').hide();
                $('.bankacc_no').hide();
            } else if (selectedValue === 'Bank') {
                $('.cash-field').hide();
                $('.bank-field').show();
            } else {
                $('.cash-field').hide();
                $('.bank-field').hide();
            }
        });
    });
</script>


<script>
$(document).on('change', '#bank_name', function() {
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

            $('.banktotalfield').show();

            $('#banktotalamount').val(data.totalAmount);

        },
        error: function(xhr, status, error) {
            console.error('Error:', error);
        }
    });
});


$(document).on('change', '#bank_name', function() {
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

                $('.bankacc_no').show();
                $('#accNo').val(data.acc_no);
            }
        });
    });


    $(document).on('change', '#pay_mode', function() {
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

</script>

<script>
    document.getElementById('subbtn').addEventListener('click', function(event) {
        var cashtotalamount = parseFloat($('#cashtotalamount').val());
        var currentSalary = parseFloat($('#currentSalary').val());
        var banktotalamount = parseFloat($('#banktotalamount').val());
        var paymentMode = $('#pay_mode').val();
        var paymentAmount = parseFloat($('#paidamount').val());
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

        if (paymentAmount > currentSalary) {
            alert("Payment amount exceeds current salary.");
            valid = false;
        }

        if (!valid) {
            event.preventDefault(); // Prevent form submission if not valid
        }
    });
</script>


<script>

    $(document).on('change','#month',function(){
        var emp_id = $('#employeeName').val();
        var year = $('#year').val();
        var month = $(this).val();

        $.ajax({
            url: "{{ route('get_adv_salary') }}",
            method: 'GET',
            dataType: 'JSON',
            data: {
                emp_id , month , year
            },
            success: function(data) {
                console.log(data);
                $('#advancedSalary').val(data ?? 0);
            }
        });
    });

</script>































