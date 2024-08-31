
<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <!-- card header -->
                <div class="card-header">
                    <h4 class="card-title">
                      Mode Wise Tranjection Page
                    </h4>
                    <div>
                        {{-- <a href=""  class="btn btn-sm btn-success"><i class="fa fa-print" aria-hidden="true"></i><span class="btn-icon-add"></span>Print</a> --}}
                        <a href="" class="btn btn-sm btn-primary"><i class="fa fa-reply"></i><span class="btn-icon-add"></span>Back</a>
                    </div>

                </div>
                <!-- card body -->
                <div class="card-body">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <label class="col-md-4 col-form-label font-weight-bold" >Form</label>
                                    <div class="col-md-8">
                                        <input type="date" id="start_date" style="margin-left: 10px"  class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="row">
                                    <label class="col-md-4 col-form-label font-weight-bold" >To</label>
                                    <div class="col-md-8">
                                        <input type="date" id="end_date" style="margin-left: -94px" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-5">
                                <div class="row">
                                    <label class="col-md-4 col-form-label font-weight-bold">Mode Name</label>
                                    <div class="col-md-8">

                                        <select name="headName" id="accountId" class="form-control dropdwon_select head" style="margin-left: -20px">
                                            <option value="" selected disabled>select a head name</option>
                                            <option value="Cash">Cash</option>
                                            @foreach ($bankName as $item )
                                                <option value="{{ $item->id }}">{{ $item->bank_name }}</option>
                                             @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            

                            <div class="col-md-2">
                                <div class="row">
                                    <div class="col-md-8">
                                       <button type="submit" id="filter" class="btn btn-success btn-sm">Filter</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <div class="row mt-4">
                        <table class="table" id="data-table">
                            <thead class="thead-dark"  style="display: none">
                              <tr>
                                <th >SL.No</th>
                                <th >Date</th>
                                <th >Mode Name</th>
                                <th >Description</th>
                                <th >Debit</th>
                                <th >Credit</th>
                                <th >Balance</th>
                              </tr>
                            </thead>
                            <tbody id="tbody">

                            </tbody>
                          </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
     $(document).on('click','#filter',function(){
        var startDate = $('#start_date').val();
        var endDate = $('#end_date').val();
        var headCode = $('#accountId').val();
        
       
            $.ajax({
                url:'{{ route('get_modeWiseReport') }}',
                method:'GET',
                dataType:"html",
                data:{startDate,endDate,headCode},
                success:function(response){
                    console.log(response);
                    $('#tbody').html(response);

                    if (response.trim() === '') {

                        $('#data-table thead').hide();
                    } else {

                            $('#data-table thead').show();
                            $('#tbody').html(response);
                    }

                }
            });

        });

</script>

<script>
     $('.dropdwon_select').each(function () {
            $(this).select2({
                dropdownParent: $(this).parent()
            });
        });
</script>






























