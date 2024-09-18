
<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <!-- card header -->
                <div class="card-header">
                    <h4 class="card-title">
                     Sales Balance Sheet
                    </h4>
                    <div>
                        <button id="print" class="btn btn-sm btn-success"><i class="fa fa-reply"></i><span class="btn-icon-add"></span>Print</button>
                        <a href="" class="btn btn-sm btn-primary"><i class="fa fa-reply"></i><span class="btn-icon-add"></span>Back</a>
                    </div>

                </div>
                <!-- card body -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="row">
                                <label class="col-md-4 col-form-label font-weight-bold" >Form</label>
                                <div class="col-md-8">
                                    <input type="date" id="start_date" style="margin-left: 10px"  class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="row">
                                <label class="col-md-4 col-form-label font-weight-bold" >To</label>
                                <div class="col-md-8">
                                    <input type="date" id="end_date" style="margin-left: -55px" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="row">
                                <label class="col-md-5 col-form-label font-weight-bold" >Customer Name</label>
                                <div class="col-md-7">
                                    <select name="land_id" id="customerId" class="form-control dropdwon_select">
                                        <option value="" selected disabled>Select Customer</option>
                                        @foreach($allSallerName as $item)
                                        <option value="{{ $item->id }}">{{ $item->company_name }}</option>
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

                    <div class="row mt-2">
                        
                    </div>
                    <div class="row mt-4">
                        <table class="table" id="data-table">
                            <thead class="thead-dark" style="display: none">
                                <tr>
                                    <th>SL.No</th>
                                    <th>Date</th>
                                    <th>Site-Location</th>
                                    <th>Grade</th>
                                    <th>Qty</th>
                                    <th>Qty-cft</th>
                                    <th>Unit-Price</th>
                                    <th>Sub-Total</th>
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
        var startDate = $('#start_date').val();
        var endDate = $('#end_date').val();
        var customerId = $('#customerId').val();
       $.ajax({
           url: '{{ route('get_cus_totaldate_report') }}',
           method: 'GET',
           dataType: "html",
           data: { customerId ,startDate,endDate},
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


   $(document).on('click', '#print', function() {
    var startDate = $('#start_date').val();
    var endDate = $('#end_date').val();
    var customerId = $('#customerId').val();

    if (startDate && endDate && customerId) {
        window.location.href = '{{ route('get_cus_totaldate_invoice') }}' + '?start_date=' + startDate + '&end_date=' + endDate + '&customerId=' + customerId;
    } else if (customerId) {
        window.location.href = '{{ route('get_cus_totaldate_invoice') }}' + '?customerId=' + customerId;
    } else {
        alert('Please select a date range and supplier before printing.');
    }
});
</script>



































