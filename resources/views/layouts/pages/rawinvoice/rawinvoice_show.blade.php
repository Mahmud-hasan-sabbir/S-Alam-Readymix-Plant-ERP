<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content" style="width: 1270px;margin-left:-60px">
            <div class="modal-header bg-primary">
                <h5 class="modal-title">Raw Invoice  Order</h5>

                <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span></button>
            </div>

            <form id="myForm" class="form-valide" action="{{ route('store_rawinvoice') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body py-2">
                    <div class="row" id="main-row-data">
                        <input type="hidden" name="total_amount" id="total_amount">

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="orderNO" class="form-label">Order No : </label>
                                <input type="text" readonly id="orderNO" name="RI_No" value="{{ $rawsale_codes }}"  class="form-control">

                                <!-- <label  class="col-form-label" name="po_no" id="inv_no"></label> -->
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="inv_date" class="form-label">Order Date :</label>
                                <input type="date" name="inv_date" id="inv_date" class="form-control" value="{{ old('date') ? old('date'):  date('Y-m-d') }}">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="supplierId" class="form-label">Customer : <span class="text-danger">*</span></label>
                                <select name="customer_name" id="supplierId" class="form-control dropdwon_select" required>
                                    <option selected disabled>Select Customer</option>
                                    @foreach($allCustomer as $row)
                                        <option value="{{ $row->id}}">{{ $row->company_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="categoryId" class="form-label">
                                    Category Name : <span class="text-danger">*</span>
                                </label>

                                <select name="" id="categoryId" class="form-control dropdwon_select" required>
                                    <option selected disabled>Select Category</option>
                                    @foreach($allcategory as $row)
                                        <option value="{{ $row->id}}">{{ $row->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="materialId" class="form-label">Materials Name : <span class="text-danger">*</span></label>
                                <select name="" id="materialId" class="form-control dropdwon_select" required>

                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="storeId" class="form-label">Store Name :<span class="text-danger">*</span></label>
                                <select name="store_id" id="storeId" class="form-control dropdwon_select" required>
                                    <option selected disabled>Select Store</option>
                                    @foreach ($allstoreName as $row)
                                        <option value="{{$row->id}}">{{$row->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="unitId" class="form-label">Unit Name : <span class="text-danger">*</span> </label>
                                <select name="unit_id" id="unitId" class="form-control dropdwon_select" required>
                                    @foreach ($allunit as $row)
                                        <option value="{{$row->id}}">{{$row->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <div style="margin-top: 30px;">
                                    <button type='button' class="btn btn-sm btn-primary add_row"><i class="fa fa-plus"></i><span class="btn-icon-add"></span>Add More</button>
                                </div>
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
                                        <th>store</th>
                                        <th>Unit</th>
                                        <th>Stock Value</th>
                                        <th>Location</th>
                                        <th>Quantity (kg)</th>
                                        <th>Unit Price (Ton)</th>
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
                            <div class="float-right" id="totaledit">
                                <h6 style="margin-left: -125px">Discount</h6>
                                <input type="text" id="discount" name="discount" placeholder="0.00" class="form-control form-total">
                            </div>
                        </div>

                        <div class="col-md-12" style="margin-top: 15px">
                            <div class="float-right" id="discount-container">
                                <h6 style="margin-left: -125px">Total</h6>

                                <input type="text" id="total" readonly name="netamount" placeholder="0.00" class="form-control form-total"style="margin-top: -35px">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="" class="form-label">Remarks :</label>
                                <textarea name="remarks" id="remarks" cols="30" rows="2" class="form-control"></textarea>
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
