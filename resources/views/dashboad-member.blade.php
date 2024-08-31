
<x-app-layout>



<div class="row" style="margin-top: 25px">
    <button type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample" style="height: 132px;border:none;margin-left:60px">
        <div class="">
            <div class="widget-stat card bg-primary">
                <div class="card-body ">
                    <div class="media">
                        <span class="mr-3">
                            <i class="la la-users"></i>
                        </span>
                        <div class="media-body text-white">
                            <p class="mb-1">Ploat Wise Report</p>
                            <h3 class="text-white"></h3>
                            <div class="progress mb-2 bg-secondary">
                                <div class="progress-bar progress-animated bg-light" style="width: 80%"></div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
       </button>

      <button type="button" data-toggle="collapse" data-target="#memberfees" aria-expanded="false" aria-controls="collapseExample" style="height: 132px;border:none;margin-left:60px">
        <div class="">
            <div class="widget-stat card bg-primary">
                <div class="card-body ">
                    <div class="media">
                        <span class="mr-3">
                            <i class="la la-users"></i>
                        </span>
                        <div class="media-body text-white">
                            <p class="mb-1">Member Fees</p>
                            <h3 class="text-white"></h3>
                            <div class="progress mb-2 bg-secondary">
                                <div class="progress-bar progress-animated bg-light" style="width: 80%"></div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
       </button>
       <button type="button"   style="height: 132px;border:none;margin-left:62px">
        <div class="">
            <div class="widget-stat card bg-primary">
                <div class="card-body ">
                    <div class="media">
                        <span class="mr-3">
                            <i class="la la-users"></i>
                        </span>
                        <div class="media-body text-white">
                            <p class="mb-1">Due Amount</p>
                            <h3 class="text-white" id="due"></h3>
                            <div class="progress mb-2 bg-secondary">
                                <div class="progress-bar progress-animated bg-light" style="width: 80%"></div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
       </button>





    <div class="col-md-12">
        <div class="row" style="margin-top: 14px;margin-left:15px">
              <div class="collapse" id="collapseExample" style="margin-top: 15px;width:100%">
                <div class="card card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                             <div class="col-md-6">
                                 <div class="row">
                                     <label for="" class="col-md-4 text-muted" style="font-size: 15px">Land Name : </label>
                                     <div class="col-md-8">
                                         <label for="" class="text-muted" style="font-size: 15px;">{{ $CS_number }},{{ $RS_number }},{{ $SA_number }},{{ $BRS_number }},{{ $mouza_number }}</label>
                                     </div>
                                 </div>
                             </div>

                             {{-- <div class="col-md-6">
                                 <div class="row">
                                      <label for="" class="col-md-4 text-muted" style="font-size: 14px">Ploat No : </label>
                                     <div class="col-md-8">
                                     <label for="" class="text-muted" style="font-size: 15px">{{ $plot_no }}</label>
                                     </div>
                                 </div>
                             </div> --}}


                            </div>
                            <div class="row">
                                 <table style="width: 100%">
                                     <thead style="background: darkslategrey;color: white;">

                                             <td>Date</td>
                                             <td>Description</td>
                                             <td>Plot No</td>
                                             <td>Plot Area</td>
                                             <td>Amount(DR)</td>
                                             <td>Amount(CR)</td>

                                     </thead>
                                     <tbody>
                                         @foreach ($memberwisereport as $info )
                                             <tr>
                                                 <td>{{ $info->VDate }}</td>
                                                 <td>{{ $info->Description }}</td>
                                                 <td>{{ $info->ploat_id }}</td>
                                                 <td>{{ $info->StoreID }}</td>
                                                 <td>{{ $info->Debit }}</td>
                                                 <td>{{ $info->Credit }}</td>
                                             </tr>
                                         @endforeach

                                     </tbody>
                                     <tfoot>
                                         <tr id="">
                                             <td style="border-top:1px solid; border-right:0px solid; border-bottom:1px solid">
                                                 <h6 style="font-weight: bold;padding:0px;margin:0px;" class="text-muted"></h6>
                                             </td>
                                             <td style="border-top:1px solid; border-right:0px solid; border-bottom:1px solid">
                                                 <h6 style="font-weight: bold;padding:0px;margin:0px;text-muted;text-align:end" id="landPurchase" class="text-muted">Total Amount :  </h6>
                                             </td>
                                             <td style="border-top:1px solid; border-right:0px solid; border-bottom:1px solid">
                                                 <h6 style="font-weight: bold;padding:0px;margin:0px;" class="text-muted" id=""></h6>
                                             </td>
                                             <td style="border-top:1px solid; border-right:0px solid; border-bottom:1px solid">
                                                <h6 style="font-weight: bold;padding:0px;margin:0px;" class="text-muted" id=""></h6>
                                            </td>

                                             <td style="border-top:1px solid; border-right:0px solid; border-bottom:1px solid;padding-top:6px;padding-bottom:6px">
                                                 <h6 style="font-weight: bold;padding:0px;margin:0px;text-muted" id="totalamount" class="text-muted" >
                                                 </h6>
                                             </td>
                                             <td style="border-top:1px solid; border-right:0px solid; border-bottom:1px solid;padding-top:6px;padding-bottom:6px">
                                                <h6 style="font-weight: bold;padding:0px;margin:0px;text-muted" id="" class="text-muted" >
                                                </h6>
                                            </td>
                                         </tr>
                                         <tr id="">
                                             <td style="border-top:1px solid; border-right:0px solid; border-bottom:1px solid">
                                                 <h6 style="font-weight: bold;padding:0px;margin:0px;" class="text-muted"></h6>
                                             </td>
                                             <td style="border-top:1px solid; border-right:0px solid; border-bottom:1px solid">
                                                 <h6 style="font-weight: bold;padding:0px;margin:0px;text-muted;text-align:end" id="landPurchase" class="text-muted">Payment :  </h6>
                                             </td>
                                             <td style="border-top:1px solid; border-right:0px solid; border-bottom:1px solid">
                                                 <h6 style="font-weight: bold;padding:0px;margin:0px;" class="text-muted"></h6>
                                             </td>
                                             <td style="border-top:1px solid; border-right:0px solid; border-bottom:1px solid">
                                                <h6 style="font-weight: bold;padding:0px;margin:0px;" class="text-muted" id=""></h6>
                                            </td>

                                             <td style="border-top:1px solid; border-right:0px solid; border-bottom:1px solid;padding-top:6px;padding-bottom:6px">
                                                 <h6 style="font-weight: bold;padding:0px;margin:0px;text-muted" id="totalCreditSum" class="text-muted" >
                                                 </h6>
                                             </td>
                                             <td style="border-top:1px solid; border-right:0px solid; border-bottom:1px solid;padding-top:6px;padding-bottom:6px">
                                                <h6 style="font-weight: bold;padding:0px;margin:0px;text-muted" id="" class="text-muted" >
                                                </h6>
                                            </td>
                                         </tr>
                                         <tr id="">
                                             <td style="border-top:1px solid; border-right:0px solid; border-bottom:1px solid">
                                                 <h6 style="font-weight: bold;padding:0px;margin:0px;" class="text-muted"></h6>
                                             </td>
                                             <td style="border-top:1px solid; border-right:0px solid; border-bottom:1px solid">
                                                 <h6 style="font-weight: bold;padding:0px;margin:0px;text-muted;text-align:end" id="landPurchase" class="text-muted">Due :  </h6>
                                             </td>
                                             <td style="border-top:1px solid; border-right:0px solid; border-bottom:1px solid">
                                                 <h6 style="font-weight: bold;padding:0px;margin:0px;" class="text-muted"></h6>
                                             </td>
                                             <td style="border-top:1px solid; border-right:0px solid; border-bottom:1px solid">
                                                <h6 style="font-weight: bold;padding:0px;margin:0px;" class="text-muted" id=""></h6>
                                            </td>

                                             <td style="border-top:1px solid; border-right:0px solid; border-bottom:1px solid;padding-top:6px;padding-bottom:6px">
                                                 <h6 style="font-weight: bold;padding:0px;margin:0px;text-muted" id="dueAmount" class="text-muted" >
                                                 </h6>
                                             </td>
                                             <td style="border-top:1px solid; border-right:0px solid; border-bottom:1px solid;padding-top:6px;padding-bottom:6px">
                                                <h6 style="font-weight: bold;padding:0px;margin:0px;text-muted" id="" class="text-muted" >
                                                </h6>
                                            </td>
                                         </tr>
                                       </tfoot>
                                 </table>
                            </div>
                         </div>


                        </div>

                </div>
              </div>
        </div>
            <!-- member fees collaps view-->
            <div class="row" style="margin-top: 14px;margin-left:15px">
                <div class="collapse" id="memberfees" style="margin-top: 15px;width:100%">
                  <div class="card card-body">
                      <div class="row">
                          <div class="col-md-12">
                              <div class="row">
                               <div class="col-md-6">
                                   <div class="row">
                                       <label for="" class=" text-muted" style="font-size: 15px">Member Fees : </label>

                                   </div>
                               </div>


                              </div>

                              <div class="row">
                                   <table style="width: 100%">
                                       <thead style="background: darkslategrey;color: white;">

                                               <td>Date</td>
                                               <td>Description</td>
                                               <td>Amount(DR)</td>

                                       </thead>
                                       <tbody>
                                           @foreach ($memberfees as $info )
                                               <tr>
                                                   <td>{{ $info->VDate }}</td>
                                                   <td>{{ $info->Description }}</td>
                                                   <td>{{ $info->Credit }}</td>

                                               </tr>
                                           @endforeach

                                       </tbody>
                                       <tfoot>
                                           <tr id="">
                                               <td style="border-top:1px solid; border-right:0px solid; border-bottom:1px solid">
                                                   <h6 style="font-weight: bold;padding:0px;margin:0px;" class="text-muted"></h6>
                                               </td>
                                               <td style="border-top:1px solid; border-right:0px solid; border-bottom:1px solid">
                                                   <h6 style="font-weight: bold;padding:0px;margin:0px;text-muted;text-align:end" id="landPurchase" class="text-muted">Total Member Fees :  </h6>
                                               </td>
                                               <td style="border-top:1px solid; border-right:0px solid; border-bottom:1px solid">
                                                   <h6 style="font-weight: bold;padding:0px;margin:0px;" class="text-muted" id="membertotalfees"></h6>
                                               </td>


                                           </tr>


                                         </tfoot>
                                   </table>
                              </div>
                           </div>

                      </div>
                  </div>
                </div>
          </div>

    </div>





</div>

</x-app-layout>

<script>
    var totalDebit = {{ $totalDebit }};
    var totalCreditSum = {{ $totalCreditSum }};
    var dueAmount = totalDebit - totalCreditSum;
    var membertotalfees = {{ $membertotalfees }}
    document.getElementById('totalamount').innerHTML = totalDebit;
    document.getElementById('totalCreditSum').innerHTML = totalCreditSum;
    document.getElementById('dueAmount').innerHTML = dueAmount;
    document.getElementById('membertotalfees').innerHTML = membertotalfees;
    document.getElementById('due').innerHTML = dueAmount;


</script>







