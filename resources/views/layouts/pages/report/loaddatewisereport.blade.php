


@foreach ($purchases as $purchase)
    @foreach ($purchase->purchaseDetails as $detail)
    <tr>
        <td>{{ $loop->parent->iteration }}</td>
        <td>{{ $purchase->order_date }}</td>
        <td>{{ $detail->challan_no }}</td>
        <td>{{ $detail->truck_no }}</td>
        <td>{{ $detail->material->name }}</td>
        <td>{{ $detail->Qty }}</td>
        <td>{{ $detail->unit_price }}</td>
        <td>{{ $detail->sub_total }}</td>
    </tr>
    @endforeach
@endforeach




<t-footer style="display: none">
    <tr class="addr" >
        <td style="border-top:1px solid; border-right:0px solid; border-bottom:1px solid">

        </td>
       
        <td style="border-top:1px solid; border-right:0px solid; border-bottom:1px solid;padding-top:6px;padding-bottom:6px">

        </td>
        <td style="border-top:1px solid; border-right:0px solid; border-bottom:1px solid;padding-top:6px;padding-bottom:6px">

        </td>
        <td style="border-top:1px solid; border-right:0px solid; border-bottom:1px solid;padding-top:6px;padding-bottom:6px">

        </td>
        <td style="border-top:1px solid; border-right:0px solid; border-bottom:1px solid;padding-top:6px;padding-bottom:6px">

        </td>
        <td style="border-top:1px solid; border-right:0px solid; border-bottom:1px solid;padding-top:6px;padding-bottom:6px">
            <h6 style="font-weight: bold;padding:0px;margin:0px;text-align:center;">Total Purchase Amount : </h6>
        </td>
        <td style="border-top:1px solid; border-left:0px solid; border-bottom:1px solid">
            <h6 style="font-weight: bold;padding:0px;margin:0px" id="" >
            </h6>
        </td>
        <td style="border-top:1px solid; border-left:0px solid; border-bottom:1px solid">
            <h6 style="font-weight: bold;padding:0px;margin:0px" id="totalpurchaseamount" >
            </h6>
        </td>
       
      
    </tr>
</t-footer>

<tr class="addr" >
    <td style="border-top:1px solid; border-left:0px solid; border-bottom:1px solid">
        <h6 style="font-weight: bold;padding:0px;margin:0px;text-muted" class="text-muted" id=""></h6>
    </td>
    <td style="border-top:1px solid; border-left:0px solid; border-bottom:1px solid">
        <h6 style="font-weight: bold;padding:0px;margin:0px;text-muted" class="text-muted" id=""></h6>
    </td>
    <td style="border-top:1px solid; border-left:0px solid; border-bottom:1px solid">
        <h6 style="font-weight: bold;padding:0px;margin:0px;text-muted" class="text-muted" id=""></h6>
    </td>
    <td style="border-top:1px solid; border-left:0px solid; border-bottom:1px solid">
        <h6 style="font-weight: bold;padding:0px;margin:0px;text-muted;">Payment summary:</h6>
    </td>
    <td style="border-top:1px solid; border-left:0px solid; border-bottom:1px solid">
        <h6 style="font-weight: bold;padding:0px;margin:0px;text-muted;" class="text-muted"></h6>
    </td>
    <td style="border-top:1px solid; border-right:0px solid; border-bottom:1px solid;">
        <h6 style="font-weight: bold;padding:0px;margin:0px;text-muted;" class="text-muted" ></h6>
    </td>
    <td style="border-top:1px solid; border-left:0px solid; border-bottom:1px solid">
        <h6 style="font-weight: bold;padding:0px;margin:0px;text-muted" class="text-muted" id=""></h6>
    </td>
    <td style="border-top:1px solid; border-left:0px solid; border-bottom:1px solid">
        <h6 style="font-weight: bold;padding:0px;margin:0px;text-muted" class="text-muted" id=""></h6>
    </td>


</tr>


