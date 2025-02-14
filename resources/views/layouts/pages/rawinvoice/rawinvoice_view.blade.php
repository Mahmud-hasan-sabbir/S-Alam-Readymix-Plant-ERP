<div class="modal fade bd-example-modal-lg-view" id="viewmodal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content" style="width: 1270px;margin-left:-60px">
            <div class="modal-header bg-primary">
                <h5 class="modal-title">Purchase Order View</h5>
                <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span></button>
            </div>

            <form class="form-valide" action="" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body py-2">
                    <div class="row" id="main-row-data">
                        <input type="hidden" name="total_amount" id="total_amount">
                        
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Order No : </label>
                                <input type="text" readonly id="ordernoview" name="po_no" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Order Date : </label>
                                <input type="date" readonly name="inv_date" id="inv_dateview" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Supplier Name :<span class="text-danger">*</span></label>
                                <select name="" id="supplierIdview" @selected(true) disabled class="form-control dropdwon_select" required>
                                    {{-- @foreach($allSupplier as $row)
                                        <option value="{{ $row->id }}">{{ $row->company_name }}</option>
                                    @endforeach --}}
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-12">
                            <table class="table table-striped table-bordered" id="productTable">
                                <thead class="table-head">
                                    <tr>
                                        <th>Category</th>
                                        <th>Product</th>
                                        <th>Store</th>
                                        <th>Unit</th>
                                        <th>Challan No</th>
                                        <th>Truck No</th>
                                        <th>Quantity (Kg)</th>
                                        <th>Unit Price (Ton)</th>
                                        <th>Truck Fee</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>

                        <div class="col-md-12">
                            <div class="float-right">
                                <h6 style="margin-left: -125px">Total amount</h6>
                                <input type="text" style="margin-top: -35px" id="totalamountview" class="form-control totaledit" readonly>
                            </div>
                        </div>

                        <div class="col-md-12" style="margin-top: 15px">
                            <div class="float-right" id="discount-container">
                                <h6 style="margin-left: -125px">Discount</h6>
                                <input type="text" style="margin-top: -35px" readonly name="discount" id="discountview" class="form-control discount" placeholder="0.00">
                            </div>
                        </div>

                        <div class="col-md-12" style="margin-top: 15px">
                            <div class="float-right" id="netamount">
                                <h6 style="margin-left: -125px">Net amount</h6>
                                <input type="text" readonly class="form-control" id="totalview" style="margin-top: -35px">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="" class="form-label">Remarks :</label>
                                <textarea name="remarks" readonly id="remarksview" cols="30" rows="2" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="height:50px">
                    <button type="button" class="btn btn-sm btn-danger light" data-dismiss="modal">Close</button>

                </div>
            </form>
        </div>
    </div>
</div>
