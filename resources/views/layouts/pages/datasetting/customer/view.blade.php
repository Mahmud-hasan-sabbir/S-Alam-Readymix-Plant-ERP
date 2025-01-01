<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Customer View page</h4>
                    <a href="{{ route('information.index',['cat_id' => 2]) }}" class="btn btn-sm btn-primary"><i class="fa fa-reply"></i><span class="btn-icon-add"></span>Back</a>
                </div>
                <div class="card-body">
                    <form class="form-valide" action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" id="edit_id" name="edit_id">
                        <div class="modal-body py-2 px-4">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-md-5 col-form-label">Customer Name

                                        </label>
                                        <div class="col-md-7">
                                           <input type="text" readonly value="{{ $customerView->company_name }}" placeholder=" customer name.." id="" aria-invalid aria-required="true"  name="customer_name" class="form-control" >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <div class="form-group row">
                                                <label for="" class="col-md-5">Security Cheque : </label>
                                                <div class="col-md-7">
                                                    <div id="file-preview" style="margin-top: 10px;">
                                                        @if (pathinfo($customerView->security_cheque, PATHINFO_EXTENSION) == 'pdf')
                                                            <a href="{{ asset($customerView->security_cheque) }}" target="_blank">{{ basename($customerView->security_cheque) }}</a>
                                                        @elseif (in_array(pathinfo($customerView->security_cheque, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif']))
                                                            <img src="{{ asset($customerView->security_cheque) }}" alt="Attachment" style="width: 40px; height: 40px;">
                                                        @else
                                                            {{ basename($customerView->security_cheque) }}
                                                        @endif
                                                    </div>

                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-md-5 col-form-label">Project Name

                                        </label>
                                        <div class="col-md-7">
                                           <input type="text" readonly value="{{ $customerView->project_name }}" placeholder=" project name.." id="" aria-invalid aria-required="true"  name="project_name" class="form-control" >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <div class="form-group row">
                                                <label for="" class="col-md-5">Bank Guaranty</label>
                                                <div class="col-md-7">
                                                    <div id="file-preview" style="margin-top: 10px;">
                                                        @if (pathinfo($customerView->bank_guaranty, PATHINFO_EXTENSION) == 'pdf')
                                                            <a href="{{ asset($customerView->bank_guaranty) }}" target="_blank">{{ basename($customerView->bank_guaranty) }}</a>
                                                        @elseif (in_array(pathinfo($customerView->bank_guaranty, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif']))
                                                            <img src="{{ asset($customerView->bank_guaranty) }}" alt="Attachment" style="width: 40px; height: 40px;">
                                                        @else
                                                            {{ basename($customerView->bank_guaranty) }}
                                                        @endif
                                                    </div>


                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-md-5 col-form-label">Contact Person

                                        </label>
                                        <div class="col-md-7">
                                           <input type="text" readonly value="{{ $customerView->contact_person }}" placeholder=" contact person.." id="" aria-invalid aria-required="true"  name="contact_person" class="form-control" >
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <div class="form-group row">
                                                <label for="" class="col-md-5">Work Order</label>
                                                <div class="col-md-7">
                                                    <div id="file-preview" style="margin-top: 10px;">
                                                        @if (pathinfo($customerView->work_order, PATHINFO_EXTENSION) == 'pdf')
                                                            <a href="{{ asset($customerView->work_order) }}" target="_blank">{{ basename($customerView->work_order) }}</a>
                                                        @elseif (in_array(pathinfo($customerView->work_order, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif']))
                                                            <img src="{{ asset($customerView->work_order) }}" alt="Attachment" style="width: 40px; height: 40px;">
                                                        @else
                                                            {{ basename($customerView->work_order) }}
                                                        @endif
                                                    </div>

                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-md-5 col-form-label">Site Location

                                        </label>
                                        <div class="col-md-7">
                                           <input type="text" readonly value="{{ $customerView->Address }}" placeholder=" site location.." id="" aria-invalid aria-required="true"  name="site_location" class="form-control" >
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <div class="form-group row">
                                                <label for="" class="col-md-5">NID</label>
                                                <div class="col-md-7">
                                                    <div id="file-preview" style="margin-top: 10px;">
                                                        @if (pathinfo($customerView->nid, PATHINFO_EXTENSION) == 'pdf')
                                                            <a href="{{ asset($customerView->nid) }}" target="_blank">{{ basename($customerView->nid) }}</a>
                                                        @elseif (in_array(pathinfo($customerView->nid, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif']))
                                                            <img src="{{ asset($customerView->nid) }}" alt="Attachment" style="width: 40px; height: 40px;">
                                                        @else
                                                            {{ basename($customerView->nid) }}
                                                        @endif
                                                    </div>

                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="" class="col-md-5">Status</label>
                                        <div class="col-md-7">
                                            <select name="status" @selected(true) disabled id="" class="form-control">
                                                <option value="Active" {{ $customerView->Status == 'Active' ? 'selected' : '' }}>Active</option>
                                                <option value="Inactive" {{ $customerView->Status == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <div class="form-group row">
                                                <label for="" class="col-md-5">Attachment</label>
                                                <div class="col-md-7">
                                                    <div id="file-preview" style="margin-top: 10px;">
                                                        @if (pathinfo($customerView->attachment, PATHINFO_EXTENSION) == 'pdf')
                                                            <a href="{{ asset($customerView->attachment) }}" target="_blank">{{ basename($customerView->attachment) }}</a>
                                                        @elseif (in_array(pathinfo($customerView->attachment, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif']))
                                                            <img src="{{ asset($customerView->attachment) }}" alt="Attachment" style="width: 40px; height: 40px;">
                                                        @else
                                                            {{ basename($customerView->attachment) }}
                                                        @endif
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-md-5 col-form-label">Email

                                        </label>
                                        <div class="col-md-7">
                                            <input type="email" readonly value="{{ $customerView->Email }}" id="email" placeholder="customer Email.." aria-invalid aria-required="true"  name="email" class="form-control" >
                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-md-5 col-form-label">Mobile Number

                                        </label>
                                        <div class="col-md-7">
                                            <input class="input form-control" readonly value="{{ $customerView->mobile_no }}"  placeholder="mobile no .." id="personnalNumber" type="tel" name="mobile_no" placeholder="" autocomplete="off"  aria-labelledby="InputLabel" aria-invalid aria-required="true"  tabindex="1" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="" class="col-md-5">Opening Date</label>
                                        <div class="col-md-7">
                                            <input type="date" readonly value="{{ $customerView->opening_date }}" name="date" class="form-control"  id="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="" class="col-md-5">Note</label>
                                        <div class="col-md-7">
                                            <textarea name="note" readonly placeholder="note....." class="form-control"  id="" cols="30" rows="2">{{ $customerView->note }}</textarea>
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