<tr class="addr" id="landPurchaseTr">
    <td style="border-top:1px solid; border-left:0px solid; border-bottom:1px solid">
        <h6 style="font-weight: bold;padding:0px;margin:0px;text-muted" class="text-muted" id=""></h6>
    </td>
    <td style="border-top:1px solid; border-left:0px solid; border-bottom:1px solid">
        <h6 style="font-weight: bold;padding:0px;margin:0px;text-muted" class="text-muted" id=""></h6>
    </td>
    <td style="border-top:1px solid; border-left:0px solid; border-bottom:1px solid">
        <h6 style="font-weight: bold;padding:0px;margin:0px;text-muted" class="text-muted" id=""></h6>
    </td>
    <td style="border-top:1px solid; border-left:0px solid; border-bottom:1px solid">
        <h6 style="font-weight: bold;padding:0px;margin:0px;text-muted;" class="text-muted">SL.No:</h6>
    </td>
    <td style="border-top:1px solid; border-left:0px solid; border-bottom:1px solid">
        <h6 style="font-weight: bold;padding:0px;margin:0px;text-muted;" class="text-muted">Pay Date:</h6>
    </td>
    <td style="border-top:1px solid; border-right:0px solid; border-bottom:1px solid;">
        <h6 style="font-weight: bold;padding:0px;margin:0px;text-muted;" class="text-muted" >Pay Amount:</h6>
    </td>
    <td style="border-top:1px solid; border-left:0px solid; border-bottom:1px solid">
        <h6 style="font-weight: bold;padding:0px;margin:0px;text-muted" class="text-muted" id="">Pay Mode</h6>
    </td>
    <td style="border-top:1px solid; border-left:0px solid; border-bottom:1px solid">
        <h6 style="font-weight: bold;padding:0px;margin:0px;text-muted" class="text-muted" id=""></h6>
    </td>


</tr>

@foreach ($payments as $item)
<tr>
    <td></td>
    <td></td>
    <td></td>
    <td>{{ $loop->iteration }}</td>
    <td>{{ $item->pay_date }}</td>
    <td>{{ $item->pay_amount }}</td>
    <td>{{ $item->pay_mode }}</td>
    <td></td>
    
</tr>
@endforeach

<tr class="addr" id="landPurchaseTr">
    <td style="border-top:1px solid; border-left:0px solid; border-bottom:1px solid">
        <h6 style="font-weight: bold;padding:0px;margin:0px;text-muted" class="text-muted" id=""></h6>
    </td>
    <td style="border-top:1px solid; border-left:0px solid; border-bottom:1px solid">
        <h6 style="font-weight: bold;padding:0px;margin:0px;text-muted" class="text-muted" id=""></h6>
    </td>
    <td style="border-top:1px solid; border-left:0px solid; border-bottom:1px solid">
        <h6 style="font-weight: bold;padding:0px;margin:0px;text-muted" class="text-muted" id=""></h6>
    </td>
    <td style="border-top:1px solid; border-left:0px solid; border-bottom:1px solid">
        <h6 style="font-weight: bold;padding:0px;margin:0px;text-muted;" class="text-muted"></h6>
    </td>
    <td style="border-top:1px solid; border-left:0px solid; border-bottom:1px solid">
        <h6 style="font-weight: bold;padding:0px;margin:0px;text-muted;">Total Paid Payment:</h6>
    </td>
    <td style="border-top:1px solid; border-right:0px solid; border-bottom:1px solid;">
        <h6 style="font-weight: bold;padding:0px;margin:0px;text-muted;" id="totalpayment" ></h6>
    </td>
    <td style="border-top:1px solid; border-left:0px solid; border-bottom:1px solid">
        <h6 style="font-weight: bold;padding:0px;margin:0px;text-muted" class="text-muted" id=""></h6>
    </td>
    <td style="border-top:1px solid; border-left:0px solid; border-bottom:1px solid">
        <h6 style="font-weight: bold;padding:0px;margin:0px;text-muted" class="text-muted" id=""></h6>
    </td>
</tr>

<tr class="addr" >
    <td style="border-top:1px solid; border-left:0px solid; border-bottom:1px solid">
        <h6 style="font-weight: bold;padding:0px;margin:0px;text-muted" class="text-muted" id=""></h6>
    </td>
    <td style="border-top:1px solid; border-left:0px solid; border-bottom:1px solid">
        <h6 style="font-weight: bold;padding:0px;margin:0px;text-muted" class="text-muted" id=""></h6>
    </td>
    <td style="border-top:1px solid; border-left:0px solid; border-bottom:1px solid">
        <h6 style="font-weight: bold;padding:0px;margin:0px;text-muted" class="text-muted" id=""></h6>
    </td>
    <td style="border-top:1px solid; border-left:0px solid; border-bottom:1px solid">
        <h6 style="font-weight: bold;padding:0px;margin:0px;text-muted;">Bill summary:</h6>
    </td>
    <td style="border-top:1px solid; border-left:0px solid; border-bottom:1px solid">
        <h6 style="font-weight: bold;padding:0px;margin:0px;text-muted;" class="text-muted"></h6>
    </td>
    <td style="border-top:1px solid; border-right:0px solid; border-bottom:1px solid;">
        <h6 style="font-weight: bold;padding:0px;margin:0px;text-muted;" class="text-muted" ></h6>
    </td>
    <td style="border-top:1px solid; border-left:0px solid; border-bottom:1px solid">
        <h6 style="font-weight: bold;padding:0px;margin:0px;text-muted" class="text-muted" id=""></h6>
    </td>
    <td style="border-top:1px solid; border-left:0px solid; border-bottom:1px solid">
        <h6 style="font-weight: bold;padding:0px;margin:0px;text-muted" class="text-muted" id=""></h6>
    </td>


