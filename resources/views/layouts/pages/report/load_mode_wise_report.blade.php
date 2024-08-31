
<tr>
    <td scope="col"></td>
    <td scope="col"></td>
    <td scope="col"></td>
    <td scope="col">Opening Balance</td>
    <td scope="col"></td>
    <td scope="col"></td>
    <td scope="col">{{ $openBal->balance }}</td>
</tr>



@foreach ($getmode as $item )
<tr>
    <td scope="col">{{ $loop->iteration }}</td>
    <td scope="col">{{ $item->VDate }}</td>
    <td scope="col">{{ $item->UpdateBy}}</td>
    <td scope="col">{{ $item->Description}}</td>
    <td scope="col">{{ $item->Debit}}</td>
    <td scope="col">{{ $item->Credit}}</td>
    <td scope="col">{{ $item->balance }}</td>
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
            <h6 style="font-weight: bold;padding:0px;margin:0px">Total</h6>
        </td>
        <td style="border-top:1px solid; border-left:0px solid; border-bottom:1px solid">
            <h6 style="font-weight: bold;padding:0px;margin:0px" id="debitSumDisplay" >
            </h6>
        </td>
        <td style="border-top:1px solid; border-left:0px solid; border-bottom:1px solid">
            <h6 style="font-weight: bold;padding:0px;margin:0px" id="creditSumDisplay" >
            </h6>
        </td>
         <td style="border-top:1px solid; border-left:0px solid; border-bottom:1px solid">
            <h6 style="font-weight: bold;padding:0px;margin:0px" id="totalBalance" >
            </h6>
        </td>
        <td style="border-top:1px solid; border-left:0px solid; border-bottom:1px solid">

        </td>
    </tr>
</t-footer>


<script>
    var debitsum = {{ $debitSum }};
    var creditsum = {{ $creditSum }};
    var totalBalance = {{ $totalBalance }};
    document.getElementById('debitSumDisplay').innerHTML = debitsum.toFixed(2);
    document.getElementById('creditSumDisplay').innerHTML = creditsum.toFixed(2);
    document.getElementById('totalBalance').innerHTML = totalBalance.toFixed(2);

</script>









