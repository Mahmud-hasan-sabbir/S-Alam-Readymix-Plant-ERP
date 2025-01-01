
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
<div class="container-fluid invoice-container" style="max-width: 1020px !important; width: 1020px !important; margin: 0 auto;"> 
   <!-- Header -->
   <header>
      <div class="row align-items-center gy-3">
         <div class="col-sm-1 text-center text-sm-start"> 
            <img id="logo" src="{{ asset('/public/logo.png') }}" title="Koice" alt="Koice" width="100px" />
         </div>
         
         <div class="col-sm-11 text-center text-sm-end">
            <h4 class="text-center" style="font-weight: 700;">S. Alam Readymix Concrete Plant</h4>
            <h6 class="text-center" style="font-weight: 500;">Consumption Report</h6>
         </div>
      </div>
   <hr>
   </header>
   <!-- Main Content -->

   <main>
      <div class="row">     
         <div class="text-center">
            <p style="font-size: 22px; font-weight: bold; text-decoration: underline; margin-bottom: 0;">Consumption Report</p>
            <p>Date: {{ $startdate }} to {{ $enddate }}</p>
         </div>
      </div>

   	<div class="table-responsive">

   	  <table class="table border mb-0">
            <thead style="font-weight: 600;">               
               <tr class="bg-light text-center">
                <th>#</th>
                <th>Date</th>
                <th>Customer Name</th>
                <th>Grade</th>
                <th>Qty</th>
                <th>Admixer</th>
                <th>10MM</th>
                <th>Mexed Builder</th>
                <th>Balack Stone</th>
                <th>Dubai</th>
                <th>Sand</th>
                <th>pcc_cement</th>
                <th>opc_cement</th>
                <th>beg_cement</th>
                <th>Bricks</th>
               </tr>
            </thead>

            <tbody class="text-center">
                @foreach ($consumptions as $item)
                <tr>
                    <td scope="col">{{ $loop->iteration }}</td>
                    <td scope="col">{{ $item->date }}</td>
                    <td scope="col">{{ $item->customer->company_name}}</td>
                    <td scope="col">{{ $item->grade->name}}</td>
                    <td scope="col">{{ $item->quantity}}</td>
                    <td scope="col">{{ $item->admixer}}</td>
                    <td scope="col">{{ $item->mm10}}</td>
                    <td scope="col">{{ $item->mixed_builder}}</td>
                    <td scope="col">{{ $item->black_stone}}</td>
                    <td scope="col">{{ $item->dubai}}</td>
                    <td scope="col">{{ $item->sand}}</td>
                    <td scope="col">{{ $item->pcc_cement}}</td>
                    <td scope="col">{{ $item->opc_cement}}</td>
                    <td scope="col">{{ $item->beg_cement}}</td>
                    <td scope="col">{{ $item->bricks}}</td>
                </tr>
                @endforeach

                <tr class="bg-light">              
                    <th colspan="4" class="text-end">Total =</th>
                    <th>{{ $totalqty != 0 ? $totalqty : '' }}</th>
                    <th>{{ $admixer != 0 ? $admixer : '' }}</th>
                    <th>{{ $mm10 != 0 ? $mm10 : '' }}</th>
                    <th>{{ $mixed_builder != 0 ? $mixed_builder : '' }}</th>
                    <th>{{ $totalblackstone != 0 ? $totalblackstone : '' }}</th>
                    <th>{{ $dubai != 0 ? $dubai : '' }}</th>
                    <th>{{ $sand != 0 ? $sand : '' }}</th>
                    <th>{{ $pcc_cement != 0 ? $pcc_cement : '' }}</th>
                    <th>{{ $opc_cement != 0 ? $opc_cement : '' }}</th>
                    <th>{{ $beg_cement != 0 ? $beg_cement : '' }}</th>
                    <th>{{ $bricks != 0 ? $bricks : '' }}</th>
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
  
</body>
</html>