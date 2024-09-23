
<tr class="addr" id="landPurchaseTr">
    <td style="border-top:1px solid; border-left:0px solid; border-bottom:1px solid">
        <h6 style="font-weight: bold;padding:0px;margin:0px;text-muted" class="text-muted" id="">SL</h6>
    </td>
    <td style="border-top:1px solid; border-left:0px solid; border-bottom:1px solid">
        <h6 style="font-weight: bold;padding:0px;margin:0px;text-muted;" class="text-muted">Supplier Name:</h6>
    </td>
    <td style="border-top:1px solid; border-left:0px solid; border-bottom:1px solid">
        <h6 style="font-weight: bold;padding:0px;margin:0px;text-muted;" class="text-muted">Date:</h6>
    </td>
    <td style="border-top:1px solid; border-right:0px solid; border-bottom:1px solid;">
        <h6 style="font-weight: bold;padding:0px;margin:0px;text-muted;" class="text-muted" >Description:</h6>
    </td>
    <td style="border-top:1px solid; border-left:0px solid; border-bottom:1px solid">
        <h6 style="font-weight: bold;padding:0px;margin:0px;text-muted" class="text-muted" id="">Debit</h6>
    </td>
    <td style="border-top:1px solid; border-left:0px solid; border-bottom:1px solid">
        <h6 style="font-weight: bold;padding:0px;margin:0px;text-muted" class="text-muted" id="">Credit</h6>
    </td>


</tr>
@foreach ($getSupplierReport as $item)
<tr>
    <td>{{ $loop->iteration }}</td>
    <td>{{ $item->sallername->company_name }}</td>
    <td>{{ $item->VDate }}</td>
    <td>{{ $item->Description }}</td>
    <td>{{ $item->Debit }}</td>
    <td>{{ $item->Credit }}</td>
</tr>
@endforeach

<tr class="addr" id="landPurchaseTr">
    <td style="border-top:1px solid; border-left:0px solid; border-bottom:1px solid">
        <h6 style="font-weight: bold;padding:0px;margin:0px;text-muted" class="text-muted" id=""></h6>
    </td>
    <td style="border-top:1px solid; border-left:0px solid; border-bottom:1px solid">
        <h6 style="font-weight: bold;padding:0px;margin:0px;text-muted;" class="text-muted"></h6>
    </td>
    <td style="border-top:1px solid; border-left:0px solid; border-bottom:1px solid">
        <h6 style="font-weight: bold;padding:0px;margin:0px;text-muted;" class="text-muted"></h6>
    </td>
    <td style="border-top:1px solid; border-right:0px solid; border-bottom:1px solid;">
        <h6 style="font-weight: bold;padding:0px;margin:0px;text-muted;margin-left:235px" class="text-muted" >Total:</h6>
    </td>
    <td style="border-top:1px solid; border-left:0px solid; border-bottom:1px solid">
        <h6 style="font-weight: bold;padding:0px;margin:0px;text-muted" class="text-muted" id="alldebit"></h6>
    </td>
    <td style="border-top:1px solid; border-left:0px solid; border-bottom:1px solid">
        <h6 style="font-weight: bold;padding:0px;margin:0px;text-muted" class="text-muted" id="allcredit"></h6>
    </td>


</tr>
<tr class="addr" id="landPurchaseTr">
    <td style="border-top:1px solid; border-left:0px solid; border-bottom:1px solid">
        <h6 style="font-weight: bold;padding:0px;margin:0px;text-muted" class="text-muted" id=""></h6>
    </td>
    <td style="border-top:1px solid; border-left:0px solid; border-bottom:1px solid">
        <h6 style="font-weight: bold;padding:0px;margin:0px;text-muted;" class="text-muted"></h6>
    </td>
    <td style="border-top:1px solid; border-left:0px solid; border-bottom:1px solid">
        <h6 style="font-weight: bold;padding:0px;margin:0px;text-muted;" class="text-muted"></h6>
    </td>
    <td style="border-top:1px solid; border-right:0px solid; border-bottom:1px solid;">
        <h6 style="font-weight: bold;padding:0px;margin:0px;text-muted;margin-left:235px" class="text-muted" >amount:</h6>
    </td>
    <td style="border-top:1px solid; border-left:0px solid; border-bottom:1px solid">
        <h6 style="font-weight: bold;padding:0px;margin:0px;text-muted" class="text-muted" id="amount"></h6>
    </td>
    <td style="border-top:1px solid; border-left:0px solid; border-bottom:1px solid">
        <h6 style="font-weight: bold;padding:0px;margin:0px;text-muted" class="text-muted" id=""></h6>
    </td>


</tr>

<script>
    var alldebit = {{ $alldebit }};
    var allcredit = {{ $allcredit }};
    var alldebit = alldebit.toFixed(2);
    var allcredit = allcredit.toFixed(2);
    var amount =   alldebit - allcredit;

    document.getElementById('alldebit').innerHTML = alldebit;
    document.getElementById('allcredit').innerHTML = allcredit;
    document.getElementById('amount').innerHTML = amount;
</script>


























