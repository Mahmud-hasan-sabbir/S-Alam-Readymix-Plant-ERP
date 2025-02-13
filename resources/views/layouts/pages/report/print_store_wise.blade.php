
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
            <h6 class="text-center" style="font-weight: 500;">All store Materials</h6>
         </div>
      </div>
   <hr>
   </header>
   <!-- Main Content -->

   <main>
    <div class="row">
        <div class="text-center">
           <p style="font-size: 22px; font-weight: bold; text-decoration: underline; margin-bottom: 0;">store Material</p>
          
        </div>
     </div>

   	<div class="table-responsive">
   	  <table class="table border mb-0">
            <thead>
               <tr class="bg-light text-center">
                <th>Sl. No.</th>
                <th>Material name</th>
                <th>Purchase Qty </th>
                <th>Sale Qty</th>
               </tr>
            </thead>

            <tbody class="text-center">
                @foreach ($getStoreReport as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->material->name }}</td>
                    <td>{{ $item->pur_qty }}</td>
                    <td>{{ $item->sale_qty }}</td>
                </tr>
                @endforeach

               <tr class="bg-light">

                <th></th>
                  <th  class="text-center">Total Amount =  </th>
               
                  <th>{{ $pursum }}</th>
                  <th>{{ $salesum }}</th>
                 
               </tr>
               <tr class="bg-light">

                <th></th>
                  <th  class="text-center">Available Material  =  </th>
               
                  <th>{{ $pursum - $salesum }}</th>
                  <th></th>
                 
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
      </d$v>
   </footer>
</div>


</body>
</html>

      