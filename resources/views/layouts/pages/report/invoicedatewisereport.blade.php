
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="utf-8" />
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link href="vendor/logo.png" rel="icon" />
   <title>Invoice</title>

   <!-- Web Fonts
   ======================= -->
   <!-- <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900' type='text/css'> -->


   <link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link href="https://fonts.googleapis.com/css2?family=PT+Sans+Narrow:wght@400;700&family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

   <script src="https://kit.fontawesome.com/029b158c0c.js" crossorigin="anonymous"></script>

   <!-- Stylesheet
   ======================= -->
   <link rel="stylesheet" type="text/css" href="{{ asset('/public/bootstrap.min.css') }}"/>
   <link rel="stylesheet" type="text/css" href="{{ asset('/public/all.min.css') }}"/>
   <link rel="stylesheet" type="text/css" href="{{ asset('/public/stylesheet.css') }}"/>
</head>

<body>
<!-- Container -->
<div class="container-fluid invoice-container"> 
   <!-- Header -->
   <header>
      <div class="row align-items-center gy-3">
         <div class="col-sm-1 text-center text-sm-start"> 
            <img id="logo" src="{{ asset('/public/logo.png') }}" title="Koice" alt="Koice" width="100px" />
         </div>
         
         <div class="col-sm-11 text-center text-sm-end">
            <h4 class="text-center" style="font-weight: 700;">S. Alam Readymix Concrete Plant</h4>
            <h6 class="text-center" style="font-weight: 500;">Supplier Ledger – Delivery Basis</h6>
         </div>
      </div>
   <hr>
   </header>
   <!-- Main Content -->

   <main>
      <div class="row">
         <div class="col-sm-9">
            <p>
               <span style="font-weight: 700;">Supplier Name:</span> {{ $info->company_name }} <br>
               <span style="font-weight: 700;">Address:</span> {{ $info->Address }} <br>
               <span style="font-weight: 700;">Opening Date:</span> {{ $info->opening_date }} <br>
               <span style="font-weight: 700;">Contact Number:</span> {{ $info->mobile_no }} <br>
            </p>         
         </div>

         <div class="col-sm-3 text-end">
            <strong>Date: {{ now()->format('d-m-Y') }}</strong>
         </div>
      </div>

   	<div class="table-responsive">
   	  <table class="table border mb-0">
            <thead style="font-weight: 600;">
               <tr class="bg-light text-center">
                  <td>#</td>
                  <td>Date</td>
                  <td>Challan No.</td>
                  <td>Truck No.</td>
                  <td>Types</td>
                  <td>Quantity</td>
                  <td>Unit Rate</td>
                  <td>Balance</td>
               </tr>
            </thead>

            <tbody class="text-center">
                @foreach ($purchases as $purchase)
                @foreach ($purchase->purchaseDetails as $detail)
                <tr>
                    <td>{{ $loop->parent->iteration }}</td>
                    <td>{{ $purchase->order_date }}</td>
                    <td>{{ $detail->challan_no }}</td>
                    <td>{{ $detail->truck_no }}</td>
                    <td>{{ $detail->material->name }}</td>
                    <td>{{ $detail->Qty }}</td>
                    <td>{{ $detail->unit_price }}</td>
                    <td>{{ $detail->sub_total }}</td>
                </tr>
                @endforeach
            @endforeach

              
            </tbody>
            <t-footer style="display: none">
                <tr class="addr" >
                    <td style="border-top:1px solid; border-right:0px solid; border-bottom:1px solid">
            
                    </td>
                   
                    <td style="border-top:1px solid; border-right:0px solid; border-bottom:1px solid;padding-top:6px;padding-bottom:6px">
            
                    </td>
                    <td style="border-top:1px solid; border-right:0px solid; border-bottom:1px solid;padding-top:6px;padding-bottom:6px">
            
                    </td>
                    <td style="border-top:1px solid; border-right:0px solid; border-bottom:1px solid;padding-top:6px;padding-bottom:6px">
            
                    </td>
                    <td style="border-top:1px solid; border-right:0px solid; border-bottom:1px solid;padding-top:6px;padding-bottom:6px">
            
                    </td>
                    <td style="border-top:1px solid; border-right:0px solid; border-bottom:1px solid;padding-top:6px;padding-bottom:6px">
                        <h6 style="font-weight: bold;padding:0px;margin:0px;text-align:center;">Total Purchase Amount : </h6>
                    </td>
                    <td style="border-top:1px solid; border-left:0px solid; border-bottom:1px solid">
                        <h6 style="font-weight: bold;padding:0px;margin:0px" id="" >
                        </h6>
                    </td>
                    <td style="border-top:1px solid; border-left:0px solid; border-bottom:1px solid">
                        <h6 style="font-weight: bold;padding:0px;margin:0px" >{{ $totalpurchaseamount }}</h6>
                    </td>
                   
                  
                </tr>
            </t-footer>
   	  </table>
   	</div>

      <div class="table-responsive mt-3">
         <h6 class="text-center mb-3" style="font-weight: 700;">PAYMENT SUMMARY</h6>
         <table class="table table-bordered">
            <thead>
               <tr class="bg-light text-center">
                  <th width="25%">SL.NO</th>
                  <th width="25%">Pay Date</th>
                  <th width="25%">Pay Amount</th>
                  <th width="25%">pay mode</th>
               </tr>
            </thead>
            <tbody>
                @foreach ($payments as $item)
                <tr>
                   
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->pay_date }}</td>
                    <td>{{ $item->pay_amount }}</td>
                    <td>{{ $item->pay_mode }}</td>
                   
                    
                </tr>
                @endforeach
            </tbody>
            <t-footer style="display: none">
                <tr class="addr" >
                   
                    
                    <td style="border-top:1px solid; border-right:0px solid; border-bottom:1px solid;padding-top:6px;padding-bottom:6px">
            
                    </td>
                    <td style="border-top:1px solid; border-right:0px solid; border-bottom:1px solid;padding-top:6px;padding-bottom:6px">
                        <h6 style="font-weight: bold;padding:0px;margin:0px;text-align:center;">Total Paid Amount : </h6>
                    </td>
                    <td style="border-top:1px solid; border-left:0px solid; border-bottom:1px solid">
                        <h6 style="font-weight: bold;padding:0px;margin:0px" id="" >
                        </h6>
                    </td>
                    <td style="border-top:1px solid; border-left:0px solid; border-bottom:1px solid">
                        <h6 style="font-weight: bold;padding:0px;margin:0px" >{{ $totalpaymentamount }}</h6>
                    </td>
                   
                  
                </tr>
            </t-footer>
         </table>
      </div>

      <div class="table-responsive mt-3">
        <h6 class="text-center mb-3" style="font-weight: 700;">BILL SUMMARY</h6>
        <table class="table table-bordered">
           <thead>
              <tr class="bg-light text-center">
                 <th width="25%">Total Amount</th>
                 <th width="25%">Paid Amount</th>
                 <th width="25%">Balance</th>
                 <th width="25%">Status</th>
              </tr>
           </thead>
           <tbody>
            <tr class=" text-center">
                <?php $balance = $totalpurchaseamount - $totalpaymentamount ?>
                <th >{{ $totalpurchaseamount }}</th>
                <th >{{ $totalpaymentamount }}</th>
                <th>{{ $balance }}</th>
                <th >{{ $balance > 0 ? 'Due' : 'paid' }}</th>
             </tr>
           </tbody>
          
        </table>
     </div>
   </main>

  <!-- Footer -->
   <footer class="text-center">
      <p class="text-1">
         <strong>NOTE :</strong> This is computer generated Ledger and does not require physical signature.
      </p>

      <div class="btn-group btn-group-sm d-print-none"> 
         <a href="javascript:window.print()" class="btn btn-light border text-black-50 shadow-none">
            <i class="fa fa-print"></i> Print & Download</a> 
      </div>
   </footer>
</div>

   <!-- Back to My Account Link -->
   <p class="text-center d-print-none"><a href="#">&laquo; Back to My Account</a></p>
</body>
</html>