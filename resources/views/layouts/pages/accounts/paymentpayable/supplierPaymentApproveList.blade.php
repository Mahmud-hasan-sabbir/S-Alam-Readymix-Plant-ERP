<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-primary">
                    <h4 class="card-title">Supplier Payment Approve List</h4>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example3" class="display table table-hover">
                            <thead>
                                <tr>
                                    <th>Sl. No.</th>
                                    <th>Date</th>
                                    <th>Supplier Name</th>
                                    <th>Payment Type</th>
                                    <th>Purpose</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($allapprovelist as $data)

                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ date('d-m-y', strtotime($data->pay_date)) }}</td>
                                    <td>{{ $data->supplierName->company_name }}</td>
                                    <td>{{ $data->pay_mode }}</td>
                                    <td>{{ $data->pay_reason }}</td>
                                    <td>{{ number_format($data->pay_amount) }}</td>
                                    <td>
                                        <span class="badge light badge-primary">
                                            Pending
                                        </span>
                                    </td>
                                    <td>
                                        <form action="{{ route('supplier_payment_approve',['id' => $data->id]) }}" method="post" >
                                            <button class="btn btn-success light view display-inline" title="Approved">
                                                <i class="fa fa-check-circle"></i>
                                            </button>
                                            @csrf
                                            @method('PATCH')
                                        </form>

                                        <form action="{{ route('supplier_payment_cancaled',['id' => $data->id]) }}" method="post" >
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

















