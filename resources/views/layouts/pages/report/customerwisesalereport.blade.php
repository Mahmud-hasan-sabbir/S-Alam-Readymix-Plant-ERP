
<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <!-- card header -->
                <div class="card-header">
                    <h4 class="card-title">
                       Sale Report Date wise
                    </h4>
                    <div>
                        <button id="print" class="btn btn-sm btn-success"><i class="fa fa-reply"></i><span class="btn-icon-add"></span>Print</button>

                        <a href="" class="btn btn-sm btn-primary"><i class="fa fa-reply"></i><span class="btn-icon-add"></span>Back</a>
                    </div>

                </div>

                <div class="card-body">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="row">
                                    <label class="col-md-4 col-form-label font-weight-bold" >Form Date</label>
                                    <div class="col-md-8">
                                        <input type="date" name="formdate" id="fdate" style="margin-left: 10px"  class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="row">
                                    <label class="col-md-4 col-form-label font-weight-bold" >End Date</label>
                                    <div class="col-md-8">
                                        <input type="date" name="enddate" id="edate" style="margin-left: 10px"  class="form-control">
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

                        <div class="row" style="margin-top: 20px">
                            <table class="table" id="data-table">
                                <thead class="thead-dark" style="display: none">
                                    <tr>
                                        <th>SL.No</th>
                                        <th>Date</th>
                                        <th>Customer Name</th>
                                        <th>Grade</th>
                                        <th>Qty(m3)</th>
                                        <th>Qty(CFT)</th>
                                        <th>Unit price (CFT)</th>
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
        var fdate = $('#fdate').val();
        var edate = $('#edate').val();
       $.ajax({
           url: '{{ route('getcuswisesalereport') }}',
           method: 'GET',
           dataType: "html",
           data: { fdate ,edate},
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


   $(document).on('click', '#print', function(){
        var fdate = $('#fdate').val();
        var edate = $('#edate').val();
        window.location.href = '{{ route('generate_sale_invoice') }}' + '?fdate=' + fdate + '&edate=' + edate;
    });
</script>



































