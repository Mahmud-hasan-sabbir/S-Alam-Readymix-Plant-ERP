<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        Supplier Payment Approve List
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
                                    <th>Supplier</th>
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
                                    <td>{{ $data->supplierName->company_name }}</td>
                                    <td>{{ $data->pay_mode }}</td>
                                    <td>{{ $data->pay_reason }}</td>
                                    <td>{{ $data->pay_amount }}</td>
                                    <td>{{ $data->pay_date }}</td>
                                    <td>
                                        <div style="width: 100%;margin-left:-50px">
                                            <form action="{{ route('supplier_payment_approve',['id' => $data->id]) }}" method="post" >
                                                <button class="btn btn-sm btn-success" style="padding: 3px">Approve</i></button>
                                                @csrf
                                                @method('PATCH')
                                            </form>
                                            <form action="{{ route('supplier_payment_cancaled',['id' => $data->id]) }}" method="post" >
                                                <button class="btn btn-sm btn-danger" style="padding: 3px;float: left;margin-left:58px;margin-top:-27px">Cancale</i></button>
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

















