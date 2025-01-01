
<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <!-- card header -->
                <div class="card-header">
                    <h4 class="card-title">
                     Store Wise Report
                    </h4>
                    <div>

                        <a href="" class="btn btn-sm btn-primary"><i class="fa fa-reply"></i><span class="btn-icon-add"></span>Back</a>
                    </div>

                </div>
                <!-- card body -->
                <div class="card-body">

                    <div class="row">
                        <div class="col-md-5">
                            <div class="row">
                                <label class="col-md-4 col-form-label font-weight-bold">Store Name</label>
                                <div class="col-md-8">
                                    <select name="land_id" id="storeId" class="form-control dropdwon_select">
                                        <option value="" selected disabled>Select store name</option>
                                        @foreach($allStoreName as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
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
                            <thead class="thead-dark" style="display: none">
                                <tr>
                                    <th style="width: 25%"></th>
                                    <th style="width: 25%"></th>
                                    <th style="width: 25%">store Wise Report</th>
                                    <th style="width: 25%"></th>
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
    $(document).on('click', '#filter', function(){
       var storeId = $('#storeId').val();
    //    alert(storeId);
       $.ajax({
           url: '{{ route('get_store_wise_report') }}',
           method: 'GET',
           dataType: "html",
           data: { storeId },
           success: function(response){
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



































