
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="utf-8" />
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link href="{{ asset('/public/logo.png') }}" rel="icon" />
   <title>Invoice</title>
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
                       <b>Customer : {{ $info->company_name }} </b><br />
                      <b> Address: {{ $info->Address }}</b><br />
                        <b>Contact No : {{ $info->mobile_no }}</b><br />
                       
                     </address>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="row">
                <strong style="text-align: end">Date: {{ now()->format('m-d-Y') }}</strong>
            </div>
        </div>    
      </div>

   	<div class="table-responsive">
   	  <table class="table border mb-0">
            <thead style="font-weight: 600;">
               <tr class="bg-light text-center">
                  <td>SL.NO</td>
                  <td>Grade</td>
                  <td>Black-stone</td>
                  <td>mixed-builder</td>
                  <td>dubai</td>
                  <td>mm10</td>
                  <td>pcc-cement</td>
                  <td>opc-cement</td>
                  <td>beg-cement</td>			
                  <td>sand</td>			
                  <td>admixer</td>			
                  <td>bricks</td>			
               </tr>
            </thead>

            <tbody class="text-center">
                @foreach ($getdetcusReport as $item )
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->grade->name}}</td>
                    <td>{{ $item->black_stone}}</td>
                    <td>{{ $item->mixed_builder}}</td>
                    <td>{{ $item->dubai}}</td>
                    <td>{{ $item->mm10}}</td>
                    <td>{{ $item->pcc_cement }}</td>
                    <td>{{ $item->opc_cement }}</td>
                    <td>{{ $item->beg_cement }}</td>
                    <td>{{ $item->sand }}</td>
                    <td>{{ $item->admixer }}</td>
                    <td>{{ $item->bricks }}</td>
                </tr>
                @endforeach
              
               {{-- <tr class="bg-light">              
                  <th colspan="8" class="text-end">Total Amount</th>
                  <th></th>
               </tr> --}}
               
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