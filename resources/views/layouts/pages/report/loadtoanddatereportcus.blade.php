

@foreach ($data as $item)
<tr>
    <td scope="col">{{ $loop->iteration }}</td>
    <td scope="col">{{ $item->date }}</td>
    <td scope="col">{{ $item->Address}}</td>
    <td scope="col">{{ $item->grade}}</td>
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

    <td style="border-top:1px solid; border-right:0px solid; border-bottom:1px solid;padding-top:6px;padding-bottom:6px">

    </td>
    <td style="border-top:1px solid; border-right:0px solid; border-bottom:1px solid;padding-top:6px;padding-bottom:6px">

    </td>
    <td style="border-top:1px solid; border-right:0px solid; border-bottom:1px solid;padding-top:6px;padding-bottom:6px">
        <h6 style="font-weight: bold;padding:0px;margin:0px;text-align:center;">Total : </h6>
    </td>
    <td style="border-top:1px solid; border-right:0px solid; border-bottom:1px solid;padding-top:6px;padding-bottom:6px">
        <h6 style="font-weight: bold;padding:0px;margin:0px" id="totalqty" >
        </h6>
    </td>
    <td style="border-top:1px solid; border-right:0px solid; border-bottom:1px solid;padding-top:6px;padding-bottom:6px">
        <h6 style="font-weight: bold;padding:0px;margin:0px" id="totalqtycft" >
        </h6>
    </td>
    <td style="border-top:1px solid; border-left:0px solid; border-bottom:1px solid">
        <h6 style="font-weight: bold;padding:0px;margin:0px" id="" >
        </h6>
    </td>
    <td style="border-top:1px solid; border-left:0px solid; border-bottom:1px solid">
        <h6 style="font-weight: bold;padding:0px;margin:0px" id="totalsub" >
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
    var totalpaymentamount = {{ $totalpaidamount }}; // Ensure this is a number
    var formattedTotalamount = '{{ $formattedTotalamount }}'.replace(/,/g, ''); // Remove commas
    var totalsumqty = '{{ $totalsumqty }}';
    var totalsumqtycft = '{{ $totalsumqtycft }}';

    // Convert formattedTotalamount to a float
    var totalAmountNumber = parseFloat(formattedTotalamount);

    // Calculate balance
    var balance = totalAmountNumber - totalpaymentamount;
    
    // Determine payment status
    var paymentstatus = balance > 0 ? 'Due' : 'Paid';

    // Update the DOM with values
    document.getElementById('totalpayment').innerHTML = totalpaymentamount;
    document.getElementById('totalqty').innerHTML = totalsumqty;
    document.getElementById('totalqtycft').innerHTML = totalsumqtycft;
    document.getElementById('totalsub').innerHTML = formattedTotalamount;
    document.getElementById('totalbil').innerHTML = formattedTotalamount;
    document.getElementById('paidamount').innerHTML = totalpaymentamount;
    document.getElementById('balance').innerHTML = balance.toFixed(2); 
    document.getElementById('paymentstatus').innerHTML = paymentstatus;
</script>
