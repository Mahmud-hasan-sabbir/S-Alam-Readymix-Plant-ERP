
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="utf-8" />
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link href="{{ asset('/public/logo.png') }}" rel="icon" />
   <title>Invoice</title>

   <!-- Web Fonts
   ======================= -->
   {{-- <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900' type='text/css'> --}}

   <!-- Stylesheet
   ======================= -->
   <link rel="stylesheet" type="text/css" href="{{ asset('/public/bootstrap.min.css') }}">
   <link rel="stylesheet" type="text/css" href="{{ asset('/public/all.min.css') }}">
   <link rel="stylesheet" type="text/css" href="{{ asset('/public/stylesheet.css') }}">
   
</head>

<body>
<!-- Container -->
<div class="container-fluid invoice-container"> 
   <!-- Header -->
   <header>
      <div class="row align-items-center gy-3" style="margin-top: -55px">
         <div class="col-sm-7 text-center text-sm-start"> 
            <img id="logo" src="{{ asset('/public/logo.png') }}" title="Koice" alt="Koice" width="100px" />
         </div>
         
         <div class="col-sm-11 text-center text-sm-end" style="margin-top: -44px;margin-left:57px">
            <h4 class="text-center" style="font-weight: 700;">S. Alam Readymix Concrete Plant</h4>
            <h6 class="text-center" style="font-weight: 500;">All Purchases Materials</h6>
         </div>
      </div>
   <hr>
   </header>
   <!-- Main Content -->

   <main>
    <div class="row">     
        <div class="text-center">
           <p style="font-size: 22px; font-weight: bold; text-decoration: underline; margin-bottom: 0;">Purchase Material</p>
           <p>Date: {{ $formdate }} to {{ $enddate }}</p>
        </div>
     </div>

   	<div class="table-responsive">
   	  <table class="table border mb-0">
            <thead style="font-weight: 600;">
               <tr class="bg-light text-center">
                <th>SL.No</th>
                <th>Date</th>
                <th>Challan-No</th>
                <th>Truck-No</th>
                <th>Types</th>
                <th>Qty</th>
                <th>Unit-price</th>
                <th>Balance</th>			
               </tr>
            </thead>

            <tbody class="text-center">
                @foreach ($purdetails as $purchase)
                @foreach ($purchase->purchaseDetails as $item)
                <tr>
                    <td>{{ $loop->parent->iteration }}</td>
                    <td>{{ $purchase->order_date }}</td>
                    <td>{{ $item->challan_no }}</td>
                    <td>{{ $item->truck_no }}</td>
                    <td>{{ $item->material->name }}</td>
                    <td>{{ $item->Qty }}</td>
                    <td>{{ $item->unit_price }}</td>
                    <td>{{ $item->sub_total }}</td>
                
                </tr>
                @endforeach
                @endforeach
              
               <tr class="bg-light">              
                  <th colspan="7" class="text-end">Total Amount</th>
                  <th>{{ $total }}</th>
               </tr>
               
            </tbody>
   	  </table>
   	</div>

      
   </main>

  <!-- Footer -->
   <footer class="text-center">
      <p class="text-1">
         <strong>NOTE :</strong> This is computer generated receipt and does not require physical signature.
      </p>

      <div class="btn-group btn-group-sm d-print-none"> 
         <a href="javascript:window.print()" class="btn btn-light border text-black-50 shadow-none">
            <i class="fa fa-print"></i> Print & Download</a> 
      </div>
   </footer>
</div>
   
</body>
</html>