




@foreach ($getpaidSalary as $item )
<tr>
    <td scope="col">{{ $loop->iteration }}</td>
    <td scope="col">{{ $item->employee->company_name }}</td>
    <td scope="col">{{ $item->month}}</td>
    <td scope="col">{{ $item->year}}</td>
    <td scope="col">{{ $item->pay_mode}}</td>
    <td scope="col">{{ $item->adv_salary}}</td>
    <td scope="col">{{ $item->paid_salary}}</td>
   
</tr>
@endforeach


<t-footer style="display: none">
    <tr class="addr" >
        <td style="border-top:1px solid; border-right:0px solid; border-bottom:1px solid">

        </td>
        <td style="border-top:1px solid; border-right:0px solid; border-bottom:1px solid">

        </td>

        <td style="border-top:1px solid; border-right:0px solid; border-bottom:1px solid;padding-top:6px;padding-bottom:6px">

        </td>
        <td style="border-top:1px solid; border-right:0px solid; border-bottom:1px solid;padding-top:6px;padding-bottom:6px">

        </td>
        <td style="border-top:1px solid; border-right:0px solid; border-bottom:1px solid;padding-top:6px;padding-bottom:6px">
            <h6 style="font-weight: bold;padding:0px;margin:0px;text-align:center;margin-left:175px">Total</h6>
        </td>
        <td style="border-top:1px solid; border-left:0px solid; border-bottom:1px solid">
            <h6 style="font-weight: bold;padding:0px;margin:0px" id="" >
            </h6>
        </td>
        <td style="border-top:1px solid; border-left:0px solid; border-bottom:1px solid">
            <h6 style="font-weight: bold;padding:0px;margin:0px" id="debitSumDisplay" >
            </h6>
        </td>
       
      
    </tr>
</t-footer>

<script>
    var totalpaid = {{ $totalpaid }};
    document.getElementById('debitSumDisplay').innerHTML = totalpaid;
</script>












