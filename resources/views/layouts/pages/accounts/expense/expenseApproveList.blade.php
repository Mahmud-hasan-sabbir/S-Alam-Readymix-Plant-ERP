<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        Expense Payment Approve List
                    </h4>
                    
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
                                @foreach ($allapprovelist as $data )

                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $data->expenseHead->name }}</td>
                                    <td>{{ $data->pay_mode }}</td>
                                    <td>{{ $data->pay_date }}</td>
                                    <td>{{ $data->pay_amount }}</td>
                                  
                                    <td>
                                        <div style="width: 100%;margin-left:-50px">
                                            <form action="{{ route('expense_payment_approve',['id' => $data->id]) }}" method="post" >
                                                <button class="btn btn-sm btn-success" style="padding: 3px">Approve</i></button>
                                                @csrf
                                                @method('PATCH')
                                            </form>
                                            <form action="{{ route('expense_payment_cancaled',['id' => $data->id]) }}" method="post" >
                                                <button class="btn btn-sm btn-danger" style="padding: 3px;float: left;margin-left:58px;margin-top:-27px">Cancale</i></button>
                                                @csrf
                                                @method('PATCH')
                                            </form>
                                            <button class="btn btn-sm btn-info view"  data-id="{{ $data->id }}" style="padding: 3px;width:45px;margin-left:117px;margin-top:-48px">view</i></button>

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
                        View approve expense
                    </h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <form class="form-valide" action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body py-2 px-4">
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <div class="row">
                                    <label class="col-md-5 col-form-label">Head Name :</label>
                                    <div class="col-md-7">
                                        <label id="headname" style="margin-top: 7px"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <label class="col-md-5 col-form-label">Payment Reason :</label>
                                    <div class="col-md-7">
                                        <label id="payreason" style="margin-top: 7px"></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <div class="row">
                                    <label class="col-md-5 col-form-label">Pay Mode :</label>
                                    <div class="col-md-7">
                                        <label id="paymode" style="margin-top: 7px"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <label class="col-md-5 col-form-label">Pay Date :</label>
                                    <div class="col-md-7">
                                        <label id="paydate" style="margin-top: 7px"></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2" id="bankrowshow" style="display: none">
                            <div class="col-md-6">
                                <div class="row">
                                    <label class="col-md-5 col-form-label">Bank Name :</label>
                                    <div class="col-md-7">
                                        <label id="bankName" style="margin-top: 7px"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <label class="col-md-5 col-form-label">check No :</label>
                                    <div class="col-md-7">
                                        <label id="checkNo" style="margin-top: 7px"></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6" style="display: none" id="checkdatefield">
                                <div class="row">
                                    <label class="col-md-5 col-form-label">check Date :</label>
                                    <div class="col-md-7">
                                        <label id="checkdate" style="margin-top: 7px"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <label class="col-md-5 col-form-label">Pay Amount :</label>
                                    <div class="col-md-7">
                                        <label id="payamount" style="margin-top: 7px"></label>
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
        url: "{{ route('get_coexpense_view') }}",
        type: "GET",
        data: { id: id },
        success: function(data) {
           
            $('.bd-example-modal-lg').modal('show');
            $('#headname').text(data.headname);
            $('#payreason').text(data.getCoexpenseview.pay_reason);
            $('#paymode').text(data.getCoexpenseview.pay_mode);
            $('#paydate').text(data.getCoexpenseview.pay_date);

            if(data.getCoexpenseview.pay_mode === 'Bank') {
                $('#bankrowshow').show();
                $('#checkdatefield').show();
                $('#bankName').text(data.bankname).show();
                $('#checkNo').text(data.getCoexpenseview.check_num).show();
                $('#checkdate').text(data.getCoexpenseview.check_date).show();
            } else {
                $('#bankName').text('').hide(); 
                $('#checkNo').text('').hide();   
                $('#checkdate').text('').hide();
            }

            $('#payamount').text(data.getCoexpenseview.pay_amount);
            $('#description').text(data.getCoexpenseview.remarks);
        }
    });
});
</script>

















