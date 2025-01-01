
<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <!-- card header -->
                <div class="card-header bg-primary">
                    <h4 class="card-title">Supplier Dues List</h4>
                </div>

                <!-- card body -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <table id="example3" class="display table table-stripe table-hover">
                            <thead class="thead-head">
                              <tr>
                                <th>Sl. No.</th>
                                <th>Supplier Name</th>
                                <th>Total Purchase</th>
                                <th>Paid Amount</th>
                                <th>Due Amount</th>
                                <th>Advance</th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach($totalSupplierReport as $report)
                                    @php
                                        $dueAmount = $report->total_debit - $report->total_credit;
                                    @endphp
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td class="text-left">{{ $report->sallername->company_name }}</td>
                                        <td class="text-right">{{ number_format($report->total_debit) }}</td>
                                        <td class="text-right">{{ number_format($report->total_credit) }}</td>
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
                                        {{ number_format($totalsupdebit) }}

                                    </td>
                                    <td style="text-align: end;font-weight: bold;">
                                        {{ number_format($totalsupcredit) }}

                                    </td>
                                    <td style="text-align: end;font-weight: bold;">
                                        {{ number_format($totaldue) }}

                                    </td>
                                    <td style="text-align: center;font-weight: bold;">
                                        @if($totaldue < 0)
                                        <span class="badge light badge-primary">
                                            {{ number_format($totaldue) }}
                                        </span>
                                    @else
                                        0
                                    @endif
                                    </td>

                                </tr>
                            </tfoot>

                          </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>




