</tr>
<tr class="addr" id="landPurchaseTr">
    <td style="border-top:1px solid; border-left:0px solid; border-bottom:1px solid">
        <h6 style="font-weight: bold;padding:0px;margin:0px;text-muted" class="text-muted" id=""></h6>
    </td>
    <td style="border-top:1px solid; border-left:0px solid; border-bottom:1px solid">
        <h6 style="font-weight: bold;padding:0px;margin:0px;text-muted" class="text-muted" id=""></h6>
    </td>
    <td style="border-top:1px solid; border-left:0px solid; border-bottom:1px solid">
        <h6 style="font-weight: bold;padding:0px;margin:0px;text-muted" class="text-muted" id=""></h6>
    </td>
    <td style="border-top:1px solid; border-left:0px solid; border-bottom:1px solid">
        <h6 style="font-weight: bold;padding:0px;margin:0px;text-muted;" class="text-muted">Total Bill:</h6>
    </td>
    <td style="border-top:1px solid; border-left:0px solid; border-bottom:1px solid">
        <h6 style="font-weight: bold;padding:0px;margin:0px;text-muted;" class="text-muted">Paid Amount:</h6>
    </td>
    <td style="border-top:1px solid; border-right:0px solid; border-bottom:1px solid;">
        <h6 style="font-weight: bold;padding:0px;margin:0px;text-muted;" class="text-muted" >Balance:</h6>
    </td>
    <td style="border-top:1px solid; border-left:0px solid; border-bottom:1px solid">
        <h6 style="font-weight: bold;padding:0px;margin:0px;text-muted" class="text-muted" id="">Payment status</h6>
    </td>
    <td style="border-top:1px solid; border-left:0px solid; border-bottom:1px solid">
        <h6 style="font-weight: bold;padding:0px;margin:0px;text-muted" class="text-muted" id=""></h6>
    </td>


</tr>

<tr class="addr" >
    <td style="border-top:1px solid; border-left:0px solid; border-bottom:1px solid">
        <h6 style="font-weight: bold;padding:0px;margin:0px;text-muted" class="text-muted" id=""></h6>
    </td>
    <td style="border-top:1px solid; border-left:0px solid; border-bottom:1px solid">
        <h6 style="font-weight: bold;padding:0px;margin:0px;text-muted" class="text-muted" id=""></h6>
    </td>
    <td style="border-top:1px solid; border-left:0px solid; border-bottom:1px solid">
        <h6 style="font-weight: bold;padding:0px;margin:0px;text-muted" class="text-muted" id=""></h6>
    </td>
    <td style="border-top:1px solid; border-left:0px solid; border-bottom:1px solid">
        <h6 style="font-weight: bold;padding:0px;margin:0px;text-muted;" id="totalbil"></h6>
    </td>
    <td style="border-top:1px solid; border-left:0px solid; border-bottom:1px solid">
        <h6 style="font-weight: bold;padding:0px;margin:0px;text-muted;" id="paidamount" ></h6>
    </td>
    <td style="border-top:1px solid; border-right:0px solid; border-bottom:1px solid;">
        <h6 style="font-weight: bold;padding:0px;margin:0px;text-muted;" id="balance"  ></h6>
    </td>
    <td style="border-top:1px solid; border-left:0px solid; border-bottom:1px solid">
        <h6 style="font-weight: bold;padding:0px;margin:0px;text-muted" id="paymentstatus"></h6>
    </td>
    <td style="border-top:1px solid; border-left:0px solid; border-bottom:1px solid">
        <h6 style="font-weight: bold;padding:0px;margin:0px;text-muted"  id=""></h6>
    </td>


</tr>


<script>
    var totalpurchaseamount = {{ $totalpurchaseamount }};
    var totalpaymentamount = {{ $totalpaymentamount }};
    var balance = totalpurchaseamount - totalpaymentamount;
    var paymentstatus = balance > 0 ? 'Due' : 'Paid';
    document.getElementById('totalpurchaseamount').innerHTML = totalpurchaseamount;
    document.getElementById('totalpayment').innerHTML = totalpaymentamount;
    document.getElementById('totalbil').innerHTML = totalpurchaseamount;
    document.getElementById('paidamount').innerHTML = totalpaymentamount;
    document.getElementById('balance').innerHTML = balance;
    document.getElementById('paymentstatus').innerHTML = paymentstatus;

</script>














