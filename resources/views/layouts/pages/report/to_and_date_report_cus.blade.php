
<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <!-- card header -->
                <div class="card-header bg-primary">
                    <h4 class="card-title">Sales Balance Sheet</h4>

                    <button id="print" class="btn btn-sm btn-success"><i class="fa fa-reply"></i><span class="btn-icon-add"></span>Print</button>
                </div>

                <!-- card body -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <label class="form-label font-weight-bold" >Form <span class="text-primary font-weight-bold">*</span></label>
                            <input type="date" id="start_date" class="form-control">
                        </div>

                        <div class="col-md-3">
                            <label class="form-label font-weight-bold">To <span class="text-primary font-weight-bold">*</span></label>
                            <input type="date" id="end_date" class="form-control">
                        </div>

                        <div class="col-md-5">
                            <label class="form-label font-weight-bold" >Customer Name <span class="text-primary font-weight-bold">*</span></label>
                            <select name="land_id" id="customerId" class="form-control dropdwon_select">
                                <option value="" selected disabled>Select Customer</option>
                                @foreach($allSallerName as $item)
                                <option value="{{ $item->id }}">{{ $item->company_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-1" style="margin-top: 31px">
                            <button type="submit" id="filter" class="btn btn-success btn-sm">Search</button>
                        </div>
                    </div>

                    <div class="row mt-2">
                        
                    </div>
                    <div class="row mt-4">
                        <table class="table text-center" id="data-table">
                            <thead class="thead-dark" style="display: none">
                                <tr>
                                    <th>SL. No.</th>
                                    <th>Date</th>
                                    <th>Location</th>
                                    <th>Grade</th>
                                    <th>Qty</th>
                                    <th>Cft</th>
                                    <th>Unit Price</th>
                                    <th>Total</th>
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



































