
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
   <link rel="stylesheet" type="text/css" href="{{ asset('/public/bootstrap.min.css') }}">
   <link rel="stylesheet" type="text/css" href="{{ asset('/public/all.min.css') }}">
   <link rel="stylesheet" type="text/css" href="{{ asset('/public/stylesheet.css') }}">
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
            <h6 class="text-center" style="font-weight: 500;">Payment Ledger</h6>
         </div>
      </div>
   <hr>
   </header>
   <!-- Main Content -->

   <main>
      <div class="row">
         <div class="col-sm-9">
            @if($info == 'Cash')
            <span style="font-weight: 700;">Cash:</span> Cash in hand <br>
            @else
            <p>
               <span style="font-weight: 700;">Bank:</span> {{ $info->bank_name }} <br>
               <span style="font-weight: 700;">Account Number:</span> {{ $info->acc_no }} <br>
               <span style="font-weight: 700;">Branch:</span> {{$info->branch_name}} <br>
              
            </p>
            @endif
         </div>

         <div class="col-sm-3 text-end">
            <strong>Date: {{ now()->format('Y-m-d') }}</strong>
         </div>
      </div>

   	<div class="table-responsive mb-3">
   	  <table class="table border mb-0">
            <thead style="font-weight: 600;">
               <tr class="bg-light text-center">
                  <td>#</td>
                  <td>Date</td>
                  <td>Particulars</td>
                  <td>Cheque No.</td>
                  <td>Deposit</td>
                  <td>Withdraw</td>
                  <td>Balance</td>
                  <td>Remarks</td>
               </tr>
            </thead>

            <tbody class="text-center">
                <tr>
                    <td scope="col"></td>
                    <td scope="col"></td>
                    <td scope="col"></td>
                    <td scope="col"></td>
                    <td scope="col">Opening Balance</td>
                    <td scope="col"></td>
                    <td scope="col"></td>
                    <td scope="col">{{ $openBal->balance }}</td>
                </tr>

                @foreach ($getmode as $item)
                <tr>
                    <td scope="col">{{ $loop->iteration }}</td>
                    <td scope="col">{{ $item->VDate }}</td>
                    <td scope="col">{{ $item->name }}</td>
                    <td scope="col">{{ $item->UpdateBy }}</td>
                    <td scope="col">{{ $item->Description }}</td>
                    <td scope="col">{{ $item->Debit }}</td>
                    <td scope="col">{{ $item->Credit }}</td>
                    <td scope="col">{{ $item->balance }}</td>
                </tr>
                @endforeach

               

               <tr class="bg-light">
                  <th colspan="5" class="text-end">Total =</th>
           
                  <th>{{ $debitSum }}</th>
                  <th>{{ $creditSum }}</th>
                  <th>{{ $totalBalance }}</th>
                  
               </tr>
            </tbody>
   	  </table>
   	</div>

      <div class="table-responsive mt-3">
         <h6 class="text-center mb-3" style="font-weight: 700;">SUMMARY</h6>
         <table class="table table-bordered">
            <thead>
               <tr class="bg-light text-center">
                  <th width="25%">Total Received</th>
                  <th width="25%">Expense</th>
                  <th width="25%">Balance</th>
               </tr>
            </thead>
            <tbody>
               <tr class="text-center">
                  <td width="25%">{{ $debitSum }}</td>
                  <td width="25%">{{ $creditSum }}</td>
                  <td width="25%">{{ $totalBalance }}</td>
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
