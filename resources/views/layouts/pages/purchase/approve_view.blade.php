<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                       Approve Data View
                    </h4>
                    <a href="{{ route('purchase_approve_list') }}" class="btn btn-success" style="float: inline-end">Next</a>

                </div>

                <div class="card-body" id="reload">
                    <form class="form-valide" action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body py-2">
                            <div class="row" id="main-row-data">
                                <input type="hidden" name="total_amount" id="total_amount">
                                <div class="col-md-4">
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label">Order No : </label>
                                        <div class="col-md-8">
                                            <input type="text" readonly id="orderNO" name="po_no" value="{{ $purchaseEdit->PO_No }}"  class="form-control" style="border:none">

                                            {{-- <label  class="col-form-label" name="po_no" id="inv_no">{{ $purchase_codes }}</label> --}}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4" style="margin-left: -28px">
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label">Order Date : </label>
                                        <div class="col-md-8">
                                            <input type="date" name="inv_date" id="inv_date" readonly class="form-control" value="{{ $purchaseEdit->order_date }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label">Challan No :</label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" readonly value="{{ $purchaseEdit->challan_no }}" name="challan_no" placeholder="enter your challan no" id="challanNO">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group row">
                                        <label class="col-md-5 col-form-label">Supplier Name :
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-md-7">
                                            <select name="supplier_id" id="supplierId" @selected(true) disabled class="form-control dropdwon_select" required>
                                            <option selected disabled>--Select--</option>
                                            @foreach($allSupplier as $row)
                                                <option value="{{ $row->id}}" {{ $row->id == $purchaseEdit->supplier_id ? 'selected' : '' }}>{{ $row->Saller_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label">Truck No :</label>
                                        <div class="col-md-8">
                                            <input type="text" name="truck_no" readonly value="{{ $purchaseEdit->truck_no }}" class="form-control" placeholder="enter your truck no" id="truckNO">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label">Truck Fees :</label>
                                        <div class="col-md-8">
                                            <input type="text" name="truck_fees" readonly value="{{ $purchaseEdit->truck_fees }}" class="form-control" placeholder="enter your truck fess" id="truckfees">
                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="" class="col-md-2">Remarks :</label>
                                        <div class="col-md-10">
                                            <textarea name="remarks" readonly id="remarks" cols="30" rows="2" class="form-control" style="width: 95%; margin-left: 45px;">{{ $purchaseEdit->remarks }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-md-5 col-form-label">Store Name :
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-md-7">
                                            <select name="store_id" @selected(true) disabled id="storeId" class="form-control dropdwon_select" required>
                                                <option selected disabled>--Select--</option>
                                                @foreach ($allstoreName as $row)
                                                    <option value="{{$row->id}}" {{ $row->id == $purchaseEdit->store_id ? 'selected' : '' }}>{{$row->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <table id="audit-design-matrix-table" class="table table-bordered" >
                                        <thead class="thead-light" style="">
                                            <tr>
                                                <th width="20%" style="text-transform: capitalize">Category Name</th>
                                                <th width="20%" style="text-transform: capitalize">Materials</th>
                                                <th width="15%" style="text-transform: capitalize">Unit</th>
                                                <th width="10%" style="text-transform: capitalize">Qty</th>
                                                <th width="15%" style="text-transform: capitalize">Price</th>
                                                <th width="15%" style="text-transform: capitalize">Subtotal</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($purchaseDetails as $key => $data)
                                                <tr class="audit_design_matrix_row addr">
                                                    <input type="hidden" name="data[{{$key}}][id]" value="{{ $data->id }}">
                                                    <input type="hidden" name="data[{{ $key }}][purId]" value="{{ $data->purchase_id }}">
                                                    <td>
                                                        <select name="data[{{$key}}][category_id]" @selected(true) disabled style="border-radius: 30px" id="categoryId" class="form-control category-select" required>
                                                            <option value="" selected disabled> select Category </option>
                                                            @foreach ($allcategory as $item)
                                                            <option value="{{ $item->id }}" {{ $item->id == $data->category_id ? 'selected' : '' }}>{{ $item->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select name="data[{{$key}}][materials_id]" @selected(true) disabled style="border-radius: 30px" id="materialId" class="form-control material-select" required>
                                                            @foreach ($data->material as $row)
                                                            <option value="{{ $row->id }}" {{ $row->id == $data->category_id ? 'selected' : '' }}>{{ $row->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select name="data[{{$key}}][unit_id]" @selected(true) disabled style="border-radius: 30px" class="form-control" required>
                                                            <option value="" selected disabled> select Unit</option>
                                                            @foreach ($allunit as $item)
                                                            <option value="{{ $item->id }}" {{ $item->id == $data->unit_id ? 'selected' : '' }}>{{ $item->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <input type="text" name="data[{{$key}}][qty]" readonly value="{{ $data->Qty }}" class="qtyinput form-control expected_benefits">
                                                    </td>
                                                    <td>
                                                        <input type="number" name="data[{{$key}}][amount]" readonly value="{{ $data->price }}" class="amountinput form-control expected_benefits">
                                                    </td>
                                                    <td>
                                                        <input type="number" name="data[{{$key}}][subtotal]" readonly value="{{ $data->sub_total }}" class="subtotal form-control expected_benefits" readonly>
                                                    </td>

                                                </tr>
                                                @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-12">
                                    <div class="float-right">
                                        <h6>Total <span style="border: 1px solid #2222; padding: 10px 40px; margin-left: 10px" id="total">{{ $purchaseEdit->Total_purchase_amount }}</span></h6>
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
    </div>
    <!--=======//Modal Show Data//========-->





</x-app-layout>












