<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                       Loan Paid Approve List
                    </h4>

                </div>

                <div class="card-body" id="reload">
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
                            <tbody id="purchase_tbody">
                                @foreach ($allapprovelist as $item)

                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->bank->bank_name }}</td>
                                    <td>{{ $item->loan_amount }}</td>
                                    <td>{{ $item->pay_loan_amount }}</td>
                                    <td>{{ $item->date }}</td>
                                    <td>
                                        <div style="width: 100%;margin-left:-50px">
                                            <form action="{{ route('paidloan_approve',['id' => $item->id]) }}" method="post" >
                                                <button class="btn btn-sm btn-success" style="padding: 3px">Approve</i></button>
                                                @csrf
                                                @method('PATCH')
                                            </form>
                                            <form action="{{ route('paidloan_cancaled',['id' => $item->id]) }}" method="post" >
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






