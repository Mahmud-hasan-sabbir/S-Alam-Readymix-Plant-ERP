<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-primary">
                    <h4 class="card-title">Return Payment Approve List</h4>
                    
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example3" class="display">
                            <thead>
                                <tr>
                                    <th>Sl. No.</th>
                                    <th>Coustomer Name</th>
                                    <th>Mode</th>
                                    <th>Type</th>
                                    <th>Amount</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($allapprovelist as $data )
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $data->customerName->company_name }}</td>
                                    <td>{{ $data->pay_mode }}</td>
                                    <td>{{ $data->pay_reason }}</td>
                                    <td>{{ (number_format($data->pay_amount)) }}</td>
                                    <td>{{ date('d-m-y', strtotime($data->pay_date)) }}</td>
                                    <td>
                                        <div style="width: 100%;margin-left:-50px">
                                            <form action="{{ route('refunding_payment_approve',['id' => $data->id]) }}" method="post" >
                                                <button class="btn btn-sm btn-success" style="padding: 3px">Approve</i></button>
                                                @csrf
                                                @method('PATCH')
                                            </form>
                                            <form action="" method="post" >
                                                <button class="btn btn-sm btn-danger" style="padding: 3px;float: left;margin-left:58px;margin-top:-27px">delete</i></button>
                                                @csrf
                                                @method('PATCH')
                                            </form>

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


</x-app-layout>

















