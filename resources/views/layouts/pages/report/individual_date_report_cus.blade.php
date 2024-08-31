
<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <!-- card header -->
                <div class="card-header">
                    <h4 class="card-title">
                    Individual Date Wise Report Customer
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
                                    <label class="col-md-4 col-form-label font-weight-bold" >Date</label>
                                    <div class="col-md-8">
                                        <input type="date" name="date" id="date" style="margin-left: 10px"  class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="row">
                                    <label class="col-md-4 col-form-label font-weight-bold">Customer Name</label>
                                    <div class="col-md-8">
                                        <select name="supplier_id" id="customerId" class="form-control dropdwon_select">
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

                        <div class="row" style="margin-top: 20px">
                            <table class="table" id="data-table">
                                <thead class="thead-dark" style="display: none">
                                    <tr>
                                        <th>SL.No</th>
                                        <th>Grade</th>
                                        <th>Black-Stone</th>
                                        <th>Mixed-Builder</th>
                                        <th>Dubai</th>
                                        <th>MM10</th>
                                        <th>Pcc-Cement</th>
                                        <th>Opc-Cement</th>
                                        <th>Beg-Cement</th>
                                        <th>Sand</th>
                                        <th>Admixer</th>
                                        <th>Bricks</th>

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
        var date = $('#date').val();
        var customerId = $('#customerId').val();
       $.ajax({
           url: '{{ route('dete_cus_report') }}',
           method: 'GET',
           dataType: "html",
           data: { date ,customerId},
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
        var date = $('#date').val();
        var customerId = $('#customerId').val();
        window.location.href = '{{ route('generate_cus_invoice') }}' + '?date=' + date + '&customerId=' + customerId;
    });
</script>



































