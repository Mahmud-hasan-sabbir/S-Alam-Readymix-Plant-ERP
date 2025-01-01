
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
               <span style="font-weight: 700;">Opening Date:</span> {{ date('d-m-Y', strtotime($info->opening_date)) }} <br>
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
                    <th>Sl. No.</th>
                    <th>Date</th>
                    <th>Location</th>
                    <th>Grade</th>
                    <th>Qty</th>
                    <th>Qty (Cft)</th>
                    <th>Unit Price</th>
                    <th>Total</th>
               </tr>
            </thead>

            <tbody class="text-center">
                @foreach ($data as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ date('d-m-y', strtotime($item->date)) }}</td>
                    <td>{{ $item->Address }}</td>
                    <td>{{ $item->grade }}</td>
                    <td>{{ $item->qty_m3 }}</td>
                    <td>{{ $item->qty_cft }}</td>
                    <td>{{ number_format($item->unit_price_cft) }}</td>
                    <td>{{ $item->sub_total }}</td>
                </tr>
                @endforeach
            </tbody>

            <t-footer>
                <tr class="bg-light text-center">
                    <th colspan="4" class="text-end">Total Sales</th>
                    <th>{{ $totalsumqty }}</th>
                    <th>{{ $totalsumqtycft }}</th>
                    <th>-</th>
                    <th>{{ $formattedTotalamount }}</th>
                </tr>
            </t-footer>
   	  </table>
   	</div>

      <div class="table-responsive mt-4">
         <h6 class="text-center mb-3" style="font-weight: 700;">Payment History</h6>
         <table class="table table-bordered">
            <thead>
                <tr class="bg-light text-center">
                    <th width="10%">Sl. No.</th>
                    <th width="30%">Pay Date</th>
                    <th width="30%">Pay Mode</th>
                    <th width="30%">Pay Amount</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($payments as $item)
                <tr class="text-center">
                   
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ date('d-m-y', strtotime($item->pay_date)) }}</td>
                    <td>{{ $item->pay_mode }}</td>
                    <td>{{ number_format($item->pay_amount) }}</td>
                </tr>
                @endforeach
            </tbody>

            <t-footer>
                <tr class="bg-light">
                    <th colspan="3" class="text-end">Total Paid Amount :</th>
                    <th class="text-center">{{ number_format($totalpaidamount) }}</th>
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
                <?php 
                    // Remove commas and convert to float
                    $numericTotalAmount = floatval(str_replace(',', '', $formattedTotalamount));
                    $numericTotalPaidAmount = floatval(str_replace(',', '', $totalpaidamount));

                    // Calculate balance
                    $balance = $numericTotalAmount - $numericTotalPaidAmount;
                ?>
               <tr class="text-center">
                <th>{{ number_format($numericTotalAmount, 2) }}</th> <!-- Format back with commas for display -->
                <th>{{ number_format($numericTotalPaidAmount, 2) }}</th>
                <th>{{ number_format($balance, 2) }}</th>
                <th>
                    <!-- {{ $balance > 0 ? 'Due' : 'Paid' }} -->

                    @if($balance < 0)
                        Advance
                    @elseif($balance > 0)
                        Dues
                    @else
                        Paid
                    @endif
                </th>
            </tr>
             </tr>
           </tbody>
          
        </table>
     </div>
   </main>

  <!-- Footer -->
   <footer class="text-center">
      <p class="text-1">
         <strong>NOTE :</strong> This is Computer Generated Ledger and does not require any physical signature.
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