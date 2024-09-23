


@foreach ($purchases as $purchase)
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

        </td>
        <td style="border-top:1px solid; border-right:0px solid; border-bottom:1px solid;padding-top:6px;padding-bottom:6px">
            <h6 style="font-weight: bold;padding:0px;margin:0px;text-align:center;">Total Discount : </h6>
        </td>
        <td style="border-top:1px solid; border-left:0px solid; border-bottom:1px solid">
            <h6 style="font-weight: bold;padding:0px;margin:0px" id="" >
            </h6>
        </td>
        <td style="border-top:1px solid; border-left:0px solid; border-bottom:1px solid">
            <h6 style="font-weight: bold;padding:0px;margin:0px" id="totaldiscout" >
            </h6>
        </td>


    </tr>
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

        </td>
        <td style="border-top:1px solid; border-right:0px solid; border-bottom:1px solid;padding-top:6px;padding-bottom:6px">
            <h6 style="font-weight: bold;padding:0px;margin:0px;text-align:center;">Payble Amount : </h6>
        </td>
        <td style="border-top:1px solid; border-left:0px solid; border-bottom:1px solid">
            <h6 style="font-weight: bold;padding:0px;margin:0px" id="" >
            </h6>
        </td>
        <td style="border-top:1px solid; border-left:0px solid; border-bottom:1px solid">
            <h6 style="font-weight: bold;padding:0px;margin:0px" id="payableamount" >
            </h6>
        </td>


    </tr>
</t-footer>

<script>
    var totalsub = {{ $total }};
    var totaldiscount = {{ $totaldiscount }};
    var payableamount = totalsub - totaldiscount;
    document.getElementById('debitSumDisplay').innerHTML = Number(totalsub).toFixed(2);
    document.getElementById('totaldiscout').innerHTML = Number(totaldiscount).toFixed(2);
    document.getElementById('payableamount').innerHTML = Number(payableamount).toFixed(2);
</script>












