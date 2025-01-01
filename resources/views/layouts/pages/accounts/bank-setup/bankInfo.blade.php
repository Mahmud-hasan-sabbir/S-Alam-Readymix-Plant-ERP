<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-primary">
                    <h4 class="card-title">Bank Information</h4>

                    <div>
                        <a href="" data-toggle="modal" data-target=".bd-example-modal-lg" class="btn btn-sm btn-success p-1 px-2"><i class="fa fa-plus"></i></i><span class="btn-icon-add"></span>Create</a>

                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example3" class="display " style="min-width: 845px">
                            <thead>
                                <tr>
                                    <th>Sl. No.</th>
                                    <!-- <th>Holder Name</th> -->
                                    <th>Bank Name</th>
                                    <!-- <th>Branch Name</th> -->
                                    <th>Account Number</th>
                                    <!-- <th>Routing No</th> -->
                                    <th>Balance</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($banksWithBalances as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <!-- <td>{{ $item->holder_name }}</td> -->
                                    <td class="text-left">
                                        <a href="{{ route('bank_total_cal', $item->id) }}">{{ $item->bank_name }}</a>
                                    </td>
                                    <!-- <td>{{ $item->branch_name }}</td> -->
                                    <td>{{ $item->acc_no }}</td>
                                    <!-- <td>{{ $item->routing_no }}</td> -->
                                    <td class="text-right">{{ $item->balance }}</td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-success p-1 px-2 edit-data" data-id="{{ $item->id }}"><i class="fa fa-pencil"></i>Edit</button>
                                        <button type="button" class="btn btn-sm btn-info p-1 px-2 view-data" data-id="{{ $item->id }}"><i class="fa fa-eye"></i>View</button>
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
                    <h5 class="modal-title">Create New Bank</h5>
                    <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <form class="form-valide" action="{{ route('store_bank_info') }}" method="POST" enctype="multipart/form-data" id="editform">
                    @csrf
                    <div class="modal-body py-2 px-4">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="bankName" class="form-label">Bank Name <span class="text-danger">*</span></label>
                                    <input type="text" placeholder="Bank Name" id="bankName" required name="bank_name" class="form-control" autofocus>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="branchName" class="form-label">Branch Name</label>
                                    <input type="text" name="branch_name" id="branchName" placeholder="Branch Name" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="accountNumber" class="form-label">Account Number <span class="text-danger">*</span> </label>
                                    <input type="text" id="accountNumber" placeholder="Account Number" required name="acc_no" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="acctype" class="form-label">Account Type <span class="text-danger">*</span> </label>
                                    <input type="text" id="acctype" placeholder="Account type" required name="acc_type" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="holderName" class="form-label">Account Holder Name <span class="text-danger">*</span> </label>
                                    <input type="text" id="holderName" placeholder="Account Holder Name" required name="holder_name" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="routingno" class="form-label">Routing No.</label>
                                    <input class="input form-control" id="routingno" type="tel" name="routing_no" placeholder="Routing No." required/>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="remarks" class="form-label">Notes</label>
                                    <textarea name="remarks" id="remarks" placeholder="Notes" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer" style="height:50px">
                        <button type="button" class="btn btn-sm btn-danger light" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-sm btn-primary submit_btn">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


</x-app-layout>

<script src="https://cdnjs.cloudflare.com/ajax/libs/imask/3.3.0/imask.min.js"></script>


<script>
    $(document).ready(function () {

        $(".edit-data").click(function () {
            var itemId = $(this).data('id');

            $.ajax({
                url:'{{ route('bank_edit') }}',
                method:'GET',
                dataType:"JSON",
                data:{'id':itemId},
                success:function(response){
                    console.log(response);
                    $('.bd-example-modal-lg').modal('show');
                    $('.modal-title').text('Edit Information');
                    $('#bankName').empty();
                    $('#bankName').val(response.bank_name);
                    $('#branchName').empty();
                    $('#branchName').val(response.branch_name);
                    $('#accountNumber').empty();
                    $('#accountNumber').val(response.acc_no);
                    $('#acctype').empty();
                    $('#acctype').val(response.acc_type);
                    $('#holderName').empty();
                    $('#holderName').val(response.holder_name);
                    $('#routingno').empty();
                    $('#routingno').val(response.routing_no);
                    $('#remarks').empty();
                    $('#remarks').val(response.remarks);
                    $('.submit_btn').html('Update');
                    let updateUrl = '{{ route("update_bank_info", ":id") }}';
                        updateUrl = updateUrl.replace(':id', response.id);
                        $('#editform').attr('action', updateUrl);
                }
            });


        });

        $(".view-data").click(function () {
            var itemId = $(this).data('id');

            $.ajax({
                url:'{{ route('bank_edit') }}',
                method:'GET',
                dataType:"JSON",
                data:{'id':itemId},
                success:function(response){
                    console.log(response);
                    $('.bd-example-modal-lg').modal('show');
                    $('.modal-title').text('View Information');
                    $('#bankName').empty();
                    $('#bankName').val(response.bank_name).prop('readonly', true);
                    $('#branchName').empty();
                    $('#branchName').val(response.branch_name).prop('readonly', true);
                    $('#accountNumber').empty();
                    $('#accountNumber').val(response.acc_no).prop('readonly', true);
                    $('#acctype').empty();
                    $('#acctype').val(response.acc_type).prop('readonly', true);
                    $('#holderName').empty();
                    $('#holderName').val(response.holder_name).prop('readonly', true);
                    $('#routingno').empty();
                    $('#routingno').val(response.routing_no).prop('readonly', true);
                    $('#remarks').empty();
                    $('#remarks').val(response.remarks).prop('readonly', true);
                    $('.submit_btn').hide();

                }
            });


        });
    });
</script>












