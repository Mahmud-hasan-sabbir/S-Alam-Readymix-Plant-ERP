<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content" style="width: 1270px;margin-left:-60px">
            <div class="modal-header">
                <h5 class="modal-title">
                    Purchase Order
                </h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <form id="myForm" class="form-valide" action="{{ route('store_purchase') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body py-2">
                    <div class="row" id="main-row-data">
                        <input type="hidden" name="total_amount" id="total_amount">
                        <div class="col-md-4">
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label">Order No : </label>
                                <div class="col-md-8">
                                    <input type="text" readonly id="orderNO" name="po_no" value="{{  $purchase_codes }}"  class="form-control" style="border:none">

                                    {{-- <label  class="col-form-label" name="po_no" id="inv_no">{{ $purchase_codes }}</label> --}}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4" style="margin-left: -28px">
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label">Order Date : </label>
                                <div class="col-md-8">
                                    <input type="date" name="inv_date" id="inv_date" class="form-control" value="{{ old('date') ? old('date'):  date('Y-m-d') }}">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group row">
                                <label class="col-md-5 col-form-label">Supplier :
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="col-md-7">
                                    <select name="supplier_name" id="supplierId" class="form-control dropdwon_select" required>
                                    <option selected disabled>--Select--</option>
                                    @foreach($allSupplier as $row)
                                        <option value="{{ $row->id}}">{{ $row->company_name}}</option>
                                    @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group row">
                                <label class="col-md-5 col-form-label">Category Name :
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="col-md-7">
                                    <select name="" id="categoryId" class="form-control dropdwon_select" required>
                                    <option selected disabled>--Select--</option>
                                    @foreach($allcategory as $row)
                                        <option value="{{ $row->id}}">{{ $row->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group row">
                                <label class="col-md-5 col-form-label">Materials Name :
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="col-md-7">
                                    <select name="" id="materialId" class="form-control dropdwon_select" required>

                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group row">
                                <label class="col-md-5 col-form-label">Store Name :
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="col-md-7">
                                    <select name="store_id" id="storeId" class="form-control dropdwon_select" required>
                                        <option selected disabled>--Select--</option>
                                        @foreach ($allstoreName as $row)
                                            <option value="{{$row->id}}">{{$row->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="" class="col-md-2">Remarks :</label>
                                <div class="col-md-10">
                                    <textarea name="remarks" id="remarks" cols="30" rows="2" class="form-control" style="width: 95%; margin-left: 32px;"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group row">
                                <label class="col-md-5 col-form-label">Unit Name :
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="col-md-7">
                                    <select name="unit_id" id="unitId" class="form-control dropdwon_select" required>
                                        <option selected disabled>--Select--</option>
                                        @foreach ($allunit as $row)
                                            <option value="{{$row->id}}">{{$row->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group row">
                                <div style="margin-left:80px;margin-top:8px">
                                    <button type='button' class="btn btn-sm btn-primary add_row"><i class="fa fa-plus"></i><span class="btn-icon-add"></span>Add More</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-12">
                            <table class="table table-bordered" id="productTable">
                                <thead>
                                    <tr>
                                        <th>Category</th>
                                        <th>Product</th>
                                        <th>store</th>
                                        <th>Unit</th>
                                        <th>Challan No</th>
                                        <th>Truck No</th>
                                        <th>Quantity</th>
                                        <th>Unit Price</th>
                                        <th>Truck Fee</th>
                                        <th>Total</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- New rows will be appended here -->
                                </tbody>
                            </table>
                        </div>


                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="d-flex justify-content-end align-items-center" style="margin-top: 15px; float: right;">
                                <h6>Discount:</h6>
                                <input type="text" id="discount" name="discount" placeholder="0.00" class="form-control" style="width: 120px; margin-left: 10px;">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="d-flex justify-content-end align-items-center" style="margin-top: 15px;">
                                <h6>Total:</h6>
                                <input type="text" id="total" readonly name="netamount" placeholder="0.00" class="form-control" style="width: 120px; margin-left: 10px;">
                                {{-- <span style=" padding: 10px 40px; margin-left: 10px;" id="total">0.00</span> --}}
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer" style="height:50px">
                    <button type="button" class="btn btn-sm btn-danger light" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-sm btn-primary submit_btn">Submit</button>
                </div>
            </form>

        </div>
    </div>
</div>
