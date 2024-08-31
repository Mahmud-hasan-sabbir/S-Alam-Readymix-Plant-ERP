
<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <!-- card header -->
                <div class="card-header">
                    <h4 class="card-title">
                    Total customer Report
                    </h4>
                    <div>
                        
                        <a href="" class="btn btn-sm btn-primary"><i class="fa fa-reply"></i><span class="btn-icon-add"></span>Back</a>
                    </div>

                </div>
                <!-- card body -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                          <h6 class="text-muted">Total Sales and paid amount</h6>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <table class="table">
                            <thead class="thead-dark">
                              <tr>
                                <th>SL.NO</th>
                                <th>Customer Name</th>
                                <th>Total Sales</th>
                                <th>Received Amount</th>
                                <th>Due Amount</th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach($totalcustomerReport as $report)
                                    @php
                                        $totalSales = floatval($report['total_credit']);
                                        $receivedAmount = floatval($report['total_debit']);
                                        $dueAmount = $totalSales - $receivedAmount;
                                    @endphp
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $report['saller']->company_name }}</td> 
                                        <td>{{ number_format($totalSales, 2, '.', ',') }}</td>
                                        <td>{{ number_format($receivedAmount, 2, '.', ',') }}</td>
                                        <td>
                                            {{ number_format($dueAmount, 2, '.', ',') }}
                                            @if($dueAmount < 0)
                                                (Advanced)
                                            @endif
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






































