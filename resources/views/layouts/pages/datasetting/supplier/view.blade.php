<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Supplier View page</h4>
                    <a href="{{ route('information.index',['cat_id' => 1]) }}" class="btn btn-sm btn-primary"><i class="fa fa-reply"></i><span class="btn-icon-add"></span>Back</a>
                </div>

                <div class="card-body">
                    <form class="form-valide"  method="POST" enctype="multipart/form-data">

                        <div class="modal-body py-2 px-4">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-md-5 col-form-label">Company Name
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-md-7">
                                           <input type="text" readonly value="{{ $supplierView->company_name }}" placeholder="company name.." id="" aria-invalid aria-required="true" required name="com_name" class="form-control" >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-md-5 col-form-label">Contact Person
                                        </label>
                                        <div class="col-md-7">
                                           <input type="text" readonly value="{{ $supplierView->contact_person }}" placeholder="contact person.." id="" aria-invalid aria-required="true"  name="contact_name" class="form-control" >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-md-5 col-form-label">Mobile no</label>
                                        <div class="col-md-7">
                                            <input class="input form-control" readonly value="{{ $supplierView->mobile_no }}"  placeholder=" Mobile number.." id="" type="tel" name="mobile_no" placeholder="" autocomplete="off"  aria-labelledby="InputLabel" aria-invalid aria-required="true"  tabindex="1" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-md-5 col-form-label">Email
                                        </label>
                                        <div class="col-md-7">
                                            <input type="email" id="" readonly  value="{{ $supplierView->Email }}" placeholder=" Email.." aria-invalid aria-required="true"  name="email" class="form-control" >
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="" class="col-md-5">Security Cheque</label>
                                        <div class="col-md-7">
                                            <div id="file-preview" style="margin-top: 10px;">
                                                @if (pathinfo($supplierView->security_cheque, PATHINFO_EXTENSION) == 'pdf')
                                                    <a href="{{ asset($supplierView->security_cheque) }}" target="_blank">{{ basename($supplierView->security_cheque) }}</a>
                                                @elseif (in_array(pathinfo($supplierView->security_cheque, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif']))
                                                    <img src="{{ asset($supplierView->security_cheque) }}" alt="Attachment" style="width: 40px; height: 40px;">
                                                @else
                                                    {{ basename($supplierView->security_cheque) }}
                                                @endif
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="" class="col-md-5">Bank Guaranty</label>
                                        <div class="col-md-7">
                                            <div id="file-preview" style="margin-top: 10px;">
                                                @if (pathinfo($supplierView->bank_guaranty, PATHINFO_EXTENSION) == 'pdf')
                                                    <a href="{{ asset($supplierView->bank_guaranty) }}" target="_blank">{{ basename($supplierView->bank_guaranty) }}</a>
                                                @elseif (in_array(pathinfo($supplierView->bank_guaranty, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif']))
                                                    <img src="{{ asset($supplierView->bank_guaranty) }}" alt="Attachment" style="width: 40px; height: 40px;">
                                                @else
                                                    {{ basename($supplierView->bank_guaranty) }}
                                                @endif
                                            </div>


                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="" class="col-md-5">Attachment</label>
                                        <div class="col-md-7">
                                            <div id="file-preview" style="margin-top: 10px;">
                                                @if (pathinfo($supplierView->attachment, PATHINFO_EXTENSION) == 'pdf')
                                                    <a href="{{ asset($supplierView->attachment) }}" target="_blank">{{ basename($supplierView->attachment) }}</a>
                                                @elseif (in_array(pathinfo($supplierView->attachment, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif']))
                                                    <img src="{{ asset($supplierView->attachment) }}" alt="Attachment" style="width: 40px; height: 40px;">
                                                @else
                                                    {{ basename($supplierView->attachment) }}
                                                @endif
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="" class="col-md-5">Opening Date</label>
                                        <div class="col-md-7">
                                            <input type="date" readonly name="date" value="{{ $supplierView->opening_date }}" class="form-control"  id="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="" class="col-md-5">Status</label>
                                        <div class="col-md-7">
                                            <select name="status" @selected(true) disabled id="" class="form-control">
                                                <option value="Active" {{ $supplierView->Status == 'Active' ? 'selected' : ''}}>Active</option>
                                                <option value="Inactive" {{ $supplierView->Status == 'Inactive' ? 'selected' : ''}}>Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="" class="col-md-5"> Address</label>
                                        <div class="col-md-7">
                                            <textarea name="address" readonly class="form-control"  id="" cols="30" rows="2">{{ $supplierView->Address }}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="" class="col-md-5">Note</label>
                                        <div class="col-md-7">
                                            <textarea name="note" readonly class="form-control"  id="" cols="30" rows="2">{{ $supplierView->note }}</textarea>
                                        </div>
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

</x-app-layout>













