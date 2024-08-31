
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
         
         <div class="col-sm-5 text-center text-sm-end">
            <h2 class="mb-0">Invoice</h2>
            <p class="mb-0">Invoice Number - 17004</p>
         </div>
      </div>
   <hr>
   </header>
   <!-- Main Content -->

   <main>
      <div class="row"> 
        <div class="col-md-6">
            <div class="row">
                <div>
                    <address>
                       <b>Supplier : {{ $info->company_name }}</b><br />
                      <b> Address: {{ $info->Address }}</b><br />
                        <b>Contact No : {{ $info->mobile_no }}</b><br />
                       
                     </address>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="row">
                <strong style="text-align: end">Date: {{ now()->format('d-m-Y') }}</strong>
            </div>
        </div>    
      </div>

   	<div class="table-responsive">
   	  <table class="table border mb-0">
            <thead style="font-weight: 600;">
               <tr class="bg-light text-center">
                  <td>SL.NO</td>
                  <td>Material</td>
                  <td>Unit</td>
                  <td>Challan-NO</td>
                  <td>Truck-NO</td>
                  <td>Truck-fee</td>
                  <td>Qty</td>
                  <td>Unit-Price</td>			
                  <td>Sub-Total</td>			
               </tr>
            </thead>

            <tbody class="text-center">
                @foreach ($details as $item )
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->material->name}}</td>
                    <td>{{ $item->unit->name}}</td>
                    <td>{{ $item->challan_no}}</td>
                    <td>{{ $item->truck_no}}</td>
                    <td>{{ $item->truck_fee }}</td>
                    <td>{{ $item->Qty }}</td>
                    <td>{{ $item->unit_price }}</td>
                    <td>{{ $item->sub_total }}</td>
                </tr>
                @endforeach
              
               <tr class="bg-light">              
                  <th colspan="8" class="text-end">Total Amount</th>
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