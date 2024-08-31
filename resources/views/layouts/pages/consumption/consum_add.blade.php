<x-app-layout>

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-header">
                <h6 class="card-title">
                    Add Consumption
                    <a href="" class="btn btn-inverse-primary float-end" data-bs-toggle="tooltip" data-bs-placement="left" title="Invoice List">

                    </a>
                </h6>
            </div>



            <div class="card-body">

                <div class="row">
                    <table class="table table-striped table-bordered table-sm mb-3">
                        <thead>
                            <tr class="text-center">
                                <th>Black Stone</th>
                                <th>Mixed Builder</th>
                                <th>Dubai</th>
                                <th>10MM</th>
                                <th>PCC Cement</th>
                                <th>OPC cement</th>
                                <th>Beg cement</th>
                                <th>Sand</th>
                                <th>Admixer</th>
                                <th>Bricks</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr class="text-end" id="initial-values">
                                <td>
                                    <div class="input-group">
                                        {{-- <span class="input-group-text">Kg</span> --}}
                                        <input type="text" class="form-control" style="text-align: right;" readonly name="Black Stone[]" id="initial-BlackStone" value="{{ $blackstone->cur_qty ?? 0 }}" autocomplete="off" autofocus>
                                    </div>
                                </td>

                                <td>
                                    <div class="input-group">
                                        {{-- <span class="input-group-text">kg</span> --}}
                                        <input type="text" class="form-control" style="text-align: right;" readonly name="Mixed Builder[]" id="initial-MixedBuilder" value="{{ $mixedbuilder->cur_qty ?? 0 }}" autocomplete="off">
                                    </div>
                                </td>

                                <td>
                                    <div class="input-group">
                                        {{-- <span class="input-group-text">kg</span> --}}
                                        <input type="text" class="form-control" style="text-align: right;" readonly name="black_stone[]" id="initial-Dubai" value="{{ $dubai->cur_qty ?? 0 }}" autocomplete="off">
                                    </div>
                                </td>

                                <td>
                                    <div class="input-group">
                                        {{-- <span class="input-group-text">kg</span> --}}
                                        <input type="text" class="form-control" style="text-align: right;" readonly name="bolder_stone[]" id="initial-mm10" value="{{ $mm10->cur_qty ?? 0 }}" autocomplete="off">
                                    </div>
                                </td>

                                <td>
                                    <div class="input-group">
                                        {{-- <span class="input-group-text">kg</span> --}}
                                        <input type="text" class="form-control" style="text-align: right;" readonly name="dubai_stone[]" id="initial-pccCement" value="{{ $pccCement->cur_qty ?? 0 }}" autocomplete="off">
                                    </div>
                                </td>

                                <td>
                                    <div class="input-group">
                                        {{-- <span class="input-group-text">kg</span> --}}
                                        <input type="text" class="form-control" style="text-align: right;" readonly name="sand[]" id="initial-opcCement" value="{{ $opcCement->cur_qty ?? 0 }}" autocomplete="off">
                                    </div>
                                </td>

                                <td>
                                    <div class="input-group">
                                        {{-- <span class="input-group-text">kg</span> --}}
                                        <input type="text" class="form-control" style="text-align: right;" readonly name="bricks[]" id="initial-begCement" value="{{ $begCement->cur_qty ?? 0 }}" autocomplete="off">
                                    </div>
                                </td>
                                <td>
                                    <div class="input-group">
                                        {{-- <span class="input-group-text">kg</span> --}}
                                        <input type="text" class="form-control" style="text-align: right;" readonly name="bricks[]" id="initial-sand" value="{{ $sand->cur_qty ?? 0 }}" autocomplete="off">
                                    </div>
                                </td>
                                <td >
                                    <div class="input-group">
                                        {{-- <span class="input-group-text">kg</span> --}}
                                        <input type="text" class="form-control" style="text-align: right;" readonly name="bricks[]" id="initial-admixer" value="{{ $admixer->cur_qty ?? 0 }}" autocomplete="off">
                                    </div>
                                </td>
                                <td >
                                    <div class="input-group">
                                        {{-- <span class="input-group-text">kg</span> --}}
                                        <input type="text" class="form-control" style="text-align: right;" readonly name="bricks[]" id="initial-bricks" value="{{ $bricks->cur_qty ?? 0 }}" autocomplete="off">
                                    </div>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>


                <form action="{{ route('store_consumption') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-striped table-bordered table-sm mb-3">
                                <tr class="text-center">
                                    <th width="50%">Invoice Number: {{ $invoice->inv_no }}</th>
                                    <th width="50%">Date: {{ now()->format('d-m-Y') }}</th>
                                </tr>
                            </table>

                        </div>
                        <div class="col-md-6">
                            <table class="table table-striped table-bordered table-sm mb-3">
                                <tr class="text-center">
                                    <th>Customer Name: {{ $invoice->customerName->company_name }} </th>
                                </tr>
                            </table>

                        </div>
                    </div>

                    <table class="table table-striped table-bordered table-sm mb-3">
                        <thead>
                            <tr class="text-center">
                                <th>Grade</th>
                                <th>Qty(m3)</th>
                                <th>Black Stone</th>
                                <th>Mixed Builder</th>
                                <th>Dubai</th>
                                <th>10MM</th>
                                <th>PCC Cement</th>
                                <th>OPC Cement</th>
                                <th>Beg Cement</th>
                                <th>Sand</th>
                                <th>Admixer</th>
                                <th>Bricks</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($invoice['invdetail'] as $key => $row)
                            <input type="hidden" name="date[]" value="{{ now()->format('Y-m-d') }}">
                            <input type="hidden" name="invoice_id[]" value="{{ $invoice->id }}">
                            <input type="hidden" name="customer_id[]" value="{{ $invoice->customerName->id }}">
                            <input type="hidden" name="grade_id[]" value="{{ $row->grade_id }}">
                            <tr class="text-end">
                                <td>
                                    <input type="text"  value="{{ $row->grade->name }}" class="form-control" readonly>
                                </td>
                                <td>
                                    <input type="text" name="quantity[]" value="{{ $row->qty_m3 }}" class="form-control qtycheck" readonly>
                                </td>
                                <td>
                                    <input type="text" class="form-control check-value" style="border-radius: 7px;" name="black_stone[]" data-initial="initial-BlackStone" autocomplete="off">
                                </td>
                                <td>
                                    <input type="text" class="form-control check-value" style="border-radius: 7px;" name="mixed_builder[]" data-initial="initial-MixedBuilder" autocomplete="off">
                                </td>
                                <td>
                                    <input type="text" class="form-control check-value" style="border-radius: 7px;" name="dubai[]" data-initial="initial-Dubai" autocomplete="off">
                                </td>
                                <td>
                                    <input type="text" class="form-control check-value" style="border-radius: 7px;" name="mm10[]" data-initial="initial-mm10" autocomplete="off">
                                </td>
                                <td>
                                    <input type="text" class="form-control check-value" style="border-radius: 7px;" name="pcc_cement[]" data-initial="initial-pccCement" autocomplete="off">
                                </td>
                                <td>
                                    <input type="text" class="form-control check-value" style="border-radius: 7px;" name="opc_cement[]" data-initial="initial-opcCement" autocomplete="off">
                                </td>
                                <td>
                                    <input type="text" class="form-control check-value" style="border-radius: 7px;" name="beg_cement[]" data-initial="initial-begCement" autocomplete="off">
                                </td>
                                <td>
                                    <input type="text" class="form-control check-value" style="border-radius: 7px;" name="sand[]" data-initial="initial-sand" autocomplete="off">
                                </td>
                                <td>
                                    <input type="text" class="form-control check-value" style="border-radius: 7px;" name="admixer[]" data-initial="initial-admixer" autocomplete="off">
                                </td>
                                <td>
                                    <input type="text" class="form-control check-value" style="border-radius: 7px;" name="bricks[]" data-initial="initial-bricks" autocomplete="off">
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="form-group mt-3" style="float: inline-end">
                        <button type="submit" class="btn btn-success btn-sm" data-bs-toggle="tooltip" data-bs-placement="right" title="Create New Invoice">Submit</button>
                    </div>
                </form>
            </div> <!-- End Card Body -->
        </div>
    </div>
</div>
</x-app-layout>


<script>
   document.addEventListener('DOMContentLoaded', function() {
    const inputs = document.querySelectorAll('.check-value');

    inputs.forEach(input => {
        input.addEventListener('input', function() {
            var currentRow = $(this).closest('tr');
            const initialId = this.getAttribute('data-initial');
            const initialValue = parseFloat(document.getElementById(initialId).value) || 0;
            const inputValue = parseFloat(this.value) || 0;

            if (inputValue > initialValue) {
                alert(`Insufficient quantity for ${initialId.replace('initial-', '').replace(/_/g, ' ')}`);
                this.value = '';
            }

        });
    });
});
</script>
