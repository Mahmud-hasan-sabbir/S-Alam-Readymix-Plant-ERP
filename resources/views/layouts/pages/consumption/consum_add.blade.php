<x-app-layout>

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-header bg-primary">
                <h4 class="card-title">Add Consumption</h4>
                <a href="{{ route('consumption') }}" class="btn btn-sm btn-success">
                        <i class="fa fa-reply"></i>
                        <span class="btn-icon-add"></span>Back
                    </a>
            </div>

            <div class="card-body">

                <form action="{{ route('store_consumption') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <table class="table table-striped table-bordered table-sm mb-3">
                                <tr class="text-center">
                                    <td> {{ $invoice->inv_no }}</td>
                                </tr>
                            </table>
                        </div>

                        <div class="col-md-4">
                            <table class="table table-striped table-bordered table-sm mb-3">
                                <tr class="text-center">
                                    <td>Date: {{ $invoice->date }}</td>
                                </tr>
                            </table>
                        </div>

                        <div class="col-md-4">
                            <table class="table table-striped table-bordered table-sm mb-3">
                                <tr class="text-center">
                                    <td><span class="font-weight-bold">{{ $invoice->customerName->company_name }}</span></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <table class="table table-striped table-bordered table-sm mb-3">
                        <thead>
                            <tr class="text-center">
                                <th>Grade</th>
                                <th>Quantity</th>
                                <th>Admixer</th>
                                <th>10mm</th>
                                <th>Bolder</th>
                                <th>Black</th>
                                <th>Dubai</th>
                                <th>Sand</th>
                                <th>Cement</th>
                                <th>Brick</th>
                            </tr>
                        </thead>
                         <tbody>
                            <tr class="text-end" id="initial-values">
                                <td colspan="2" class="text-center font-weight-bold">Stock Quantity</td>

                                <td>
                                    <div class="input-group">
                                        <input type="text" class="form-control text-right" readonly name="bricks[]" id="initial-admixer" value="{{ $admixer->cur_qty ?? 0 }}">
                                    </div>
                                </td>

                                <td>
                                    <div class="input-group">
                                        <input type="text" class="form-control text-right" readonly name="bolder_stone[]" id="initial-mm10" value="{{ $mm10->cur_qty ?? 0 }}">
                                    </div>
                                </td>

                                <td>
                                    <div class="input-group">
                                        <input type="text" class="form-control text-right" readonly name="Mixed Builder[]" id="initial-MixedBuilder" value="{{ $mixedbuilder->cur_qty ?? 0 }}">
                                    </div>
                                </td>

                                <td>
                                    <div class="input-group">
                                        <input type="text" class="form-control text-right" readonly name="Black Stone[]" id="initial-BlackStone" value="{{ $blackstone->cur_qty ?? 0 }}">
                                    </div>
                                </td>

                                <td>
                                    <div class="input-group">
                                        <input type="text" class="form-control text-right" readonly name="black_stone[]" id="initial-Dubai" value="{{ $dubai->cur_qty ?? 0 }}">
                                    </div>
                                </td>

                                <td>
                                    <div class="input-group">
                                        <input type="text" class="form-control text-right" readonly name="bricks[]" id="initial-sand" value="{{ $sand->cur_qty ?? 0 }}">
                                    </div>
                                </td>

                                <td>
                                    <div class="input-group">
                                        <input type="text" class="form-control text-right" readonly name="dubai_stone[]" id="initial-pccCement" value="{{ $Cement->cur_qty ?? 0 }}">
                                    </div>
                                </td>

                                <td >
                                    <div class="input-group">
                                        <input type="text" class="form-control text-right" readonly name="bricks[]" id="initial-bricks" value="{{ $bricks->cur_qty ?? 0 }}">
                                    </div>
                                </td>
                            </tr>

                        </tbody>

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
                                    <input type="text" class="form-control check-value" name="admixer[]" data-initial="initial-admixer" autocomplete="off" autofocus required>
                                </td>

                                <td>
                                    <input type="text" class="form-control check-value" name="mm10[]" data-initial="initial-mm10" autocomplete="off">
                                </td>

                                <td>
                                    <input type="text" class="form-control check-value" name="mixed_builder[]" data-initial="initial-MixedBuilder" autocomplete="off">
                                </td>

                                <td>
                                    <input type="text" class="form-control check-value" name="black_stone[]" data-initial="initial-BlackStone" autocomplete="off">
                                </td>

                                <td>
                                    <input type="text" class="form-control check-value" name="dubai[]" data-initial="initial-Dubai" autocomplete="off">
                                </td>

                                <td>
                                    <input type="text" class="form-control check-value" name="sand[]" data-initial="initial-sand" autocomplete="off" required>
                                </td>

                                <td>
                                    <input type="text" class="form-control check-value" name="cement[]" data-initial="initial-pccCement" autocomplete="off" required>
                                </td>

                                <td>
                                    <input type="text" class="form-control check-value" name="bricks[]" data-initial="initial-bricks" autocomplete="off">
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="form-group mt-3" style="float: inline-end">
                        <button type="submit" class="btn btn-success btn-sm" data-bs-toggle="tooltip" data-bs-placement="right" title="Create New Invoice">Submit</button>
                    </div>
                </form>

<!--                 <div class="row">
                    <table class="table table-striped table-bordered table-sm mb-3">
                        <thead>
                            <tr class="text-center">
                                <th>Admixer</th>
                                <th>10mm</th>
                                <th>Bolder</th>
                                <th>Black</th>
                                <th>Dubai</th>
                                <th>Sand</th>
                                <th>Cement</th>
                                <th>Brick</th>
                            </tr>
                        </thead>


                    </table>
                </div> -->



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
