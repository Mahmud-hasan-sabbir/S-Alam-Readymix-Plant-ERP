
<x-app-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <!-- card header -->
                <div class="card-header">
                    <h4 class="card-title">
                     Advanced Salary Report
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
                                <label class="col-md-4 col-form-label font-weight-bold" >Month</label>
                                <div class="col-md-8">
                                    <select name="month" id="month" required class="form-control">
                                        <option value="" selected disabled >Select a Month</option>
                                        <option value="January">January</option>
                                        <option value="February">February</option>
                                        <option value="March">March</option>
                                        <option value="April">April</option>
                                        <option value="May">May</option>
                                        <option value="June">June</option>
                                        <option value="July">July</option>
                                        <option value="August">August</option>
                                        <option value="September">September</option>
                                        <option value="October">October</option>
                                        <option value="November">November</option>
                                        <option value="December">December</option>
                                    </select>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-5">
                            <div class="row">
                                <label class="col-md-4 col-form-label font-weight-bold" >Year : </label>
                                <div class="col-md-8">
                                    <input type="text" id="year" required class="form-control font-weight-bold" readonly value="{{ date('Y') }}" name="year" style="border: none;margin-left:-105px;margin-top:-3px">
                                </div>
                            </div>

                        </div>

                        <div class="col-md-2">
                            <div class="row">
                                <div class="col-md-8">
                                    <button type="submit" id="filter" class="btn btn-success btn-sm" style="margin-left: -290px">Filter</button>
                                </div>
                            </div>
                        </div>
                    </div>




                    <div class="row mt-4">
                        <table class="table" id="data-table">
                            <thead class="thead-dark" style="display: none">
                                <tr>
                                    <th>SL.No</th>
                                    <th>Employee Name</th>
                                    <th>Month</th>
                                    <th>Year</th>
                                    <th>Mode</th>
                                    <th>Advanced Salary</th>
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
       var month = $('#month').val();
       var year = $('#year').val();
       $.ajax({
           url: '{{ route('get_advanced_salary_report') }}',
           method: 'GET',
           dataType: "html",
           data: { month, year },
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



































