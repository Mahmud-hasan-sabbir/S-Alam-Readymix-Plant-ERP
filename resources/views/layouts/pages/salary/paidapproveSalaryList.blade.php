<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        paid Salary Approve List
                    </h4>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example3" class="display" style="min-width: 845px">
                            <thead>
                                <tr>
                                    <th>SL.#</th>
                                    <th>Employee Name</th>
                                    <th>Designation</th>
                                    <th>Paid_Salary</th>
                                    <th>Month</th>
                                    <th>Mode</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($paidSalary as $item )

                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->employee->company_name }}</td>
                                        <td>{{ $item->employee->desig->name }}</td>
                                        <td>{{ $item->paid_salary }}</td>
                                        <td>{{ $item->month }}</td>
                                        <td>{{ $item->pay_mode }}</td>
                                        <td>{{ $item->date }}</td>

                                    <td>
                                        <div style="width: 100%;margin-left:-50px">
                                            <form action="{{ route('paid_salary_approve',['id' => $item->id]) }}" method="post" >
                                                <button class="btn btn-sm btn-success" style="padding: 3px">Approve</i></button>
                                                @csrf
                                                @method('PATCH')
                                            </form>
                                            <form action="{{ route('paid_salary_cancaled',['id' => $item->id]) }}" method="post" >
                                                <button class="btn btn-sm btn-danger" style="padding: 3px;float: left;margin-left:58px;margin-top:-27px">Cancale</i></button>
                                                @csrf
                                                @method('PATCH')
                                            </form>
                                            <button class="btn btn-sm btn-info view"  data-id="{{ $item->id }}" style="padding: 3px;width:45px;margin-left:117px;margin-top:-48px">view</i></button>

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
                        View paid Salary view
                    </h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <form class="form-valide" action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body py-2 px-4">
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <div class="row">
                                    <label class="col-md-5 col-form-label">Employee Name :</label>
                                    <div class="col-md-7">
                                        <label id="empname" style="margin-top: 7px"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <label class="col-md-5 col-form-label">Month :</label>
                                    <div class="col-md-7">
                                        <label id="month" style="margin-top: 7px"></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <div class="row">
                                    <label class="col-md-5 col-form-label">Year :</label>
                                    <div class="col-md-7">
                                        <label id="year" style="margin-top: 7px"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <label class="col-md-5 col-form-label">paid Salary :</label>
                                    <div class="col-md-7">
                                        <label id="ad_salary" style="margin-top: 7px"></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <div class="row">
                                    <label class="col-md-5 col-form-label">pay mode :</label>
                                    <div class="col-md-7">
                                        <label id="paymode" style="margin-top: 7px"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <label class="col-md-5 col-form-label">Date :</label>
                                    <div class="col-md-7">
                                        <label id="date" style="margin-top: 7px"></label>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <div class="row mt-2" id="showbankrow">
                            <div class="col-md-6">
                                <div class="row">
                                    <label class="col-md-5 col-form-label">Bank name :</label>
                                    <div class="col-md-7">
                                        <label id="bankname" style="margin-top: 7px"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <label class="col-md-5 col-form-label">acc no :</label>
                                    <div class="col-md-7">
                                        <label id="accno" style="margin-top: 7px"></label>
                                    </div>
                                </div>
                            </div>
                           
                           
                        </div>
                        <div class="row mt-2">
                            
                            <div class="col-md-12">
                                <div class="row">
                                    <label class="col-md-5 col-form-label">Description :</label>
                                    <div class="col-md-7">
                                        <label id="description" style="margin-top: 7px;margin-left:-165px"></label>
                                    </div>
                                </div>
                            </div>

                        </div>



                    </div>
                    <div class="modal-footer" style="height:50px">
                        <button type="button" class="btn btn-sm btn-danger light" data-dismiss="modal">Close</button>

                    </div>
                </form>
            </div>
        </div>
    </div>


</x-app-layout>


<script>
   $(document).on('click', '.view', function() {
    var id = $(this).data('id');
   
    $.ajax({
        url: "{{ route('paid_salary_view') }}",
        type: "GET",
        data: { id: id },
        success: function(data) {

            $('.bd-example-modal-lg').modal('show');
            $('#empname').text(data.empname);
            $('#month').text(data.viewpaidsalary.month);
            $('#year').text(data.viewpaidsalary.year);
            $('#ad_salary').text(data.viewpaidsalary.paid_salary);
            $('#date').text(data.viewpaidsalary.date);
            $('#description').text(data.viewpaidsalary.remarks);
            $('#paymode').text(data.viewpaidsalary.pay_mode);
            if (data.viewpaidsalary.pay_mode == 'Bank') {
                $('#showbankrow').show();
            } else {
                $('#showbankrow').hide();
            }
            $('#bankname').text(data.bankname);
            $('#accno').text(data.viewpaidsalary.acc_no);







        }
    });
});
</script>

















