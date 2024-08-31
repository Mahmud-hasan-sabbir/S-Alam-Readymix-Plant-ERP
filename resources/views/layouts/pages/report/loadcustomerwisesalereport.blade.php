@foreach ($detail as $item)
<tr>
    <td scope="col">{{ $loop->iteration }}</td>
    <td scope="col">{{ $item->invoice->inv_no }}</td>
    <td scope="col">{{ $item->grade->name}}</td>
    <td scope="col">{{ $item->location}}</td>
    <td scope="col">{{ $item->qty_m3}}</td>
    <td scope="col">{{ $item->qty_cft}}</td>
    <td scope="col">{{ $item->unit_price_cft}}</td>
    <td scope="col">{{ $item->sub_total}}</td>
</tr>
@endforeach

<t-footer style="display: none">
<tr class="addr" >
    <td style="border-top:1px solid; border-right:0px solid; border-bottom:1px solid">

    </td>
    <td style="border-top:1px solid; border-right:0px solid; border-bottom:1px solid">

    </td>
    <td style="border-top:1px solid; border-right:0px solid; border-bottom:1px solid">

    </td>
    <td style="border-top:1px solid; border-right:0px solid; border-bottom:1px solid">

    </td>
  
    <td style="border-top:1px solid; border-right:0px solid; border-bottom:1px solid;padding-top:6px;padding-bottom:6px">

    </td>
    <td style="border-top:1px solid; border-right:0px solid; border-bottom:1px solid;padding-top:6px;padding-bottom:6px">
        <h6 style="font-weight: bold;padding:0px;margin:0px;text-align:center;">Total Amount : </h6>
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
    var formattedTotalamount = '{{ $formattedTotalamount }}';
    document.getElementById('debitSumDisplay').innerHTML = formattedTotalamount;
</script>

