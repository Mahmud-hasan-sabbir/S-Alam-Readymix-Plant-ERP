<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-primary">
                    <h4 class="card-title">coustomer Payment Approve List</h4>
                    
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example3" class="display" style="min-width: 845px">
                            <thead>
                                <tr>
                                    <th>Sl. No.</th>
                                    <th>Date</th>
                                    <th>Customer Name</th>
                                    <th>Type</th>
                                    <th>Amount</th>
                                    <th>Remarks</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($allapprovelist as $data )
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ date('d-m-y', strtotime($data->pay_date)) }}</td>
                                    <td>{{ $data->customerName->company_name }}</td>
                                    
                                    <td>{{ $data->pay_mode }}</td>
                                    <td>{{ number_format($data->pay_amount) }}</td>
                                    <td>{{ $data->remarks }} - {{ $data->check_num }}</td>
                                    <td>
                                        <form action="{{ route('coustomer_payment_approve',['id' => $data->id]) }}" method="post" >

                                            <button class="btn btn-success light display-inline" title="Approved">
                                                <i class="fa fa-check-circle"></i>
                                            </button>

                                            @csrf
                                            @method('PATCH')
                                        </form>

                                        <form action="{{ route('coustomer_payment_cancaled',['id' => $data->id]) }}" method="post" >

                                            <button class="btn btn-primary light edit" title="Delete">
                                                <i class="fa fa-trash"></i>
                                            </button>

                                            @csrf
                                            @method('PATCH')
                                        </form>
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

















