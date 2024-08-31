<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                       Bank Loan Approve List
                    </h4>

                </div>

                <div class="card-body" id="reload">
                    <div class="table-responsive">
                        <table id="example3" class="display " style="min-width: 845px">
                            <thead>
                                <tr>
                                    <th>SL.#</th>
                                    <th>Bank Name</th>
                                    <th>year Of Loan</th>
                                    <th>Interest Loan</th>
                                    <th>Loan Amount</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody id="purchase_tbody">
                                @foreach ($allapprovelist as $item)

                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->bank->bank_name }}</td>
                                        <td>{{ $item->year_of_loan }}</td>
                                        <td>{{ $item->interest_loan }}</td>
                                        <td>{{ $item->loan_amount }}</td>
                                        <td>{{ $item->start_date }}</td>
                                        <td>{{ $item->end_date }}</td>
                                    <td>
                                        <div style="width: 100%;margin-left:-50px">
                                            <form action="{{ route('bankloan_approve',['id' => $item->id]) }}" method="post" >
                                                <button class="btn btn-sm btn-success" style="padding: 3px">Approve</i></button>
                                                @csrf
                                                @method('PATCH')
                                            </form>
                                            <form action="{{ route('bankloan_cancaled',['id' => $item->id]) }}" method="post" >
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






