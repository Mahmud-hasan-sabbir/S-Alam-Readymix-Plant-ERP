
<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <!-- card header -->
                <div class="card-header bg-primary">
                    <h4 class="card-title">All Customer Due List</h4>
                </div>

                <!-- card body -->
                <div class="card-body">

                    <table id="example3" class="display table table-hover">
                            <thead class="bg-light">
                              <tr>
                                <th>Sl. No.</th>
                                <th>Customer Name</th>
                                <th>Total Sales</th>
                                <th>Received Amount</th>
                                <th>Due Amount</th>
                                <th>Advance</th>
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
                                    <td class="text-left">{{ $report['saller']->company_name }}</td>
                                    <td class="text-right">{{ number_format($totalSales) }}</td>
                                    <td class="text-right">{{ number_format($receivedAmount) }}</td>
                                    <td class="text-right">
                                        @if($dueAmount < 0)
                                            <span class="badge light badge-primary">
                                                {{ number_format($dueAmount) }}
                                            </span>
                                        @else
                                            {{ number_format($dueAmount) }}
                                        @endif
                                    </td>
                                    <td>

                                        @if($dueAmount < 0)
                                            <span class="badge light badge-primary">
                                                {{ number_format($dueAmount) }}
                                            </span>
                                        @else
                                            0
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <!-- Empty cells -->
                                    <td colspan="2" style="font-weight: bold; text-align: right;">Total Amount</td>

                                    <!-- Total values -->
                                    <td style="text-align: end;font-weight: bold;">
                                        {{ number_format($totalsales) }}

                                    </td>
                                    <td style="text-align: end;font-weight: bold;">
                                        {{ number_format($totalreceived) }}

                                    </td>
                                    <td style="text-align: end;font-weight: bold;">
                                        {{ number_format($totaldue) }}

                                    </td>
                                    <td style="text-align: center;font-weight: bold;">
                                        {{ number_format($negativeDueTotal) }}
                                    </td>

                                </tr>
                            </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>






































